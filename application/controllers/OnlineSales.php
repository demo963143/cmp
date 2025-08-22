<?php
class OnlineSales extends CI_Controller {
	public function __construct() {

		parent::__construct();
		is_login();
        $this->load->database(); // Default DB
        $this->db2 = $this->load->database('second_db', TRUE);
		$this->load->model('onlinesale_model','onlinesale');
		$this->load->vars(array('activemn' => 'onlineSales','lastid' => $this->onlinesale->last_id()));
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

			   $dataexport['sales'] =$this->onlinesale->gen_pdf($startdate,$enddate);
			   $html = $this->load->view('sale/pdf',$dataexport,true);
			   $name = 'exportdepense.pdf';
			   // load sma library
	           $this->load->library('sma');
			    // generate pdf
	           $this->sma->generate_pdf('L',$html, $name);

		}
		//echo "<pre>";print_r($this->session->userdata());die;
		$this->db->select("*");
        $query = $this->db->get("users");
        $result =  $query->result();

        //echo "<pre>";print_r($result);die;
		$data['content_page']=$this->load->view('sale/onlinesales' ,$data=array('result'=>$result),true);
		$this->load->view('tpl/template' ,$data);
		
	}
	

    private function is_json_array($data) {
        // Decode JSON
        $decoded = json_decode($data, true);
    
        // Check if JSON is valid and is an array
        return (json_last_error() === JSON_ERROR_NONE) && is_array($decoded);
    }
	

	
	// View the list of sales
	public function ajax_list($year=null){
        $list = $this->onlinesale->get_datatables($year);
        $data = array();
        $no = $_POST['start'];
        // echo "<pre>";print_R($list);die;
        foreach ($list as $invoice) {
            $no ++;
            $row = array();
            $row[] = sprintf("%05d", $invoice->id);
            $row[] = $invoice->vendor_id;
            $row[] = $invoice->created_at;
            $row[] = $invoice->product_list;
            
            /*
            $products = $invoice->product_list;
            $proList = [];
            if($this->is_json_array($products)){
                $decoded = json_decode($products, true);
                foreach($decoded as $k=>$v){
                    array_push($proList,$v['name']);
                }
                $row[] = implode(",",$proList);
            }else{
               $row[] = $invoice->product_list;
            }
            */
            

            $user_id = $invoice->user_id;
            if(!empty($user_id)){
              $name = $this->db2->select('name')
                  ->get_where('customers', array('id' => $user_id))
                  ->row()
                  ->name;
                  $row[] = $name;
            }else{
                $row[] = "";
            }
            $row[] = $invoice->coupan;
            $row[] = $invoice->delivery_address;
            $row[] = $invoice->delivery_date;
            $row[] = $invoice->delivery_time;
            $row[] = $invoice->pickup_address;
            $row[] = $invoice->pickup_date;
            $row[] = $invoice->pickup_time;
            $row[] = $invoice->instructions;
            $row[] = $invoice->payment_method;
            
            $row[] = $invoice->shipping_cost;
            $row[] = number_format((float)$invoice->sub_total, settings()->decimals, '.', '');
            $row[] = number_format((float)$invoice->total_amount, settings()->decimals, '.', '');
            $row[] = $invoice->status;
            
            
            /*
            if($invoice->status){
                 $statusdelev = display('delivery');
                 $classe2 = "badge badge-success";
            }else{
				$statusdelev = display('did_not_deliver');
				$classe2 = "badge badge-danger";
			}
			
			if($invoice->total == $invoice->paid){
				$satus = display('paid');
				$classeStyle ='badge badge-success';
			}elseif($invoice->paid == 0){
				$satus = display('unpaid');
				$classeStyle ='badge badge-danger';
			}else{
				$satus = display('partial_payment');
				$classeStyle ='badge badge-warning';
			}
			*/
			
            // $row[] = '<span class="' . $classeStyle . '">' . $satus . '<span>';
			// $row[] = '<span class="' . $classe2 . '">' . $statusdelev . '<span>';
			
            // add html for action
            /*
			if($year==null){
    				$row[] = '<div class="dropdown d-inline-block">
    				<button class="btn btn-outline-primary dropdown-toggle mb-1" type="button"
    					id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
    					aria-expanded="false">
    					' .display('action'). '
    				</button>
    				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    					<a class="dropdown-item" href="javascript:void(0)" onclick="showTicket(' . "'" . $invoice->id . "'" . ')"><i class="fa fa-sticky-note" aria-hidden="true"></i> ' .display('bill'). '</a>
    					<a class="dropdown-item" href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="'.$invoice->id.'"><i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  ' .display('delete'). ' </a><a class="dropdown-item" href="https://wa.me/91'.$phone.'?text='.$html.'" target="_blank">Send Invoice</a>
    				</div>
    			</div>';
			 }
			   
			   $order_status = '<select onchange="change_order_status(' . "'" . $invoice->id . "'" . ','.this.')" class="btn btn-outline-primary" id="order_status" name="order_status">
                  <option value="0" >Pending</option>
                  <option value="1" >Processing</option>
                  <option value="2" >Ready To Deliver</option>
                  
                </select>';
                
                
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
                */       
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->onlinesale->count_all(array()),
            "recordsFiltered" => $this->onlinesale->count_filtered($year),
            "data" => $data
        );
        // output to json format
        echo json_encode($output);
    }
    
   
	
}
