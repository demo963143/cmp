<?php
class Repports extends CI_Controller {
	public function __construct() {

		parent::__construct();
		is_login();
		$this->load->vars(array('activemn' => 'repports'));
		$this->load->model('sale_model','sale');
		$this->load->model('client_model','client');
		$this->load->model('register_model','register');
		$this->load->model('product_model','product');
		$this->load->model('expence_model','expence');
		$this->load->model('user_model','user');
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
		permission();
	   }
	   
	public function index()
	{
		$data['sum_sale_day'] = $this->sale->sum_sale(array('created_at'=> date('Y-m-d')));
		$data['sales_day'] = $this->sale->get_all(array('created_at'=> date('Y-m-d')));
		$data['count_client'] = $this->client->count_all();
		$data['count_product'] = $this->product->count_all();
		$data['count_sale'] = $this->sale->count_all(array());
		$data['count_register'] = $this->register->count_all($start=null,$end=null);
		$data['count_expence'] = $this->expence->count_all(array());
		$datasale = [];
			foreach(months() as $month) {
				$datasale['label'][] = date('Y').'/'.$month->id;
				$datasale['data1'][] = number_format((float) $this->sale->sum_sale(array('date_yeare'=> date('Y'),'date_month'=> $month->id)), settings()->decimals, '.', '');
				$datasale['data2'][] = number_format((float) $this->expence->sum_expences(array('year'=> date('Y'),'month'=> $month->id)), settings()->decimals, '.', '');
			}
		$data['datasale'] = $datasale;
		//
		$year = date("Y");
		
		$data['querytop']  = $this->sale->top_product($year,settings()->top_product);
		//
		$data['year'] = date("Y");
		$data['content_page']=$this->load->view('repports/index' ,$data,true);
        $this->load->view('tpl/template' ,$data);
	}
	
	public function expences()
	{
		$year = date("Y");
		if($this->input->post('year'))
		{
			$year = $this->input->post('year');
		}
		if($this->input->post('pdfgen'))
		{
			   $dataexport['xdirection'] = $this->input->post('xdirection');
			   $dataexport['year'] = $year;
			   $dataexport['expences_repport'] =$this->expence->get_datatables($year);
			   $html = $this->load->view('repports/pdf/expences',$dataexport,true);
			 //  print_r($dataexport['expences_repport']); die;
			   $name = 'exportexpences_'.$year.'.pdf';
	           $this->load->library('sma');
	           $this->sma->generate_pdf('L',$html, $name);
		}
		$data['year'] = $year;
		$chartdata = [];
			foreach(months() as $month) {
				$chartdata['label'][] = $year.'/'.$month->id;
				$chartdata['data1'][] = number_format((float) $this->expence->sum_expences(array('year'=> $year,'month'=> $month->id)), settings()->decimals, '.', '');
			}
		$data['chartdata'] = $chartdata;
		$data['amount'] = $this->expence->sum_expences("DATE_FORMAT(date, '%Y')= $year");
		$data['content_page']=$this->load->view('repports/expences_repports' ,$data,true);
        $this->load->view('tpl/template' ,$data);
	}


	public function sales()
	{

		$year = date("Y");
		if($this->input->post('year'))
		{
			$year = $this->input->post('year');
		}
		if($this->input->post('pdfgen'))
		{
		   
		       $dataexport['xdirection'] = $this->input->post('xdirection');
			   $dataexport['year'] = $year;
			   $dataexport['amount'] = $this->sale->sum_sale("DATE_FORMAT(created_at, '%Y')= $year");
			 //   print_e($dataexport['amount']); die;
		       $dataexport['taxamount'] = $this->sale->taxamount_sale("DATE_FORMAT(created_at, '%Y')= $year");
		       $dataexport['discountamount'] = $this->sale->discountamount_sale("DATE_FORMAT(created_at, '%Y')= $year");
			   $dataexport['paid'] = $this->sale->paid_sale("DATE_FORMAT(created_at, '%Y')= $year");
			   $dataexport['sales_repport'] =$this->sale->get_datatables($year);
			   
			   $dataexport['card'] = $this->sale->card_sale("DATE_FORMAT(created_at, '%Y')= $year");
			  
		       $dataexport['upi'] = $this->sale->upi_sale("DATE_FORMAT(created_at, '%Y')= $year");
		       $dataexport['cash'] = $this->sale->cash_sale("DATE_FORMAT(created_at, '%Y')= $year");
		       $dataexport['cheque'] = $this->sale->cheque_sale("DATE_FORMAT(created_at, '%Y')= $year");
			   
			   $html = $this->load->view('repports/pdf/sales',$dataexport,true);
			   $name = 'exportsales_'.$year.'.pdf';
	           $this->load->library('sma');
			   $this->sma->generate_pdf('L',$html, $name);
		}
		if($this->input->post('advgen'))
		{
			   $startdate = $this->input->post('start');
			   $enddate = $this->input->post('end');
			   $dataexport['EndDate'] =$enddate ;
			   $dataexport['StartDate'] =$startdate ;
               $dataexport['xdirection'] = $this->input->post('xdirection');
			   $dataexport['sales'] =$this->sale->gen_pdf($startdate,$enddate);
			   $html = $this->load->view('sale/pdf',$dataexport,true);

			   $name = 'exportsales_'.$year.'.pdf';
	           $this->load->library('sma');
			   $this->sma->generate_pdf('L',$html, $name);
		}
		$data['year'] = $year;
		$chartdata = [];
			foreach(months() as $month) {
				$chartdata['label'][] = $year.'/'.$month->id;
				$chartdata['data1'][] = number_format((float) $this->sale->sum_sale(array('date_yeare'=> $year,'date_month'=> $month->id)), settings()->decimals, '.', '');
			}
		$data['chartdata'] = $chartdata;
		$data['amount'] = $this->sale->sum_sale("DATE_FORMAT(created_at, '%Y')= $year");
		$data['taxamount'] = $this->sale->taxamount_sale("DATE_FORMAT(created_at, '%Y')= $year");
		
		
		$data['card'] = $this->sale->card_sale("DATE_FORMAT(created_at, '%Y')= $year");
		$data['upi'] = $this->sale->upi_sale("DATE_FORMAT(created_at, '%Y')= $year");
		$data['cash'] = $this->sale->cash_sale("DATE_FORMAT(created_at, '%Y')= $year");
		$data['cheque'] = $this->sale->cheque_sale("DATE_FORMAT(created_at, '%Y')= $year");
		
		
		//print_r($data['card']);die;
		
		$data['discountamount'] = $this->sale->discountamount_sale("DATE_FORMAT(created_at, '%Y')= $year");
		$data['paid'] = $this->sale->paid_sale("DATE_FORMAT(created_at, '%Y')= $year");
		$this->db->select("*");
        $query = $this->db->get("users");
        $result =  $query->result();
        $data['result'] = $result;
		$data['content_page']=$this->load->view('repports/sales_repports' ,$data,true);
        $this->load->view('tpl/template' ,$data);
	}
	
	public function clients()
	{

		if($this->input->post('pdfgen'))
		{
			   $dataexport['xdirection'] = $this->input->post('xdirection');
			   $dataexport['count_client'] = $this->client->count_all();
			   $dataexport['clients_repport'] =$this->client->get_datatables();
			   $html = $this->load->view('repports/pdf/clients',$dataexport,true);
			   $name = 'exportclients_'.date('Y-m-d').'.pdf';
	           $this->load->library('sma');
	           $this->sma->generate_pdf('L',$html, $name);
		}
		$data['count_client'] = $this->client->count_all();
		$data['year'] = date('Y');
		$data['content_page']=$this->load->view('repports/clients_repports' ,$data,true);
        $this->load->view('tpl/template' ,$data);
	}
	public function registers()
	{
		$where =array();
		if($this->input->post('pdfgen'))
		{
			   $dataexport['xdirection'] = $this->input->post('xdirection');
			   $dataexport['start_date'] = $this->session->userdata('start_date');
			   $dataexport['end_date'] = $this->session->userdata('end_date');
			   $dataexport['registers_repport'] =$this->register->get_datatables($this->input->post('start_dt'),$this->input->post('end_dt'));
			   $html = $this->load->view('repports/pdf/registers',$dataexport,true);
			   $name = 'exportregisters_'.date('Y-m-d').'.pdf';
	           $this->load->library('sma');
	           $this->sma->generate_pdf('L',$html, $name);
		}
		if($this->input->post('start') && $this->input->post('end'))
		{
			$dateSearch['start_date'] = $this->input->post('start');
			$dateSearch['end_date'] = $this->input->post('end');
			$this->session->set_userdata($dateSearch);
		}
		if($this->session->userdata('start_date'))
		{
			$where = 'date BETWEEN "'. $this->session->userdata('start_date'). '" and "'. $this->session->userdata('end_date').'"';
		}
		$data['totalRevenue'] = $this->register->totalRevenue($where);
		$data['content_page']=$this->load->view('repports/register_reports' ,$data,true);
        $this->load->view('tpl/template' ,$data);
	}
	public function RegisterDetails($id)
	{
	     
		$register = $this->register->get_by_id(array('id'=> $id));
       
		$user = $this->user->get_by_id($register->user_id);
		$user2 = $this->user->get_by_id($register->closed_by);
        $CashinHand = number_format((float)$register->cash_inhand, settings()->decimals, '.', '');
        $date = $register->date;
        $closedate = $register->closed_at;
        $createdBy = $user->name;
        $closedBy = $user2->name;
        $total = $register->cheque_total + $register->cash_total;
        $subtotal = $register->cash_sub + $register->cheque_sub;

        $data = '<div class="col-md-3"><blockquote><footer> '.display('Openedby').'  </footer><p>' . $createdBy . '</p></blockquote></div>
        <div class="col-md-3"><blockquote><footer>' .display('CashinHand'). '</footer>
        <p>' . $CashinHand . ' ' . settings()->currency . '</p></blockquote></div><div class="col-md-4"><blockquote><footer>' .display('openingtime'). ' </footer>
        <p>' . $date . '</p></blockquote></div><div class="col-md-2"><i class="glyph-icon iconsminds-cash-register-2" style="font-size: 50px;"></i></div>
        <h2>' .display('paymentssummary'). '</h2><table class="table table-striped"><tr><th width="25%">' .display('payementtype'). '</th>
        <th width="25%">' .display('EXPECTED'). ' (' . settings()->currency . ')</th><th width="25%">' .display('COUNTED'). '  (' . settings()->currency . ')</th>
        <th width="25%">' .display('DIFFERENCES'). ' (' . settings()->currency . ')</th></tr><tr><td>' .display('cash'). '</td>
        <td><span id="expectedcash">' . number_format((float)$register->cash_total, settings()->decimals, '.', '') . '</span></td>
        <td><span id="countedcash">' . number_format((float)$register->cash_sub, settings()->decimals, '.', '') . '</span></td><td>
        <span id="diffcash">' . number_format((float)($register->cash_sub - $register->cash_total), settings()->decimals, '.', '') . '</span></td>
        </tr><tr><td>' .display('cheque'). ' :</td>
        <td><span id="expectedcheque">' . number_format((float)$register->cheque_total, settings()->decimals, '.', '') . '</span></td>
        <td><span id="countedcheque">' . number_format((float)$register->cheque_sub, settings()->decimals, '.', '') . '</span></td>
        <td><span id="diffcheque">' . number_format((float)($register->cheque_sub - $register->cheque_total),settings()->decimals, '.', '') . '</span></td></tr>
        <tr class="warning"><td>' .display('total'). '</td>
        <td><span id="total">' . number_format((float)$total, settings()->decimals, '.', '') . '</span></td>
        <td><span id="countedtotal">' . number_format((float)$subtotal, settings()->decimals, '.', '') . '</span></td>
        <td><span id="difftotal">' . number_format((float)($subtotal - $total), settings()->decimals, '.', '') . '</span></td></tr>
        </table><p>- ' .display('closeby'). ' ' . $closedBy . ' ' . label("at") . ' ' . $closedate . '</p><div  class="form-group"><h2>ملاحظة</h2><p>' . $register->note . '</p></div>';
    
        echo $data;
	}
	public function deleteRegister($id=null)
	{
		if($this->input->post('register_id'))
		{
			echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">' .display('close'). '</button>
			      <button type="button" class="btn btn-danger" onclick="deleteRegister('.$this->input->post('register_id').')">' .display('deletion_confirmation'). ' </button>
			   ';
		}
		if($id !=null)
		{
			//
			$sales = $this->sale->get_all(array('register_id' => $id));
			foreach($sales as $sale)
			{
				$this->sale->delete_items($sale->id);
			}
			$this->sale->delete_by_id(array('register_id' => $id));
			$this->register->delete_by_id($id);
			  $datajson=array(
				 'delete' =>'delete',
				 'msg' => '<span class="alert-success"> ' .display('successfully_deleted'). ' <strang><i class="ace-icon fa fa-check"></i></strang> </span>'
				); 
			echo json_encode($datajson);
		}
	}
}
