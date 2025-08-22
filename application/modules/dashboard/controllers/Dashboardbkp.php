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
        $data=$_POST['search'];
        $activities = $this->mdl_clients->search_activities($data);
        echo json_encode($activities);
       // print_r($activities);
        die;
    }
            
    public function sendBirthdaySms(){
        $this->db->query('Update ip_clients set bir_sms=1 where client_id = ' . $this->input->post('id'));
        $api_key = '35E2FC90276DF0';
        $contacts = $this->input->post('phone');
        $from = 'MINKCH';
        $sms = get_setting('birthday_sms', '', true);
        $sms_text = urlencode($sms->bir_sms);
        
        //Submit to server
        
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, "http://sms.meshink.xyz/app/smsapi/index.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=9131&routeid=100242&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }
    
    public function sendAnniversarySms(){
        $this->db->query('Update ip_clients set ann_sms=1 where client_id = ' . $this->input->post('id'));
       // echo
        $api_key = '35E2FC90276DF0';
        $contacts = $this->input->post('phone');
        $from = 'MINKCH';
        
        $sms = get_setting('anniversary_sms', '', true);
        $sms_text = urlencode($sms->ann_sms);
        
        //Submit to server
        
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, "http://sms.meshink.xyz/app/smsapi/index.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=9131&routeid=100242&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response; 
        die;
    }

}
