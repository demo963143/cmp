<?php
class App extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// check if a user logged in : helpers/auth_helper
		is_login();

        // load models
		$this->load->vars(array('activemn' => 'home'));
		$this->load->model('sale_model', 'sale');
		$this->load->model('client_model', 'client');
		$this->load->model('product_model', 'product');
		$this->load->model('expence_model', 'expence');
		
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
	}
	 // load home view Page
	public function index()
	{
		 // data  Today's sales, count clients, count products
		$data['sum_sale_day'] = $this->sale->sum_sale(array('created_at' => date('Y-m-d')));
		$data['sales_day'] = $this->sale->get_all(array('created_at' => date('Y-m-d')));
		$data['count_client'] = $this->client->count_all();
		$data['count_product'] = $this->product->count_all();
		$data['count_sale'] = $this->sale->count_all(array('created_at' => date('Y-m-d')));
		$datasale = [];
		foreach (months() as $month) {
			$datasale['label'][] = date('Y') . '/' . $month->id;
			$datasale['data1'][] = number_format((float) $this->sale->sum_sale(array('date_yeare' => date('Y'), 'date_month' => $month->id)), settings()->decimals, '.', '');
			$datasale['data2'][] = number_format((float) $this->expence->sum_expences(array('year' => date('Y'), 'month' => $month->id)), settings()->decimals, '.', '');
		}
		$data['datasale'] = $datasale;
		$data['glide'] = true;
		
		$data['count_sale'] = $this->sale->count_all(array('created_at' => date('Y-m-d')));
		$data['sum_sale_day'] = $this->sale->sum_sale(array('created_at' => date('Y-m-d')));

		$data['content_page'] = $this->load->view('home/index', $data, true);
		
		//$data['content_page'] = $this->load->view('home/new_index', $data, true);

		$this->load->view('tpl/template', $data);
	}
	
	
	// new dashboard
	
	public function dashboard()
	{
		 // data  Today's sales, count clients, count products
		$data['sum_sale_day'] = $this->sale->sum_sale(array('created_at' => date('Y-m-d')));
		$data['sales_day'] = $this->sale->get_all(array('created_at' => date('Y-m-d')));
		$data['count_client'] = $this->client->count_all();
		$data['count_product'] = $this->product->count_all();
		$data['count_sale'] = $this->sale->count_all(array('created_at' => date('Y-m-d')));
		$datasale = [];
		foreach (months() as $month) {
			$datasale['label'][] = date('Y') . '/' . $month->id;
			$datasale['data1'][] = number_format((float) $this->sale->sum_sale(array('date_yeare' => date('Y'), 'date_month' => $month->id)), settings()->decimals, '.', '');
			$datasale['data2'][] = number_format((float) $this->expence->sum_expences(array('year' => date('Y'), 'month' => $month->id)), settings()->decimals, '.', '');
		}
		$data['datasale'] = $datasale;
		$data['glide'] = true;
		
		$data['count_sale'] = $this->sale->count_all(array('created_at' => date('Y-m-d')));
		$data['sum_sale_day'] = $this->sale->sum_sale(array('created_at' => date('Y-m-d')));

		//$data['content_page'] = $this->load->view('home/index', $data, true);
		
		$data['content_page'] = $this->load->view('home/new_index', $data, true);

		$this->load->view('tpl/template', $data);
	}
	
	
	
	
	
	

	// Logout from admin page
	public function logout()
	{
		$this->load->helper('cookie');
		
		delete_cookie("uniquecoder");
		//helpers /auth_helper
		auth_logout();
	}

	// load error_permission view Page
	public function error_permission()
	{
		$data['content_page'] = $this->load->view('permission/index', $data = array(), true);
		$this->load->view('tpl/template', $data);
	}
	
}
