<?php
class Services extends CI_Controller {
	public function __construct() {

		parent::__construct();
		is_login();
		$this->load->model('service_model','service');
		$this->load->vars(array('activemn' => 'product','lastid' => $this->service->last_id()));
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';

		permission();
	   }

	public function index()
	{
		$data['content_page']=$this->load->view('service/index' ,$data=array(),true);
		$this->load->view('tpl/template' ,$data);
	}

	// ------------Add----------------------------
	public function add()
	{
			$data = array(
				'num' => $this->input->post('num'),
				'name' => $this->input->post('nameservice'),
				'store_id' =>  $this->session->userdata('store_id'),
				'user_id' =>  $this->session->userdata('user_id'),
				'created_at' =>  date('Y-m-d H:s'),
			);
				 if($this->service->save($data))
							{
								$invID = str_pad($this->service->last_id() + 1, 3, '0', STR_PAD_LEFT);
                                $numclt = 'CG'.$invID;
								 $datajson=array(
									                    'add' =>'add',
														'msg' => display('successfully_added'),
														'lastid' =>  $numclt,
									                    ); 
							}
							else
							{
								echo '<span class="red"> '.display('an_error_occurred').' </span>';
							}
					
		    echo json_encode($datajson);
	}
    //--------- update-----------
	public function update($id=null)
	{
		if($this->input->post('service_id'))
		{
			$this->load->view('service/update' ,array('service' => $this->service->get_by_id($this->input->post('service_id'))));
		}
	}
	public function update_ajax()
	{
		$data = array(
			'name' => $this->input->post('nameservice'),
			'updated_at' =>  date('Y-m-d H:s'),
			'user_id' =>  $this->session->userdata('user_id'),
		);
		     $id = $this->input->post('id');
			 if($this->service->update($data,$id))
						{

							 $datajson=array(
													'update' =>'update',
													'msg' => display('successfully_updated'),
													); 
						}
						else
						{
							echo '<span class="red"> '.display('an_error_occurred').'  </span>';
						}
				
		echo json_encode($datajson);
	}

	// ----------delete-------
	public function delete($id=null)
	{
		if($this->input->post('service_id'))
		{
			echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">'.display('cancel').' </button>
			      <button type="button" class="btn btn-danger" onclick="deletebtm('.$this->input->post('service_id').')"> '.display('delete').' </button>
			   ';
		}
		if($id !=null)
		{
			$this->service->delete_by_id($id);
			$datajson=array(
				'delete' =>'delete',
				'msg' => '<span class="alert-success"> '.display('successfully_deleted').' <strang><i class="ace-icon fa fa-check"></i></strang> </span>'
				); 
			echo json_encode($datajson);
		}
	}
	
	// View the list of services
	public function ajax_service()
    {
        $list = $this->service->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $service) {   
            $no ++;
			$row = array();
			$row[] = $service->num;
            $row[] = $service->name;
			$row[] = '<a href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="'.$service->id.'">
			<button class="btn btn-xs btn-danger">
			  <i class="far fa-trash-alt"></i>
			  </button>
		</a><a href="#updateclt" class="green" id="custId" data-toggle="modal" data-id="'.$service->id.'">
		<button class="btn btn-xs btn-info">
	    	<i class="fa fa-pencil"></i>
		  </button>
	</a>';
     
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->service->count_all(),
            "recordsFiltered" => $this->service->count_filtered(),
            "data" => $data
        );
        // output to json format
        echo json_encode($output);
	}
	
	
	

	
	
	
	
	
	
	
	
	
	
	
}
