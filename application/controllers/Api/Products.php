<?php
class Products extends CI_Controller {
	public function __construct() {

		parent::__construct();
		$this->load->model('product_model','product');
		$this->load->model('Category_model','Category');
	}
	
	
    public function save(){ 
	    
	    $ironingnormal = $_POST['ironingnormal'];
	    $ironingnormaldata= json_encode($ironingnormal, true); 
	    
	    $ironingexpress = $_POST['ironingexpress'];
	    $ironingexpressdata= json_encode($ironingexpress, true); 
	    
	    $laundrynormal = $_POST['laundrynormal'];
	    $laundrynormaldata= json_encode($laundrynormal, true); 
	    
	    $laundryexpress = $_POST['laundryexpress'];
	    $laundryexpressdata= json_encode($laundryexpress, true); 
	    
	    $laundryironnormal = $_POST['laundryironnormal'];
	    $laundryironnormaldata= json_encode($laundryironnormal, true); 
	    
	    $laundryironexpress = $_POST['laundryironexpress'];
	    $laundryironexpressdata= json_encode($laundryironexpress, true); 
	    
	    $drywashnormal = $_POST['drywashnormal'];
	    $drywashnormaldata= json_encode($drywashnormal, true); 
	    
	    $drywashexpress = $_POST['drywashexpress'];
	    $drywashexpressdata= json_encode($drywashexpress, true); 
	    
	   // $item_name = $_POST['item_name'];
	   // $itemnamedetails = json_encode($item_name, true); 
	    
	   // $servid = $_POST['servid'];
	   // $serviddetails = json_encode($servid, true); 
	   
	    $service = $_POST['service'];
	    $servicedetails = json_encode($service, true); 
	   
	   
	   // $this->db->update('products', $data);
	    try{
	        if($this->input->method() == 'post') {
                $product_id = $this->product->insert([
                    'num'=>$this->input->post('num'),
                    'name'=>$this->input->post('name'),
                    'category_id'=>$this->input->post('category_id'),
                    'ironingnormal'=>$ironingnormaldata,
                    'ironingexpress'=>$ironingexpressdata,
                    'laundrynormal'=>$laundrynormaldata,
                    'laundryexpress'=>$laundryexpressdata,
                    'laundryironnormal'=>$laundryironnormaldata,
                    'laundryironexpress'=>$laundryironexpressdata,
                    'drywashnormal'=>$drywashnormaldata,
                    'drywashexpress'=>$drywashexpressdata,
                    'service'=>$servicedetails,
                    // 'itemvalue'=>$itemnamedetails,
                    // 'servid'=>$serviddetails,
                    'status'=>'1'
                ]);
                
                 
                $invID = str_pad($product_id + 1, 3, '0', STR_PAD_LEFT);
                $numclt = 'PR' .$invID;
                echo json_encode([
                    'status'=>True,
                    'msg'=>$numclt
                ]);

                              
	        }
	        
	        
	    }catch(Exception $e){

	        echo json_encode([
              'status'=>False,
              'msg'=>$e->getMessage()
            ]);
	    }
	}
	

    public function update(){ 
	    
	  	$ironingnormal = $_POST['ironingnormal'];
	    $ironingnormaldata= json_encode($ironingnormal, true); 
	    
	    $ironingexpress = $_POST['ironingexpress'];
	    $ironingexpressdata= json_encode($ironingexpress, true); 
	    
	    $laundrynormal = $_POST['laundrynormal'];
	    $laundrynormaldata= json_encode($laundrynormal, true); 
	    
	    $laundryexpress = $_POST['laundryexpress'];
	    $laundryexpressdata= json_encode($laundryexpress, true); 
	    
	    $laundryironnormal = $_POST['laundryironnormal'];
	    $laundryironnormaldata= json_encode($laundryironnormal, true); 
	    
	    $laundryironexpress = $_POST['laundryironexpress'];
	    $laundryironexpressdata= json_encode($laundryironexpress, true); 
	    
	    $drywashnormal = $_POST['drywashnormal'];
	    $drywashnormaldata= json_encode($drywashnormal, true); 
	    
	    $drywashexpress = $_POST['drywashexpress'];
	    $drywashexpressdata= json_encode($drywashexpress, true); 
	    
	   // $item_name = $_POST['item_name'];
	   // $itemnamedetails = json_encode($item_name, true); 
	    
	   // $servid = $_POST['servid'];
	   // $serviddetails = json_encode($servid, true); 
	   
	    $service = $_POST['service'];
	    $servicedetails = json_encode($service, true); 
	    
	    try{
	        if($this->input->method() == 'post') {
                $data = array( 
                    'num'=>$this->input->post('num'),
                    'name'=>$this->input->post('name'),
                    'category_id'=>$this->input->post('category_id'),
                    'ironingnormal'=>$ironingnormaldata,
                    'ironingexpress'=>$ironingexpressdata,
                    'laundrynormal'=>$laundrynormaldata,
                    'laundryexpress'=>$laundryexpressdata,
                    'laundryironnormal'=>$laundryironnormaldata,
                    'laundryironexpress'=>$laundryironexpressdata,
                    'drywashnormal'=>$drywashnormaldata,
                    'drywashexpress'=>$drywashexpressdata, 
                    'service'=>$servicedetails,
                    // 'itemvalue'=>$itemnamedetails,
                    // 'servid'=>$serviddetails 
                );

                $this->db->where('num', $this->input->post('num'));
                $this->db->update('products', $data);

                echo json_encode([
                    'status'=>True,
                    'msg'=>"Updated Successfully!"
                ]);

                              
	        }
	        
	        
	    }catch(Exception $e){

	        echo json_encode([
              'status'=>False,
              'msg'=>$e->getMessage()
            ]);
	    }
	}
	
	
	public function addcategory()
	{
	     $data = $this->Category->save([
            'num'=>$this->input->post('num'),
            'name'=>$this->input->post('name'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
	}
	
	

    
     public function getService(){ 
    	    try{
                $ids =$this->input->post('service_id');
                $services = $this->db->where('id',$ids)->get('services')->row();
                echo json_encode([
                    'status'=>True,
                    'msg'=>$services
                ]);
    	    }catch(Exception $e){
    
    	        echo json_encode([
                  'status'=>False,
                  'msg'=>$e->getMessage()
                ]);
    	    }
    }
    
    
       public function service(){ 
    	    try{
                $ids =$this->input->post('service_ids');
                $services = $this->db->where_in('id',$ids)->get('services')->result();
                echo json_encode([
                    'status'=>True,
                    'msg'=>$services
                ]);
    	    }catch(Exception $e){
    
    	        echo json_encode([
                  'status'=>False,
                  'msg'=>$e->getMessage()
                ]);
    	    }
    	}
	
	
	
	
	
	public function get_payment_options_status()
    {
        $url = "http://uataaservices.ahdigistg.com/api/AskApolloWeb/GetAvailablePaymentOptionsV2";
    
        $headers = [
            'xauthtoken: UATLUNCKNOWLP-3RBD71IC2ABDDMABBA82',
            'Client-IP: 112.196.59.228',
            'Content-Type: application/json'
        ];
    
        $payload = json_encode([
            "LocationId" => 10551,
            "PaymentRequestId" => 11
        ]);
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_POST, true);
    
        curl_exec($ch);
    
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Gets the HTTP response code
        curl_close($ch);
    
        return $httpCode;
    }

	
	
	
}