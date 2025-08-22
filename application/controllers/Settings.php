<?php
class Settings extends CI_Controller {
	public function __construct() {
		parent::__construct();
		is_login();
		$this->load->vars(array('activemn' => 'setting'));
		$this->load->model('currency_model','currency');
		$this->load->model('color_model','color');
		$this->load->model('language_model','language');
		$this->load->model('store_model','store');
		$this->load->model('user_model','user');
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';

		permission();
	   }
	   
	public function index()
	{
	    //print_r($_POST); die;
		$this->load->library('form_validation');
		// sms library bulksmsnigeria
		//$this->load->library('bulksmsnigeria');

		$this->load->library('upload');
		
		if($this->input->post())
		{
			$this->form_validation->set_rules('storename', display('storename'), 'required');
			$this->form_validation->set_rules('currency', display('currency'), 'required');
		  //$this->form_validation->set_rules('language', display('language'), 'required');
			if ($this->form_validation->run())
                {
                    $data =array(
						'store_name' => $this->input->post('storename'),
						'store_address' => $this->input->post('storeaddress'),
						'store_email' => $this->input->post('storeemail'),
						'store_phone' => $this->input->post('storephone'),
						'currency' => $this->input->post('currency'),
						'audio_alert' => $this->input->post('audioalert'),
						'language' => $this->input->post('language'),
						'discount' => $this->input->post('discount'),
						'tax' => $this->input->post('tax'),
						'receiptheader' => $this->input->post('receiptheader'),
						'receiptfooter' => $this->input->post('receiptfooter'),
						'footer_text' => $this->input->post('footer_text'),
						'sms_add_order' => $this->input->post('sms_add_order'),
						'sms_order_readyr' => $this->input->post('sms_order_readyr'),
						'senderId' => $this->input->post('senderid'),
						'api_sms' => $this->input->post('api_sms'),
					    'store_id' => $this->session->userdata('store_id'),
					);
						// Upload Image
						$config['upload_path']          = './files/img/';
						$config['allowed_types']        = 'gif|jpg|png|jpeg';
						$config['max_size']             = 10000;
					//	$config['max_width']            = 1024;
					//	$config['max_height']           = 1024;
						
						$this->upload->initialize($config);
						$this->load->library('upload', $config);
		
						if ($this->upload->do_upload('logo'))
						{	
							$upload_data = $this->upload->data(); 
							$data['logo'] =   $upload_data['file_name'];	
						}
					
					    $store_id = $this->session->userdata('store_id');	
					    $existing_store = $this->store->get_by_id($store_id);
		
					if ($existing_store) {
                        $this->store->update($data, $store_id);
                        $this->session->set_flashdata('msg_success', display('successfully_updated'));
                    } else {
                        $store_id = $this->store->save($data);
                        $this->session->set_flashdata('msg_success', display('successfully_added'));
                    }
                }
		}
		
		$store_id = $this->session->userdata('store_id');
		$data['settings'] = $this->store->featch_data($store_id);
	

		$data['currencies'] = $this->currency->get_all();
		$data['colors'] = $this->color->get_all();
		$data['languages']    = $this->languages();
		$data['content_page']=$this->load->view('setting/index' ,$data,true);
        $this->load->view('tpl/template' ,$data);
	}
	
	public function profile()
	{
		$this->load->library('form_validation');
		if($this->input->post())
		{
			$this->form_validation->set_rules('email', display('email'), 'required');
			$this->form_validation->set_rules('name', display('name'), 'required');
			if ($this->form_validation->run())
                {
                    $data =array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
					);
						// update password
						if(!empty($this->input->post('password')) && !empty($this->input->post('oldpassword')))
						{	
							$old= $this->input->post('old');
							$oldpassword= md5(sha1($this->input->post('oldpassword')));

							if($old == $oldpassword)
							{
							$data['password'] =  md5(sha1($this->input->post('password')));	
							}
							else
							{
								$this->session->set_flashdata('msg_error', display('password_does_not_match'));
							}
						}
						//
					$this->user->update($data,$this->session->userdata('user_id'));
					$this->session->set_flashdata('msg_success', display('successfully_updated'));
                }
		}
		$data['user'] = $this->user->get_by_id($this->session->userdata('user_id'));
		$data['content_page']=$this->load->view('setting/profile' ,$data,true);
        $this->load->view('tpl/template' ,$data);
	}

	//add Currency
	public function addCurrency()
	{
			$data = array(
				'code' => $this->input->post('code'),
				'country' => $this->input->post('country'),
				'store_id' => $this->session->userdata('store_id')
			);
				 if($this->currency->save($data))
							{
								 $id =$this->db->insert_id();
								 $datajson=array(
									                    'add' =>'add',
														'msg' => display('successfully_added'),
														'insertid' => $id,
									                    ); 
							}
							else
							{
								echo '<span class="red">  '.display('an_error_occurred').'   </span>';
							}
					
		    echo json_encode($datajson);
	}
	//add Color
	public function addColor()
	{
			$data = array(
				'color' => $this->input->post('color'),
				'name' => $this->input->post('namecolor'),
				'store_id' => $this->session->userdata('store_id')
			);
				 if($this->color->save($data))
							{
								 $id =$this->db->insert_id();
								 $datajson=array(
									                    'add' =>'add',
														'msg' => display('successfully_added'),
														'insertid' => $id,
									                    ); 
							}
							else
							{
								echo '<span class="red">  '.display('an_error_occurred').'   </span>';
							}
					
		    echo json_encode($datajson);
	}
	public function load_Currencies($id=null)
    {
		     $selectedclt = '';
		     $load_Currencies = '<option value="0"> </option>';
			foreach ($this->currency->get_all() as $currency):
				if($currency->id == $id) $selectedclt = 'selected';
				$load_Currencies.='<option '.$selectedclt.' value="'.$currency->id.'"> '.$currency->country.'('.$currency->code.')'.' </option>';
			endforeach;
			echo  $load_Currencies;
	 }
	 public function load_colors()
	 {
		 $colorData="";
		$colors = $this->color->get_all();
		foreach($colors as $color)
		{
			$colorData .='<tr>
				<td>'.$color->name.'</td>
				<td style="color:#ffffff;background-color:'.$color->color.'">'.$color->color.'</td>
				<td><a href="#" onclick="deletecColor('. $color->id .')"><i class="glyph-icon simple-icon-trash"></i></a></td>
			</tr>';
		}
		echo $colorData;
	 }
	 public function deletecColor($idColor)
	 {
		 $this->color->delete_by_id($idColor);
		 $datajson=array(
			'delete' =>'delete',
			'msg' => '<span class="alert-success"> '.display('successfully_deleted').'<strang><i class="ace-icon fa fa-check"></i></strang> </span>'
			); 
		echo json_encode($datajson);
	 }
	 public function languages()
    { 
        if ($this->db->table_exists('language')) { 

                $fields = $this->db->field_data('language');

                $i = 1;
                foreach ($fields as $field)
                {  
                    if ($i++ > 2)
                    $result[$field->name] = ucfirst($field->name);
                }

                if (!empty($result)) return $result;
 

        } else {
            return false; 
        }
    }

}
