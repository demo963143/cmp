<?php
class Orderstatus extends CI_Controller {
	public function __construct() {

		parent::__construct();
		is_login();
		$this->load->model('sale_model','sale');
		$this->load->model('orderstatus_model','orderstatus');
		$this->load->vars(array('activemn' => 'sales','lastid' => $this->sale->last_id()));
		$this->load->helper('language');
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
	   }
	   
// 	public function index()
// 	{ 
	   

// 	     if ($this->input->is_ajax_request()) {
	         
// 	        $store_id = $_SESSION['store_id'];
	       
// 			$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',0);
// 			if(isset($_REQUEST['data_val']))
// 	        {
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
// 			$this->db->where('sales.store_id',$store_id);
// 			$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['orders_placed']= $query->result();
			
// 			//echo $str = $this->db->last_query();

// 			$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',1);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        { 
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
// 			$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['current_status']= $query->result();
			 
// 			//echo $str = $this->db->last_query(); 
			
// 			$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',2);
// 			$this->db->where('sales.store_id',$store_id);
// 			if(isset($_REQUEST['data_val']))
// 	        {
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
// 			$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['picked_processing_plant']= $query->result();
			
// 			$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',3);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        { 
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
// 			$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['processing_plant']= $query->result();
			
// 			$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',4);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        { 
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 			$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['packed_delivery']= $query->result();
			
// 			$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',5);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        { 
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 			$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['delivered_outlet']= $query->result();
			
// 			$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',6);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        {  
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 	        // new status
	        
// 	        $this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['ready_to_dispatch']= $query->result();
			
// 			$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',7);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        {  
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 	        $this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['Pick_up_by_delivery_van']= $query->result();
			
// 			$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',8);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        {  
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 	        // new status
	        
	        
// 			$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['received_customer']= $query->result();
	

// 			echo $this->load->view('orderstatus/ajax_list' ,$data,true);
// 			exit();
// 		}
//         $data['title'] = 'Order Status';
//         $this->db->select("*");
// 		$this->db->where('store_id',$this->session->userdata('store_id'));
//         $query = $this->db->get("users");
//         $result =  $query->result();
//         $data['result'] = $result;
//         $data['content_page']=$this->load->view('orderstatus/index' ,$data,true);
//         // echo"<pre>";print_r($data);die;
// 		$this->load->view('tpl/template' ,$data);
// 	}

 

      //  change 10/02/2025
//     public function index()
// 	{ 
// 	     if ($this->input->is_ajax_request()) {
	         
// 	        $store_id = $_SESSION['store_id'];
	        
// 			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->select('sales.id, clientname, sales.id as order_no, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',0);
// 			if(isset($_REQUEST['data_val']))
// 	        {
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
// 			$this->db->where('sales.store_id',$store_id);
			
//             // $this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
            
//             $this->db->group_by('sales.id');

// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['orders_placed']= $query->result();
			
// 			//echo $str = $this->db->last_query();

// 		//	$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->select('sales.id, clientname, sales.id as order_no, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',1);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        { 
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
// 		  //	$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 		                 $this->db->group_by('sales.id');

// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['Picked_up_by_delivery_van']= $query->result();
			 
// 			//echo $str = $this->db->last_query(); 
			
// 			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 			$this->db->select('sales.id, clientname, sales.id as order_no, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',2);
// 			$this->db->where('sales.store_id',$store_id);
// 			if(isset($_REQUEST['data_val']))
// 	        {
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
// 			//$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 			 		                 $this->db->group_by('sales.id');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['delivered_at_plant']= $query->result();
			
// 			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 						$this->db->select('sales.id, clientname, sales.id as order_no, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',3);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        { 
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
// 			//$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 					                 $this->db->group_by('sales.id');

// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['recieved_at_plant']= $query->result();
			
// 			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 						$this->db->select('sales.id, clientname, sales.id as order_no, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',4);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        { 
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 			//$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 				                 $this->db->group_by('sales.id');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['Sorting_and_processing_through']= $query->result();
			
// 			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 						$this->db->select('sales.id, clientname, sales.id as order_no, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',5);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        { 
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 	        ///////
// 			//$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
			
// 					                 $this->db->group_by('sales.id');
			
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['Packing_and_sticker_print']= $query->result();
			
// 			////
// 		//	$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 					$this->db->select('sales.id, clientname, sales.id as order_no, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',6);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        {  
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 	        //$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 	        		                 $this->db->group_by('sales.id');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['ready_to_dispatch']= $query->result();
			
// 			// new status
// 			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
// 						$this->db->select('sales.id, clientname, sales.id as order_no, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',7);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        {  
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 	       // $this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 	       		                 $this->db->group_by('sales.id');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['Delivered_at_franchise']= $query->result();


//             ////

//             //$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
//             			$this->db->select('sales.id, clientname, sales.id as order_no, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',8);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        {  
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 	        //$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 	        		                 $this->db->group_by('sales.id');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['Franchise_received_through_sticker']= $query->result();
			

//             //

//           // $this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
//           			$this->db->select('sales.id, clientname, sales.id as order_no, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',9);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        {  
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 	        //$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 	        		                 $this->db->group_by('sales.id');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['delivered_to_customer']= $query->result();
			
//             ///
            
//             //$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
//             			$this->db->select('sales.id, clientname, sales.id as order_no, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

// 			$this->db->from('sales');
// 			$this->db->join('sale_items','sale_items.sale_id = sales.id');
// 			$this->db->where('sales.status',10);
// 			$this->db->where('sales.store_id',$store_id); 
// 			if(isset($_REQUEST['data_val'])) 
// 	        {  
// 			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
// 	        }
	        
// 	        //$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
// 	        		                 $this->db->group_by('sales.id');
// 			$this->db->order_by("sales.id desc");
// 			$query = $this->db->get();
// 			$data['Pick_up_by_delivery_van']= $query->result();
			
	        
// 	        // new status
	        
	        
	

// 			echo $this->load->view('orderstatus/ajax_list' ,$data,true);
// 			exit();
// 		}
		
//         $data['title'] = 'Order Status';
//         $this->db->select("*");
// 		$this->db->where('store_id',$this->session->userdata('store_id'));
//         $query = $this->db->get("users");
//         $result =  $query->result();
//         $data['result'] = $result;
//         $data['content_page']=$this->load->view('orderstatus/index' ,$data,true);
//         // echo"<pre>";print_r($data);die;
// 		$this->load->view('tpl/template' ,$data);
// 	}


    public function index()
	{ 
	     if ($this->input->is_ajax_request()) {
	         
	        $store_id = $_SESSION['store_id'];
	        
			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
			$this->db->select('sales.id, clientname, sales.id as order_no, sales.invoice_id, delivery_date,sale_items.barcode, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');
			$this->db->from('sales');
			$this->db->join('sale_items','sale_items.sale_id = sales.id');
			$this->db->where('sale_items.status',0);
			if(isset($_REQUEST['data_val']))
	        {
			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
	        }
			$this->db->where('sales.store_id',$store_id);
            $this->db->group_by('sales.id');
			$this->db->order_by("sales.id desc");
			$query = $this->db->get();
			$data['orders_placed']= $query->result();
			
			//echo $str = $this->db->last_query();

			$this->db->select('sales.id, clientname, sales.id as order_no,sales.invoice_id,sale_items.barcode, delivery_date,pickedups.image,pickedups.signature, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');
			$this->db->from('sales');
			$this->db->join('sale_items','sale_items.sale_id = sales.id');
			$this->db->join('pickedups','pickedups.order_id = sales.id','left');
			$this->db->where('sale_items.status',1);
			$this->db->where('sales.store_id',$store_id); 
			if(isset($_REQUEST['data_val'])) 
	        { 
			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
	        }
		  //	$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
		                 $this->db->group_by('sales.id');

			$this->db->order_by("sales.id desc");
			$query = $this->db->get();
			$data['Picked_up_by_delivery_van']= $query->result();
			 
			//echo $str = $this->db->last_query(); 
			
			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
			$this->db->select('sales.id, clientname, sales.id as order_no,sales.invoice_id,sale_items.barcode, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

			$this->db->from('sales');
			$this->db->join('sale_items','sale_items.sale_id = sales.id');
			$this->db->where('sale_items.status',2);
			$this->db->where('sales.store_id',$store_id);
			if(isset($_REQUEST['data_val']))
	        {
			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
	        }
			//$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
			 		                 $this->db->group_by('sales.id');
			$this->db->order_by("sales.id desc");
			$query = $this->db->get();
			$data['delivered_at_plant']= $query->result();
			
			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
			$this->db->select('sales.id, clientname, sales.id as order_no,sale_items.barcode,sales.invoice_id, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');
			$this->db->from('sales');
			$this->db->join('sale_items','sale_items.sale_id = sales.id');
			$this->db->where('sale_items.status',3);
			$this->db->where('sales.store_id',$store_id); 
			if(isset($_REQUEST['data_val'])) 
	        { 
			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
	        }
			//$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
			$this->db->group_by('sales.id');

			$this->db->order_by("sales.id desc");
			$query = $this->db->get();
			$data['recieved_at_plant']= $query->result();
			
			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
			$this->db->select('sales.id, clientname, sales.id as order_no,sale_items.barcode,sales.invoice_id, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

			$this->db->from('sales');
			$this->db->join('sale_items','sale_items.sale_id = sales.id');
			$this->db->where('sale_items.status',4);
			$this->db->where('sales.store_id',$store_id); 
			if(isset($_REQUEST['data_val'])) 
	        { 
			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
	        }
	        
			//$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
				                 $this->db->group_by('sales.id');
			$this->db->order_by("sales.id desc");
			$query = $this->db->get();
			$data['Sorting_and_processing_through']= $query->result();
			
			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
			$this->db->select('sales.id, clientname, sales.id as order_no,sales.invoice_id, delivery_date,sale_items.barcode, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

			$this->db->from('sales');
			$this->db->join('sale_items','sale_items.sale_id = sales.id');
			$this->db->where('sale_items.status',5);
			$this->db->where('sales.store_id',$store_id); 
			if(isset($_REQUEST['data_val'])) 
	        { 
			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
	        }
	        
	        ///////
			//$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
			
			$this->db->group_by('sales.id');
			
			$this->db->order_by("sales.id desc");
			$query = $this->db->get();
			$data['Packing_and_sticker_print']= $query->result();
			
			////
		//	$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
			$this->db->select('sales.id, clientname,sales.invoice_id, sales.id as order_no,sale_items.barcode, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

			$this->db->from('sales');
			$this->db->join('sale_items','sale_items.sale_id = sales.id');
			$this->db->where('sale_items.status',6);
			$this->db->where('sales.store_id',$store_id); 
			if(isset($_REQUEST['data_val'])) 
	        {  
			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
	        }
	        
	        //$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
	        $this->db->group_by('sales.id');
			$this->db->order_by("sales.id desc");
			$query = $this->db->get();
			$data['ready_to_dispatch']= $query->result();
			
			// new status
			//$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
			$this->db->select('sales.id, clientname,sales.invoice_id, sales.id as order_no,sale_items.barcode, delivery_date,pickedups.image,pickedups.signature, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

			$this->db->from('sales');
			$this->db->join('sale_items','sale_items.sale_id = sales.id');
			$this->db->join('pickedups','pickedups.order_id = sales.id','left');
			$this->db->where('sale_items.status',7);
			$this->db->where('sales.store_id',$store_id); 
			if(isset($_REQUEST['data_val'])) 
	        {  
			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
	        }
	        
	       // $this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
	       	$this->db->group_by('sales.id');
			$this->db->order_by("sales.id desc");
			$query = $this->db->get();
			$data['Delivered_at_franchise']= $query->result();


            ////

            //$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
            $this->db->select('sales.id, clientname,sales.invoice_id, sales.id as order_no, delivery_date,sale_items.barcode, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

			$this->db->from('sales');
			$this->db->join('sale_items','sale_items.sale_id = sales.id');
			$this->db->where('sale_items.status',8);
			$this->db->where('sales.store_id',$store_id); 
			if(isset($_REQUEST['data_val'])) 
	        {  
			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
	        }
	        
	        //$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
	        $this->db->group_by('sales.id');
			$this->db->order_by("sales.id desc");
			$query = $this->db->get();
			$data['Franchise_received_through_sticker']= $query->result();
			

            //

           // $this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
        	$this->db->select('sales.id,sales.invoice_id, clientname, sales.id as order_no,sale_items.barcode, delivery_date, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

			$this->db->from('sales');
			$this->db->join('sale_items','sale_items.sale_id = sales.id');
			$this->db->where('sale_items.status',9);
			$this->db->where('sales.store_id',$store_id); 
			if(isset($_REQUEST['data_val'])) 
	        {  
			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
	        }
	        
	        //$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
	        		                 $this->db->group_by('sales.id');
			$this->db->order_by("sales.id desc");
			$query = $this->db->get();
			$data['delivered_to_customer']= $query->result();
			
            ///
            
            //$this->db->select('sales.id,clientname,sales.id as order_no,delivery_date,sale_items.name,SUM(sale_items.qt) AS qt');
			 $this->db->select('sales.id, clientname,sales.invoice_id, sales.id as order_no, delivery_date,sale_items.barcode, sale_items.name, SUM(CASE WHEN sale_items.name != "Laundry By Kilo" THEN sale_items.qt ELSE 0 END) AS qt');

			$this->db->from('sales');
			$this->db->join('sale_items','sale_items.sale_id = sales.id');
			$this->db->where('sale_items.status',10);
			$this->db->where('sales.store_id',$store_id); 
			if(isset($_REQUEST['data_val'])) 
	        {  
			    $this->db->where('`client_id` IN (SELECT `id` FROM `clients` Where user_id="'.$_REQUEST['data_val'].'")', NULL, FALSE);
	        }
	        
	        //$this->db->group_by('sales.id,clientname,delivery_date,sale_items.type_one,sale_items.type_second,sale_items.color');
	        		                 $this->db->group_by('sales.id');
			$this->db->order_by("sales.id desc");
			$query = $this->db->get();
			$data['Pick_up_by_delivery_van']= $query->result();
			
	        
	        // new status
	        
	        
	

			echo $this->load->view('orderstatus/ajax_list' ,$data,true);
			exit();
		}
		
        $data['title'] = 'Order Status';
        $this->db->select("*");
		$this->db->where('store_id',$this->session->userdata('store_id'));
        $query = $this->db->get("users");
        $result =  $query->result();
        $data['result'] = $result;
        $data['content_page']=$this->load->view('orderstatus/index' ,$data,true);
        
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
	public function ShowTicket($id)
	{
		      $this->load->library('Sma');
			  $this->load->model('sale_model','sale');
			
			  $barcode = $this->input->post('barcode');
              $qt = $this->input->post('qt');
			 
			  $sale = $this->sale->get_by_id(array('id' => $id));
			 // $posales_parent = $this->sale->get_items(array('parent' => false,'sale_id' => $sale->id));
			  
			 $posales_parent = $this->sale->get_items(array('sale_id' => $sale->id,'barcode' => $barcode,'qt'=> $qt));

			  $ticket = '<div class="col-md-13"><div class="text-center"><img alt="logo" src="'.base_url().'/files/img/'. settings()->logo.'" width="25%"><br>' . settings()->receiptheader . '</div><div style="clear:both;"><h4 class="text-center">' . display('sale_num') . '.: ' . $sale->invoice_id . '</h4> <div style="clear:both;"></div><span class="float-left"> ' .display('date'). ': ' . $sale->created_at . '</span><br><div style="clear:both;"><span class="float-left"> ' .display('client'). ' : ' . $sale->clientname . '</span><div style="clear:both;"><table class="table" cellspacing="0" border="0"><thead><tr><th><em>#</em></th><th>' .display('product'). '</th><th> ' .display('quantity'). '</th><th>  ' .display('total'). '</th></tr></thead><tbody>';
	          
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
						$ticket_services .='- <span>'.$service->name.' '. number_format((float)($service->price), settings()->decimals, '.', '') . '</span><br>'; 
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
				
				  $i ++;
			  }
			  
			  
			  
			  
			  
	  
			  $ticket .= '</tbody></table><table class="table" cellspacing="0" border="0" style="margin-bottom:8px;"><tbody><tr><td style="text-align:left;"> ' .display('number_of_services'). ': </td><td style="text-align:right; padding-right:1.5%;">' . $sale->totalitems . '</td><td style="text-align:left; padding-left:1.5%;"> ' .display('subtotal'). ':  </td><td style="text-align:right;font-weight:bold;">' . $sale->subtotal . ' ' . settings()->currency . '</td></tr>';
			  if (intval($sale->discount))
				  $ticket .= '<tr><td style="text-align:left; padding-left:1.5%;"></td><td style="text-align:right;font-weight:bold;"></td><td style="text-align:left;">:' .display('discounts'). ' </td><td style="text-align:right; padding-right:1.5%;font-weight:bold;">' . $sale->discount . '</td></tr>';
				  
			  if($sale->total == $sale->paid)
			  {
		       $ticket .= '<tr>
                            <th style="text-align:left; padding-left:1.5%;">Payment Status</th>
                            <td style="text-align:right;font-weight:bold;">Paid</td>
                        </tr>';
			  }
			  elseif($sale->paid == 0)
			  {
			   $ticket .= '<tr>
                            <th style="text-align:left; padding-left:1.5%;">Payment Status</th>
                            <td style="text-align:right;font-weight:bold;">UnPaid</td>
                        </tr>';
			  }
			  else
			  {
		       $ticket .= '<tr>
                        <th style="text-align:left; padding-left:1.5%;">Payment Status</th>
                        <td style="text-align:right;font-weight:bold;">Partial Payment</td>
                    </tr>';
			  }		  
			
			  $tax_valued = str_replace('%', '', $sale->tax);	  
			  if (intval($tax_valued!= 0)){ 
			  $ticket .= '<tr><td style="text-align:left;">
			  </td><td style="text-align:right; padding-right:1.5%;font-weight:bold;"></td>
			  <td style="text-align:left; padding-left:1.5%;"> ' .display('tax'). ': </td>
			  <td style="text-align:right;font-weight:bold;">' . $sale->tax . '</td></tr>';
	          }
			  
			  $ticket .= '<tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;"> ' .display('total'). ' </td>
			  <td colspan="2" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">' . number_format((float)$sale->total, settings()->decimals, '.', '') . ' ' . settings()->currency . '</td>
			  </tr><tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">' .display('paid'). ':</td><td colspan="2" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">'.$sale->paid.'</td>
			  </tr><tr><td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">Balance :</td>
			  <td colspan="2" style="border-top:1px dashed #000; padding-top:5px; text-align:right; font-weight:bold;">'.number_format((float)$sale->total-$sale->paid, settings()->decimals, '.', '').'</td>
			  </tr></tbody></table>';
	  
			  $PayMethode = explode('~', $sale->paidmethod);
	  
			  $ticket .= '<span class="float-left">Delivery Date : ' . $sale->delivery_date . '</span><span class="float-right">Pickup Date : ' . $sale->pickup_date . '</span>';
			 // $ticket .= '<div style="border-top:1px solid #000; padding-top:10px;"><span class="float-left">' . settings()->store_name . '</span><span class="float-right">' .display('phone'). ' : ' . settings()->store_phone . '</span><div style="clear:both;"><center> '.$this->sma->save_barcode($sale->id).' </center><br><div class="text-center"> '.settings()->receiptfooter.'</div><div class="text-center" style="background-color:#000;padding:5px;width:85%;color:#fff;margin:0 auto;border-radius:3px;margin-top:20px;">' . settings()->footer_text . '</div></div>';
			  
			  
			   $ticket .= '<div style="border-top:1px solid #000; padding-top:10px;">
                    <span class="float-left">' . settings()->store_name . '</span>
                    <span class="float-right">' . display('phone') . ' : ' . settings()->store_phone . '</span>';
                
                    if (isset($sale->store_pickup_delivery)) {
                     $ticket .= '<br><span class="float-right">Store: ' . htmlspecialchars($sale->store_pickup_delivery) . '</span>';                  
                    }
                
                    $ticket .= '<div style="clear:both;">
                        <center>' . $this->sma->save_barcode($sale->id) . '</center><br>
                        <div class="text-center">' . settings()->receiptfooter . '</div>
                        <div class="text-center" style="background-color:#000;padding:5px;width:85%;color:#fff;margin:0 auto;border-radius:3px;margin-top:20px;">' . settings()->footer_text . '</div>
                    </div>
                </div>';
			  
			  echo $ticket;
	}
	
	// View the list of sales
	public function ajax_list($year=null)
    {
        $list = $this->sale->get_datatables($year);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $invoice) {
            $no ++;
            $row = array();
            $row[] = sprintf("%05d", $invoice->id);
            $row[] = $invoice->created_at;
            $row[] = $invoice->clientname;
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
            $row[] = '<span class="' . $classeStyle . '">' . $satus . '<span>';
			$row[] = '<span class="' . $classe2 . '">' . $statusdelev . '<span>';
            // add html for action
			   if($year==null)
			   {
				$row[] = '<div class="dropdown d-inline-block">
				<button class="btn btn-outline-primary dropdown-toggle mb-1" type="button"
					id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">
					' .display('action'). '
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="javascript:void(0)" onclick="showTicket(' . "'" . $invoice->id . "'" . ')"><i class="fa fa-sticky-note" aria-hidden="true"></i> ' .display('bill'). '</a>
					<a class="dropdown-item" href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="'.$invoice->id.'"><i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  ' .display('delete'). ' </a>
				</div>
			</div>';
			   }
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
    
    
    public function checkbarcode()
    {
        $barcode = $this->input->post('scannerId');
        $barcodescanner = $this->sale->check_barcode_check($barcode);
        if ($barcodescanner) { 
            echo json_encode($barcodescanner);
        } else {
            echo json_encode(null);
        }
    }
    
    
    public function update_status()
    {
        $barcode = $this->input->post('scannerId');
        $status = $this->input->post('statusId');
        $qty = $this->input->post('qty');
        $updated = $this->sale->barcodeitemsupdate($barcode,$status,$qty); 
        if ($updated) {
          echo json_encode(['status' => 'success', 'message' => "Barcode Update successfully"]); 
        } else {
            echo json_encode(['status' => 'error', 'message' => "Error updating data for barcode: "]); 
        }
    }
    
    
    public function print_sticker()
    {
        $id = $this->input->post('id');
        $orderid = $this->sale->check_stickers($id);
        
        // print_r($orderid); die;
         
        if ($orderid) { 
            echo json_encode(['status' => 1,'message' => 'print sticker successfully','order_id' => $orderid]);
        } else {
             echo json_encode(['status' => 0,'message' => 'Barcode Orderid Not Match']);
        }
    }
    
    
    
    
	
}
