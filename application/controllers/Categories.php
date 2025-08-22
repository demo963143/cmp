<?php
class Categories extends CI_Controller {
	public function __construct() {
		parent::__construct();
        // check if a user logged in : helpers/auth_helper
		is_login();
		$this->load->model('category_model','category');
		$this->load->vars(array('activemn' => 'product','lastid' => $this->category->last_id()));
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';

		//check permission  : helpers/auth_helper
		permission();
	   }

	public function index()
	{
		$data['content_page']=$this->load->view('category/index' ,$data=array(),true);
		$this->load->view('tpl/template' ,$data);
	}
	// Add a category
	public function add()
	{
			$data = array(
				'num' => $this->input->post('num'),
				'name' => $this->input->post('namecategory'),
				'store_id' =>  $this->session->userdata('store_id'),
				'user_id' =>  $this->session->userdata('user_id'),
				'created_at' =>  date('Y-m-d H:s'),
			);
				 if($this->category->save($data))
							{
								$invID = str_pad($this->category->last_id() + 1, 3, '0', STR_PAD_LEFT);
                                $numCG = 'CG'.$invID;
								 $datajson=array(
									                    'add' =>'add',
														'msg' => display('successfully_added'),
														'lastid' =>  $numCG,
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
		if($this->input->post('category_id'))
		{
			$this->load->view('category/update' ,array('category' => $this->category->get_by_id($this->input->post('category_id'))));
		}
	}
	public function update_ajax()
	{
		$data = array(
			'name' => $this->input->post('namecategoryup'),
			'updated_at' =>  date('Y-m-d H:s'),
			'user_id' =>  $this->session->userdata('user_id'),
		);
		     $id = $this->input->post('id');
			 if($this->category->update($data,$id))
						{

							 $datajson=array(
											'update' =>'update',
											'msg' => display('successfully_updated')
											); 
						}
						else
						{
							echo '<span class="red">'.display('an_error_occurred').' </span>';
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
			      <button type="button" class="btn btn-danger" onclick="deletebtm('.$this->input->post('category_id').')">'.display('delet').'</button>
			   ';
		}
		if($id !=null)
		{
			$this->category->delete_by_id($id);
			$datajson=array(
				'delete' =>'delete',
				'msg' => '<span class="alert-success"> '.display('successfully_deleted').' <strang><i class="ace-icon fa fa-check"></i></strang> </span>'
				); 
			echo json_encode($datajson);
		}
	}
	
	// View the list of categories
	public function ajax_category()
    {
        $list = $this->category->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $category) {   
            $no ++;
			$row = array();
			$row[] = $category->num;
            $row[] = $category->name;
			$row[] = '<a href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="'.$category->id.'">
			<button class="btn btn-xs btn-danger">
				<i class="far fa-trash-alt"></i>
			  </button>
		</a><a href="#updateclt" class="green" id="custId" data-toggle="modal" data-id="'.$category->id.'">
		<button class="btn btn-xs btn-info">
			<i class="fa fa-pencil"></i>
		  </button>
	</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->category->count_all(),
            "recordsFiltered" => $this->category->count_filtered(),
            "data" => $data
        );
        // output to json format
        echo json_encode($output);
	}
	
}
