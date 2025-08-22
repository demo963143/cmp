<?php
class Products extends CI_Controller {
	public function __construct() {
		parent::__construct();
		is_login();
		$this->load->model('product_model','product');
		$this->load->model('category_model','category');
		$this->load->model('service_model','service');
		$this->load->vars(array('activemn' => 'product','lastid' => $this->product->last_id()));
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
	   }

	public function index()
	{
		//$data['categories']  = $this->category->get_all();
		
		$data['categories']  = $this->category->categories_all();
		
		$data['services']  = $this->service->get_all();
		$data['icons']  = $this->product->get_icons();
		$data['content_page']=$this->load->view('product/index' ,$data,true);
		// echo "<pre>";
		// print_r($this->session->userdata());
		// die;
		$this->load->view('tpl/template' ,$data);
	}
	
	// Add  change 13/01/2025
	public function testadd()
	{
		    permission();
			$data = array(
				'num' => $this->input->post('num'),
				'name' => $this->input->post('nameprod'),
				'icon' => $this->input->post('icon'),
				'category_id' => $this->input->post('categoryid'),
				'lroning_normal' => $this->input->post('lroningnormal'),
				'lroning_fast' => $this->input->post('lroningfast'),
				'laundry_normal' => $this->input->post('laundrynormal'),
				'laundry_fast' => $this->input->post('laundryfast'),
				'laundrylroning_normal' => $this->input->post('laundrylroningnormal'),
				'laundrylroning_fast' => $this->input->post('laundrylroningfast'),
				'dry_normal' => $this->input->post('drynormal'),
				'dry_fast' => $this->input->post('dryfast'),
				'other_normal' => 0,
				'other_fast' => 0,
				'store_id' =>  $this->session->userdata('store_id'),
				'user_id' =>  $this->session->userdata('user_id'),
				'created_at' =>  date('Y-m-d H:s'),
			); 
			
// 			$res=$this->product->save($data);
// 			echo"<pre>";print_r($this->db->last_query());die;
			
				 if($this->product->save($data))
							{
							 //   echo"<pre>";print_r($this->db->last_query());die;
								$invID = str_pad($this->product->last_id() + 1, 3, '0', STR_PAD_LEFT);
								$numclt = 'PR'.$invID;

								// add pricing
								$item_name = $_POST["item_name"];
								$servid = $_POST["servid"];
								for($count = 0; $count<count($servid); $count++)
								{
									$dataserv = array(
										'pricing' =>  $item_name[$count],
										'id_product' =>$this->product->last_id(),
										'service_id' =>$servid[$count],
									);
									$this->service->save_pricing($dataserv);
								}
								//

								$datajson=array(
									                    'add' =>'add',
														'msg' => display('successfully_added'),
														'lastid' =>  $numclt,
									                    ); 
							}
							else
							{
								echo '<span class="red"> '.display('an_error_occurred').'  </span>';
							}
							 
				// 			die;
					
		    echo json_encode($datajson);
	}
	
	
	



    public function add(){ 
     
        $storeId = $this->session->userdata('store_id');
	    
	    $ironingnormalvalue = $_POST['lroningnormal'];
	    $data = [
            [
                "inr" => $ironingnormalvalue,
                "franchise" => [$storeId]
            ]
        ];
	    $ironingnormaldata= json_encode($data, true); 
	    
	    
	    $ironingexpressvalue = $_POST['lroningfast'];
	    $ironingexpress = [
            [
                "inr" => $ironingexpressvalue,
                "franchise" => [$storeId]
            ]
        ];
	    $ironingexpressdata= json_encode($ironingexpress, true); 
	    
	    
	    
	    $laundrynormalvalue = $_POST['laundrynormal'];
	    $laundrynormal = [
            [
                "inr" => $laundrynormalvalue,
                "franchise" => [$storeId]
            ]
        ];
	    $laundrynormaldata= json_encode($laundrynormal, true); 
	    
	    
	    
	    $laundryexpressvalue = $_POST['laundryfast'];
	    $laundryexpress = [
            [
                "inr" => $laundryexpressvalue,
                "franchise" => [$storeId]
            ]
        ];
	    $laundryexpressdata= json_encode($laundryexpress, true); 
	    
	    
	    $laundryironnormalvalue = $_POST['laundrylroningnormal'];
	    $laundryironnormal = [
            [
                "inr" => $laundryironnormalvalue,
                "franchise" => [$storeId]
            ]
        ];
	    $laundryironnormaldata= json_encode($laundryironnormal, true); 
	    
	    
	    
	    $laundryironexpressvalue = $_POST['laundrylroningfast'];
	    $laundryironexpress = [
            [
                "inr" => $laundryironexpressvalue,
                "franchise" => [$storeId]
            ]
        ];
	    $laundryironexpressdata= json_encode($laundryironexpress, true); 
	    
	    
	    
	    $drywashnormalvalue = $_POST['drynormal'];
	    $drywashnormal = [
            [
                "inr" => $drywashnormalvalue,
                "franchise" => [$storeId]
            ]
        ];
	    $drywashnormaldata= json_encode($drywashnormal, true); 
	    
	    
	    $drywashexpressvalue = $_POST['dryfast'];
	    $drywashexpress = [
            [
                "inr" => $drywashexpressvalue,
                "franchise" => [$storeId]
            ]
        ];
	    $drywashexpressdata= json_encode($drywashexpress, true); 
	    
	    
    
        $item_values = $_POST["item_name"]; 
        $servid = $_POST["servid"];
        $service = [];
        if (is_array($servid) && is_array($item_values)) {
            $count = min(count($servid), count($item_values));
    
            for ($i = 0; $i < $count; $i++) {
                $id = $servid[$i];
                $item_value = $item_values[$i];
    
                if (is_array($item_value)) {
                    $service[$id] = [
                        ["inr" => $item_value, "franchise" => [$storeId]]
                    ];
                } else { 
                    $service[$id] = [
                        ["inr" => $item_value, "franchise" => [$storeId]]
                    ];
                }
            }
        }
    
        $servicedetails = json_encode($service);
    
	   
	    try{
	        if($this->input->method() == 'post') {
                $product_id = $this->product->insert([
                    'num'=>$this->input->post('num'),
                    'name'=>$this->input->post('nameprod'),
                    'category_id'=>$this->input->post('categoryid'),
                    'ironingnormal'=>$ironingnormaldata,
                    'ironingexpress'=>$ironingexpressdata,
                    'laundrynormal'=>$laundrynormaldata,
                    'laundryexpress'=>$laundryexpressdata,
                    'laundryironnormal'=>$laundryironnormaldata,
                    'laundryironexpress'=>$laundryironexpressdata,
                    'drywashnormal'=>$drywashnormaldata,
                    'drywashexpress'=>$drywashexpressdata,
                    'service'=>$servicedetails,
                    'status'=>'1'
                ]);
                
                 
                $invID = str_pad($product_id + 1, 3, '0', STR_PAD_LEFT);
                $numclt = 'PR' .$invID;
                echo json_encode([
                    'status'=>True,
                     'msg' => 'Product Add successfully.' 
                ]);

                              
	        }
	        
	        
	    }catch(Exception $e){

	        echo json_encode([
              'status'=>False,
              'msg'=>$e->getMessage()
            ]);
	    }
	}
	
	
	
	
    //--------- update -----------
	public function update($id=null)
	{
		permission();
		if($this->input->post('product_id'))
		{
			//$this->load->view('product/update' ,array('services' => $this->service->get_all(),'categories' => $this->category->get_all(),'product' => $this->product->get_by_id($this->input->post('product_id'))));
	        $this->load->view('product/update' ,array('services' => $this->service->get_all(),'categories' => $this->category->get_all(),'product' => $this->product->get_by_id_edit($this->input->post('product_id'))));
		}
	}
	
	public function testupdate_ajax()
	{
		permission();
		$data = array(
				'name' => $this->input->post('nameprod'),
				'category_id' => $this->input->post('categoryid'),
				'lroning_normal' => $this->input->post('lroningnormal'),
				'lroning_fast' => $this->input->post('lroningfast'),
				'laundry_normal' => $this->input->post('laundrynormal'),
				'laundry_fast' => $this->input->post('laundryfast'),
				'laundrylroning_normal' => $this->input->post('laundrylroningnormal'),
				'laundrylroning_fast' => $this->input->post('laundrylroningfast'),
				'dry_normal' => $this->input->post('drynormal'),
				'dry_fast' => $this->input->post('dryfast'),
				'store_id' =>  $this->session->userdata('store_id'),
				'user_id' =>  $this->session->userdata('user_id'),
				'updated_at' =>  date('Y-m-d H:s'),
		   );
		   // update icon
		   if($this->input->post('icon') != '')
		   {
			$data['icon'] = $this->input->post('icon');
		   }
		     $id = $this->input->post('id');
			 if($this->product->update($data,$id))
						{
							// update pricing
							$item_name = $_POST["item_name"];
							$servid = $_POST["servid"];
							for($count = 0; $count<count($servid); $count++)
							{
								$datapricing = array(
									'pricing' =>  $item_name[$count],
									'id_product' =>$id,
									'service_id' =>$servid[$count],
								);
								if($this->service->get_pricing($servid[$count],$id))
								{
									$this->service->update_pricing($datapricing,$servid[$count],$id);
								}
								else
								{
									$this->service->save_pricing($datapricing);
								}
								
							}
							//
							 $datajson=array(
													'update' =>'update',
													'msg' => display('successfully_updated')
													); 
						}
						else
						{
							echo '<span class="red"> '.display('an_error_occurred').'  </span>';
						}
				
		echo json_encode($datajson);
	}
	
	
   public function update_ajax() {
    $storeId = $this->session->userdata('store_id');

    $ironingnormalvalue = $_POST['lroningnormal'];
    $ironingnormal = [
        [
            "inr" => $ironingnormalvalue,
            "franchise" => [$storeId]
        ]
    ];
    $ironingnormaldata = json_encode($ironingnormal); 

    $ironingexpressvalue = $_POST['lroningfast'];
    $ironingexpress = [
        [
            "inr" => $ironingexpressvalue,
            "franchise" => [$storeId]
        ]
    ];
    $ironingexpressdata = json_encode($ironingexpress); 

    $laundrynormalvalue = $_POST['laundrynormal'];
    $laundrynormal = [
        [
            "inr" => $laundrynormalvalue,
            "franchise" => [$storeId]
        ]
    ];
    $laundrynormaldata = json_encode($laundrynormal); 

    $laundryexpressvalue = $_POST['laundryfast'];
    $laundryexpress = [
        [
            "inr" => $laundryexpressvalue,
            "franchise" => [$storeId]
        ]
    ];
    $laundryexpressdata = json_encode($laundryexpress); 

    $laundryironnormalvalue = $_POST['laundrylroningnormal'];
    $laundryironnormal = [
        [
            "inr" => $laundryironnormalvalue,
            "franchise" => [$storeId]
        ]
    ];
    $laundryironnormaldata = json_encode($laundryironnormal); 

    $laundryironexpressvalue = $_POST['laundrylroningfast'];
    $laundryironexpress = [
        [
            "inr" => $laundryironexpressvalue,
            "franchise" => [$storeId]
        ]
    ];
    $laundryironexpressdata = json_encode($laundryironexpress); 

    $drywashnormalvalue = $_POST['drynormal'];
    $drywashnormal = [
        [
            "inr" => $drywashnormalvalue,
            "franchise" => [$storeId]
        ]
    ];
    $drywashnormaldata = json_encode($drywashnormal); 

    $drywashexpressvalue = $_POST['dryfast'];
    $drywashexpress = [
        [
            "inr" => $drywashexpressvalue,
            "franchise" => [$storeId]
        ]
    ];
    $drywashexpressdata = json_encode($drywashexpress); 

    $id = $this->input->post('id');

    try {
        if ($this->input->method() == 'post') {
            $product_id = $this->product->update([
                'num' => $this->input->post('num'),
                'name' => $this->input->post('nameprod'),
                'category_id' => $this->input->post('categoryid'),
                'ironingnormal' => $ironingnormaldata,
                'ironingexpress' => $ironingexpressdata,
                'laundrynormal' => $laundrynormaldata,
                'laundryexpress' => $laundryexpressdata,
                'laundryironnormal' => $laundryironnormaldata,
                'laundryironexpress' => $laundryironexpressdata,
                'drywashnormal' => $drywashnormaldata,
                'drywashexpress' => $drywashexpressdata,
                'status' => '1'
            ], $id); 

            echo json_encode([
                'status' => true,
                'msg' => 'Product updated successfully.' 
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'status' => false,
            'msg' => $e->getMessage()
        ]);
    }
}
	
	

	// ----------delete-------

	public function delete($id=null)
	{
		permission();
		if($this->input->post('product_id'))
		{
			echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">'.display('cancel').'</button>
			      <button type="button" class="btn btn-danger" onclick="deletebtm('.$this->input->post('product_id').')">'.display('delet').'</button>
			   ';
		}
		if($id !=null)
		{
			$this->product->delete_by_id($id);
			$datajson=array(
				'delete' =>'delete',
				'msg' => '<span class="alert-success">  '.display('successfully_deleted').'  <strang><i class="ace-icon fa fa-check"></i></strang> </span>'
				); 
			echo json_encode($datajson);
		}
	}
	
	
	// View the list of product
	
	// change 27-12-2024
// 	public function ajax_product()
//     {

//         $list = $this->product->get_datatables();
//         $data = array();
//         $no = $_POST['start'];
       
//         $state = $this->session->userdata('state');
//         $city = $this->session->userdata('city');
//          print_r($city); die;
//         foreach ($list as $product) {   
//             $no ++;
// 			$row = array();
// 			$row[] = $product->num;
// 			$row[] = $product->name;
			

//             $ironingnormal = json_decode($product->ironingnormal,true);
//             $states = array_merge(...array_column($ironingnormal, 'state'));
//             $uniqueStates = array_values(array_unique($states));
            
//             $cities = array_merge(...array_column($ironingnormal, 'city'));
//             $uniqueCities = array_values(array_unique($cities));
            
//             // $inrs = array_unique(array_column($ironingnormal, 'inr'));
//             $inrs = array_reduce($ironingnormal, function($carry, $item) use ($state, $city) {
//                 if (in_array($state, $item['state']) && in_array($city, $item['city'])) {
//                     $carry[] = $item['inr'];
//                 }
//                 return $carry;
//             }, []);
// 			$row[] = (in_array($state,$uniqueStates) && in_array($city,$uniqueCities)) ? implode(",",$inrs) : '';
			
			
//             $ironingexpress = json_decode($product->ironingexpress,true);
//             $states = array_merge(...array_column($ironingexpress, 'state'));
//             $uniqueStates = array_values(array_unique($states));
            
//             $cities = array_merge(...array_column($ironingexpress, 'city'));
//             $uniqueCities = array_values(array_unique($cities));
            
//             $inrs = array_reduce($ironingexpress, function($carry, $item) use ($state, $city) {
//                 if (in_array($state, $item['state']) && in_array($city, $item['city'])) {
//                     $carry[] = $item['inr'];
//                 }
//                 return $carry;
//             }, []);
//             $row[] = (in_array($state,$uniqueStates) && in_array($city,$uniqueCities)) ? implode(",",$inrs) : '';
// 			// $row[] = ($ironingexpress[0]->state[0] == $state && in_array($city,$ironingexpress[0]->city)) ? $ironingexpress[0]->inr : '';



//             $laundrynormal = json_decode($product->laundrynormal,true);
//             $states = array_merge(...array_column($laundrynormal, 'state'));
//             $uniqueStates = array_values(array_unique($states));
            
//             $cities = array_merge(...array_column($laundrynormal, 'city'));
//             $uniqueCities = array_values(array_unique($cities));
            
//             $inrs = array_reduce($laundrynormal, function($carry, $item) use ($state, $city) {
//                 if (in_array($state, $item['state']) && in_array($city, $item['city'])) {
//                     $carry[] = $item['inr'];
//                 }
//                 return $carry;
//             }, []);
//             $row[] = (in_array($state,$uniqueStates) && in_array($city,$uniqueCities)) ? implode(",",$inrs) : '';
			
			
//             $laundryexpress = json_decode($product->laundryexpress,true);
//             $states = array_merge(...array_column($laundryexpress, 'state'));
//             $uniqueStates = array_values(array_unique($states));
            
//             $cities = array_merge(...array_column($laundryexpress, 'city'));
//             $uniqueCities = array_values(array_unique($cities));
            
//             $inrs = array_reduce($laundryexpress, function($carry, $item) use ($state, $city) {
//                 if (in_array($state, $item['state']) && in_array($city, $item['city'])) {
//                     $carry[] = $item['inr'];
//                 }
//                 return $carry;
//             }, []);
//             $row[] = (in_array($state,$uniqueStates) && in_array($city,$uniqueCities)) ? implode(",",$inrs) : '';



//             $laundryironnormal = json_decode($product->laundryironnormal,true);
//             $states = array_merge(...array_column($laundryironnormal, 'state'));
//             $uniqueStates = array_values(array_unique($states));
            
//             $cities = array_merge(...array_column($laundryironnormal, 'city'));
//             $uniqueCities = array_values(array_unique($cities));
            
//             $inrs = array_reduce($laundryironnormal, function($carry, $item) use ($state, $city) {
//                 if (in_array($state, $item['state']) && in_array($city, $item['city'])) {
//                     $carry[] = $item['inr'];
//                 }
//                 return $carry;
//             }, []);
//             $row[] = (in_array($state,$uniqueStates) && in_array($city,$uniqueCities)) ? implode(",",$inrs) : '';


//             $laundryironexpress = json_decode($product->laundryironexpress,true);
//             $states = array_merge(...array_column($laundryironexpress, 'state'));
//             $uniqueStates = array_values(array_unique($states));
            
//             $cities = array_merge(...array_column($laundryironexpress, 'city'));
//             $uniqueCities = array_values(array_unique($cities));
            
//             $inrs = array_reduce($laundryironexpress, function($carry, $item) use ($state, $city) {
//                 if (in_array($state, $item['state']) && in_array($city, $item['city'])) {
//                     $carry[] = $item['inr'];
//                 }
//                 return $carry;
//             }, []);
//             $row[] = (in_array($state,$uniqueStates) && in_array($city,$uniqueCities)) ? implode(",",$inrs) : '';


			
			
//             // 	$row[] = format_price($product->ironingexpress);
//             // 	$row[] = format_price($product->laundrynormal);
//             // 	$row[] = format_price($product->laundryexpress);
//             // 	$row[] = format_price($product->laundryironnormal);
//             // 	$row[] = format_price($product->laundryironexpress);
//             // 	$row[] = format_price($product->drywashnormal);
//             // 	$row[] = format_price($product->drywashexpress);

		
// 			 if(permission_link())
// 				{
// 			$row[] = '<a href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="'.$product->id.'">
// 					<button class="btn btn-xs btn-danger">
// 					'.display('delete').'
// 					</button>
// 				</a><a href="#updateclt" class="green" id="custId" data-toggle="modal" data-id="'.$product->id.'">
// 				<button class="btn btn-xs btn-info">
// 				     '.display('update').'
// 				</button>
// 			</a>';
// 				}
// 				else
// 				{
// 					$row[]='-';
// 				}
			
     
//             $data[] = $row;
//         }

//         $output = array(
//             "draw" => $_POST['draw'],
//             "recordsTotal" => $this->product->count_all(),
//             "recordsFiltered" => $this->product->count_filtered(),
//             "data" => $data
//         );
//         // output to json format
//         echo json_encode($output);
// 	}
	
	
 //	13/01/2025
// 	public function ajax_product()
//     {
       
//         $list = $this->product->get_datatables();
        
//         $data = array();
//         $no = $_POST['start'];
//         foreach ($list as $product) {   
//             $no ++;
// 			$row = array();
// 			$row[] = $product->num;
// 			$row[] = $product->name;
// 			$row[] = format_price($product->lroning_normal);
// 			$row[] = format_price($product->lroning_fast);
// 			$row[] = format_price($product->laundry_normal);
// 			$row[] = format_price($product->laundry_fast);
// 			$row[] = format_price($product->laundrylroning_normal);
// 			$row[] = format_price($product->laundrylroning_fast);
// 			 if(permission_link())
// 				{
// 			$row[] = '
// 			<a href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="'.$product->id.'">
// 					<button class="btn btn-xs btn-danger">
// 					'.display('delete').'
// 					</button>
// 				</a><a href="#updateclt" class="green" id="custId" data-toggle="modal" data-id="'.$product->id.'">
// 				<button class="btn btn-xs btn-info">
// 				     '.display('update').'
// 				</button>
// 			</a>';
// 				}
// 				else
// 				{
// 					$row[]='-';
// 				}
			
     
//             $data[] = $row;
//         }

//         $output = array(
//             "draw" => $_POST['draw'],
//             "recordsTotal" => $this->product->count_all(),
//             "recordsFiltered" => $this->product->count_filtered(),
//             "data" => $data
//         );
//         // output to json format
//         echo json_encode($output);
// 	}


    public function ajax_product()
    {

        $list = $this->product->get_datatables();
         
        $data = array();
        $no = $_POST['start'];
       
        $state = $this->session->userdata('store_id');
        
        foreach ($list as $product) {   
            $no ++;
			$row = array();
			$row[] = $product->num;
			$row[] = $product->name;
			

            $ironingnormal = json_decode($product->ironingnormal,true);
            $states = array_merge(...array_column($ironingnormal, 'franchise'));
            $uniqueStates = array_values(array_unique($states));
            
            
            $inrs = array_reduce($ironingnormal, function($carry, $item) use ($state) {
                if (in_array($state, $item['franchise'])) {
                    $carry[] = $item['inr'];
                }
                return $carry;
            }, []);
            
			$row[] = (in_array($state,$uniqueStates)) ? implode(",",$inrs) : '';
			
			
            $ironingexpress = json_decode($product->ironingexpress,true);
            $states = array_merge(...array_column($ironingexpress, 'franchise'));
            $uniqueStates = array_values(array_unique($states));
            
           
            
            $inrs = array_reduce($ironingexpress, function($carry, $item) use ($state) {
                if (in_array($state, $item['franchise'])) {
                    $carry[] = $item['inr'];
                }
                return $carry;
            }, []);
            $row[] = (in_array($state,$uniqueStates)) ? implode(",",$inrs) : '';



            $laundrynormal = json_decode($product->laundrynormal,true);
            $states = array_merge(...array_column($laundrynormal, 'franchise'));
            $uniqueStates = array_values(array_unique($states));
            
           
            
            $inrs = array_reduce($laundrynormal, function($carry, $item) use ($state) {
                if (in_array($state, $item['franchise'])) {
                    $carry[] = $item['inr'];
                }
                return $carry;
            }, []);
            
            $row[] = (in_array($state,$uniqueStates)) ? implode(",",$inrs) : '';
			
			
            $laundryexpress = json_decode($product->laundryexpress,true);
            $states = array_merge(...array_column($laundryexpress, 'franchise'));
            $uniqueStates = array_values(array_unique($states));
            
            
            $inrs = array_reduce($laundryexpress, function($carry, $item) use ($state) {
                if (in_array($state, $item['franchise'])) {
                    $carry[] = $item['inr'];
                }
                return $carry;
            }, []);
            $row[] = (in_array($state,$uniqueStates)) ? implode(",",$inrs) : '';



            $laundryironnormal = json_decode($product->laundryironnormal,true);
            $states = array_merge(...array_column($laundryironnormal, 'franchise'));
            $uniqueStates = array_values(array_unique($states));
           
            
            $inrs = array_reduce($laundryironnormal, function($carry, $item) use ($state) {
                if (in_array($state, $item['franchise'])) {
                    $carry[] = $item['inr'];
                }
                return $carry;
            }, []);
            $row[] = (in_array($state,$uniqueStates)) ? implode(",",$inrs) : '';


            $laundryironexpress = json_decode($product->laundryironexpress,true);
            $states = array_merge(...array_column($laundryironexpress, 'franchise'));
            $uniqueStates = array_values(array_unique($states));
            
            
            $inrs = array_reduce($laundryironexpress, function($carry, $item) use ($state) {
                if (in_array($state, $item['franchise'])) {
                    $carry[] = $item['inr'];
                }
                return $carry;
            }, []);
            $row[] = (in_array($state,$uniqueStates)) ? implode(",",$inrs) : '';
            
            
            $drynormal = json_decode($product->drywashnormal,true);
            $states = array_merge(...array_column($drynormal, 'franchise'));
            $uniqueStates = array_values(array_unique($states));
            
            
            $inrs = array_reduce($drynormal, function($carry, $item) use ($state) {
                if (in_array($state, $item['franchise'])) {
                    $carry[] = $item['inr'];
                }
                return $carry;
            }, []);
            $row[] = (in_array($state,$uniqueStates)) ? implode(",",$inrs) : '';
            
            
            $dryexpress = json_decode($product->drywashexpress,true);
            $states = array_merge(...array_column($dryexpress, 'franchise'));
            $uniqueStates = array_values(array_unique($states));
            
            
            $inrs = array_reduce($dryexpress, function($carry, $item) use ($state) {
                if (in_array($state, $item['franchise'])) {
                    $carry[] = $item['inr'];
                }
                return $carry;
            }, []);
            $row[] = (in_array($state,$uniqueStates)) ? implode(",",$inrs) : '';
            

        // 	$row[] = format_price($product->ironingexpress);
        // 	$row[] = format_price($product->laundrynormal);
        // 	$row[] = format_price($product->laundryexpress);
        // 	$row[] = format_price($product->laundryironnormal);
        // 	$row[] = format_price($product->laundryironexpress);
        // 	$row[] = format_price($product->drywashnormal);
        // 	$row[] = format_price($product->drywashexpress);

		
			
    		$row[] = '<a href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="'.$product->id.'">
    				<button class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i>
    				</button>
    			</a><a href="#updateclt" class="green" id="custId" data-toggle="modal" data-id="'.$product->id.'">
    			<button class="btn btn-xs btn-info">
    			     <i class="fa fa-pencil"></i>
    			</button>
    		</a>';
				
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->product->count_all(),
            "recordsFiltered" => $this->product->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);
	}
	
	
	
	
}
