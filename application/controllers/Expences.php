<?php
class Expences extends CI_Controller {
	public function __construct() {

		parent::__construct();
		// check if a user logged in : helpers/auth_helper
		is_login();

		$this->load->model('expence_model','expence');
		$this->load->model('category_expence_model','category_expence');
		$this->load->vars(array('activemn' => 'product','lastid' => $this->expence->last_id()));
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
		$this->load->library('upload');
		$this->load->helper('download');

		//check permission  : helpers/auth_helper
		permission();
	   }

	// load expences view Page
	public function index()
	{
		$data['categories'] = $this->category_expence->get_all();
		$data['content_page']=$this->load->view('expence/index' ,$data,true);
		$this->load->view('tpl/template' ,$data);
	}
	//Add an expense
	public function add()
	{
			$data = array(
				'reference' => $this->input->post('num'),
				'note' => $this->input->post('note'),
				'date' => $this->input->post('date'),
				'year' => date('Y', strtotime($this->input->post('date'))),
				'month' => date('m', strtotime($this->input->post('date'))),
				'amount' => $this->input->post('amount'),
				'category_id' => $this->input->post('category_id'),
				'store_id' =>  $this->session->userdata('store_id'),
				'created_by' =>  $this->session->userdata('user_id'),
				'created_at' =>  date('Y-m-d H:s'),
			);
			    // if files is uploaded
			     if(isset($_FILES["attachment"]["name"]))  
                   {  
			            $config['upload_path']          = './files/expences/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 10000;
						$config['max_width']            = 1024;
						$config['max_height']           = 1024;
						
						$this->upload->initialize($config);
						$this->load->library('upload', $config);
		
						if($this->upload->do_upload('attachment'))
						{	
							$upload_data = $this->upload->data(); 
							$data['attachment'] =   $upload_data['file_name'];	
						} 
					}
				 if($this->expence->save($data))
							{
								$invID = str_pad($this->expence->last_id() + 1, 3, '0', STR_PAD_LEFT);
                                $numclt = 'EXP'.$invID;
								 $datajson=array(
									                    'add' =>'add',
														'msg' => display('successfully_added'),
														'lastid' =>  $numclt,
									                    ); 
							}
							else
							{
								echo '<span class="red">'.display('an_error_occurred').'</span>';
							}
			
		    // output to json format		
		    echo json_encode($datajson);
	}
    //--------- update a category-----------
	public function update($id=null)
	{
		if($this->input->post('expence_id'))
		{
			$data['categories'] = $this->category_expence->get_all();
			$data['expence'] = $this->expence->get_by_id($this->input->post('expence_id'));
			$this->load->view('expence/update' ,$data);
		}
	}
	public function update_ajax()
	{
		$data = array(
			'note' => $this->input->post('noteup'),
			'date' => $this->input->post('dateup'),
			'year' => date('Y', strtotime($this->input->post('dateup'))),
			'month' => date('m', strtotime($this->input->post('dateup'))),
			'amount' => $this->input->post('amountup'),
			'category_id' => $this->input->post('category_id'),
			'store_id' =>  $this->session->userdata('store_id'),
			'updated_at' =>  date('Y-m-d H:s'),
			'created_by' =>  $this->session->userdata('user_id'),
		);
			 $id = $this->input->post('idexpenceup');
			 if(isset($_FILES["attachment"]["name"]))  
                   {  
			            $config['upload_path']          = './files/expences/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 10000;
						$config['max_width']            = 1024;
						$config['max_height']           = 1024;
						
						$this->upload->initialize($config);
						$this->load->library('upload', $config);
		
						if($this->upload->do_upload('attachment'))
						{	
							$upload_data = $this->upload->data(); 
							$data['attachment'] =   $upload_data['file_name'];	
						} 
					}
			 if($this->expence->update($data,$id))
						{

							 $datajson=array(
													'update' =>'update',
													'msg' => display('successfully_updated')
													); 
						}
						else
						{
							echo '<span class="red">'.display('an_error_occurred').'</span>';
						}
				
		echo json_encode($datajson);
	}

	// ----------delete-------

	public function delete($id=null)
	{
		if($this->input->post('expence_id'))
		{
			echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">'.display('cancel').'</button>
			      <button type="button" class="btn btn-danger" onclick="deletebtm('.$this->input->post('expence_id').')">'.display('delet').'</button>
			   ';
		}
		if($id !=null)
		{
			$this->expence->delete_by_id($id);
			$datajson=array(
				'delete' =>'delete',
				'msg' => '<span class="alert-success">'.display('successfully_deleted').'<strang><i class="ace-icon fa fa-check"></i></strang> </span>'
				); 
			echo json_encode($datajson);
		}
	}
	function download($id=null)
	{
		$expence = $this->expence->get_by_id($id);
		if($expence->attachment !=null)
		 {
		   force_download('files/expences/'.$expence->attachment, null);
		 }
	}
	
	// View the list of categories
	public function ajax_expence($year=null)
    {
        $list = $this->expence->get_datatables($year);
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $expence) {   
            $no ++;
			$row = array();
			$row[] = $expence->date;
			$row[] = $expence->reference;
			$row[] = $expence->note;
			$row[] = $expence->namecategory;
			$row[] = number_format((float)$expence->amount, settings()->decimals, '.', '');
			
			if($expence->attachment)
			{
				$row[] = '<a href="'.base_url('expences/download/'.$expence->id).'" class="btn btn-xs btn-danger"><i class="glyph-icon simple-icon-paper-clip"></i></a>';
			}
			else
			{
				$row[] = display('there_is_no');
			}
			if($year == null)
			{
    			$row[] = '<a href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="'.$expence->id.'">
    			<button class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i>
    				'.'
    			  </button>
    				</a><a href="#updateclt" class="green" id="custId" data-toggle="modal" data-id="'.$expence->id.'">
    				<button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i>
    				'.'
    				</button>
    			</a>';
			}
     
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->expence->count_all($year),
            "recordsFiltered" => $this->expence->count_filtered($year),
            "data" => $data
        );
        // output to json format
        echo json_encode($output);
	}
	
}
