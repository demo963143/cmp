<?php
require_once APPPATH . 'third_party/Zend/Barcode.php';
// use Zend\Barcode\Object;

class Auth extends CI_Controller {
	public function __construct() {
		
		parent::__construct();
		if($this->session->userdata('laundry_acess'))
		{
			 redirect("app");
		}
		$this->load->model('auth_model');
		
			$this->load->model('product_model','product');
		
		$this->load->library('zend');
        $this->zend->load('Zend/Barcode');
		
		$this->load->model('register_model','register_m');		
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
		$this->load->model('User_model','user');
	   }

	
	// Show login page
	public function index()
	{
		// Load form security library
		$this->load->helper('security');  
        // Load form validation library
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Username:', 'required|trim|xss_clean');  
		$this->form_validation->set_rules('password', 'Password:', 'required|trim');
		$data= array();
		if($this->form_validation->run())   
        {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			// Check for user login process
			if($this->auth_model->accountvalidation($email,$password)){
    			if($this->auth_model->validation($email,$password))
    			{
    				$auth_user = $this->auth_model->validation($email,$password);
    				$newdata['laundry_acess'] = $email;
    				$newdata['user_id'] = $auth_user->id;
    				$newdata['state'] = $auth_user->state;
    				$newdata['city'] = $auth_user->city;
    				$newdata['role_id'] = $auth_user->role_id;
    				$newdata['store_id'] = $auth_user->store_id;
    				$newdata['store_code'] = $auth_user->store_code;
    				$newdata['delivery_amount'] = $auth_user->delivery_amount;
    				$newdata['delivery_free_limit'] = $auth_user->delivery_free_limit;
    				
    				if($this->register_m->get_by_id(array('status' => '1','store_id' => $auth_user->store_id)))
    				{
    					$newdata['register'] = $this->register_m->get_by_id(array('status' => '1','store_id' => $auth_user->store_id))->id;
    				}
    				
    				// Add user data in session
    				$this->session->set_userdata($newdata);
    				$this->session->set_userdata(array('site_lang' => settings()->language));
    				redirect('app/');
    			}else
    			{
    				$this->session->set_flashdata('error_msg', display('user_password_incorrect'));
    			}
			}else{
			   	$this->session->set_flashdata('error_msg', 'Account Inactive'); 
			}	
		}
		
		
		
        $this->load->view('login/index' ,$data);
	}

// 	public function add_user_from_newway_laundry()
// 	{
// 			$data = array(
// 				'num' => $this->generate_user_code(),
// 				'name' => $this->input->post('name'),
// 				'email ' => $this->input->post('email'),
// 				'password' => md5(sha1($this->input->post('password'))),
// 				'role_id' =>  1,
// 				'state'=>$this->input->post('state'),
//                 'city'=>$this->input->post('city'),
//                 'area'=>$this->input->post('area'),
//                 'pincode'=>$this->input->post('pincode'),
//                 'latitude'=>$this->input->post('latitude'),
//                 'longitude'=>$this->input->post('longitude'),
//                 'delivery_amount'=>$this->input->post('delivery_amount'),
//                 'delivery_free_limit'=>$this->input->post('delivery_free_limit'),
// 				'store_id' =>  $this->input->post('code'),
// 				'store_code' =>  $this->input->post('store_code'),
// 				'created_at' => date('Y-m-d :H:s'),
// 			);
// 			if(!$this->user->check_user($_POST["email"]))  
// 				{ 
// 				 if($this->user->save($data))
// 					{
// 						$datajson=array(
												
// 						'msg' => display('successfully_added'),
						
// 						); 
						
						
						
						
						
						
						
// 					}
					
					
					
					
					
					
					
// 					else
// 					{
// 						$datajson=array(
												
// 							'msg' => 'Failed',
							
// 							); 
// 					}
// 				}
// 				else
// 				{
// 					$datajson=array(
// 						'error' =>'error',
// 						'msg' => display('email_exist'),
// 						); 
// 				}
					
// 		    echo json_encode($datajson);
// 	}




    public function add_user_from_newway_laundry()
	{
			$data = array(
				'num' => $this->generate_user_code(),
				'name' => $this->input->post('name'),
				'email ' => $this->input->post('email'),
				'password' => md5(sha1($this->input->post('password'))),
				'role_id' =>  1,
				'state'=>$this->input->post('state'),
                'city'=>$this->input->post('city'),
                'area'=>$this->input->post('area'),
                'pincode'=>$this->input->post('pincode'),
                'latitude'=>$this->input->post('latitude'),
                'longitude'=>$this->input->post('longitude'),
                'delivery_amount'=>$this->input->post('delivery_amount'),
                'delivery_free_limit'=>$this->input->post('delivery_free_limit'),
				'store_id' =>  $this->input->post('code'),
				'store_code' =>  $this->input->post('store_code'),
				'created_at' => date('Y-m-d :H:s'),
			);
			if(!$this->user->check_user($_POST["email"]))  
				{ 
				 if($userId = $this->user->save($data))
					{
						$datajson=array(
						  'msg' => display('successfully_added'),
						  'user_id' => $userId->id,
						); 
						
						
						$storeId = $this->input->post('code');
	    
                	    $ironingnormalvalue = 10;
                	    
                	    $data = [
                            [
                                "inr" => $ironingnormalvalue,
                                "franchise" => [$storeId]
                            ]
                        ];
                	    $ironingnormaldata= json_encode($data, true); 
                	    
                	    
                	    $ironingexpressvalue = 20;
                	    $ironingexpress = [
                            [
                                "inr" => $ironingexpressvalue,
                                "franchise" => [$storeId]
                            ]
                        ];
                	    $ironingexpressdata= json_encode($ironingexpress, true); 
                	    
                	    
                	    
                	    $laundrynormalvalue = 10;
                	    $laundrynormal = [
                            [
                                "inr" => $laundrynormalvalue,
                                "franchise" => [$storeId]
                            ]
                        ];
                	    $laundrynormaldata= json_encode($laundrynormal, true); 
                	    
                	    
                	    
                	    $laundryexpressvalue = 30;
                	    $laundryexpress = [
                            [
                                "inr" => $laundryexpressvalue,
                                "franchise" => [$storeId]
                            ]
                        ];
                	    $laundryexpressdata= json_encode($laundryexpress, true); 
                	    
                	    
                	    $laundryironnormalvalue = 10;
                	    $laundryironnormal = [
                            [
                                "inr" => $laundryironnormalvalue,
                                "franchise" => [$storeId]
                            ]
                        ];
                	    $laundryironnormaldata= json_encode($laundryironnormal, true); 
                	    
                	    
                	    
                	    $laundryironexpressvalue = 22;
                	    $laundryironexpress = [
                            [
                                "inr" => $laundryironexpressvalue,
                                "franchise" => [$storeId]
                            ]
                        ];
                	    $laundryironexpressdata= json_encode($laundryironexpress, true); 
                	    
                	    
                	    
                	    $drywashnormalvalue = 10;
                	    $drywashnormal = [
                            [
                                "inr" => $drywashnormalvalue,
                                "franchise" => [$storeId]
                            ]
                        ];
                	    $drywashnormaldata= json_encode($drywashnormal, true); 
                	    
                	    
                	    $drywashexpressvalue = 10;
                	    $drywashexpress = [
                            [
                                "inr" => $drywashexpressvalue,
                                "franchise" => [$storeId]
                            ]
                        ];
                	    $drywashexpressdata= json_encode($drywashexpress, true); 
                	    
                	    
                    
                        $item_values = 1; 
                        $servid = 1;
                        $service = [];
                       
                        $servicedetails = json_encode($service);
                        
                         $product_id = $this->product->insert([
                            'num'=>	$this->generate_user_code(),
                            'name'=>'Laundry By Kilo',
                            'category_id'=>16,
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
					}
					else
					{
						$datajson=array(
												
							'msg' => 'Failed',
							
							); 
					}
				}
				else
				{
					$datajson=array(
						'error' =>'error',
						'msg' => display('email_exist'),
						); 
				}
					
		    echo json_encode($datajson);
	}

        



	public function generate_user_code(){
		$lastid = $this->user->last_id();
        $invID = str_pad($lastid + 1, 3, '0', STR_PAD_LEFT);
		$numclt = 'US' . $invID;
        return $numclt;
    }
    
    
    public function inactive_from_newway_laundry($vandor_id)
    {
        $data = array('status' => '0');
        $this->db->where('store_id', $vandor_id);
        $updated = $this->db->update('users', $data);
    }

    
     public function active_from_newway_laundry($vandor_id)
    {
        $data = array('status' => '1');
        $this->db->where('store_id', $vandor_id);
        $updated = $this->db->update('users', $data);
    }
    
    
  
   
    
    
	
}
