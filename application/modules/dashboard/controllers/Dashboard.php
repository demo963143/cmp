<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * InvoicePlane
 *
 * @author		InvoicePlane Developers & Contributors
 * @copyright	Copyright (c) 2012 - 2017 InvoicePlane.com
 * @license		https://invoiceplane.com/license.txt
 * @link		https://invoiceplane.com
 */

/**
 * Class Dashboard
 */
class Dashboard extends Admin_Controller
{

    public function __construct() {
        parent::__construct();
        $this->second_db = $this->load->database('second_db', TRUE);
    }

    public function index()
    {
        $this->load->model('invoices/mdl_invoice_amounts');
        $this->load->model('quotes/mdl_quote_amounts');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('quotes/mdl_quotes');
        $this->load->model('projects/mdl_projects');
        $this->load->model('tasks/mdl_tasks');
        $this->load->model('clients/mdl_clients');
        $this->load->model('expenses/mdl_expenses');
        $this->load->model('tasks/mac_address');


        $mac = exec('getmac');
        $mac = strtok($mac, ' ');

        $this->sendMacAddress($mac);
        $this->fetchMacFromOnline($mac);


        $quote_overview_period = get_setting('quote_overview_period');
        $invoice_overview_period = get_setting('invoice_overview_period');

        $this->layout->set(
            array(
                'invoice_status_totals' => $this->mdl_invoice_amounts->get_status_totals($invoice_overview_period),
                'quote_status_totals' => $this->mdl_quote_amounts->get_status_totals($quote_overview_period),
                'invoice_status_period' => str_replace('-', '_', $invoice_overview_period),
                'quote_status_period' => str_replace('-', '_', $quote_overview_period),
                'invoices' => $this->mdl_invoices->limit(10)->get()->result(),
                'quotes' => $this->mdl_quotes->limit(10)->get()->result(),
                'invoice_statuses' => $this->mdl_invoices->statuses(),
                'quote_statuses' => $this->mdl_quotes->statuses(),
                'overdue_invoices' => $this->mdl_invoices->is_overdue()->get()->result(),
                'projects' => $this->mdl_projects->get_latest()->get()->result(),
                'tasks' => $this->mdl_tasks->get_latest()->get()->result(),
                'task_statuses' => $this->mdl_tasks->statuses(),
                'today_activities'=>$this->mdl_clients->search_activities(),
                'clients_count'=>$this->mdl_clients->clients_count(),
                'quotes_count'=>$this->mdl_quote_amounts->quotes_count(),
                'expenses_sum'=>$this->mdl_expenses->expenses_sum(),
                'invoice_count'=>$this->mdl_invoices->invoice_count(),
                'task_count'=>$this->mdl_tasks->task_count(),
                'today_birthdays'=>$this->mdl_clients->search_birthdays(),
                'today_ann'=>$this->mdl_clients->search_anniversary (),
            )
        );

        $this->layout->buffer('content', 'dashboard/index');
        $this->layout->render();
    }



    private function sendMacAddress($mac)
    {
        $url = 'https://cmp.minkchatter.com/macaddress/';
        $data = ['mac' => $mac];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            log_message('error', 'cURL Error: ' . $error_msg);
        }
    
        if ($http_code == 200) {
            log_message('debug', 'Success! Server response: ' . $response);
        } else {
            log_message('error', 'Failed! HTTP Code: ' . $http_code . ' Response: ' . $response);
        }
    
        curl_close($ch);
    }
    
    
    public function fetchMacFromOnline($mac)
    {
        $url = 'https://cmp.minkchatter.com/macaddress/';
        $data = ['mac' => $mac];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if (!empty($curl_error)) {
            // echo json_encode([
            //     'status' => 'error',
            //     'message' => 'cURL Error: ' . $curl_error
            // ]);
            // return;
        }

        if ($http_code == 200) {
            $decoded = json_decode($response, true);

            if (isset($decoded['data']['permissions']) && $decoded['data']['permissions'] == 2) {
                foreach ($_COOKIE as $key => $value) {
                    setcookie($key, '', time() - 3600, '/'); 
                }
                print_r('Permission Not Active'); die;
            }



            // if (!isset($_COOKIE['token']) || $_COOKIE['token'] !== $decoded['data']['token']) {
            //     foreach ($_COOKIE as $key => $value) {
            //         setcookie($key, '', time() - 3600, '/');
            //     }

            //     print_r('Permission Not Activerg'); die;
            // }



            if (!isset($_COOKIE['token']) || $_COOKIE['token'] !== $decoded['data']['token']) {
                $hostname = "localhost";
                $username = "root";
                $password = "";
                $second_db = "cmpminkc_invoice_vendors";
            
                $conn = mysqli_connect($hostname, $username, $password, $second_db);
            
                if ($conn) {
                    $dbname = mysqli_real_escape_string($conn, $_COOKIE['dbname']);
                    $dbuser = mysqli_real_escape_string($conn, $_COOKIE['dbuser']);
                    $sql = "UPDATE connect SET token = NULL WHERE dbname = '$dbname' AND dbuser = '$dbuser'";
                    mysqli_query($conn, $sql);
            
                    mysqli_close($conn);
                }
                foreach ($_COOKIE as $key => $value) {
                    setcookie($key, '', time() - 3600, '/');
                }
                print_r('Permission Not Active'); 
                die;
            }
            



            // echo json_encode([
            //     'status' => 'success',
            //     'message' => 'Data fetched from online server.',
            //     'data' => $decoded
            // ]);
        } else {
            // echo json_encode([
            //     'status' => 'error',
            //     'message' => 'Failed to fetch from online server. HTTP Code: ' . $http_code,
            //     'response' => $response
            // ]);
        }
    }



    public function search_filter()
    {
        if($_POST['start_date']!="")
        {
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        }
        $search=$_POST['search'];
       // echo $search;
        //die;
        $this->load->model('invoices/mdl_invoice_amounts');
        $this->load->model('quotes/mdl_quote_amounts');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('quotes/mdl_quotes');
        $this->load->model('projects/mdl_projects');
        $this->load->model('tasks/mdl_tasks');
        $this->load->model('clients/mdl_clients');
        $this->load->model('expenses/mdl_expenses');
        
        $expenses_sum = $this->mdl_expenses->expenses_sum_by_date($start_date,$end_date,$search);
        $clients_count = $this->mdl_clients->clients_count_by_date($start_date,$end_date,$search);
        $quotes_count = $this->mdl_quote_amounts->quotes_count_by_date($start_date,$end_date,$search);
        $invoice_count = $this->mdl_invoices->invoice_count_by_date($start_date,$end_date,$search);
        $task_count = $this->mdl_tasks->task_count_by_date($start_date,$end_date,$search);
        $data=array(
            'expenses_sum'=>$expenses_sum->total,
            'clients_count'=>$clients_count->clients,
            'quotes_count'=>$quotes_count->quotes,
            'invoice_count'=>$invoice_count->inv_count,
            'task_count'=>$task_count->tasks,
            );
        echo json_encode($data);
        die;
    }
    public function search_activities()
    {
        $this->load->model('clients/mdl_clients');
        
        if($_POST['start_date']!="")
        {
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        }
        $data=$_POST['search'];
        $activities = $this->mdl_clients->search_activities($data,$start_date,$end_date);
        echo json_encode($activities);
       // print_r($activities);
        die;
    }
       
    public function search_birthdays()
    {
        $this->load->model('clients/mdl_clients');
        
       /* if($_POST['start_date']!="")
        {
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        }*/
        $data=$_POST['search'];
        $birthdays = $this->mdl_clients->search_birthdays($data);
        echo json_encode($birthdays);
       // print_r($activities);
        die;
    }
         
    public function search_anniversary()
    {
        $this->load->model('clients/mdl_clients'); 
     /*   if($_POST['start_date']!="")
        {
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        }*/
        $data=$_POST['search'];
        $anniversary = $this->mdl_clients->search_anniversary($data);
        echo json_encode($anniversary);
       // print_r($activities);
        die;
    }
            
    public function sendBirthdaySms(){
        $this->db->query('Update ip_clients set bir_sms=1 where client_id = ' . $this->input->post('id'));
      //  $api_key = '35E2FC90276DF0';
        $api_key = get_setting('api_key');
        $contacts = $this->input->post('phone');
       // $contacts = '8847478314';
        $from = get_setting('sender_id');
      //  $from = 'MINKCH';
        $sms = get_setting('birthday_sms', '', true);
        $sms_text = urlencode($sms);
        
        //Submit to server
        
        $ch = curl_init();
      //  curl_setopt($ch,CURLOPT_URL, "http://sms.meshink.xyz/app/smsapi/index.php");
        curl_setopt($ch,CURLOPT_URL, get_setting('api_url'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=9131&routeid=100242&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }
    
    public function sendAnniversarySms(){
        $this->db->query('Update ip_clients set ann_sms=1 where client_id = ' . $this->input->post('id'));
      //  $api_key = '35E2FC90276DF0';
        $api_key = get_setting('api_key');
        $contacts = $this->input->post('phone');
       // $contacts = '8847478314';
       // $from = 'MINKCH';
        $from = get_setting('sender_id');
        
        $sms = get_setting('anniversary_sms');
        $sms_text = urlencode($sms);
        
        //Submit to server
        
        $ch = curl_init();
      //  curl_setopt($ch,CURLOPT_URL, "http://sms.meshink.xyz/app/smsapi/index.php");
        curl_setopt($ch,CURLOPT_URL, get_setting('api_url'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=9131&routeid=100242&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response; 
        die;
    }

}
