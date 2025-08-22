<?php
class Users extends CI_Controller {
	public function __construct() {

		parent::__construct();
		is_login();
		$this->load->model('user_model','user');
				$this->load->model('product_model','product');

		$this->load->model('role_model','role');
		$this->load->vars(array('activemn' => 'user','lastid' => $this->user->last_id()));
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
		permission();
	   }

	public function index()
	{
		$data['roles'] = $this->role->get_all();
		$data['content_page']=$this->load->view('user/index' ,$data,true);
		$this->load->view('tpl/template' ,$data);
	}
	public function check_user()  
      {  
            if(isset($_POST["email"]))
                 {
		                if($this->user->check_user($_POST["email"]))  
		                {  
		                 		echo '<label class="text-danger"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.display('email_exist').'  ('.$_POST["email"].')</label>'; 
		                }  
                  }
      }
	// Add user
// 	public function add()
// 	{
// 			$data = array(
// 				'num' => $this->input->post('num'),
// 				'name' => $this->input->post('name'),
// 				'email ' => $this->input->post('email'),
// 				'password' => md5(sha1($this->input->post('password'))),
// 				'role_id' =>  $this->input->post('roleid'),
// 				'store_id' =>  $this->session->userdata('store_id'),
// 				'created_at' => date('Y-m-d :H:s'),
// 			);
// 		    if(!$this->user->check_user($_POST["email"]))  
// 			{ 
// 			    if($this->user->save($data))
// 				{
// 					$invID = str_pad($this->user->last_id() + 1, 3, '0', STR_PAD_LEFT);
//                     $numclt = 'US'.$invID;
// 					 $datajson=array(
//                     'add' =>'add',
// 					'msg' => display('successfully_added'),
// 					'lastid' =>  $numclt,
//                     ); 
// 				}
// 				else
// 				{
// 					echo '<span class="red"> '.display('an_error_occurred').'  </span>';
// 				}
// 			}
// 			else
// 			{
// 				$datajson=array(
// 					'error' =>'error',
// 					'msg' => display('email_exist'),
// 					); 
// 			}
					
// 		echo json_encode($datajson);
// 	}
	
	
	
	
	public function add()
	{
			$data = array(
				'num' => $this->input->post('num'),
				'name' => $this->input->post('name'),
				'email ' => $this->input->post('email'),
				'password' => md5(sha1($this->input->post('password'))),
				'role_id' =>  $this->input->post('roleid'),
				'store_id' =>  $this->session->userdata('store_id'),
				'created_at' => date('Y-m-d :H:s'),
			);
		    if(!$this->user->check_user($_POST["email"]))  
			{ 
			    if($this->user->save($data))
				{
					$invID = str_pad($this->user->last_id() + 1, 3, '0', STR_PAD_LEFT);
                    $numclt = 'US'.$invID;
					 $datajson=array(
                    'add' =>'add',
					'msg' => display('successfully_added'),
					'lastid' =>  $numclt,
                    ); 
				}
				else
				{
					echo '<span class="red"> '.display('an_error_occurred').'  </span>';
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
	
	

	
    //--------- update-----------
	public function update($id=null)
	{
		if($this->input->post('user_id'))
		{
			$this->load->view('user/update' ,array('user' => $this->user->get_by_id($this->input->post('user_id')),'roles'=> $this->role->get_all()));
		}
	}
	public function update_ajax()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'email ' => $this->input->post('email'),
			'role_id ' => $this->input->post('roleid'),
			'password' => (!empty($this->input->post('password'))?md5(sha1($this->input->post('password'))):$this->input->post('old_password')),
			'updated_at' =>  date('Y-m-d h:s'),
		);
		     $id = $this->input->post('id');
			 if($this->user->update($data,$id))
						{

							 $datajson=array(
													'update' =>'update',
													'msg' => display('successfully_updated'),
													); 
						}
						else
						{
							echo '<span class="red"> ' .display('an_error_occurred'). '  </span>';
						}
				
		echo json_encode($datajson);
	}
	// ----------delete-------
	public function delete($id=null)
	{
		if($this->input->post('user_id'))
		{
			echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">' .display('cancel'). ' </button>
			      <button type="button" class="btn btn-danger" onclick="deletebtm('.$this->input->post('user_id').')">' .display('delete'). '</button>
			   ';
		}
		if($id !=null)
		{
			$this->user->delete_by_id($id);
			$datajson=array(
				'delete' =>'delete',
				'msg' => '<span class="alert-success"> ' .display('successfully_updated'). '  <strang><i class="ace-icon fa fa-check"></i></strang> </span>'
				); 
			echo json_encode($datajson);
		}
	}
	
	// View the list of users
	public function ajax_user()
    {
        $users = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($users as $user) {   
            $no ++;
            $row = array();
            $row[] = $user->num;
			$row[] = $user->nameuser;
			$row[] = $user->email;
			$row[] = $user->namerols;
			$row[] = '<a href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="'.$user->id.'">
			<button class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i>
			  '.'
			  </button>
		</a><a href="#updateclt" class="green" id="custId" data-toggle="modal" data-id="'.$user->id.'">
		<button class="btn btn-xs btn-info"> <i class="fa fa-pencil"></i>
		      '.'
		  </button>
	</a>';
     
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user->count_all(),
            "recordsFiltered" => $this->user->count_filtered(),
            "data" => $data
        );
        // output to json format
        echo json_encode($output);
    }

	
}
