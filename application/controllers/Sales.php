<?php
class Sales extends CI_Controller {
	public function __construct() {

		parent::__construct();
		is_login();
		$this->load->model('sale_model','sale');
		$this->load->vars(array('activemn' => 'sales','lastid' => $this->sale->last_id()));
		$this->load->helper('language');
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
	   }
	   
	   
	   
	public function index()
	{
		if($this->input->post('pdfgen'))
		{
			   $startdate = $this->input->post('startdate');
			   $enddate = $this->input->post('enddate');
			   $dataexport['EndDate'] =$enddate ;
			   $dataexport['StartDate'] =$startdate ;

			   $dataexport['sales'] =$this->sale->gen_pdf($startdate,$enddate);
			   
			   $html = $this->load->view('sale/pdf',$dataexport,true);
			   $name = 'exportdepense.pdf';
			   // load sma library
	           $this->load->library('sma');
			    // generate pdf
	           $this->sma->generate_pdf('L',$html, $name);

		}
		
		 $this->db->select("*");
        $query = $this->db->get("users");
        $result =  $query->result();

        //echo "f";die;
		$data['content_page']=$this->load->view('sale/index' ,$data=array('result'=>$result),true);
		$this->load->view('tpl/template' ,$data);
		
	}
	

	// ----------delete-------

	public function delete($id=null)
	{
		if($this->input->post('sale_id'))
		{
			echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">'.display('cancel').'</button>
			      <button type="button" class="btn btn-danger" onclick="deletebtm('.$this->input->post('sale_id').')">'.display('delet').'</button>
			   ';
		}
		if($id !=null)
		{
			$this->sale->delete_items($id);
			$this->sale->delete_by_id(array('id'=>$id));
			$datajson=array(
				'delete' =>'delete',
				'msg' => '<span class="alert-success"> '.display('successfully_updated').'  <strang><i class="ace-icon fa fa-check"></i></strang> </span>'
				); 
			echo json_encode($datajson);
		}
	}
	
	//Show Ticket 
// 	public function ShowTicket($id)
// 	{
	    
// 		      $this->load->library('Sma');
// 			  $this->load->model('sale_model','sale');
			
// 			  $sale = $this->sale->get_by_id(array('id' => $id));
// 			  $posales_parent = $this->sale->get_items(array('parent' => false,'sale_id' => $sale->id));
			  
			 
// 			  $ticket = '<div class="col-md-13">  <input type="hidden" class="printid" value="' . $sale->id . '"> <div class="text-center"><img alt="logo" src="'.base_url().'/files/img/'. settings()->logo.'" width="25%"><br>' . settings()->receiptheader . '</div><div style="clear:both;"><h4 class="text-center">' . display('sale_num') . '.: ' . sprintf("%05d", $sale->id) . '</h4> <div style="clear:both;"></div><span class="float-left"> ' .display('date'). ': ' . $sale->created_at . '</span><br><div style="clear:both;"><span class="float-left"> ' .display('client'). ' : ' . $sale->clientname . '</span><div style="clear:both;"><table class="table" cellspacing="0" border="0"><thead><tr><th><em>#</em></th><th>' .display('product'). '</th><th> ' .display('quantity'). '</th><th>  ' .display('total'). '</th></tr></thead><tbody>';
	          
// 			  $i = 1;
// 			  $ticket_services='';
// 			  $total = 0;
// 			  foreach ($posales_parent as $posale) {
// 				 $total = $posale->qt * $posale->price;
// 				  $services = $this->sale->get_items(array('parent' => $posale->id,'sale_id' => $sale->id));
				  
// 				  if($services)
// 				  {
// 					$ticket_services ='';
// 					foreach($services as  $service)
// 					{
// 						$total = $total+($service->qt * $service->price);
						
// 						if ($service->additional_product == 1) {
//                         $ticket_services .= '- <span>' . $service->service_name . ' ' . $service->qt . '</span><br>';
//                         } else {
// 						$ticket_services .='- <span>'.$service->name.' '. number_format((float)($service->price), settings()->decimals, '.', '') . '</span><br>'; 
//                         }
// 					}
// 					   $tktserv =$ticket_services;
// 				  }
				  
// 				  else
// 				  {
// 					   $total = $total+0;
// 					   $tktserv = '';
// 				  }
// 				  $ticket .= '<tr>
// 								<td style="text-align:center; width:30px;">'. $i . '</td>
// 								<td style="width:180px;">'. $posale->name . '( '.display($posale->type_one) .':'. display($posale->type_second) .''.($posale->price > 0 ? $posale->price : '').' )<br>'.$tktserv.'</td>
// 								<td style="text-align:center; width:50px;">'. $posale->qt . '</td>
// 								<td style="width:70px; ">'. number_format((float)($total), settings()->decimals, '.', '') . ' </td>
// 							  </tr>';
// 				  $i ++;
// 			  }
	  
// 			  $ticket .= '</tbody></table><table class="table" cellspacing="0" border="0" style="margin-bottom:8px;"><tbody><tr><td style="text-align:left;"> ' .display('number_of_services'). ': </td><td style="text-align:right; padding-right:1.5%;">' . $sale->totalitems . '</td><td style="text-align:left; padding-left:1.5%;"> ' .display('subtotal'). ':  </td><td style="text-align:right;font-weight:bold;">' . $sale->subtotal . ' ' . settings()->currency . '</td></tr>';
// 			  if (intval($sale->discount))
// 				  $ticket .= '<tr><td style="text-align:left; padding-left:1.5%;"></td><td style="text-align:right;font-weight:bold;"></td><td style="text-align:left;">:' .display('discounts'). ' </td><td style="text-align:right; padding-right:1.5%;font-weight:bold;">' . $sale->discount . '</td></tr>';
// 			  if (intval($sale->tax))
// 				  $ticket .= '<tr><td style="text-align:left;"></td><td style="text-align:right; padding-right:1.5%;font-weight:bold;"></td><td style="text-align:left; padding-left:1.5%;"> ' .display('tax'). ': </td><td style="text-align:right;font-weight:bold;">' . $sale->tax . '</td></tr>';
// 			  $ticket .= '<tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;"> ' .display('total'). ' </td><td colspan="2" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">' . number_format((float)$sale->total, settings()->decimals, '.', '') . ' ' . settings()->currency . '</td></tr><tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">' .display('paid'). ':</td><td colspan="2" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">'.$sale->paid.'</td></tr><tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">' .display('rest'). ':</td><td colspan="2" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">'.number_format((float)$sale->total-$sale->paid, settings()->decimals, '.', '').'</td></tr></tbody></table>';
	  
// 			  $PayMethode = explode('~', $sale->paidmethod);
	  
// 			  $ticket .= '<span class="float-left">Delivery Date : ' . $sale->delivery_date . '</span><span class="float-right">Pickup Date : ' . $sale->pickup_date . '</span>';
// 			  $ticket .= '<div style="border-top:1px solid #000; padding-top:10px;"><span class="float-left">' . settings()->store_name . '</span><span class="float-right">' .display('phone'). ' : ' . settings()->store_phone . '</span><div style="clear:both;"><center> '.$this->sma->save_barcode($sale->id).' </center><br><div class="text-center"> '.settings()->receiptfooter.'</div><div class="text-center" style="background-color:#000;padding:5px;width:85%;color:#fff;margin:0 auto;border-radius:3px;margin-top:20px;">' . settings()->footer_text . '</div></div>';
			  
			  
			  
			  
// 			  echo $ticket;
// 	}
	
	// View the list of sales
	
	public function ajax_list($year=null)
    {
       // print_r('teedt'); die;
        $list = $this->sale->get_datatables($year);
       
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $invoice) {
            $no ++;
            $row = array();
            // $row[] = sprintf("%05d", $invoice->id);
            $row[] = $invoice->invoice_id;
            $row[] = $invoice->created_at;
            $row[] = $invoice->clientname;
            $user_id = $this->db->select('user_id')
                  ->get_where('clients', array('id' => $invoice->client_id))
                  ->row()
                  ->user_id;
                  
            $phone = $this->db->select('phone')
                  ->get_where('clients', array('id' => $invoice->client_id))
                  ->row()
                  ->phone;
                  $html = "Hi,".$invoice->clientname."\n Thank You for visiting Express Laundry\n Your Invoice No :".$invoice->id."\n Your Total Bill Value : RS. ".number_format((float)$invoice->total, settings()->decimals, '.', '')."\n Your Expected Delivery Date : ".$invoice->delivery_at;
            if($user_id)
            {
              $name = $this->db->select('name')
                  ->get_where('users', array('id' => $user_id))
                  ->row()
                  ->name;
                  $row[] = $name;
            }
            else
            {
                $row[] = "";
            }
            $row[] = $invoice->tax;
            $row[] = $invoice->discount;
            $row[] = number_format((float)$invoice->total, settings()->decimals, '.', '');
            $row[] = $invoice->created_by;
            $row[] = $invoice->totalitems;
            
             if($invoice->status)
              {
                 $statusdelev = display('delivery');
                 $classe2 = "badge badge-success";
              }
              else
              {
				$statusdelev = display('did_not_deliver');
				$classe2 = "badge badge-danger";
			  }
			  
			  if($invoice->total == $invoice->paid)
			  {
				$satus = display('paid');
				$classeStyle ='badge badge-success';
			  }
			  elseif($invoice->paid == 0)
			  {
				$satus = display('unpaid');
				$classeStyle ='badge badge-danger';
			  }
			  else
			  {
				$satus = display('partial_payment');
				$classeStyle ='badge badge-warning';
			  }
			  
			  ///
			  
			  if($invoice->paidmethod == 0)
			  {
				$psatus = 'Cash';
				$pclasseStyle ='badge badge-success';
			  }
			  elseif($invoice->paidmethod == 2)
			  {
				$psatus = 'Cheque';
				$pclasseStyle ='badge badge-danger';
			  }
			  elseif($invoice->paidmethod == 3)
			  {
				$psatus = 'Card';
				$pclasseStyle ='badge badge-danger';
			  } 
			  elseif($invoice->paidmethod == 4)
			  {
				$psatus = 'UPI';
			    $pclasseStyle ='badge badge-warning';
			  }
			  else
			  {
				$psatus = '';
				$pclasseStyle ='';
			  }
			  
			  
			  ///
			  
			  
                $row[] = '<span class="' . $classeStyle . '">' . $satus . '<span>';
    			$row[] = '<span class="' . $classe2 . '">' . $statusdelev . '<span>';
    			
    			
    	        $row[] = '<span class="' . $pclasseStyle . '">' . $psatus . '<span>';
    			
			
            // add html for action
			   if($year==null) {
                    $dropdown_html = '<div class="dropdown d-inline-block">
                        <button class="btn btn-outline-primary dropdown-toggle mb-1" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            ' . display('action') . '
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="showTicket(' . "'" . $invoice->id . "'" . ')">
                            <i class="fa fa-sticky-note" aria-hidden="true"></i> ' . display('bill') . '</a>
                             <a class="dropdown-item" href="javascript:void(0)" onclick="showImage(' . "'" . $invoice->id . "'" . ')">
                            View Image</a>';
                
                        if ($invoice->barcode_generate_app_order == 1) { 
                            $dropdown_html .= '<a class="dropdown-item generate_barcode_link" href="javascript:void(0)" onclick="updatebarcode(' . "'" . $invoice->id . "'" . ')">
                                <i class="fa fa-barcode" aria-hidden="true"></i> Generate Barcode</a>';
                        }
                    
                
                    // $dropdown_html .= '<a class="dropdown-item" href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="' . $invoice->id . '">
                    //         <i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>Delete</a>
                    //         <a class="dropdown-item" href="https://wa.me/91' . $phone . '?text=' . $html . '" target="_blank">Send Invoice</a>
                    //     </div>
                    // </div>';
                    
                  
                    $dropdown_html .= '<a class="dropdown-item" href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="' . $invoice->id . '">
                            <i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>Delete</a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="edititeam(' . "'" . $invoice->id . "'" . ')">Edit Order</a>
                        </div>
                    </div>';
                  
                    
                    //  $dropdown_html .= '<a class="dropdown-item" href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="' . $invoice->id . '">
                    //         <i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>Delete</a>
                    //     </div>
                    // </div>';
                
                    $row[] = $dropdown_html; 
                
                }
			   /*
			   $order_status = '<select onchange="change_order_status(' . "'" . $invoice->id . "'" . ','.this.')" class="btn btn-outline-primary" id="order_status" name="order_status">
                  <option value="0" >Pending</option>
                  <option value="1" >Processing</option>
                  <option value="2" >Ready To Deliver</option>
                  
                </select>';
                */ 
                
		 	    $order_status = '<select onchange="change_order_status(' . "'" . $invoice->id . "'" . ','.this.')" class="btn btn-outline-primary" id="order_status" name="order_status">
                          <option value="0" >Pending</option>
                          <option value="1" >Picked up by Delivery Van</option>
                          <option value="2" >Delivered at Plant</option>
                          <option value="3" >Recieved at Plant</option>
                          <option value="4" >Sorting and Processing </option>
                          <option value="5" >Packing and Sticker Print</option>
                          <option value="6" >Ready to Dispatch</option>
                          <option value="10">Pick-up by Delivery Van</option>
                          <option value="7">Delivered at Franchise</option>
                          <option value="8">Franchise Received </option>
                          <option value="9">Delivered to Customer</option>
                        </select>';
                        
                if($invoice->status==0){
                   $order_status=  str_replace('value="0"','value="0" selected',$order_status);
                }elseif($invoice->status==1){
                    $order_status=  str_replace('value="1"','value="1" selected',$order_status);
                }elseif($invoice->status==2){
                    $order_status=  str_replace('value="2"','value="2" selected',$order_status);
                }elseif($invoice->status==3){
                    $order_status=  str_replace('value="3"','value="3" selected',$order_status);
                }elseif($invoice->status==4){
                    $order_status=  str_replace('value="4"','value="4" selected',$order_status);
                }elseif($invoice->status==5){
                    $order_status=  str_replace('value="5"','value="5" selected',$order_status);
                }elseif($invoice->status==6){
                    $order_status=  str_replace('value="6"','value="6" selected',$order_status);
                }elseif($invoice->status==10){
                    $order_status=  str_replace('value="10"','value="10" selected',$order_status);
                }elseif($invoice->status==7){
                    $order_status=  str_replace('value="7"','value="7" selected',$order_status);
                }elseif($invoice->status==8){
                    $order_status=  str_replace('value="8"','value="8" selected',$order_status);
                }elseif($invoice->status==9){
                    $order_status=  str_replace('value="9"','value="9" selected',$order_status);
                }
                
                $row[]= $order_status;
                        
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sale->count_all(array()),
            "recordsFiltered" => $this->sale->count_filtered($year),
            "data" => $data
        );
        // output to json format
        echo json_encode($output);
    }
    
    public function change_order_status(){
		$id = $_GET['id'];
		$status = $_GET['status'];
		$data = array('status' => $status);
		
		// var_dump($data); die;
		
        if($id && !empty($data)){
			
				// $this->db->where('id', $id);
				$this->db->where('sale_id', $id);
				
				if($this->db->update('sale_items', $data)){
				    
				  $this->db->where('id', $id);
				  $sale = $this->db->update('sales', $data);
				    
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
                  
                  
					$result = ['status' => '1', 'clientname'=> $clientname, 'username' => $store_name,'phone'=> $phone, 'message' => 'Status is updated successfully'];
					echo json_encode($result);
				}else{
					$result = ['status' => 0, 'message' => 'There was some problem while updating record'];
					echo json_encode($result);
				}
        }else{
			$result = ['status' => 0, 'message' => 'Please select status'];
			echo json_encode($result);
		}
    } 
    


    
    

    public function send_notification()
    {
    $id = $this->input->post('id');

    if (!$id) {
        echo json_encode(['status' => 0, 'message' => 'Please send Invoice ID.']);
        return;
    }

    $sales = $this->db->where('id', $id)->get('sales')->row();
    if (!$sales) {
        echo json_encode(['status' => 0, 'message' => 'Record not found.']);
        return;
    }

    $client_id = $sales->client_id;
    $client = $this->db->where('id', $client_id)->get('clients')->row();
    if (!$client) {
        echo json_encode(['status' => 0, 'message' => 'Client not found.']);
        return;
    }
    
    $phone     = $client->phone;
    $store_id  = $client->store_id;
    $store     = $this->db->where('id', $store_id)->get('settings')->row();
    $storeName = $store ? $store->store_name : '';

    $posales_parent = $this->db->where('sale_id', $id)->get('sale_items')->result();
    if (empty($posales_parent)) {
        echo json_encode(['status' => 0, 'message' => 'No items found for this sale.']);
        return;
    }

    $itemsData = [];
    foreach ($posales_parent as $posale) {
        $qt    = (float) $posale->qt;
        $price = (float) $posale->price;
        $lineSubtotal = $qt * $price;  

        $itemsData[] = [
            'name'         => $posale->name,
            'service_name' => $posale->service_name,  
            'qt'           => $qt,
            'price'        => $price,
            'subtotal'     => $lineSubtotal,
            'type_one'     => $posale->type_one,
            'type_second'  => $posale->type_second,
            'color'        => $posale->color,
        ];
    }

    $result = [
        'status'         => 1,
        'message'        => 'Send Invoices',
        'clientname'     => $sales->clientname,
        'username'       => $storeName,
        'phone'          => $phone,
        // 'sales_id'       => $sales->id,
        'sales_id'       => $sales->invoice_id,
        'total_amount'   => number_format((float) $sales->total, 2, '.', ''),
        
        // 'discountamount' => number_format((float) $sales->discount, 2, '.', ''), 
        'discountamount' => is_numeric($sales->discount) ? number_format((float)$sales->discount, 2, '.', '') : $sales->discount,
        
        'subtotal_amount'   => number_format((float) $sales->subtotal, 2, '.', ''),
        'client_id'      => $client_id,
        'store_id'       => $store_id,
        'tax'            => $sales->tax,
        'items'          => $itemsData,
    ];

    echo json_encode($result);
}

    
    
    

	public function ShowTicket($id)
	{

		      $this->load->library('Sma');
			  $this->load->model('sale_model','sale');
			
			  $sale = $this->sale->get_by_id(array('id' => $id));
			  
			  $posales_parent = $this->sale->get_items(array('parent' => false,'sale_id' => $sale->id));
			  

			  $ticket = '<div class="col-md-13">  <input type="hidden" class="printid" value="' . $sale->id . '">
			  <div class="text-center">
			  <img alt="logo" src="'.base_url().'/files/img/'. settings()->logo.'" width="30%"><br><p>' . settings()->receiptheader . '</p></div>
			  
			  <div style="clear:both;"><h4 class="text-center" style="font-size:28px;font-weight: bold;">' . 'Invoice Number' . ' : ' . $sale->invoice_id . '</h4> 
			  <div style="clear:both;"></div><h4 class="float-left;" style="margin-bottom: 0px; font-size:15px;font-weight: bold;">Invoice ' .display('date'). ' : ' . $sale->invoice_date . ' '.date('h:i:s A', strtotime($sale->date_time)).'</h4>
			  
			  <div style="clear:both;">
			  <div>
			  <p class="" style="margin-bottom: 0px; font-size:15px;font-weight: bold;"> ' .display('client'). ' : ' . $sale->clientname . '</p>
			  </div>
			  
			  <div>
			   <p class="" style="margin-bottom: 0px; font-size:15px;font-weight: bold;"> ' .'Phone'. ' : ' . $sale->phoneclient . '</p>
			  </div>
			  
			  <h4 class="float-left; text-center" style="font-size:28px;font-weight: bold;"> ' .Store. ' : ' . $sale->store_pickup_delivery . '</h4>
			  <div style="clear:both;"><table class="table" cellspacing="0" border="0" style="font-size: 15px; font-weight: bold;"><thead><tr><th><em>#</em></th>
			  <th>' .display('product'). '</th><th> ' .display('quantity'). '</th><th>  ' .display('total'). '</th></tr>
			  </thead><tbody>';
	          
			  $i = 1;
			  $ticket_services='';
			  $total = 0;
			  
			  foreach ($posales_parent as $posale) {
				 $total = $posale->qt * $posale->price;
				  $services = $this->sale->get_items(array('parent' => $posale->id,'sale_id' => $sale->id));
				  
				  if($services)
				  {
					$ticket_services ='';
					foreach($services as  $service)
					{
						$total = $total+($service->qt * $service->price);
						
						if ($service->additional_product == 1) {
                        $ticket_services .= '- <span>' . $service->service_name . ' ' . $service->qt . '</span><br>';
                        } else {
						$ticket_services .='- <span>'.$service->name.' '. number_format((float)($service->price), settings()->decimals, '.', '') . '</span><br>'; 
                        }
					}
					   $tktserv =$ticket_services;
				  }
				  
				  else
				  {
					   $total = $total+0;
					   $tktserv = '';
				  }
				//   $ticket .= '<tr>
				// 				<td style="text-align:center; width:30px;">'. $i . '</td>
				// 				<td style="width:180px;">'. $posale->name . '( '.display($posale->type_one) .':'. display($posale->type_second) .''.($posale->price > 0 ? $posale->price : '').' )<br>'.$tktserv.'</td>
				// 				<td style="text-align:center; width:50px;">'. $posale->qt . '</td>
				// 				<td style="width:70px; ">'. number_format((float)($total), settings()->decimals, '.', '') . ' </td>
				// 			  </tr>';
				
				  $ticket .= '<tr style="font-size: 15px; font-weight: bold;">
                        <td>' . $i . '</td>
                        <td>' . $posale->name . '( ' . display($posale->type_one) . ':' . display($posale->type_second) . ' ' . ($posale->price > 0 ? $posale->price : '') . ' )<br>' . $tktserv;
                        if (!empty($posale->notes)) {
                            $ticket .= '<br>Notes:-' . htmlspecialchars($posale->notes);
                        }
                        $ticket .= '</td>
                        <td>' . $posale->qt . '</td>
                        <td>' . number_format((float)($total), settings()->decimals, '.', '') . ' </td>
                    </tr>';
				
				  $i ++;
			  }
			  
	  
			 // $ticket .= '</tbody>
			 //    </table><table class="table" cellspacing="0" border="0" style="margin-bottom:8px;">
			 //    <tbody>
			 //    <tr><td style="text-align:left;"> ' .display('number_of_services'). ': </td>
			 //    <td style="text-align:right; padding-right:1.5%;">' . $sale->totalitems . '</td>
			 //    <td style="text-align:left; padding-left:1.5%;"> ' .display('subtotal'). ':  </td>
			 //    <td style="text-align:right;font-weight:bold;">' . $sale->subtotal . ' ' . settings()->currency . '</td>
			 //    </tr>';
			 
			 $tax_valued = str_replace('%', '', $sale->tax);
			 
			 if ($sale->delivery_amount != 0 || $tax_valued!= 0) {
			  $ticket .= '</tbody>
			     </table><table class="table" cellspacing="0" border="0" style="margin-bottom:8px;" style="font-size: 15px; font-weight: bold;">
			     <tbody>
			     <tr>
			     <td style="text-align:left; padding-left:10%; font-size: 15px; font-weight: bold;"> ' .display('subtotal'). ':  </td>
			     
			     <td colspan="3" style="text-align:right;font-weight:bold;font-size:15px;">' . $sale->subtotal .'</td>
			     </tr>';
			  }    
			  
			  if (intval($sale->discount!= 0)) {
				  $ticket .= '<tr>
				  <td style="text-align:left; padding-left:10%; font-size: 15px; font-weight: bold;">:' .display('discounts'). ' </td>
				  <td colspan="3" style="text-align:right;font-weight:bold; font-size: 15px;">' . $sale->discount . '</td>
				  </tr>';
			  }	  
			  
			   
			   if (intval($tax_valued!= 0)) 
			   {
				  $ticket .= '<tr>
				  
				  <td style="text-align:left; padding-left:10%; font-size: 15px;font-weight:bold;"> ' .display('tax'). ': </td>
				  <td colspan="3" style="text-align:right;font-weight:bold; font-size: 15px;">' . $sale->tax . '</td>
				  </tr>';
			   }  
			   
			   
			     $sum_sale = $this->sale->sum_sale(array('client_id' => $sale->client_id));
			     $paid_sale = $this->sale->paid_sale(array('client_id' => $sale->client_id));
			     $prev = $sum_sale - $paid_sale;
			   
			    if (intval($prev) != 0) {
                    $ticket .= '<tr style="font-size: 15px; font-weight: bold;">
                                    <th style="padding-left:10%; font-size: 15px; font-weight: bold;">Previous Amount</th>
                                    <td colspan="3" style="text-align:right; font-size: 15px; font-weight: bold;">' . $prev . '.00</td>
                                </tr>';
                }
				  
			     if($sale->total == $sale->paid)
    			  {
			       $ticket .= '<tr style="font-size: 15px; font-weight: bold;">
                                <th style="padding-left:10%; font-size: 15px; font-weight: bold;">Payment Status</th>
                                <td colspan="3" style="text-align:right; font-size: 15px; font-weight: bold;">Paid</td>
                            </tr>';
    			  }
    			  elseif($sale->paid == 0)
    			  {
    			   $ticket .= '<tr style="font-size: 15px; font-weight: bold;">
                                <th style="padding-left:10%; font-size: 15px; font-weight: bold;">Payment Status</th>
                                <td colspan="3" style="text-align:right; font-size: 15px; font-weight: bold;">UnPaid</td>
                            </tr>';
    			  }
    			  else
    			  {
			       $ticket .= '<tr style="font-size: 15px; font-weight: bold;">
                            <th style="padding-left:10%; font-size: 15px; font-weight: bold;">Payment Status</th>
                            <td colspan="3" style="text-align:right; font-size: 15px; font-weight: bold;">Partial payment</td>
                        </tr>';
    			  }	  
				  
			  $ticket .= '<tr>
			  <td style="padding-left:10%; text-align:left; font-weight:bold; font-size:15px;"> ' .display('total'). ' </td>
			  <td colspan="3" style="text-align:right; font-weight:bold; font-size:15px;">' . number_format((float)$sale->total, settings()->decimals, '.', '') . ' ' . settings()->currency . '</td>
			  </tr><tr>
			  <td style="padding-left:10%; text-align:left; font-weight:bold; font-size:15px;">' .display('paid'). ':</td>
			  <td colspan="3" style="text-align:right; font-weight:bold;">'.$sale->paid.'</td>
			  </tr><tr><td style="padding-left:10%; text-align:left; font-weight:bold; font-size:15px;">Balance :</td>
			  <td colspan="3" style="text-align:right; font-size:15px; font-weight:bold;">'.number_format((float)$sale->total-$sale->paid, settings()->decimals, '.', '').'</td>
			  </tr></tbody></table>';
	  
			  $PayMethode = explode('~', $sale->paidmethod);
	  
			  $ticket .= '<span class="float-left" style="font-size: 15px; font-weight: bold;">Delivery Date : ' . $sale->delivery_date . '</span> <span class="float-right" style="font-size: 15px; font-weight: bold;">' . settings()->store_name . '</span>';
			 
			 // $ticket .= '<div style="border-top:1px solid #000; padding-top:10px;">    <span class="float-left">' . settings()->store_name . '</span><span class="float-right">' .display('phone'). ' : ' . settings()->store_phone . '</span><div style="clear:both;"><center> '.$this->sma->save_barcode($sale->id).' </center><br><div class="text-center"> '.settings()->receiptfooter.'</div><div class="text-center" style="background-color:#000;padding:5px;width:85%;color:#fff;margin:0 auto;border-radius:3px;margin-top:20px;">' . settings()->footer_text . '</div></div>';
			  
			  $ticket .= '<div style="border-top:1px solid #000; padding-top:10px;font-size: 15px; font-weight: bold;">
                    <span class="float-left">Pickup Date : ' . $sale->pickup_date . '</span>
                    <span class="float-right"> <i class="fa fa-phone"></i> ' . settings()->store_phone . '</span>';
                
                    $ticket .= '<div style="clear:both;">
                        <center>' . $this->sma->save_barcode($sale->invoice_id) . '</center><br>
                        <div class="text-center" style="font-weight:400;">' . settings()->receiptfooter . '</div>
                        <div class="text-center" style="background-color:#000;padding:5px;width:85%;color:#fff;margin:0 auto;border-radius:3px;margin-top:20px; font-weight:400;">' . settings()->footer_text . '</div>
                    </div>
                </div>';

			  
			  echo $ticket;
	}


     public function showimage($id)
    {
        $sale = $this->sale->get_by_id(array('id' => $id));
        $dataprint = $this->db->where('sale_id', $sale->id)->get('sale_items')->result();
        $ticket = '<div style="display: flex; flex-wrap: wrap; gap: 10px;">'; 
        $imageFound = false; 
        foreach ($dataprint as $posales) {
            if (!empty($posales->product_image)) {
                $images = json_decode($posales->product_image, true); 
                if (is_array($images) && count($images) > 0) {
                    foreach ($images as $img) {
                        $ticket .= '<img alt="Product Image" src="' . $img . '" width="30%" style="border-radius: 10px;">';
                        $imageFound = true;
                    }
                }
            }
        }
        if (!$imageFound) {
            $ticket .= '<p>No Image Available</p>';
        }
        $ticket .= '</div>';
        echo $ticket;
    }
    







}
