<?php
class Clients extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// check if a user logged in : helpers/auth_helper
		is_login();

		$this->load->model('client_model', 'client');
		$this->load->vars(array('activemn' => 'client', 'lastid' => $this->client->last_id()));
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
	}

	public function index()
	{
		$this->load->model('sale_model', 'sale');
		if ($this->input->post('pdfgen')) {
			$dataexport['xdirection'] = $this->input->post('xdirection');
			$dataexport['clients'] = $this->client->get_all();
			$html = $this->load->view('client/pdf', $dataexport, true);
			$name = 'clients.pdf';
			// Load form sma library /libraries/Sma
			$this->load->library('sma');
			// generate pdf
			$this->sma->generate_pdf('L', $html, $name);
		}
		$data['content_page'] = $this->load->view('client/index', $data = array(), true);
		$this->load->view('tpl/template', $data);
	}

	// Add a client
	public function add()
	{
		$data = array(
			'num' => $this->input->post('num'),
			'phone' => $this->input->post('phone'),
			'lastname' => $this->input->post('lastname'),
			'firstname' => $this->input->post('firstname'),
			'adress' =>  $this->input->post('adress'),
			'store_id' =>  $this->session->userdata('store_id'),
			'user_id' =>  $this->session->userdata('user_id'),
			'discount' =>  $this->input->post('discount'),
			'created_at' =>  date('Y-m-d'),
		);
		if ($this->client->save($data)) {
			$id = $this->db->insert_id();
			$datajson = array(
				'add' => 'add',
				'insertid' => $id,
				'msg' => display('successfully_added')
			);
		} else {
			echo '<span class="red">' . display('an_error_occurred') . ' </span>';
		}
       // output to json format 
		echo json_encode($datajson);
	}
	//--------- update a client-----------
	public function update($id = null)
	{
		if ($this->input->post('client_id')) {
			$this->load->view('client/update', array('client' => $this->client->get_by_id($this->input->post('client_id'))));
		}
	}
	public function update_ajax()
	{
		$data = array(
			'phone' => $this->input->post('phone'),
			'lastname' => $this->input->post('lastname'),
			'firstname' => $this->input->post('firstname'),
			'adress' =>  $this->input->post('adress'),
			'discount' =>  $this->input->post('discount'),
			'updated_at' =>  date('Y-m-d h:s'),
			'user_id' =>  $this->session->userdata('user_id'),
		);
		$id = $this->input->post('id');
		if ($this->client->update($data, $id)) {

			$datajson = array(
				'update' => 'update',
				'msg' => display('successfully_updated')
			);
		} else {
			echo '<span class="red"> ' . display('an_error_occurred') . ' </span>';
		}
       // output to json format
		echo json_encode($datajson);
	}

	// ----------delete-------

	public function delete($id = null)
	{
		if ($this->input->post('client_id')) {
			echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">' . display('cancel') . '</button>
			      <button type="button" class="btn btn-danger" onclick="deletebtm(' . $this->input->post('client_id') . ')">' . display('delete') . '</button>
			   ';
		}
		if ($id != null) {
			$this->client->delete_by_id($id);
			$datajson = array(
				'delete' => 'delete',
				'msg' => '<span class="alert-success"> ' . display('successfully_deleted') . '<strang><i class="ace-icon fa fa-check"></i></strang> </span>'
			);
			echo json_encode($datajson);
		}
	}
	//------load_customers--------------
	public function load_clients($id = null)
	{
		$selectedclt = '';
		$client_load = '<option value="0">' . display('default_client') . '</option>';
		foreach ($this->client->get_all() as $client) :
			if ($client->id == $id) $selectedclt = 'selected';
			$client_load .= '<option ' . $selectedclt . ' value="' . $client->id . '">' . $client->lastname . ' ' . $client->firstname . ' ' . $client->phone . '</option>';
		endforeach;
		echo  $client_load;
	}
	/*---------------------------*/

	// View the list of customers
	public function ajax_client()
	{
		$this->load->model('sale_model', 'sale');
		$list = $this->client->get_datatables();
		// echo "<pre>";
		// print_r($this->db->last_query()); die;
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $client) {
			$sum_sale = $this->sale->sum_sale(array('client_id' => $client->id));
			$paid_sale = $this->sale->paid_sale(array('client_id' => $client->id));
			$no++;
			$row = array();
			$row[] = $client->num;
			$row[] = $client->lastname;
			$row[] = $client->firstname;
			$row[] = $client->phone;
			$row[] = $client->adress;
			$row[] = number_format((float)($sum_sale), settings()->decimals, '.', '');
			$row[] = number_format((float)($paid_sale), settings()->decimals, '.', '');
			$row[] = number_format((float)($sum_sale - $paid_sale), settings()->decimals, '.', '');
			$row[] = '<a href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="' . $client->id . '">
			<button class="btn btn-xs btn-danger"> <i class="far fa-trash-alt"></i>
				' . '
			  </button>
		</a><a href="#updateclt" class="green" id="custId" data-toggle="modal" data-id="' . $client->id . '">
		<button class="btn btn-xs btn-info"> <i class="fa fa-pencil"></i>
			'.'
		  </button>
	</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->client->count_all(),
			"recordsFiltered" => $this->client->count_filtered(),
			"data" => $data
		);
		// output to json format
		echo json_encode($output);
	}

	// send sms bulksmsnigeria 
	public function send_sms()
	{

		if($this->input->post('sendmsgsms'))
		{
			 // Load form Bulksmsnigeria library
			$this->load->library('Bulksmsnigeria');
			$data = array(  
				'message'  => $this->input->post('msgsms'),  
				'store_id'   => $this->session->userdata('store_id'),  
				);  
				//
			    //insert data into database table.  
		    	$this->db->insert('sms_msg',$data);
				//send msg
				foreach($this->client->get_all() as $client)
				{
					$this->bulksmsnigeria->sendSMS($client->phone,$this->input->post('msgsms'),settings()->senderId,'2');
				}
				$data['alert'] = display('successfully_added');
				//
		}
		$data['sms_list'] = $this->client->get_sms();
		$data['content_page'] = $this->load->view('client/send_sms', $data , true);
		$this->load->view('tpl/template', $data);
	}
}
