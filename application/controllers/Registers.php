<?php
class Registers extends CI_Controller {
	public function __construct() {

		parent::__construct();
		is_login();
		$this->load->model('register_model','register');
		$this->load->model('user_model','user');
		$this->load->vars(array('activemn' => 'Registers'));
		$this->load->library('upload');
		$this->load->helper('download');
		$this->language = $this->session->userdata('site_lang') ? $this->session->userdata('site_lang') : 'english';
	   }
	
	   
    // View the list of registers
	public function ajax_register()
    {
		$start_date = $this->session->userdata('start_date') ? $this->session->userdata('start_date') : null;
		$end_date = $this->session->userdata('end_date') ? $this->session->userdata('end_date') : null;
		
        $list = $this->register->get_datatables($start_date,$end_date);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $reg) { 
//             $action = '
// 			 <a href="#confirm-delete" class="green" id="custId" data-toggle="modal" data-id="'. $reg->id .'">
// 				<button class="btn btn-xs btn-danger">
// 				'.display('delete').'
// 				</button>
// 			</a>
		
// 			 ';
            $no ++;
			$row = array();
			$row[] = '<a href="javascript:void(0)" '.($reg->closed_at ? 'onclick="RegisterDetails(' . $reg->id . ')"' : '').'><i class="glyph-icon iconsminds-preview"></i> ' . $reg->date . '</a>';
			$row[] = ($reg->closed_at ? $reg->closed_at : '<span class="text-danger">' .display('open'). '</span>') ;
			$row[] = $this->user->get_by_id($reg->user_id)->name;
			$row[] = number_format((float)$reg->cash_total, settings()->decimals, '.', '') . ' ' . settings()->currency ;
			$row[] = number_format((float)$reg->cheque_total, settings()->decimals, '.', '') . ' ' . settings()->currency;
			$row[] = $action;
			
     
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->register->count_all($start_date,$end_date),
            "recordsFiltered" => $this->register->count_filtered($start_date,$end_date),
            "data" => $data
        );
        // output to json format
        echo json_encode($output);
	}
	
}
