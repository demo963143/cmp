<?php
class Categorie_expences extends CI_Controller {
	public function __construct() {

		parent::__construct();
		// check if a user logged in : helpers/auth_helper
		is_login();

		$this->load->model('category_expence_model','category_expence');
		$this->load->vars(array('activemn' => 'product','expence' => $this->category_expence->last_id()));

		// check language session
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
	   }

	// load categories view Page
	public function index()
	{
		$data['content_page']=$this->load->view('expence/categories' ,$data=array(),true);
		$this->load->view('tpl/template' ,$data);
	}

	// Add a expence
	public function add()
	{
			$data = array(
				'name' => $this->input->post('name'),
				'store_id' =>  $this->session->userdata('store_id'),
				'created_date' =>  date('Y-m-d H:s'),
			);
				 if($this->category_expence->save($data))
							{
								//Generate a number  
								$invID = str_pad($this->category_expence->last_id() + 1, 3, '0', STR_PAD_LEFT);
                                $numclt = 'EXP'.$invID;
								$datajson=array(
									                    'add' =>'add',
														'msg' => display('successfully_added'),
														'lastid' =>  $numclt,
									                    ); 
							}
							else
							{
								echo '<span class="red">'.display('an_error_occurred').' </span>';
							}
			// output to json format
		    echo json_encode($datajson);
	}
    //--------- update a category-----------
	public function update($id=null)
	{
		if($this->input->post('category_id'))
		{
			$this->load->view('expence/update_category' ,array('category' => $this->category_expence->get_by_id($this->input->post('category_id'))));
		}
	}
	public function update_ajax()
	{
		$data = array(
			'name' => $this->input->post('name'),
		);
		     $id = $this->input->post('id');
			 if($this->category_expence->update($data,$id))
						{
							 $datajson=array(
													'update' =>'update',
													'msg' => display('successfully_updated')
													); 
						}
						else
						{
							$datajson=array(
								'update' =>'error',
								'msg' => ''
								); 
						}
	    // output to json format	
		echo json_encode($datajson);
	}

	// ----------delete-------

	public function delete($id=null)
	{
		if($this->input->post('category_id'))
		{
			echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">'.display('cancel').'</button>
			      <button type="button" class="btn btn-danger" onclick="deletebtm('.$this->input->post('category_id').')">'.display('delete').'</button>
			   ';
		}
		if($id !=null)
		{
			$this->category_expence->delete_by_id($id);
			$datajson=array(
				'delete' =>'delete',
				'msg' => '<span class="alert-success"> '.display('successfully_deleted').' <strang><i class="ace-icon fa fa-check"></i></strang> </span>'
				); 
			echo json_encode($datajson);
		}
	}
	
	// View the list of categories
	public function ajax_categories()
    {
        $list = $this->category_expence->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $category) {   
            $no ++;
			$row = array();
			$row[] = $category->id;
			$row[] = $category->name;
			$row[] = '<a href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="'.$category->id.'">
			<button class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i>
				'.'
			  </button>
		</a><a href="#updateclt" class="green" id="custId" data-toggle="modal" data-id="'.$category->id.'">
		<button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i>
			'.'
		  </button>
	</a>';
     
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->category_expence->count_all(),
            "recordsFiltered" => $this->category_expence->count_filtered(),
            "data" => $data
        );
        // output to json format
        echo json_encode($output);
	}
	
}
