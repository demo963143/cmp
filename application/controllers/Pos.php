<?php
require_once APPPATH . 'third_party/Zend/Barcode.php';
// use Zend\Barcode\Object;
class Pos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->vars(array('activemn' => 'pos'));
		$this->load->model('category_model', 'category');
		$this->load->model('product_model', 'product');
		$this->load->model('client_model', 'client');
		$this->load->model('posale_model', 'posale');
		$this->load->model('service_model', 'service');
		$this->load->model('register_model', 'register_m');
		$this->load->model('user_model', 'user_m');
		$this->load->model('color_model', 'color');
		$this->load->model('store_model','store');
		$this->load->library('zend');
		 $this->load->model('sale_model','sale');
        $this->zend->load('Zend/Barcode');
		$this->register = $this->session->userdata('register') ? $this->session->userdata('register') : 1;
		$this->store_id = $this->session->userdata('store_id');
		$this->user_name = $this->user_m->get_by_id($this->session->userdata('user_id'))->name;
		$this->load->helper('language');
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
		//$this->load->library('Bulksmsnigeria');	
	}
	
	
	public function index()
	{
	   // print_r($this->session->userdata('delivery_free_limit')); die;
	   //echo"<pre>";print_r($this->db);die;
	   
		$this->load->model('sale_model', 'sale');
		// print_r($this->session->userdata());die;
		if (!$this->session->userdata('register')) {
			redirect('pos/openregister');
		}
		
		$data['activbmregister'] = true;
		$data['posales'] = $this->posale->get_all(array('parent' => false, 'register' => $this->register, 'store_id' => $this->store_id));
		
        $data['categories'] = $this->category->get_all();
        
		$data['products'] =  $this->product->get_datatables();
		
		//$data['products'] =  $this->product->get_all();
        
		$data['clients'] =  $this->client->get_all();
		$data['colors'] =  $this->color->get_all();
		
		$data['count_sale'] = $this->sale->count_all(array('created_at' => date('Y-m-d')));
		
		$data['sum_sale_day'] = $this->sale->sum_sale(array('created_at' => date('Y-m-d')));
		
		$data['content_page'] = $this->load->view('pos/pos', $data, true);
		$this->load->view('tpl/template', $data);
	}
	
	//------load_product--------------
	public function load_product($id = null)
	{
		$data = '';
		if (!empty($id)) {
			$products =  $this->product->get_by_category($id);
		} else {
			$products =  $this->product->get_all();
		}
		if ($products) {
			foreach ($products as $product) :

				$data .= '<a href="javascript:void(0)" class="btn btn-light default mb-1 mr-1 addPct addPctlead-' . $product->id . '" style="padding-left:5px!important; padding-right:5px!important; padding-bottom:5px!important; text-align:center; width: 23%!important; border-top:4px solid #138496; height:100px" id="' . $product->num . '" onclick="add_prodpos(' . "'" . $product->id . "'" . ')">
											<div class="card-body text-center p-1">';


				$type = substr($product->icon, strrpos($product->icon, '.') + 0);
				if ($type == '.svg') {

					$data .= '<img class="mt-1 mb-1" src="' . base_url() . '/files/svg/' . $product->icon . '" width="45%">';
				} else {

					$data .= '<i class="' . $product->icon . '" style="font-size: 30px;"></i>';
				}

				$data .= '<p class="card-text mb-0">' . $product->name . '</p>
                                                <input type="hidden" id="idname-' . $product->id . '" name="name" value="' . $product->name . '" />
                                                <input type="hidden" id="category" name="category" value="' . $product->category_id . '" />
                                            </div>
                                        </a>';
			endforeach;
		} else {
			$data .= '<div id="" style="overflow: hidden; width: 95%; height: 220px; margin: 20px"><div class="messageVide">' . display('empty') . ' <span></span></div></div>';
		}
		echo $data;
	}
	
	
	
	/*---------------------------*/
	
	public function add_prodcart()
	{
		if ($this->input->post('idproduct')) {
			$cart['product_cart'] = $this->input->post('idproduct');
			$cart['product_name'] = $this->input->post('name');
			$this->session->set_userdata($cart);
		}
	}
	public function add_typeone()
	{
		if ($this->input->post('selectype1')) {
			$cart['selectype1_cart'] = $this->input->post('selectype1');
			$this->session->set_userdata($cart);
		}
	}
	public function add_typetow()
	{
		if ($this->input->post('selectype2')) {
			$cart['selectype2_cart'] = $this->input->post('selectype2');
			$this->session->set_userdata($cart);
		}
	}



    public function add_posale()
    {
        
        if ($this->input->post('color')) {
            
            $posale['product_id'] = $this->session->userdata('product_cart');
            $posale['product_name'] = $this->session->userdata('product_name');
            $posale['type_one'] = $this->session->userdata('selectype1_cart');
            $posale['type_second'] = $this->session->userdata('selectype2_cart');
            $pricecart = $this->session->userdata('selectype1_cart') . $this->session->userdata('selectype2_cart');
         
            $pricecartMap = [
                'lroningnormal' => 'ironingnormal',
                'laundryfast' => 'laundryexpress',
                'lroningfast' => 'ironingexpress',
                'laundrylroningnormal' => 'laundryironnormal',
                'laundrylroningfast' => 'laundryironexpress',
                'drynormal' => 'drywashnormal',
                'dryfast' => 'drywashexpress',
            ];
            $pricecart = $pricecartMap[$pricecart] ?? $pricecart;
            
    
            $product = $this->product->get_by_id($this->session->userdata('product_cart'));
           
            $state = $this->session->userdata('store_id'); 
    
            $priceField = isset($product->$pricecart) ? json_decode($product->$pricecart, true) : [];
            $price = 0;
    
            foreach ($priceField as $entry) {
                if (in_array($state, $entry['franchise'])) {
                    $price = $entry['inr'];
                    break;
                }
            }
            
              if($pricecart == 'laundrynormal'){
                $getServic = $this->getService(['service_id'=>23]);
                $icon = $getServic['msg']['icon']; 
              }
              if($pricecart == 'laundryexpress'){
                  $getServic = $this->getService(['service_id'=>27]);
                  $icon = $getServic['msg']['icon']; 
              }
              if($pricecart == 'ironingnormal'){
                  $getServic = $this->getService(['service_id'=>24]);
                  $icon = $getServic['msg']['icon']; 
              }
              if($pricecart == 'ironingexpress'){
                  $getServic = $this->getService(['service_id'=>28]);
                  $icon = $getServic['msg']['icon']; 
              }
              if($pricecart == 'laundryironnormal'){
                  $getServic = $this->getService(['service_id'=>25]); 
                  $icon = $getServic['msg']['icon']; 
              }
              if($pricecart == 'laundryironexpress'){
                   $getServic = $this->getService(['service_id'=>29]);
                   $icon = $getServic['msg']['icon']; 
              }
              if($pricecart == 'drywashnormal'){
                   $getServic = $this->getService(['service_id'=>26]);
                   $icon = $getServic['msg']['icon']; 
              }
              if($pricecart == 'drywashexpress'){
                   $getServic = $this->getService(['service_id'=>30]);
                   $icon = $getServic['msg']['icon']; 
              }
            
            
            $other = $this->session->userdata('selectype1_cart');

            if($other == 'other'){
                $quantity = $this->input->post('qtecart');
                $subtotal = $price * $quantity;
                $delivery_amount = $this->session->userdata('delivery_amount');
                $posale['delivery_amount'] = $delivery_amount;
                $posale['price'] = $price;
                $posale['total'] = $subtotal;
                $posale['color'] = $this->input->post('color');
                $posale['quantity'] = $quantity;
                $posale['register'] = $this->register;
                $posale['store_id'] = $state;
                $posale['user_id'] = $this->session->userdata('user_id');
                $this->posale->save($posale);
                $array_session = ['product_cart', 'product_name', 'selectype1_cart', 'selectype2_cart'];
                $this->session->unset_userdata($array_session);
            }
            
            if($price == 0){
                
            }else{
                $quantity = $this->input->post('qtecart');
                $subtotal = $price * $quantity;
                $delivery_amount = $this->session->userdata('delivery_amount');
                $posale['delivery_amount'] = $delivery_amount;
                $posale['price'] = $price;
                $posale['total'] = $subtotal;
                $posale['color'] = $this->input->post('color');
                $posale['quantity'] = $quantity;
                $posale['register'] = $this->register;
                $posale['store_id'] = $state;
                $posale['service_icon'] = $icon;
                $posale['icon_status'] = 3;
                $posale['user_id'] = $this->session->userdata('user_id');
                $this->posale->save($posale);
                $array_session = ['product_cart', 'product_name', 'selectype1_cart', 'selectype2_cart'];
                $this->session->unset_userdata($array_session);
          }
        
        }
        
        
        if($this->input->post('laundry') == "laundry"){
           if ($this->input->post('color')) {
            $proname = 'Laundry By Kilo';
            $product = $this->product->get_kilo_by_id($proname);
            $posale['product_id'] = $product->id;
            $posale['product_name'] = $product->name;
            $posale['type_one'] = $this->session->userdata('selectype1_cart');
            $posale['type_second'] = $this->session->userdata('selectype2_cart');
            $pricecart = $this->session->userdata('selectype1_cart') . $this->session->userdata('selectype2_cart');
            $pricecartMap = [
                'lroningnormal' => 'ironingnormal',
                'laundryfast' => 'laundryexpress',
                'lroningfast' => 'ironingexpress',
                'laundrylroningnormal' => 'laundryironnormal',
                'laundrylroningfast' => 'laundryironexpress',
                'drynormal' => 'drywashnormal',
                'dryfast' => 'drywashexpress',
            ];
            $pricecart = $pricecartMap[$pricecart] ?? $pricecart;
            $product = $this->product->get_by_id($posale['product_id']);
            $state = $this->session->userdata('store_id'); 
            $priceField = isset($product->$pricecart) ? json_decode($product->$pricecart, true) : [];
            $price = 0;
            foreach ($priceField as $entry) {
                if (in_array($state, $entry['franchise'])) {
                    $price = $entry['inr'];
                    break;
                }
            }
            $other = $this->session->userdata('selectype1_cart');
            if($other == 'other'){
                 $quantity = $this->input->post('qtecart');
                $subtotal = $price * $quantity;
                $delivery_amount = $this->session->userdata('delivery_amount');
                $posale['delivery_amount'] = $delivery_amount;
                $posale['price'] = $price;
                $posale['total'] = $subtotal;
                $posale['color'] = $this->input->post('color');
                $posale['quantity'] = $quantity;
                $posale['register'] = $this->register;
                $posale['store_id'] = $state;
                $posale['user_id'] = $this->session->userdata('user_id');
                $this->posale->save($posale);
                $array_session = ['product_cart', 'product_name', 'selectype1_cart', 'selectype2_cart'];
                $this->session->unset_userdata($array_session);
            }
            
            if($price == 0){
                
            }else{
                $quantity = $this->input->post('qtecart');
                $subtotal = $price * $quantity;
                $delivery_amount = $this->session->userdata('delivery_amount');
                $posale['delivery_amount'] = $delivery_amount;
                $posale['price'] = $price;
                $posale['total'] = $subtotal;
                $posale['color'] = $this->input->post('color');
                $posale['quantity'] = $quantity;
                $posale['register'] = $this->register;
                $posale['store_id'] = $state;
                $posale['icon_status'] = 3;
                $posale['user_id'] = $this->session->userdata('user_id');
                $this->posale->save($posale);
                $array_session = ['product_cart', 'product_name', 'selectype1_cart', 'selectype2_cart'];
                $this->session->unset_userdata($array_session);
          }
        }  
           
        }
        
        
    }


    

	
	public function add_service()
	{
		if ($this->input->post('service_id')) {
			$dbposale = $this->posale->get_by_id(array('id' => $this->input->post('posale_id')));
			$dbservice = $this->service->get_by_id($this->input->post('service_id'));
			$dbpricing = $this->service->get_pricing($this->input->post('service_id'), $dbposale->product_id);

			$posale['product_id'] = $this->input->post('service_id');
			$posale['parent'] = $this->input->post('posale_id');
			$posale['quantity'] = $dbposale->quantity;
			$posale['price'] = $dbpricing->pricing;
			$posale['total'] = $dbpricing->pricing * $dbposale->quantity;
			$posale['product_name'] = $dbservice->name;
			$posale['register'] = $this->register;
			$posale['store_id'] = $this->session->userdata('store_id');
			$posale['user_id'] = $this->session->userdata('user_id');
			$this->posale->save($posale);
		}
	}
	
	public function edit_posale($id, $type)
	{
		$dbposale = $this->posale->get_by_id(array('id' => $id));
		$services = $this->posale->get_all(array('parent' => $id));

		if ($type == 'increment') {
			$total = $dbposale->total + $dbposale->price;
			$quantity = $dbposale->quantity + 1;
		} elseif ($type == 'decrement') {
			$total = $dbposale->total - $dbposale->price;
			$quantity = $dbposale->quantity - 1;
			if ($dbposale->quantity == 1) {
				$quantity = 1;
				$total = $dbposale->total;
			}
		}
		foreach ($services as $service) {
			if ($type == 'increment') {
				$total_srv = $service->total + $service->price;
				$quantity_srv = $service->quantity + 1;
			} elseif ($type == 'decrement') {
				$total_srv = $service->total - $service->price;
				$quantity_srv = $service->quantity - 1;
				if ($service->quantity == 1) {
					$quantity_srv = 1;
					$total_srv = $service->total;
				}
			}
			$this->posale->update_service(array('quantity' => $quantity_srv, 'total' => $total_srv), $service->id, $id);
		}
		$this->posale->update(array('quantity' => $quantity, 'total' => $total), $id);

		echo json_encode(array(
			"status" => TRUE
		));
	}
	
    //	27/01/2025
    // 	public function load_posales()
    // 	{
    // 		$setting = settings()->currency;
    // 		$posales = $this->posale->get_all(array('parent' => false, 'register' => $this->register, 'store_id' => $this->store_id));
    // 		$data = '';
    // 		if ($posales) {
    // 			foreach ($posales as $posale) {
    // 				$product = $this->product->get_by_id($posale->product_id);
    // 				$storeid = $this->session->userdata('store_id');
    // 				$services = $this->posale->get_all(array('parent' => $posale->id, 'register' => $this->register, 'store_id' => $this->store_id));
    
    // 				if ($posale->price > 0) {
    // 					$posale_price = $posale->price . '' . settings()->currency;
    // 				} else {
    // 					$posale_price = '';
    // 				}
    // 				$row = '<div class="row mt-2 pb-1" style="border-bottom:1px dotted #138496">
    // 				 <div class="col-md-3">
    // 							 <div>' . $product->name . ' : <span class="value">' . $product->category_name . '</span></div>
    // 							 <div> '.display('color').': <span class="value">' . $posale->color . '</span></div>
    
    // 				 </div>
    // 				 <div class="col-md-3">
    // 							 <div>' .display($posale->type_one). ': <span class="value">' . display($posale->type_second) . '</span><br>' . $posale_price . ' </div>
    // 				 </div>
    				 
    // 				 <div class="col-md-2 text-center">
    // 					 <span class="font-weight-bold">' . $posale->quantity . '</span>
    // 				 </div>
    // 				 <div class="col-md-2 text-center">';
    // 				if ($posale->total > 0) {
    // 					$row .= '<span class="font-weight-bold">' . number_format((float)$posale->total, settings()->decimals, '.', '') . '</span>';
    // 				}
    
    // 				$row .= '</div>
    // 				 <div class="col-md-1 text-center">
    // 				 <span class="font-weight-bold"><a href="javascript:void(0)" onclick="delete_posale(' . "'" . $posale->id . "'" . ')"><div class="glyph-icon simple-icon-trash text-danger"></div></a></span>
    // 				 </div>
    // 				 <div class="col-md-12">';
    // 				foreach ($services as $service) {
    // 					$row .= '<a href="javascript:void(0)" onclick="delete_posale(' . $service->id . ')"><span class="badge badge-pill badge-success mb-1"><i class="glyph-icon simple-icon-close"></i> ' . $service->product_name . ' (' . $service->total . ') ' . settings()->currency . '</span></a>';
    // 				}
    				
    // 				$row .= '</div>
    // 				 <div class="col-md-12"><a href="javascript:void(0)" onclick="edit_posale(' . "'" . $posale->id . "','increment'" . ')"><span class="btn btn-light default mr-1">+</span></a><a href="javascript:void(0)" onclick="edit_posale(' . "'" . $posale->id . "','decrement'" . ')"><span class="btn btn-light default ">-</span></a>
    // 				 <a href="#servicemodal" class="green" id="custId" data-toggle="modal" data-id="' . $posale->id . '"><span class="btn btn-success default">' . display('add_services') . '</span></a>
    				 
    // 				 </div>
    // 			 </div>';
    // 				$data .= $row;
    // 			}
    // 		} else {
    // 			$data = '<br><span class="m-5 text-center col-md-12"> ' . display('empty') . ' </span>';
    // 		}
    // 		echo $data;
    // 	}
	
	
	public function load_posales()
    {
        $setting = settings()->currency;
    
        $posales = $this->posale->get_all(array('parent' => false, 'register' => $this->register, 'store_id' => $this->store_id));
        $data = '';
        if ($posales) {
            foreach ($posales as $posale) {
                $product = $this->product->get_by_id($posale->product_id);
                $storeid = $this->session->userdata('store_id');
                $services = $this->posale->get_all(array('parent' => $posale->id, 'register' => $this->register, 'store_id' => $this->store_id));
                
                //print_r($services); die;
                
                if ($posale->price > 0) {
                    $posale_price = $posale->price . '' . settings()->currency;
                } else {
                    $posale_price = '';
                }
    
                $row = '<div class="row mt-2 pb-1" style="border-bottom:1px dotted #138496">
                     <div class="col-3">
                         <div>' . $product->name . ' : <span class="value">' . $product->category_name . '</span></div>
                         <div> ' . display('color') . ': <span class="value">' . $posale->color . '</span></div>
                     </div>
                     <div class="col-3">
                         <div>' . display($posale->type_one) . ': <span class="value">' . display($posale->type_second) . '</span><br>' . $posale_price . ' </div>
                     </div>
                     
                     <div class="col-2 text-center">
                         <span class="font-weight-bold">' . $posale->quantity . '</span>
                     </div>
                     <div class="col-2 text-center">';
    
                if ($posale->total > 0) {
                    $row .= '<span class="font-weight-bold">' . number_format((float)$posale->total, settings()->decimals, '.', '') . '</span>';
                }
    
                $row .= '</div>
                     <div class="col-2">
                         <span class="font-weight-bold"><a href="javascript:void(0)" onclick="delete_posale(' . "'" . $posale->id . "'" . ')"><div class="far fa-trash-alt text-danger"></div></a></span>
                     </div>
                     <div class="col-md-12">';
    
                // foreach ($services as $service) {
                //     	if ($service->additional_product == 1) {
                //     	    $row .= '<a href="javascript:void(0)" onclick="delete_posale(\'' . $service->id . '\')"><span class="badge badge-pill badge-success mb-1"><i class="glyph-icon simple-icon-close"></i> ' . $service->product_name . ' (' . $service->quantity . ') </span></a>';
                //     	}else {
                //         $row .= '<a href="javascript:void(0)" onclick="delete_posale(' . $service->id . ')"><span class="badge badge-pill badge-success mb-1"><i class="glyph-icon simple-icon-close"></i> ' . $service->service_name . ' (' . $service->total . ') ' . settings()->currency . '</span></a>';
                //     	}
                // }
                
                foreach ($services as $service) {
                    $display_value = is_null($service->type_one) ? $service->total : $service->quantity;
                    $display_name = is_null($service->type_one) ? $service->service_name : $service->product_name;
                    $row .= '<a href="javascript:void(0)" onclick="delete_posale(' . $service->id . ')"><span class="badge badge-pill badge-success mb-1"><i class="glyph-icon simple-icon-close"></i> ' . $display_name . ' (' . $display_value . ') ' . settings()->currency . '</span></a>';
                }
                
                
                
    
                $row .= '</div>
                     <div class="col-md-12 mt-1">
                         <a href="javascript:void(0)" onclick="edit_posale(' . "'" . $posale->id . "','increment'" . ')"><span style="margin-bottom:5px;" class="btn btn-outline-success default btn-xs mr-1"><i class="fa fa-plus"></i></span></a>
                         <a href="javascript:void(0)" onclick="edit_posale(' . "'" . $posale->id . "','decrement'" . ')"><span style="margin-bottom:5px;" class="btn btn-outline-danger default btn-xs"><i class="fa fa-minus"></i></span></a>
                         <a href="#servicemodal" class="green" id="custId" data-toggle="modal" data-id="' . $posale->id . '"><span style="margin-bottom:5px;" class="btn btn-success default btn-xs"><i class="fa fa-plus"></i> ' .'Services'. '</span></a>';
    
                // Adding condition for "Laundry By Kilo"
                if ($product->name == 'Laundry By Kilo') {
                    $row .= '<a class="ml-2" href="#laundrybykilomodal" class="green" id="custId" data-toggle="modal" data-id="' . $posale->id . '"><span style="margin-bottom:5px;" class="btn btn-success default btn-xs"><i class="fa fa-plus"></i> Product</span></a>';
                }
                
                $row .= '<a class="ml-2 product_notesdata green" href="#noteslomodal" id="custId" data-toggle="modal" data-id="' . $posale->id . '"><span style="margin-bottom:5px;" class="btn btn-success default btn-xs"><i class="fa fa-plus"></i> Notes</span></a>';
                
                $row .= '<a class="ml-2 product_imagesdata green" href="#imagesmodel" id="custId" data-toggle="modal" data-id="' . $posale->id . '"><span style="margin-bottom:5px;" class="btn btn-success default btn-xs"><i class="fa fa-plus"></i> Images</span></a>';

                
                $row .= '</div>
                 </div>';
    
                $data .= $row;
            }
        } else {
            $data = '<br><span class="m-5 text-center col-md-12"> ' . display('empty') . ' </span>';
        }
        echo $data;
    }

	
	
	public function service_list(){
	   
	    try{
	         if($this->input->method() == 'post') {
        		
    		    $proId = $this->input->post('product_id');
    		    $posId = $this->input->post('posale_id');
    		    $serId = $this->input->post('service_id');
    		    
    		    $posale = $this->posale->get_by_id(array('id' => $posId));
    		    
    			$product = $this->product->get_by_id($proId);
    			
    		    $services = json_decode($product->service);
    		    
    		    $lists = isset($services->{$serId})? $services->{$serId} : [];
    		    
    		    $getServices = $this->getService(['service_id'=>$serId]);
    		   // print_r($getServices); die;
    		    
    		    //$getServices = $this->service->service_get_row(['id' => $serId]);

    		    $total = 0;
    		    $qty = 0;
    		    $franchieService = [];
    		    $service_name = '';
    		    $service_icon = '';
    		    if($getServices['status']){
    		        $service_name = $getServices['msg']['name'];
    		        $service_icon = $getServices['msg']['icon'];
    		       
    		    }
    		   
    		    
    		    foreach($lists as $pri){
    		        foreach($pri->franchise as $code){
    		            if($code==$posale->store_id){
             		        $total +=$pri->inr;
            		        $qty+=1;
            		        array_push($franchieService,$pri);
    		            }
    		        }

    		    }
    		    // print_r($franchieService);die;
    			$pos['product_id'] = $proId;
    			$pos['parent'] = $posId;
    			$pos['price'] = $total;
    			$pos['total'] = $total;
    			$pos['service'] = json_encode($franchieService);
    			$pos['quantity'] = $qty;
    			$pos['product_name'] = $product->name;
    			$pos['service_name'] = $service_name;
    			  $pos['service_icon'] = $service_icon;
    			  $pos['icon_status'] = 2;
    			$pos['register'] = $this->register;
    			$pos['store_id'] = $this->session->userdata('store_id');
    			$pos['user_id'] = $this->session->userdata('user_id');
    			$this->posale->save($pos);
    			
    			
                /*
        		$posales = $this->posale->get_all(array('parent' => $posId));
        	    $data = '';
        		$i = 0;
        		foreach ($posales as $posale) {
        		    
                	$lists = json_decode($posale->service);
            		foreach ($lists as $key=>$list) {
            			$i++;
            			$data .= '<tr>
                					<th scope="row">' . $i . '</th>
                					<td>' . implode(',',$list->franchise) . '</td>
                					<td>1</td>
                					<td>' . number_format((float)$list->inr, settings()->decimals, '.', '') . '</td>
                					<td>' . number_format((float)$list->inr, settings()->decimals, '.', '') . '</td>
                					<td><a href="javascript:void(0)" onclick="delete_posale_service('.$posId.','. $posale->id .','.$key.')"><div class="glyph-icon simple-icon-trash text-danger"></div></a></td>
                				</tr>';
            		}
                    
        		}
        		*/
        		
        		echo $pos;
    			
    	       
	         }
    	       
	    }catch(Exception $e){
    
    	        echo json_encode([
                  'status'=>False,
                  'msg'=>$e->getMessage()
                ]);
    	 }
	}
	
    

	
	
	public function servicemodal()
	{

		if ($this->input->post('posall_id')) {
		
			$posaleId = $this->input->post('posall_id');
			$posale = $this->posale->get_by_id(array('id' => $this->input->post('posall_id')));
	
			$product = $this->product->get_by_id($posale->product_id);
			
			$data = '';
			$data .= '<span>' . $product->name . ' (' . $posale->quantity . ') ' . display($posale->type_one) . ' - ' . display($posale->type_second) . '</span>';
		
			/*
			foreach ($services as $service) {
				$data .= '<div class="form-group col-4">
				<a href="javascript:void(0)" onclick="add_service(' . "'" . $service->id . "','" . $posale->id . "'" . ')"><button type="button" class="btn btn-light  btn-lg mb-1 w-100 text-center default" style="border-top:4px solid #138496;" id="">' . $service->name . '</button></a>
			    </div>';
			}
			*/
			$services = json_decode($product->service);
			

			$serviceIds = [];

	        foreach($services as $k=>$v){
	           foreach($v as $s){
	               //$arr = (array)$s;
	               //if($arr['inr']){
	               //    if(!in_array($k,$serviceIds)){
	               //        array_push($serviceIds,$k);
	               //    }
	               //}
	               foreach($s->franchise as $code){
	                   if($code==$posale->store_id){
	                        array_push($serviceIds,$k);
	                   }
	               }
	           }
	        }
	        $uniqueServiceIds = array_unique($serviceIds);
	        
	
		    
		   	$data .='<div class="row mt-3">';
		   	if(!empty($services)){

    			$allServices = $this->allService(['service_ids'=>$uniqueServiceIds]);
    			
    			if($allServices['status'] && count($allServices['msg'])){
                    foreach($allServices['msg'] as $ser){
        				$data .= '<div class="form-group col-4">
        				<a href="javascript:void(0)" onclick="service_list('.$product->id.','.$ser['id'].','.$posaleId.')">
        				<button type="button" class="btn btn-light  btn-lg mb-1 w-100 text-center default" 
        				style="border-top:4px solid #138496;" id="">'.$ser['name'].'</button></a>
        			    </div>';    
                    } 
    			    
    			}
		   	}
			$data .= '</div>';
			echo $data;
		}
	}
	
	
	
	
	public function demo_servicemodal()
    {
     if ($this->input->post('posall_id')) {
        $posaleId = $this->input->post('posall_id');
        $posale = $this->posale->get_by_id(['id' => $posaleId]);
        $product = $this->product->get_by_id($posale->product_id);
        $data = '';
        $data .= '<span>' . $product->name . ' (' . $posale->quantity . ') ' . display($posale->type_one) . ' - ' . display($posale->type_second) . '</span>';
        $services = json_decode($product->service);
        $serviceIds = [];
        if (!empty($services)) {
                foreach ($services as $k => $v) {
                    foreach ($v as $s) {
                        foreach ($s->franchise as $code) {
                            if ($code == $posale->store_id) {
                                array_push($serviceIds, $k);
                            }
                        }
                    }
                }
            }
            $uniqueServiceIds = array_unique($serviceIds);
            $data .= '<div class="row mt-3">';
            if (!empty($uniqueServiceIds)) {
                $allServices = $this->service->service_get_all(['id' => $uniqueServiceIds]);
                foreach ($allServices as $ser) {
                    $data .= '<div class="form-group col-4">
                        <a href="javascript:void(0)" onclick="service_list(' . $product->id . ',' . $ser->id . ',' . $posaleId . ')">
                            <button type="button" class="btn btn-light btn-lg mb-1 w-100 text-center default" style="border-top:4px solid #138496;">
                                ' . $ser->name . '
                            </button>
                        </a>
                    </div>';
                }
            }
            $data .= '</div>';
            echo $data;
        }
    }
	
	


    
    public function productemodal()
    {
        if ($this->input->post('posall_id')) {
            $posaleId = $this->input->post('posall_id');
            $posale = $this->posale->get_by_id(array('id' => $posaleId));
            if ($posale) {
                $id = $posale->store_id;
                $products = $this->product->get_product_model($id);
                $productHTML = '';
                foreach ($products as $index => $product) {
                    $productHTML .= '<tr style="display:none">';
                    $productHTML .= '<td class="product_name_model">' . htmlspecialchars($product->name) . '</td>';
                    $productHTML .= '<td>
                                            <input type="hidden" id="product_quantity_' . $product->id . '" class="form-control product_quantity_model" min="0" value="0" style="width: 50px; display: inline-block; text-align: center;">
                                            <input type="hidden" class="form-control product_id_model" value="' . $product->id . '">
                                            <input type="hidden" class="form-control product_storeid_model" value="' . $id . '">
                                            <input type="hidden" class="form-control product_parent_model" value="' . $posaleId . '">
                                            <input type="hidden" class="form-control product_register_model" value="' . $posale->register . '">
                                            
                                             <input type="hidden" class="form-control product_serviceicon_model" value="' . $posale->service_icon . '">
                                             <input type="hidden" class="form-control product_color_model" value="' . $posale->color . '">
                                             <input type="hidden" class="form-control product_type_one_model" value="' . $posale->type_one . '">
                                             <input type="hidden" class="form-control product_type_second_model" value="' . $posale->type_second . '">
                                            
                                        </td>';
                    $productHTML .= '</tr>';
                }
                echo $productHTML;
                return;
            } else {
                echo '<tr><td colspan="3">Error: Posale not found.</td></tr>';
                return;
            }
        } else {
            echo '<tr><td colspan="3">Error: No POS all ID provided.</td></tr>';
            return;
        }
    }
    
    
    public function productSearchbymodel()
    {
        $search = $this->input->post('term');
        $parent = $this->input->post('parent');
        $register = $this->input->post('register');
        $id = $this->session->userdata('store_id');
        
        $serviceicon = $this->input->post('serviceicon');
        $color = $this->input->post('color');
        $typeone = $this->input->post('typeone');
        $typeseconde = $this->input->post('typeseconde');
        
        
        if (empty($search) || empty($id)) {
            echo json_encode(['status' => false, 'message' => 'Invalid input data.']);
            return;
        }
        $products = $this->product->get_product_model_search($id, $search); 
        $productData = array(); 
        foreach ($products as $product) {
            $productData[] = array(
                'id' => $product->id,
                'name' => $product->name,
                'parent' => $parent,
                'register' => $register,
                'store_id' => $id,
                'serviceicon' => $serviceicon,
                'color' => $color,
                'typeone' => $typeone,
                'typeseconde' => $typeseconde,
            );
        }

        echo json_encode(['status' => true, 'products' => $productData]); 
    }
    
    
    
    
    
    
    
    public function productemodal_listAdd()
    {
        $products = $this->input->post('products'); 
        
        if (!empty($products)) {
            foreach ($products as $product) {
                $productName = $product['name'];
                $productQuantity = $product['quantity'];
                $productId = $product['productid'];
                $storeId = $product['storeid'];
                $register = $product['register'];
                $parentid = $product['parentid'];
                
                $serviceicon = $product['serviceicon'];
                $color = $product['color'];
                $typeone = $product['typeone'];
                $typeseconde = $product['typeseconde'];
                
                $pos = [
                    'product_name' => $productName,
                    'quantity' => $productQuantity,
                    'product_id' => $productId,
                    'store_id' => $storeId,
                    'parent' => $parentid,
                    'register' => $register,
                    'additional_product' => 1,
                    'icon_status' => 3,
                    'color' => $color,
                    'service_icon' => $serviceicon,
                    'type_one' => $typeone,
                    'type_second' => $typeseconde,
                    'user_id' => $this->session->userdata('user_id'),
                ];
    			$this->posale->save($pos);
                // echo '<pre>';
                // print_r($pos);
                // echo '</pre>';
            }
    
           // die; 
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No valid product data received.']);
        }
    }





	
	
	private function allService($postData){
        try {
            
           // $url = 'https://laundroklean.meshink.xyz/super-admin/api/service';
            $url = 'https://laundroklean.meshink.xyz/software/Api/products/service';
            
            $curl = curl_init($url);
            // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($curl, CURLOPT_HTTPHEADER, [
            //     'Content-Type: application/json', // Optional, based on API requirements
            // ]);
            
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST,true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
              'Content-Type: application/x-www-form-urlencoded'
            ]);

            $response = curl_exec($curl);
            
            if (curl_errno($curl)) {
                $errorMessage = curl_error($curl);
                curl_close($curl);
                return $errorMessage;
            }else{
                    $responseData = json_decode($response, true);

                    if (json_last_error() === JSON_ERROR_NONE) {
                        return $responseData; // Output the response if it's valid JSON
                    } else {
                        return 'Response is not valid JSON: ' . $response;
                    }
            }


            
        } catch (Throwable $e) {
           
            return $e->getMessage();
        }
	}
	
	
	private function getService($postData){
	    
        try {
           //  $url = 'https://laundroklean.meshink.xyz/super-admin/api/getServicedata';

            $url = 'https://laundroklean.meshink.xyz/software/Api/products/getService';
            
            $curl = curl_init($url);
            // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($curl, CURLOPT_HTTPHEADER, [
            //     'Content-Type: application/json', // Optional, based on API requirements
            // ]);
            
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST,true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
              'Content-Type: application/x-www-form-urlencoded'
            ]);

            $response = curl_exec($curl);
            
            if (curl_errno($curl)) {
                $errorMessage = curl_error($curl);
                curl_close($curl);
                return $errorMessage;
            }else{
                    $responseData = json_decode($response, true);

                    if (json_last_error() === JSON_ERROR_NONE) {
                        return $responseData; // Output the response if it's valid JSON
                    } else {
                        return 'Response is not valid JSON: ' . $response;
                    }
            }


            
        } catch (Throwable $e) {
           
            return $e->getMessage();
        }
	}
	
	/*
	public function load_service_posale2($posale_id = null)
	{
		$posales = $this->posale->get_all(array('parent' => $posale_id));
		$i = 0;
		$data = '<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col"> ' . display('service') . '</th>
					<th scope="col"> ' . display('quantity') . '</th>
					<th scope="col"> ' . display('price') . ' ' . settings()->currency . '</th>
					<th scope="col"> ' . display('total') . ' ' . settings()->currency . '</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>';
		foreach ($posales as $posale) {
			$i++;
			$data .= '<tr>
					<th scope="row">' . $i . '</th>
					<td>' . $posale->product_name . '</td>
					<td>' . $posale->quantity . '</td>
					<td>' . number_format((float)$posale->price, settings()->decimals, '.', '') . '</td>
					<td>' . number_format((float)$posale->total, settings()->decimals, '.', '') . '</td>
					<td><a href="javascript:void(0)" onclick="delete_posale(' . $posale->id . ')"><div class="glyph-icon simple-icon-trash text-danger"></div></a></td>
				</tr>';
		}
		$data .= '</tbody>
		</table>';
		echo $data;
	}
	*/
	
	
	
	public function load_service_posale($posale_id = null)
	{
		 //$posale = $this->posale->get_by_id(array('id' => $posale_id));
		$posales = $this->posale->get_all(array('parent' => $posale_id));
		
	    $data = '';
		$i = 0;
		$total = 0;
		$price = 0;
		foreach ($posales as $posale) {
        	$lists = json_decode($posale->service);
    		foreach ($lists as $key=>$list) {
    			$i++;
    			$price +=$list->inr;
    			$total +=$list->inr;
    			$data .= '<tr>
        					<th scope="row">' . $i . '</th>
        					<td>' . $posale->service_name . '</td>
        					<td>1</td>
        					<td>' . number_format((float)$list->inr, settings()->decimals, '.', '') . '</td>
        					<td>' . number_format((float)$list->inr, settings()->decimals, '.', '') . '</td>
        					<td><a href="javascript:void(0)" onclick="delete_posale('.$posale->id.')"><div class="glyph-icon simple-icon-trash text-danger"></div></a></td>
        				</tr>';
    		}
		}
		$data .= '<tr>
	                  <td></td>
	                  <td>Total</td>
	                  <td>'.$i.'</td>
	                  <td>'.number_format((float)$total, settings()->decimals, '.', '').'</td>
	                  <td>'.number_format((float)$total, settings()->decimals, '.', '').'</td>
                 </tr>';
		
		echo $data;
	}
	

	public function load_product_model_posale($posale_id = null)
    {
        if ($posale_id === null) {
            return "Posale ID is missing."; 
        }
        $posales = $this->posale->get_allserch(array('parent' => $posale_id));
        $data = '';
        $i = 1; 
        foreach ($posales as $posale) {
            $data .= '<tr>
                <td>' . $posale->product_name . '</td>
                <td>' . $posale->quantity . '</td> 
                <td><a href="javascript:void(0)" onclick="delete_posaledata('.$posale->id.')"><div class="glyph-icon simple-icon-trash text-danger"></div></a></td>
            </tr>';
            $i++; 
        }
        echo $data;
    }
	
	
	public function delete($id)
	{
		$posall = $this->posale->get_by_id(array('id' => $id));
		$this->posale->delete_by_id(array('id' => $id));
		$this->posale->delete_by_id(array('parent' => $id));
		echo json_encode(array(
			"status" => TRUE,
			"parent_id" => $posall->parent,
		));
	}


    

	
	
	public function delete_service()
	{
	    try{
	        if($this->input->method()=="post"){
	             $posaleId = $this->input->post('posale_id');
	             $parent_id = $this->input->post('parent_id');
	             $delete_id = $this->input->post('delete_id');
	             
	             $posale = $this->posale->get_by_id(array('id' => $posaleId));
	             
	             $lists = json_decode($posale->service);
	             
	             if (array_key_exists($delete_id, $lists)) {
                    unset($lists[$delete_id]);
                 }
                 if (property_exists($lists, $delete_id)) {
                    unset($lists->$delete_id);
                 }
                 //print_r($lists);die;
                //  $service = [];
                //  foreach($lists as $list){
                //      //if()
                //  }
	             
	             if(!empty($lists) && is_array($lists)){
	                 $total = 0;
	                 $qty = 0;
        		     foreach($lists as $pri){
        		        $total +=$pri->inr;
        		        $qty+=1;
        		     }
    	             $update['service'] = json_encode($lists);
    	             $update['quantity'] = $qty;
    	             $update['total'] = $total;
    	             // print_r($update);die;
    	             $this->posale->update($update,$posaleId);  
	             }else{
	                 $this->posale->delete_by_id(array('id'=>$posaleId)); 

	             }

	             echo json_encode(['status'=>true,'data'=>$lists]);
	             die;
	        }
	        echo json_encode(['status'=>false,'error'=>'Invalid Request']);
	    }catch(Exception $e){
	        echo json_encode(['status'=>false,'error'=>$e->getMessage()]);
	    }
		$posall = $this->posale->get_by_id(array('id' => $id));
		$this->posale->delete_by_id(array('id' => $id));
		$this->posale->delete_by_id(array('parent' => $id));
		echo json_encode(array(
			"status" => TRUE,
			"parent_id" => $posall->parent,
		));
	}
	
	
	public function ResetPos()
	{
		$this->posale->delete_by_id(array('register' => $this->register));
		echo json_encode(array(
			"status" => TRUE
		));
	}
	public function openregister($id = 0)
	{
		if ($this->input->post()) {
			$cash = $this->input->post('cash');
			$data = array(
				"status" => 1,
				"user_id" => $this->session->userdata('user_id'),
				"cash_inhand" => $cash,
				"store_id" => $this->store_id,
			);
			$register = $this->register_m->save($data);
			$this->session->set_userdata('register', $register);
			redirect("pos/index", "location");
		}
		$data['content_page'] = $this->load->view('pos/openregister', $data = array(), true);
		$this->load->view('tpl/template', $data);
	}
	public function totiems()
	{
		$posales = $this->posale->get_all(array('register' => $this->register));
		$sub = 0;
		foreach ($posales as $posale) {
			$sub += $posale->quantity;
		}
		echo $sub;
	}
	
	public function subtot()
	{
		$posales = $this->posale->get_all(array('register' => $this->register));
		$sub = 0;
		foreach ($posales as $posale) {
			$sub += $posale->total;
		}
		$delivery_amount = $this->session->userdata('delivery_amount');
        $delivery_free_limit = $this->session->userdata('delivery_free_limit');
        if ($delivery_free_limit && $sub < $delivery_free_limit) {
            $delivery_total = $delivery_amount;
         }else{
            $delivery_total = 0;
        }
        if($sub > 0){
            $sub+=$delivery_total;
        }
		echo number_format((float)$sub, settings()->decimals, '.', '');
	}
	
	
	public function GetDiscount($id)
	{
		$customer = $this->client->get_by_id($id);
		$Discount = stripos($customer->discount, '%') > 0 ? $customer->discount : number_format((float)$customer->discount, settings()->decimals, '.', '');
		echo $Discount . '~' . $customer->lastname . ' ' . $customer->firstname . '~' . $customer->id . '~' .$customer->phone;
	}
	
	

	
	public function AddNewSale($type)
	{
        //print_r($_POST); die;
        $saledataid = $this->input->post('saledata_id');
        
        $this->sale->delete_items($saledataid);
             
		$this->load->library('Sma');
		$this->load->model('sale_model', 'sale');
		date_default_timezone_set(settings()->timezone);
		$date = date("Y-m-d H:i:s");
	
		$customer_phone = $_POST['phoneclient'];
		// $delivery_date = $_POST['delivery_date'];
		// $pickup_date = $_POST['pickup_date'];
		$_POST['invoice_date'] = $_POST['invoice_date'];;
		$paid_sms = $_POST['paid'];
		$total_sms = $_POST['total'];
		$name_sms = $_POST['clientname'];
		$bal_sms = $_POST['total']-$_POST['paid'];
		$_POST['store_pickup_delivery'] = $_POST['store_pickup_delivery'];
		$_POST['created_at'] = $date;
		$_POST['date_time'] = $date;
		$_POST['saledata_id'] = $date;
		$_POST['date_yeare'] = date("Y");
		$_POST['date_month'] = date("m");
		$_POST['register_id'] = $this->register;
		$_POST['store_id'] = $this->store_id;
		
		$register = $this->register_m->get_by_id(array('id' => $this->register));
		$paystatus = $_POST['paid'] - $_POST['total'];
		$_POST['firstpayement'] = $paystatus > 0 ? $_POST['total'] : $_POST['paid'];
		$_POST['status'] = 0;
		
		$invoice = $this->sale->invoice_id($_POST['store_id']);
		//print_r($invoice); die;

        if (empty($invoice) || empty($invoice->invoice_id)) {
            $next_invoice_id = 1;
        } else {
            $next_invoice_id = $invoice->invoice_id + 1;
        }
        
        // Pad the number with leading zeros to make it 3 digits
        $_POST['invoice_id'] = str_pad($next_invoice_id, 3, '0', STR_PAD_LEFT);
		
		$delivery_amount = $this->session->userdata('delivery_amount');
        $delivery_free_limit = $this->session->userdata('delivery_free_limit');
        if ($delivery_free_limit && $total_sms < $delivery_free_limit) {
            $delivery_total = $delivery_amount;
         }else{
            $delivery_total = 0;
        }
        $_POST['delivery_amount'] = $delivery_total;
        
        if(!$saledataid)
        {
		$sale_id = $this->sale->save($_POST);
        }else{
            $this->sale->update($_POST, $saledataid);
            $sale_id = $saledataid;
        }
		
		

		$sale = $this->sale->get_by_id(array('id' => $sale_id));
		
		$posales_parent = $this->posale->get_all(array('parent' => false, 'register' => $this->register, 'store_id' => $this->store_id));
		

        if (!empty($posales_parent)) { 
            foreach ($posales_parent as $posale) {
        
                $item_secondary = $this->posale->get_all(array('parent' => $posale->id, 'register' => $this->register, 'store_id' => $this->store_id));
   
                $icons = [];
                if (!empty($item_secondary)) {
                    foreach ($item_secondary as $item) {
                        if ($item->additional_product == null && isset($item->service_icon)) {
                    $icons[] = $item->service_icon;
                }
                    }
                }
                $icons_json = json_encode($icons);
                
                $data = array(
                    "product_id" => $posale->product_id,
                    "type_one" => $posale->type_one,
                    "type_second" => $posale->type_second,
                    "color" => $posale->color,
                    "delivery_amount" => $posale->delivery_amount,
                    "parent" => $posale->parent,
                    "name" => $posale->product_name,
                    "price" => $posale->price,
                    "qt" => $posale->quantity,
                    "subtotal" => $posale->quantity * $posale->price,
                    "sale_id" => $sale_id,
                    "service_icon" => $posale->service_icon,
                    "secondary_icons" => $icons_json, 
                    "date" => $date,
                    "icon_status" => 3,
                    "store_id" => $this->store_id,
                    "notes" => $posale->notes,
                    "product_image" => $posale->product_image,
                );
        
                $pos = $this->sale->save_item($data); 

                if (!empty($item_secondary)) { 
                    foreach ($item_secondary as $secondary) {
                         $barcode=$this->generate();
                        $data_secondary = array(
                            "product_id" => $secondary->product_id,
                            "type_one" => $secondary->type_one,
                            "type_second" => $secondary->type_second,
                            "color" => $secondary->color,
                            "delivery_amount" => $secondary->delivery_amount,
                            "parent" => $pos, 
                            "name" => $secondary->product_name,
                            "service_icon" => $secondary->service_icon,
                            "secondary_icons" => $icons_json,
                            "service_name" => $secondary->additional_product == 1 ? $secondary->product_name : $secondary->service_name,
                            "additional_product" => $secondary->additional_product == 1 ? 1 : null,
                            "price" => $secondary->price,
                            "qt" => $secondary->quantity,
                            "subtotal" => $secondary->quantity * $secondary->price,
                            "sale_id" => $sale_id,
                            "date" => $date,
                            "icon_status" => $secondary->icon_status,
                            "barcode" => $secondary->additional_product == 1 ? $barcode : '',
                            "store_id" => $this->store_id
                        );
                        $this->sale->save_item($data_secondary);
                    }
                }
                 
            }
        }
        $items = $this->db->where('sale_id', $sale_id)->where('parent', false)->get('sale_items')->result();
        
		 $ticket = '<div class="header row" style="padding-top:0; margin-top:0px;">
		 <div class="col-md-12 text-end" style="text-align:center; padding-top:0; margin-top:0px;">
		 <div class="biiprintdata" style="padding-top:0; margin-top:0px;">
		 <img class="logonew" alt="logo" src="'.base_url().'/files/img/'. settings()->logo.'" style="width:30%!important; padding-top:0; margin:0 auto; text-align:center;" ></div>
		 <p>' . settings()->store_address . '</p><p style="font-size:28px;font-weight: bold;">'.display('sale_num') . ': ' . $sale->invoice_id.'</p>
                    </div>
                        <div class="class="col-md-12" style="padding-bottom: 10px; width:100%;padding-left: 15px;">
                            <h4 style="margin-bottom: 0px; font-size:15px;font-weight: bold;">Invoice '.display('date').' : '.$sale->invoice_date.' '.date('h:i:s A', strtotime($sale->date_time)).'</h4>
                           <div> <p style="margin-bottom: 0px; font-size:15px;font-weight: bold;">'.display('client').' : '.$sale->clientname.'</p></div>
                           <div> <p style="margin-bottom: 0px; font-size:15px;font-weight: bold;">'.display('phone').' : '.$sale->phoneclient.'</p></div>
                        </div>
                        
                    </div>';
                    
                    //$ticket .='<p style="font-size:17px;text-align:center;font-weight: bold;">Store : '.$sale->store_pickup_delivery.'</p>';  
                    $ticket .='<p style="font-size:28px;text-align:center;font-weight: bold;">Store : '.$sale->store_pickup_delivery.'</p>';  
                    
                     
                    $ticket .='<table class="table table-bordered" style="font-size: 15px; font-weight: bold;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>'.display('product').'</th>
                                <th>'.display('quantity').'</th>
                                <th>'.display('total').'</th>
                            </tr>
                        </thead>
                        <tbody>';
                        
		$i = 1;
		$ticket_services = '';
		$total = 0;
		foreach ($items as $posale) {
			$total = ($posale->qt * $posale->price);
			$services = $this->db->where(array('parent' => $posale->id))->get('sale_items')->result();
		
			if ($services) {
				$ticket_services = '';
				foreach ($services as $service) {
                $total += ($service->qt * $service->price);
                
            if ($service->additional_product == 1) {
                $ticket_services .= '- <span style="font-size: 15px;">' . $service->service_name . ' ' . $service->qt . '</span><br>';
                    if($service->notes)
                    {
                         $ticket_services .= '- <span style="font-size: 15px;">' .'Notes'. $service->notes.'</span><br>';
                    }
                } else {
                    $ticket_services .= '- <span style="font-size: 15px;">' . $service->service_name . ' ' . number_format((float)($service->price), settings()->decimals, '.', '') . '</span><br>';
                    if($service->notes)
                    {
                        $ticket_services .= '- <span style="font-size: 15px;">' .'Notes'. $service->notes.'</span><br>'; 
                    }
                }
            }
				$tktserv = $ticket_services;
			} else {
				//$total = $total+0;
				$tktserv = '';
			}
           
            $barcode=$this->generate();
            $data = array("barcode" => $barcode);
             
            $this->db->where('id',$posale->id)->update('sale_items',$data);
            
           
            
            
		  //  $this->sale->update($data, $posale->id);
		  //  for($j=1;$j<=$posale->quantity; $j++){
// 			$ticket .= '<tr>
// 								<td style="text-align:center; width:30px;">' . $i . '</td>
// 								<td style="width:180px;">' . $posale->name . '( ' . display($posale->type_one) . ':' . display($posale->type_second) . ' ' . ($posale->price > 0 ? $posale->price : '') . ' )<br>' . $tktserv . '</td>
// 								<td class="prdnone" style="text-align:center; width:100px;">
// 								<div style="clear:both;">
// 								<center><img src='.base_url() . 'assets/images/barcode/' . $barcode.".png".'> </center></div></td>
								
// 								<td style="text-align:center; width:50px;">' . $posale->qt . '</td>
// 								<td style= width:70px; ">' . number_format((float)($total), settings()->decimals, '.', '') . ' </td>
// 							  </tr>';

// 			$ticket .= '<tr>
// 							<td>' . $i . '</td>
// 							<td>' . $posale->name . '( ' . display($posale->type_one) . ':' . display($posale->type_second) . ' ' . ($posale->price > 0 ? $posale->price : '') . ' )<br>' . $tktserv . '</td>
// 							<td>' . $posale->qt . '</td>
// 							<td>' . number_format((float)($total), settings()->decimals, '.', '') . ' </td>
// 						</tr>';

           $ticket .= '<tr>
                        <td>' . $i . '</td>
                        <td>' . $posale->name . '( ' . display($posale->type_one) . ':' . display($posale->type_second) . ' ' . ($posale->price > 0 ? $posale->price : '') . ' )<br>' . $tktserv;
                        if (!empty($posale->notes)) {
                            $ticket .= '<br>Notes:-' . htmlspecialchars($posale->notes);
                        }
                        $ticket .= '</td>
                        <td>' . $posale->qt . '</td>
                        <td>' . number_format((float)($total), settings()->decimals, '.', '') . ' </td>
                    </tr>';
			$i++;
		  //  }
		}
		
		$ticket .= '</tbody></table>
                        <table class="table table-bordered" style="font-size: 15px;font-weight: bold;">';
                    
                    if ($sale->delivery_amount != 0) {
                        $ticket .= '<tr>
                                        <th style="padding-left:10%;">Delivery Amount</th>
                                        <th></th>
                                        <td style="width:26%;padding-left:0;text-align:right;">' . $sale->delivery_amount . '.00 ' . settings()->currency . '</td>
                                    </tr>';
                    }
                    
                    if ($sale->delivery_amount != 0) {
                    $ticket .= '<tr>    
                                        <th style="padding-left:10%;">' . display('subtotal') . '</th>
                                        <th></th>
                                        <td style="width:26%;padding-left:0;" class="text-right">' . $sale->subtotal . '.00 ' . settings()->currency . '</td>
                                    </tr>';
                    }                
                    
                   if (intval($sale->discount!= 0)) {
                        $ticket .= '<tr>
                                        
                                        <th style="padding-left:10%;">' . display('discounts') . '</th>
                                        <th></th>
                                        <td style="width:26%;padding-left:0;" class="text-right">' . $sale->discount . '.00</td>
                                    </tr>';
                    }
                    
                    $tax_valued = str_replace('%', '', $sale->tax);
                    
                    if (intval($tax_valued!= 0)) {
                        $ticket .= '<tr>
                                        <th style="padding-left:10%;">' . display('tax') . '</th>
                                        <th ></th>
                                        <td style="width:26%;padding-left:0;" class="text-right">' . $sale->tax . '</td>
                                    </tr>';
                    }
                    
                    
                  
                    
                    
                    
                      if($sale->total == $sale->paid)
        			  {
    			       $ticket .= '<tr>
    			                    
                                    <th style="padding-left:10%;">Payment Status</th>
                                    <th></th>
                                    <td style="width:26%; padding-left:0;" class="text-right">Paid</td>
                                </tr>';
        			  }
        			  elseif($sale->paid == 0)
        			  {
        			   $ticket .= '<tr>
                                    <th style="padding-left:10%;">Payment Status</th>
                                    <th></th>
                                    <td style="width:26%; padding-left:0;" class="text-right">UnPaid</td>
                                </tr>';
        			  }
        			  else
        			  {
    			       $ticket .= '<tr>
                                <th style="padding-left:10%;">Payment Status</th>
                                <th></th>
                                <td style="width:26%;padding-left:0;" class="text-right">Partial payment</td>
                            </tr>';
        			  }
                    
                    $sum_sale = $this->sale->sum_sale(array('client_id' => $sale->client_id));
			        $paid_sale = $this->sale->paid_sale(array('client_id' => $sale->client_id));
			        $prev = $sum_sale - $paid_sale;
			        $total_prev = $prev-$sale->total ;
                    
        //             $sum_sale = $this->sale->sum_salecurrent(['client_id' => $sale->client_id], $sale->id);
			     //   $paid_sale = $this->sale->paid_salecurrent(['client_id' => $sale->client_id], $sale->id);
			     //  $total_prev =$sum_sale - $paid_sale; 

			       
			        

                    
                    // $ticket .= '<tr>
                    //                     <th>' . display('total') . '</th>
                    //                     <td>' . number_format((float)$sale->total, settings()->decimals, '.', '') . ' ' . settings()->currency . '.00</td>
                    //                 </tr>
                    //                 <tr>
                    //                     <th>' . display('paid') . '</th>
                    //                     <td>' . $sale->paid . '.00</td>
                    //                 </tr>
                    //                 <tr>
                    //                     <th>Balance</th>
                    //                     <td>' . number_format((float)($sale->total - $sale->paid), settings()->decimals, '.', '') . '.00</td>
                    //                 </tr>
                                     
                    //                 <tr>
                    //                     <th>Previous Amount</th>
                    //                     <td>' . $total_prev . '.00</td>
                    //                 </tr>
                                    
                    //             </table>';
                    
                    
                    
                    $ticket .= '<tr>
                                    <th style="padding-left:10%;">' . display('total') . '</th>
                                    <th></th>
                                    <td style="text-align:right; width:26%; padding-left:0;">' . number_format((float)$sale->total, settings()->decimals, '.', '') . '.00</td>
                                </tr>
                                <tr>
                                    <th style="padding-left:10%;">' . display('paid') . '</th>
                                    <th></th>
                                    <td style="text-align:right; width:26%; padding-left:0;">' . $sale->paid . '.00</td>
                                </tr>
                                <tr>
                                    <th style="padding-left:10%;">Balance</th>
                                    <th></th>
                                    <td style="text-align:right; width: 26%; padding-left:0;">' . number_format((float)($sale->total - $sale->paid), settings()->decimals, '.', '') . '.00</td>
                                </tr>';
                    
                                    if (intval($total_prev) != 0) {
                                        $ticket .= '<tr>
                                                        <th style="padding-left:10%;">Previous Amount</th>
                                                        <th></th>
                                                        <td style="text-align:right; width:26%; padding-left:0;">' . $total_prev . '.00</td>
                                                    </tr>';
                                    }
                    
                    $ticket .= '</table>';

                                
                                
                    
                                

                $ticket .= '<span class="float-left" style="font-size:15px;font-weight: bold;">Delivery Date : ' . $sale->delivery_date . '</span><span class="float-right" style="font-size:15px;font-weight: bold;">' . settings()->store_name . '</span>';
                $ticket .= '<div style="border-top:1px solid #000; padding-top:10px;margin-top:-8px;">
		        
		        <div style="clear:both;">
		        <span class="float-left" style="font-size:15px;font-weight: bold;">Pickup Date : ' . $sale->pickup_date . '</span>
		        <span class="float-right" style="font-size:15px; font-weight: bold;"><i class="fa fa-phone"></i> ' . settings()->store_phone . '</span>
		        </div>
		        
		        <div style="clear:both;"><center> ' . $this->sma->save_barcode($sale->invoice_id) . ' </center><br>
		        <div class="text-center"> ' . settings()->receiptfooter . '</div>
		        <div class="text-center" style="background-color:#000;padding:5px;width:85%;  color:#fff;margin:0 auto;border-radius:3px;margin-top:20px;">' . settings()->footer_text . '</div>
		        </div>';
		        
		        
		        
		      //  $ticket .= '<div">
		      //  <span class="float-left" style="font-size:16px;">Shop Name:' . settings()->store_name . '</span>
		      //  </div>';
		        

                //  $ticket .='<table class="table table-bordered">
                //         <tr>
                //             <th>Delivery Date</th>
                //             <td>'.$sale->delivery_date.'</td>
                //         </tr>
                //         <tr>
                //             <th>Pickup Date</th>
                //             <td>'.$sale->pickup_date.'</td>
                //         </tr>
                //         <tr>
                //             <th>'.display('phone').'</th>
                //             <td>'.settings()->store_phone .'</td>
                //         </tr>
                //         <tr>
                //             <th>Barcode</th>
                //             <td>'.$this->sma->save_barcode($sale->id).'</td>
                //         </tr>
                //     </table>';

// 		$ticket .= '</tbody></table><table class="table secondtable" cellspacing="0" border="0" style="margin-bottom:8px;"><tbody><tr><td style="text-align:left;">' . display('number_of_services') . ':</td><td style="text-align:right; padding-right:1.5%;">' . $sale->totalitems . '</td><td style="text-align:left; padding-left:1.5%;"> ' . display('subtotal') . ':  </td><td style="text-align:right;font-weight:bold;">' . $sale->subtotal . ' ' . settings()->currency . '</td></tr>';
// 		if (intval($sale->discount))
// 			$ticket .= '<tr><td style="text-align:left; padding-left:1.5%;"></td><td style="text-align:right;font-weight:bold;"></td><td style="text-align:left;">' . display('discounts') . ' :</td><td style="text-align:right; padding-right:1.5%;font-weight:bold;">' . $sale->discount . '</td></tr>';
// 		if (intval($sale->tax))
// 			$ticket .= '<tr><td style="text-align:left;"></td><td style="text-align:right; padding-right:1.5%;font-weight:bold;"></td><td style="text-align:left; padding-left:1.5%;"> ' . display('tax') . ': </td><td style="text-align:right;font-weight:bold;">' . $sale->tax . '</td></tr>';
// 		$ticket .= '<tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;"> ' . display('total') . ' </td><td colspan="2" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">' . number_format((float)$sale->total, settings()->decimals, '.', '') . ' ' . settings()->currency . '</td></tr><tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">' . display('paid') . ':</td><td colspan="2" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">' . $sale->paid . '</td></tr><tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">' . display('rest') . ' :</td><td colspan="2" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">' . number_format((float)$sale->total - $sale->paid, settings()->decimals, '.', '') . '</td></tr></tbody></table>';

		$PayMethode = explode('~', $sale->paidmethod);

        //$ticket .= '<span class="float-left dnone">Delivery Date : ' . $sale->delivery_date . '</span><span class="float-right dnone">Pickup Date : ' . $sale->pickup_date . '</span>';
		//$ticket .= '<div class="dnone" style="border-top:1px solid #000; padding-top:10px;"><span class="float-left">' . settings()->store_name . '</span><span class="float-right">' . display('phone') . ' : ' . settings()->store_phone . '</span><div style="clear:both;"><center> ' . $this->sma->save_barcode($sale->id) . ' </center><br><div class="text-center"> ' . settings()->receiptfooter . '</div><div class="text-center" style="background-color:#000;padding:5px;width:85%;color:#fff;margin:0 auto;border-radius:3px;margin-top:20px;">' . settings()->footer_text . '</div></div>';


		$this->posale->delete_by_id(array('register' => $this->register));
	
		//sens sms
		$variablesArr = array('{customer}' => $name_sms,'{ORDERNO}' => $sale_id, '{TOTAL}' => number_format((float)($total_sms), settings()->decimals, '.', '') .' '. settings()->currency, '{PAID}' => number_format((float)($paid_sms), settings()->decimals, '.', '') .' '. settings()->currency, '{BAL}' => number_format((float)($bal_sms), settings()->decimals, '.', '') .' '. settings()->currency);
        $templateHTML = settings()->sms_add_order;

		$message = strtr($templateHTML, $variablesArr);
		//$this->bulksmsnigeria->sendSMS($customer_phone,$message,settings()->senderId,'2');
		//
		$response['html'] = $ticket;
		$response['sale_id'] = $sale_id;
		echo json_encode($response); exit;
// 		echo $ticket;
	}
	
	
	
	public function print_all_barcodes($sale_id){
	    if($sale_id){
	        $sale = $this->db->select('delivery_date,client_id,invoice_id')->where('id',$sale_id)->get('sales')->row();
	        $data['sale'] = $sale;
	       // $data['sale_items'] = $this->db->where('sale_id',$sale_id)->get('sale_items')->result();
	        $data['sale_items'] = $this->db->where('sale_id',$sale_id)->where('icon_status',3)->get('sale_items')->result();
	        
	        //print_r($data['sale_items']); die;
	        $data['customer'] = $this->db->where('id',$sale->client_id)->get('clients')->row();
	        $store_id = $this->session->userdata('store_id');
	        $data['store_info'] = $this->db->where('store_id',$store_id)->get('settings')->row();
	        $this->load->view('pos/print_all_barcodes', $data);
	    }else{
	        
	    }
	}
	
	
	
	public function print_all_barcodes2($sale_id){
	    if($sale_id){
	        $sale = $this->db->select('delivery_date,client_id,invoice_id')->where('id',$sale_id)->get('sales')->row();
	        $data['sale'] = $sale;
	       // $data['sale_items'] = $this->db->where('sale_id',$sale_id)->get('sale_items')->result();
	        $data['sale_items'] = $this->db->where('sale_id',$sale_id)->where('icon_status',3)->get('sale_items')->result();
	        
	        //print_r($data['sale_items']); die;
	        $data['customer'] = $this->db->where('id',$sale->client_id)->get('clients')->row();
	        $store_id = $this->session->userdata('store_id');
	        $data['store_info'] = $this->db->where('store_id',$store_id)->get('settings')->row();
	        $this->load->view('pos/print_all_barcodes2', $data);
	    }else{
	        
	    }
	}


  public function updatedata_barcodes(){
     // print_r($_POST); die;
      $sale_id = $this->input->post('id');
	    if($sale_id){
	        $data['sale_items_all'] = $this->db->where('sale_id',$sale_id)->get('sale_items')->result();
	         // Barcode generation and update logic
            foreach ($data['sale_items_all'] as &$item) { 
                if (empty($item->barcode)) { 
                    $barcode = $this->generateApp();
                    $data_barcode = array("barcode" => $barcode);
                    $this->db->where('id', $item->id)->update('sale_items', $data_barcode);
                    $item->barcode = $barcode; 
                }
            }
            
             $data_sales = array('barcode_generate_app_order' => 2); 
            $this->db->where('id', $sale_id)->update('sales', $data_sales);

            $response = array('status' => 1, 'message' => 'Barcodes generated and updated successfully.');
            
	    }else{
	        
	    }
	}
	

	
	

    public function generate() {
        
        $barcode_num=$this->random_barcode_number();
         
        $path=str_replace("application/controllers", "assets/images/barcode/".$barcode_num.".png", dirname(__FILE__));
        
        $barcodeOptions = array(
            'text' => $barcode_num,  // The text to encode
            'barHeight' => 50,       // Height of the barcode
            'factor' => 2,           // Scale factor
        );
        $rendererOptions = array();

        $barcode = Zend_Barcode::factory('code128', 'image', $barcodeOptions, $rendererOptions);
        $imageResource = $barcode->draw();
        imagepng($imageResource, $path);
        imagedestroy($imageResource);
        return  $barcode_num;
    }

    public function random_barcode_number()
    {
        $randomNumber = mt_rand(10000000, 99999999);
        if ($this->sale->check_barcode_exists($randomNumber)) {
          $this->random_barcode_number();
        } else {
          return $randomNumber;
        }
    }
    
    
    public function generateApp() {
        
       $barcode_num = (string)$this->random_barcode_number_app();
        
        $path=str_replace("application/controllers", "assets/images/barcode/".$barcode_num.".png", dirname(__FILE__));
        
        $barcodeOptions = array(
            'text' => $barcode_num,  // The text to encode
            'barHeight' => 50,       // Height of the barcode
            'factor' => 2,           // Scale factor
        );
        $rendererOptions = array();

        $barcode = Zend_Barcode::factory('code128', 'image', $barcodeOptions, $rendererOptions);
        $imageResource = $barcode->draw();
        imagepng($imageResource, $path);
        imagedestroy($imageResource);
        return  $barcode_num;
    }
    
    private function random_barcode_number_app($prefix = "APP", $length = 8) {
        $randomNumber = mt_rand(pow(10, $length - 1), pow(10, $length) - 1); 
        return $prefix . $randomNumber;
    }
    
    
    
	public function CloseRegister()
	{
		$this->load->model('sale_model', 'sale');
		$this->load->model('payement_model', 'payement');
		$register = $this->register_m->get_by_id(array('id' => $this->register));

		$user = $this->user_m->get_by_id($register->user_id);
		$sales = $this->sale->get_all(array('register_id'  => $this->register));

		$payaments = $this->payement->get_all(array('register_id'  => $this->register));


		$cash = 0;
		$cheque = 0;
		$cc = 0;
		$data_credit = "";
		$CashinHand = $register->cash_inhand;
		$date = $register->date;
		$createdBy = $user->name;


		$data_credit = '';


		foreach ($payaments as $payament) {
			$PayMethode = explode('~', $payament->paidmethod);
			switch ($PayMethode[0]) {
				case '1': // case Credit Card
					$cc += $payament->paid;
					break;
				case '2': // case ckeck
					$cheque += $payament->paid;
					break;
				default:
					$cash += $payament->paid;
			}
		}

		foreach ($sales as $sale) {
			$PayMethode = explode('~', $sale->paidmethod);
			$paystatus = $sale->paid - $sale->total;
			switch ($PayMethode[0]) {
				case '1': // case Credit Card
					$cc += $paystatus > 0 ? $sale->total : $sale->firstpayement;
					break;
				case '2': // case ckeck
					$cheque += $paystatus > 0 ? $sale->total : $sale->firstpayement;
					break;
				default:
					$cash += $paystatus > 0 ? $sale->total : $sale->firstpayement;
			}
		}
		$data = '<div class="row"><div class="col-md-3"><blockquote><footer>' . "" . display('Openedby') . "" . '</footer><p>' . $createdBy . '</p></blockquote></div>
         <div class="col-md-3"><blockquote><footer>' . "" . display('CashinHand') . "" . '</footer><p>' . number_format((float)$CashinHand, settings()->decimals, '.', '') . ' ' . settings()->currency . '</p>
         </blockquote></div><div class="col-md-4"><blockquote><footer>' . "" . display('openingtime') . "" . '</footer>
         <p>' . date('Y-m-d h:i:s') . '</p></blockquote></div><div class="col-md-2">
		 <img src="' . site_url() . '/assets/img/cash-register.svg" alt="" class="register-img"></div></div>
		 <h2>' . "" . display('paymentssummary') . "" . '</h2>
         <table class="table"><tr class="thead-light"><th width="25%">' . "" . display('payementtype') . "" . '</th>
         <th width="25%">' . "" . display('EXPECTED') . "" . ' (' . settings()->currency . ')</th>
         <th width="25%">' . "" . display('COUNTED') . "" . ' (' . settings()->currency . ')</th>
         <th width="25%">' . "" . display('DIFFERENCES') . "" . ' (' . settings()->currency . ')</th></tr>
         <tr><td>' . "" . display('Cash') . "" . '</td><td><span id="expectedcash">' . number_format((float)$cash, settings()->decimals, '.', '') . '</span></td>
         <td><input type="text" class="total-input" value="' . number_format((float)$cash, settings()->decimals, '.', '') . '" placeholder="0.00"  maxlength="11" id="countedcash"></td>
         <td><span id="diffcash">0.00</span></td></tr><tr><td>' . "" . display('Cheque') . "" . '</td>
         <td><span id="expectedcheque">' . number_format((float)$cheque, settings()->decimals, '.', '') . '</span></td>
         <td><input type="text" class="total-input" value="' . number_format((float)$cheque, settings()->decimals, '.', '') . '" placeholder="0.00"  maxlength="11" id="countedcheque"></td>
         <td><span id="diffcheque">0.00</span></td></tr><tr class="warning"><td>' . "" . display('total') . "" . '</td>
         <td><span id="total">' . number_format((float)($cheque + $cash), settings()->decimals, '.', '') . '</span></td>
         <td><span id="countedtotal">' . number_format((float)($cheque + $cash), settings()->decimals, '.', '') . '</span></td>
         <td><span id="difftotal">0.00</span></td></tr>
         </table><div  class="form-group">' . $data_credit . '<h2>' . "" . display('notes') . "" . '</h2><textarea id="RegisterNote" class="form-control" rows="3"></textarea></div>';
		echo $data;
	}
	public function SubmitRegister()
	{
		$date = date("Y-m-d H:i:s");
		$data = array(
			"cash_total" => $this->input->post('expectedcash'),
			"cash_sub" => $this->input->post('countedcash'),
			"cheque_total" => $this->input->post('expectedcheque'),
			"cheque_sub" => $this->input->post('countedcheque'),
			"note" => $this->input->post('RegisterNote'),
			"closed_by" => $this->session->userdata('user_id'),
			"closed_at" => $date,
			"status" => 0
		);

		$register = $this->register_m->get_by_id(array('id' => $this->register));
		$this->register_m->update($data, $this->register);
		$this->posale->delete_by_id(array('register' => $this->register));

		$this->session->set_userdata('register', 0);

		echo json_encode(array(
			"status" => TRUE
		));
	}
	public function GenerateBarcode()
	{
		$this->load->library('Sma');
		echo  '<span style="font-size:20px">' . $this->sma->save_barcode('123456', $bcs = 'code128', $height = 40, $stext = 1, $get_be = false) . '</span>';
	}
	
	public function salesearch()
	{
		$id_sale = $this->input->post('saleid');
		$this->load->library('Sma');
		$this->load->model('sale_model', 'sale');

     //	if ($this->sale->get_by_id(array('invoice_id' => $id_sale))) {
     
        $store_id = $this->session->userdata('store_id');
	    
		if ($this->sale->get_by_id_store(array('invoice_id' => $id_sale , 'store_id'=>$store_id))) {
		  
			// $sale = $this->sale->get_by_id(array('id' => $id_sale));
			
			$sale = $this->sale->get_by_id_store(array('invoice_id' => $id_sale,'store_id'=>$store_id));
			
			
			$posales_parent = $this->sale->get_items(array('parent' => false, 'sale_id' => $sale->id));

			$ticket = '<div class="col-md-13"><div style="clear:both;"><h4 class="text-center">' .'Invoice Number' . '.: ' . $sale->invoice_id . '</h4> <div style="clear:both;"></div><span class="float-left"> ' . display('depositdate') . ': ' . $sale->created_at . '</span><br>';
			if ($sale->status) {
				$ticket .= '<span class="float-left">' . display('deliverydate') . ': ' . $sale->delivery_at . '</span><br><span class="badge badge-success">' . display('delivery') . ' </span><br><span class="float-left">  ' . display('deliverydate') . ': ' . $sale->delivery_by . '</span><br>';
			}
			$ticket .= '<div style="clear:both;"><span class="float-left"> ' . display('client') . ': ' . $sale->clientname . ' - '. display('phone') . ': ' . $sale->phoneclient .'</span> <div style="clear:both;"><table class="table" cellspacing="0" border="0"><thead><tr><th><em>#</em></th><th>' . display('product') . '</th><th> ' . display('quantity') . '</th><th> ' . display('total') . '</th></tr></thead><tbody>';

			$i = 1;
			$ticket_services = '';
			$total = 0;
			foreach ($posales_parent as $posale) {
				$total = $posale->qt * $posale->price;
				$services = $this->sale->get_items(array('parent' => $posale->id, 'sale_id' => $sale->id));
				if ($services) {
					$ticket_services = '';
					foreach ($services as  $service) {
						$total = $total + ($service->qt * $service->price);
						$ticket_services .= '- <span>' . $service->name . ' ' . number_format((float)($service->price), settings()->decimals, '.', '') . '</span><br>';
					}
					$tktserv = $ticket_services;
				} else {
					$total = $total + 0;
					$tktserv = '';
				}
				$ticket .= '<tr>
								<td style="text-align:center; width:30px;">' . $i . '</td>
								<td style="width:180px;">' . $posale->name . '( ' . display($posale->type_one) . ':' . display($posale->type_second) . ' )<br>' . $tktserv . '</td>
								<td style="text-align:center; width:50px;">' . $posale->qt . '</td>
								<td style=" width:70px; ">' . number_format((float)($total), settings()->decimals, '.', '') . ' </td>
							  </tr>';
				$i++;
			}
			$PayMethode = ($sale->paidmethod == 0) ? display('cash') : display('cheque');
			$rest = $sale->total - $sale->paid;
			$artru_rest = '';
			if ($rest == 0) {
				$artru_rest = 'readonly';
			}
			$ticket .= '</tbody></table><table class="table" cellspacing="0" border="0" style="margin-bottom:8px;"><tbody><tr><td style="text-align:left;"> ' . display('number_of_services') . ':</td><td style="text-align:right; padding-right:1.5%;">' . $sale->totalitems . '</td><td style="text-align:left; padding-left:1.5%;">  ' . display('subtotal') . ':  </td><td style="text-align:right;font-weight:bold;">' . $sale->subtotal . ' ' . settings()->currency . '</td></tr>';
			if (intval($sale->discount))
				$ticket .= '<tr><td style="text-align:left; padding-left:1.5%;"></td><td style="text-align:right;font-weight:bold;"></td><td style="text-align:left;">:' . display('discounts') . ' </td><td style="text-align:right; padding-right:1.5%;font-weight:bold;">' . $sale->discount . '</td></tr>';
			if (intval($sale->tax))
				$ticket .= '<tr><td style="text-align:left;"></td><td style="text-align:right; padding-right:1.5%;font-weight:bold;"></td><td style="text-align:left; padding-left:1.5%;"> ' . display('tax') . ': </td><td style="text-align:right;font-weight:bold;">' . $sale->tax . '</td></tr>';
			$ticket .= '<tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;"> ' . display('total') . '  </td><td colspan="2" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">' . number_format((float)$sale->total, settings()->decimals, '.', '') . ' ' . settings()->currency . '</td></tr><tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">' . display('paid') . ':</td><td colspan="2" class="paid_after" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">' . number_format((float)$sale->paid, settings()->decimals, '.', '') . '</td></tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">' . display('rest') . ':</td><td class="rest_after" colspan="2" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">' . number_format((float)$rest, settings()->decimals, '.', '') . '</td></tr></tbody></table>';
			if (!$sale->status) {
				$ticket .= '<div class="row mb-5"><label class="col-2 pt-3 text-center lbl-rest">' . display('paid') . ' :</label><input ' . $artru_rest . ' type="text" id="rest" name="rest" class="form-control col-3 text-center" style="font-size: 18px;" value="' . number_format((float)$rest, settings()->decimals, '.', '') . '"><button type="button" id="deliverybtm" class="btn btn-sm btn-success default text-center col-3 ml-1" onclick="delivery(' . "'" . $sale->id . "','delivery'" . ')">' . display('delivery') . '</button><button type="button" class="btn btn-sm btn-success default text-center col-3 ml-1" id="deliverypay" onclick="delivery(' . "'" . $sale->id . "','deliverypay'" . ')"> ' . display('delivery_and_payment') . '</button></div>
				 <input type="hidden" value="' . number_format((float)$sale->total, settings()->decimals, '.', '') . '" id="deliverytotal">
				 <input type="hidden" value="' . number_format((float)$sale->paid, settings()->decimals, '.', '')  . '" id="deliverypaid">
			   ';
			   
			   $ticket .= '
				<div class="form-group paymentmethod">
					 <label for="paymentMethod">Payment Method</label>
                        <select class="js-select-options form-control" id="paymdata">
                            <option value="0">Cash</option>
                            <option value="2">cheque</option>
                            <option value="3">Card</option>
                            <option value="4">UPI</option>
                        </select>
				</div>';
			   
			   
				$ticket .= '
				<div class="form-group notesale">
					<label for="exampleFormControlTextarea1">' . display('notes') . ':</label>
					<textarea class="form-control" id="notesale" name="notesale" rows="1"></textarea>
				</div>';
			} elseif ($rest != 0) {
				$ticket .= '<div class="row mb-5"><label class="col-2 pt-3 text-center lbl-rest">' . display('paid') . ' :</label><input ' . $artru_rest . ' type="text" id="rest" name="rest" class="form-control col-3 text-center" style="font-size: 18px;" value="' . number_format((float)$rest, settings()->decimals, '.', '') . '"><button type="button" id="deliverybtm" class="btn btn-sm btn-success default text-center col-3 ml-1" onclick="delivery(' . "'" . $sale->id . "','delivery'" . ')"> ' . display('paid') . ' </button></div>
				<input type="hidden" value="' . number_format((float)$sale->total, settings()->decimals, '.', '') . '" id="deliverytotal">
				<input type="hidden" value="' . number_format((float)$sale->paid, settings()->decimals, '.', '')  . '" id="deliverypaid">
			  ';
				$ticket .= '
			   <div class="form-group notesale">
				   <label for="exampleFormControlTextarea1">' . display('notes') . ':</label>
				   <textarea class="form-control" id="notesale" name="notesale" rows="1"></textarea>
			   </div>';
			} else {
				$ticket .= '
				<div class="form-group notesale">
					<label for="exampleFormControlTextarea1">' . display('notes') . ': ' . $sale->note . '</label>
				</div>';
			}
			$ticket .= '
			  <button type="button" class="btn btn-sm btn-danger hiddenpr" data-dismiss="modal">' . display('close') . ' <i class="glyph-icon iconsminds-close"></i></button>
			  <button onclick="sendsms(' . "'" . $sale->id . "'" . ')" type="button" class="btn btn-sm btn-success hiddenpr">' . display('send_sms') . ' <i class="glyph-icon iconsminds-mail-send"></i></button>

			  ';
		} else {
			$ticket = '';
		}
		echo $ticket;
	}

	public function salesearchbyphone(){
		$this->load->model('sale_model', 'sale');
		$this->load->model('client_model', 'client');
		$id_sale = $this->input->post('saleid');
		
		if ($this->client->get_by_phone($id_sale)) {
			
			$client = $this->client->get_by_phone($id_sale);
			
			$data['tickets'] = $this->sale->get_all(array('client_id' => $client->id));
			if($data['tickets']){
				$multic = $this->load->view('pos/salesearchbyphone', $data, true);
			}else{
				$multic = '';
			}
		}else{
			$multic = '';
		}
		echo $multic;
	}

	public function productSearch(){
		$product = $this->input->post('productid');
		$data['products'] = $this->product->search('name', $product, 'products');
		echo $this->load->view('pos/productsearch', $data, true);
	}

	public function delivery($id, $type)
	{
	   // print_r($_POST); die;
		$this->load->model('sale_model', 'sale');
		$paid = $this->input->post('paid') + $this->input->post('rest');
		$data = array(
			"note" => $this->input->post('notesale'),
			"status" => true,
			"delivery_by" => $this->user_name,
			"paid" => $paid,
			"paidmethod" => $this->input->post('paidMethod'),
			"delivery_at" => date('Y-m-d :H:s')
		);
		if ($type == 'deliverypay') {
			$total = $this->input->post('total');
			$paid = $this->input->post('total');
			$data['paid'] = $total;
		}
		if ($this->sale->update($data, $id)) {
			$sale_after_update = $this->sale->get_by_id(array('id' => $id));
			
			$client_id = $this->db->select('client_id')
                  ->get_where('sales', array('id' => $id))
                  ->row()
                  ->client_id;
                  
                  $clientname = $this->db->select('clientname')
                  ->get_where('sales', array('id' => $id))
                  ->row()
                  ->clientname;
                  
                  $phone = $this->db->select('phone')
                  ->get_where('clients', array('id' => $client_id))
                  ->row()
                  ->phone;
				    
				    $store_id = $this->db->select('store_id')
                  ->get_where('clients', array('id' => $client_id))
                  ->row()
                  ->store_id;
                  
                  $store_name = $this->db->select('store_name')
                  ->get_where('settings', array('id' => $store_id))
                  ->row()
                  ->store_name;
			echo json_encode(array(
				"status1" => TRUE,
				'phone' => $phone,
				'clientname' => $clientname,
				'store_name' => $store_name,
				"paid_after" => number_format((float)$sale_after_update->paid, settings()->decimals, '.', ''),
				"rest_after" => number_format((float)$sale_after_update->total - $sale_after_update->paid, settings()->decimals, '.', ''),
				"notesale_after" => $sale_after_update->note,
				"paidmethod" => $sale_after_update->paidmethod,
				"msg" => '<span class="text-success">' . display('delivery') . ' </span>',
			));
		}
	}
	
	
	
	public function smsreadycollection($id)
	{
		$this->load->model('sale_model', 'sale');
		$sale = $this->sale->get_by_id(array('id' => $id));
		$total_sms = $sale->total;
		$total_sms = $sale->total;
		$bal_sms = $sale->total - $sale->paid;
		//sens sms
		$variablesArr = array('{customer}' => $sale->clientname,'{ORDERNO}' => $sale->id, '{DATE}' => $sale->date_time, '{BAL}' => number_format((float)($bal_sms), settings()->decimals, '.', '') .' '. settings()->currency);
        $templateHTML = settings()->sms_order_readyr;

		$message = strtr($templateHTML, $variablesArr);
		//$this->bulksmsnigeria->sendSMS($sale->phoneclient,$message,settings()->senderId,'2');
		echo json_encode(array(
			"msgtesra" => 'sms has been sent successfully'
		));

	}
	function number_sales()
	{
		$this->load->model('sale_model', 'sale');
		echo  $this->sale->count_all(array('created_at' => date('Y-m-d')));
	}
	function total_sales()
	{
		$this->load->model('sale_model', 'sale');
		echo number_format((float)($this->sale->sum_sale(array('created_at' => date('Y-m-d')))), settings()->decimals, '.', '');
	}
	
	
   
	
	
	
	
	
	public function pos_list(){

		if ($this->input->is_ajax_request()) {


			if($_POST['date'] !== ""){
                
				$this->db->select('sales.id,sales.invoice_id,clientname,sales.id as order_no,delivery_date,pickup_date,sale_items.name,sale_items.qt');
				$this->db->from('sales');
				$this->db->join('sale_items','sale_items.sale_id = sales.id');
				$this->db->where('DATE(pickup_date) =', date('Y-m-d',strtotime($_POST['date'])));
				$this->db->where(['sales.store_id' => $this->session->userdata('store_id')]);
				$this->db->group_by('clientname,delivery_date,sale_items.product_id,sale_items.type_one,sale_items.type_second,sale_items.color');
				$query = $this->db->get();
				$pickup= $query->result();

				$this->db->select('sales.id,sales.invoice_id,clientname,sales.id as order_no,delivery_date,pickup_date,sale_items.name,sale_items.qt');
				$this->db->from('sales');
				$this->db->join('sale_items','sale_items.sale_id = sales.id');
				$this->db->where('DATE(delivery_date) =', date('Y-m-d',strtotime($_POST['date'])));
				$this->db->where(['sales.store_id' => $this->session->userdata('store_id')]);
				$this->db->group_by('clientname,delivery_date,sale_items.product_id,sale_items.type_one,sale_items.type_second,sale_items.color');
				$query = $this->db->get();
				$delivery= $query->result();

				// $products =  $this->product->getPosByDate($_POST['date'], 'products');
				$result = ['status' => 1, 'message' => 'Success', 'pickup' => $pickup,'delivery' => $delivery];
				echo json_encode($result);
			}else{
				$result = ['status' => 0, 'message' => 'Failed'];
				echo json_encode($result);
			}
			exit();
		}
		// $products =  $this->product->get_all();
		// echo "<pre>";
		// print_r($products); die;
		$data['content_page'] = $this->load->view('pos/pos_list', $data, true);
		$this->load->view('tpl/template', $data);
	    
	}
	
	

	// public function testing(){
	// 	$this->load->helper('cookie');
		
	// 	delete_cookie("uniquecoder");
	// 	delete_cookie("_crm_uslap");
	// 	echo $this->input->cookie('uniquecoder');
	// }
	
    
    
    public function add_notes_route()
    {
        $notes = $this->input->post('notes');
        $id    = $this->input->post('id');
        if (!empty($id) && isset($notes)) {
            $this->db->where('id', $id);
            $update = $this->db->update('posale', ['notes' => $notes]);
            if ($update) {
                echo json_encode(['status' => true, 'message' => 'Notes updated successfully.']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to update notes.']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Invalid input.']);
        }
    }
    
    
    
    public function product_notes_gets()
    {
        $id = $this->input->post('id');
        if (!empty($id)) { 
            $data = $this->posale->get_by_id(['id' => $id]); 
            if ($data) { 
                echo json_encode(['status' => true, 'data' => $data]);
            } else {
                echo json_encode(['status' => false, 'message' => 'Product not found.']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Invalid ID.']);
        }
    }
    
    
    
    
    
    
    

    
    
    
    public function update_pos($id = null)
    {
    $store_id = $this->session->userdata('store_id');
    $this->posale->delete_data($store_id);
    
    $posales = $this->sale->edit_items_get($id);
    
    $data['sale_id'] = $this->sale->edit_by_id_get($id);
    $checkdata = $this->posale->checkdata_edit($id);
    
    //print_r($checkdata); die;

    $parent_ids = []; 

    if (!$checkdata) {
        foreach ($posales as $posaleItem) {
            if (empty($posaleItem->service_name)) {
                $posale = [];
                $posale['delivery_amount'] = $posaleItem->delivery_amount;
                $posale['price'] = $posaleItem->price;
                $posale['total'] = $posaleItem->price * $posaleItem->qt;
                $posale['color'] = $posaleItem->color;
                $posale['quantity'] = $posaleItem->qt;
                $posale['register'] = $this->session->userdata('register');
                $posale['store_id'] = $posaleItem->store_id;
                $posale['product_id'] = $posaleItem->product_id;
                $posale['type_one'] = $posaleItem->type_one;
                $posale['type_second'] = $posaleItem->type_second;
                $posale['product_name'] = $posaleItem->name;
                $posale['notes'] = $posaleItem->notes;
                $posale['service_name'] = $posaleItem->service_name;
                $posale['product_update'] = 1;
                $posale['sale_id'] = $posaleItem->sale_id;
                $posale['user_id'] = $this->session->userdata('user_id');
                $posale['icon_status'] = 3;
                $posale['product_image'] = $posaleItem->product_image;
                
                $new_parent_id = $this->posale->save($posale);
                
                $parent_ids[$posaleItem->id] = $new_parent_id;
            }
        }

        foreach ($posales as $posaleItem) {
            if (!empty($posaleItem->service_name)) {
                $posale = [];
                $posale['parent'] = isset($parent_ids[$posaleItem->parent]) ? $parent_ids[$posaleItem->parent] : 0;
                $posale['delivery_amount'] = $posaleItem->delivery_amount;
                $posale['price'] = $posaleItem->price;
                $posale['total'] = $posaleItem->price;
                $posale['color'] = $posaleItem->color;
                $posale['quantity'] = $posaleItem->qt;
                $posale['register'] = $this->session->userdata('register');
                $posale['store_id'] = $posaleItem->store_id;
                $posale['product_id'] = $posaleItem->product_id;
                $posale['type_one'] = $posaleItem->type_one;
                $posale['additional_product'] = !empty($posaleItem->type_one) ? : 1;
                $posale['type_second'] = $posaleItem->type_second;
                $posale['product_name'] = $posaleItem->name;
                $posale['service_name'] = $posaleItem->service_name;
                $posale['product_update'] = 1;
                $posale['product_image'] = $posaleItem->product_image;

                $posale['sale_id'] = $posaleItem->sale_id;
                $posale['user_id'] = $this->session->userdata('user_id');
                $posale['icon_status'] = 2;

                $this->posale->save($posale);
            }
        }
    }

    if (!$this->session->userdata('register')) {
        redirect('pos/openregister');
    }
    
    $data['activbmregister'] = true;
    $data['posales'] = $this->posale->get_all(['parent' => false, 'register' => $this->register, 'store_id' => $this->store_id]);
    $data['categories'] = $this->category->get_all();
    $data['products'] = $this->product->get_datatables();
    $data['clients'] = $this->client->get_all();
    $data['colors'] = $this->color->get_all();
    $data['count_sale'] = $this->sale->count_all(['created_at' => date('Y-m-d')]);
    $data['sum_sale_day'] = $this->sale->sum_sale(['created_at' => date('Y-m-d')]);
    
    $data['content_page'] = $this->load->view('pos/update_pos', $data, true);
    $this->load->view('tpl/template', $data);
}


   
    public function product_images_gets()
    {
        $id = $this->input->post('id');
        if (!empty($id)) { 
            $data = $this->posale->get_by_id(['id' => $id]); 
            if ($data) { 
                echo json_encode(['status' => true, 'data' => $data]);
            } else {
                echo json_encode(['status' => false, 'message' => 'Product not found.']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Invalid ID.']);
        }
    }

    
    public function add_image_route()
    {
        $this->load->library('form_validation');
        $this->load->library('upload');
    
        $id = $this->input->post('id');
    
        $this->form_validation->set_rules('id', 'ID', 'required');
    
        if ($this->form_validation->run()) {
            $config['upload_path']   = './files/img/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 10000;
    
            $uploaded_images = []; 
    
            $existing_images = $this->db->select('product_image')
                ->from('posale')
                ->where('id', $id)
                ->get()
                ->row_array();
    
            if (!empty($existing_images['product_image'])) {
                $existing_images = json_decode($existing_images['product_image'], true); // Convert to array
            } else {
                $existing_images = [];
            }
    
            if (!empty($_FILES['logo']['name'][0])) {
                $files = $_FILES['logo'];
    
                for ($i = 0; $i < count($files['name']); $i++) {
                    $_FILES['file']['name']     = $files['name'][$i];
                    $_FILES['file']['type']     = $files['type'][$i];
                    $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['file']['error']    = $files['error'][$i];
                    $_FILES['file']['size']     = $files['size'][$i];
    
                    $this->upload->initialize($config);
    
                    if ($this->upload->do_upload('file')) {
                        $upload_data = $this->upload->data();
                        $uploaded_images[] = base_url('files/img/' . $upload_data['file_name']); // Store full path
                    } else {
                        echo json_encode(['status' => false, 'message' => $this->upload->display_errors()]);
                        return;
                    }
                }
            }
    
            $final_images = array_merge($existing_images, $uploaded_images);
    
            if (!empty($id) && !empty($final_images)) {
                $images_string = json_encode($final_images); 
    
                $this->db->where('id', $id);
                $update = $this->db->update('posale', ['product_image' => $images_string]);
    
                if ($update) {
                    echo json_encode(['status' => true, 'message' => 'Images uploaded successfully.', 'images' => $final_images]);
                } else {
                    echo json_encode(['status' => false, 'message' => 'Failed to update images.']);
                }
            } else {
                echo json_encode(['status' => false, 'message' => 'Invalid ID or No Images Uploaded.']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => validation_errors()]);
        }
    }



    public function pos_pickupExport()
    {
        
        $date = $this->input->get('date');
        $this->db->select('sales.id,sales.invoice_id,clientname,sales.id as order_no,delivery_date,
        pickup_date,sale_items.name,sale_items.qt,
        clients.adress,clients.phone,sales.pickup_date');
		$this->db->from('sales');
		$this->db->join('sale_items','sale_items.sale_id = sales.id');
		$this->db->join('clients','clients.id = sales.client_id','left');
		$this->db->where('DATE(pickup_date)', date('Y-m-d', strtotime($date)));
		$this->db->where(['sales.store_id' => $this->session->userdata('store_id')]);
		$this->db->group_by('clientname,delivery_date,sale_items.product_id,sale_items.type_one,sale_items.type_second,sale_items.color');
		$query = $this->db->get();
		$pickup= $query->result();
	//	print_r($pickup); die;
	   $dataexport['expences_repport'] = $pickup;
	   $html = $this->load->view('repports/pdf/pickup',$dataexport,true);
	   $name = 'pickup.pdf';
       $this->load->library('sma');
       $this->sma->generate_pdf('L',$html, $name);
    }

    
    public function pos_deliveryExport()
    {
        
        $date = $this->input->get('date');
        
        $this->db->select('sales.id,sales.invoice_id,clientname,sales.id as order_no,delivery_date,pickup_date,sale_items.name,sale_items.qt,clients.adress,clients.phone,sales.pickup_date');
		$this->db->from('sales');
		$this->db->join('sale_items','sale_items.sale_id = sales.id');
		$this->db->join('clients','clients.id = sales.client_id','left');
		$this->db->where('DATE(delivery_date) =', date('Y-m-d', strtotime($date)));
		$this->db->where(['sales.store_id' => $this->session->userdata('store_id')]);
		$this->db->group_by('clientname,delivery_date,sale_items.product_id,sale_items.type_one,sale_items.type_second,sale_items.color');
		$query = $this->db->get();
		$delivery= $query->result();
	
	   $dataexport['expences_repport'] = $delivery;
	   $html = $this->load->view('repports/pdf/delivery',$dataexport,true);
	   $name = 'delivery.pdf';
       $this->load->library('sma');
       $this->sma->generate_pdf('L',$html, $name);
    }
	
	
	
}



