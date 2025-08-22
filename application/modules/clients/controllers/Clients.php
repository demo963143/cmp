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
 * Class Clients
 */
class Clients extends Admin_Controller
{
    /**
     * Clients constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mdl_clients');
        $this->load->model('invoice_sheets');
        $this->load->model('clients_invoice');
        $this->load->model('clients_invoice_items');
    }

    public function index()
    {
        // Display active clients by default
        redirect('clients/status/active');
    }

    /**
     * @param string $status
     * @param int $page
     */
    public function status($status = 'active', $page = 0)
    {
        if (is_numeric(array_search($status, array('active', 'inactive')))) {
            $function = 'is_' . $status;
            $this->mdl_clients->$function();
        }

        $this->mdl_clients->with_total_balance()->paginate(site_url('clients/status/' . $status), $page);
        $clients = $this->mdl_clients->result();

        $this->layout->set(
            array(
                'records' => $clients,
                'filter_display' => true,
                'filter_placeholder' => trans('filter_clients'),
                'filter_method' => 'filter_clients'
            )
        );

        $this->layout->buffer('content', 'clients/index');
        $this->layout->render();
    }

    /**
     * @param null $id
     */
    public function form($id = null)
    {
       // print_r($_POST); die;

        if ($this->input->post()) {
            if (!empty($_FILES['document_file']['name'][0])) {
                $this->load->library('upload');
                $config['upload_path']   = './assets/core/img/document/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']      = 2048; 
                //$config['encrypt_name']  = TRUE;
                $this->upload->initialize($config);
        
                $filesCount = count($_FILES['document_file']['name']);
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['file']['name']     = $_FILES['document_file']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['document_file']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['document_file']['tmp_name'][$i];
                    $_FILES['file']['error']    = $_FILES['document_file']['error'][$i];
                    $_FILES['file']['size']     = $_FILES['document_file']['size'][$i];
        
                    if (!$this->upload->do_upload('file')) {
                        $this->form_validation->set_message('validate_document_file', $this->upload->display_errors());
                        return false;
                    }
                }
            }
        }

        if ($this->input->post()) {
            if (!empty($_FILES['tenant_photo']['name'][0])) {
                $this->load->library('upload');
                $config['upload_path']   = './assets/core/img/tenant-photo/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']      = 2048; 
                //$config['encrypt_name']  = TRUE;
                $this->upload->initialize($config);
                $filesCount = count($_FILES['tenant_photo']['name']);
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['file']['name']     = $_FILES['tenant_photo']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['tenant_photo']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['tenant_photo']['tmp_name'][$i];
                    $_FILES['file']['error']    = $_FILES['tenant_photo']['error'][$i];
                    $_FILES['file']['size']     = $_FILES['tenant_photo']['size'][$i];
        
                    if (!$this->upload->do_upload('file')) {
                        $this->form_validation->set_message('validate_document_file', $this->upload->display_errors());
                        return false;
                    }
                }
            }
        }

        if ($this->input->post()) {
            if (!empty($_FILES['employee_photo']['name'][0])) {
                $this->load->library('upload');
                $config['upload_path']   = './assets/core/img/employee-photo/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']      = 2048; 
                //$config['encrypt_name']  = TRUE;
                $this->upload->initialize($config);
                $filesCount = count($_FILES['employee_photo']['name']);
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['file']['name']     = $_FILES['employee_photo']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['employee_photo']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['employee_photo']['tmp_name'][$i];
                    $_FILES['file']['error']    = $_FILES['employee_photo']['error'][$i];
                    $_FILES['file']['size']     = $_FILES['employee_photo']['size'][$i];
        
                    if (!$this->upload->do_upload('file')) {
                        $this->form_validation->set_message('validate_document_file', $this->upload->display_errors());
                        return false;
                    }
                }
            }
        }


        if ($this->input->post()) {
            if (!empty($_FILES['student_photo']['name'][0])) {
                $this->load->library('upload');
                $config['upload_path']   = './assets/core/img/student-photo/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']      = 2048; 
                //$config['encrypt_name']  = TRUE;
                $this->upload->initialize($config);
                $filesCount = count($_FILES['student_photo']['name']);
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['file']['name']     = $_FILES['student_photo']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['student_photo']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['student_photo']['tmp_name'][$i];
                    $_FILES['file']['error']    = $_FILES['student_photo']['error'][$i];
                    $_FILES['file']['size']     = $_FILES['student_photo']['size'][$i];
        
                    if (!$this->upload->do_upload('file')) {
                        $this->form_validation->set_message('validate_document_file', $this->upload->display_errors());
                        return false;
                    }
                }
            }
        }
    
        if ($this->input->post('btn_cancel')) {
            
            redirect('clients');
        }
        // Set validation rule based on is_update
        if ($this->input->post('is_update') == 0 && $this->input->post('client_name') != '') {
            $check = $this->db->get_where('ip_clients', array(
                'client_name' => $this->input->post('client_name'),
                'client_surname' => $this->input->post('client_surname')
            ))->result();

            if (!empty($check)) {
                $this->session->set_flashdata('alert_error', trans('client_already_exists'));
                redirect('clients/form');
            }
        }
        if ($this->mdl_clients->run_validation()) {
            $id = $this->mdl_clients->save($id);
            $this->load->model('custom_fields/mdl_client_custom');
            $result = $this->mdl_client_custom->save_custom($id, $this->input->post('custom'));
            if ($result !== true) {
                $this->session->set_flashdata('alert_error', $result);
                $this->session->set_flashdata('alert_success', null);
                redirect('clients/form/' . $id);
                return;
            } else {
                redirect('clients/view/' . $id);
            }
        }
        if ($id and !$this->input->post('btn_submit')) {
            if (!$this->mdl_clients->prep_form($id)) {
                show_404();
            }
            $this->load->model('custom_fields/mdl_client_custom');
            $this->mdl_clients->set_form_value('is_update', true);
            $client_custom = $this->mdl_client_custom->where('client_id', $id)->get();
            if ($client_custom->num_rows()) {
                $client_custom = $client_custom->row();

                unset($client_custom->client_id, $client_custom->client_custom_id);

                foreach ($client_custom as $key => $val) {
                    $this->mdl_clients->set_form_value('custom[' . $key . ']', $val);
                }
            }
        } elseif ($this->input->post('btn_submit')) {
            if ($this->input->post('custom')) {
                foreach ($this->input->post('custom') as $key => $val) {
                    $this->mdl_clients->set_form_value('custom[' . $key . ']', $val);
                }
            }
        }
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_values/mdl_custom_values');
        $this->load->model('custom_fields/mdl_client_custom');
        $custom_fields = $this->mdl_custom_fields->by_table('ip_client_custom')->get()->result();
        $custom_values = [];
        foreach ($custom_fields as $custom_field) {
            if (in_array($custom_field->custom_field_type, $this->mdl_custom_values->custom_value_fields())) {
                $values = $this->mdl_custom_values->get_by_fid($custom_field->custom_field_id)->result();
                $custom_values[$custom_field->custom_field_id] = $values;
            }
        }
        $fields = $this->mdl_client_custom->get_by_clid($id);
        foreach ($custom_fields as $cfield) {
            foreach ($fields as $fvalue) {
                if ($fvalue->client_custom_fieldid == $cfield->custom_field_id) {
                    // TODO: Hackish, may need a better optimization
                    $this->mdl_clients->set_form_value(
                        'custom[' . $cfield->custom_field_id . ']',
                        $fvalue->client_custom_fieldvalue
                    );
                    break;
                }
            }
        }
        $this->load->helper('country');
        $this->load->helper('custom_values');
        $this->layout->set(
            array(
                'custom_fields' => $custom_fields,
                'custom_values' => $custom_values,
                'countries' => get_country_list(trans('cldr')),
                'selected_country' => $this->mdl_clients->form_value('client_country') ?: get_setting('default_country'),
                'languages' => get_available_languages(),
            )
        );
        $this->layout->buffer('content', 'clients/form');
        $this->layout->render();
    }




    /**
     * @param int $client_id
     */
    public function view($client_id)
    {
        $this->load->model('clients/mdl_client_notes');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('quotes/mdl_quotes');
        $this->load->model('payments/mdl_payments');
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_fields/mdl_client_custom');

        $client = $this->mdl_clients->with_total()->with_total_balance()->with_total_paid()->where('ip_clients.client_id', $client_id)->get()->row();
        $custom_fields = $this->mdl_client_custom->get_by_client($client_id)->result();

        $this->mdl_client_custom->prep_form($client_id);

        if (!$client) {
            show_404();
        }

        $this->layout->set(
            array(
                'client' => $client,
                'client_notes' => $this->mdl_client_notes->where('client_id', $client_id)->get()->result(),
                'invoices' => $this->mdl_invoices->by_client($client_id)->limit(20)->get()->result(),
                'quotes' => $this->mdl_quotes->by_client($client_id)->limit(20)->get()->result(),
                'payments' => $this->mdl_payments->by_client($client_id)->limit(20)->get()->result(),
                'custom_fields' => $custom_fields,
                'quote_statuses' => $this->mdl_quotes->statuses(),
                'invoice_statuses' => $this->mdl_invoices->statuses()
            )
        );

        $this->layout->buffer(
            array(
                array(
                    'invoice_table',
                    'invoices/partial_invoice_table'
                ),
                array(
                    'quote_table',
                    'quotes/partial_quote_table'
                ),
                array(
                    'payment_table',
                    'payments/partial_payment_table'
                ),
                array(
                    'partial_notes',
                    'clients/partial_notes'
                ),
                array(
                    'content',
                    'clients/view'
                )
            )
        );

        $this->layout->render();
    }

    /**
     * @param int $client_id
     */
    public function delete($client_id)
    {
        $this->mdl_clients->delete($client_id);
        redirect('clients');
    }
    
    public function client_history($id = null)
    {
      
        $this->load->model('clients/mdl_client_notes');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('quotes/mdl_quotes');
        $this->load->model('payments/mdl_payments');
        $this->load->model('custom_fields/mdl_custom_fields');
        $this->load->model('custom_fields/mdl_client_custom');

        $client = $this->mdl_clients->with_total()->with_total_balance()->with_total_paid()->where('ip_clients.client_id', $id)->get()->row();
        $custom_fields = $this->mdl_client_custom->get_by_client($id)->result();
        $activities=$this->mdl_clients->get_activities($id);
        $invoices = $this->mdl_clients->get_invoice_by_client($id);
        
       // print_r($invoices);
        $this->mdl_client_custom->prep_form($id);

        if (!$client) {
            show_404();
        }

        $this->layout->set(
            array(
                'client' => $client,
                'usual_invoice_services'=>$this->mdl_clients->usual_invoice_services($id),
                'usual_activity_services'=>$this->mdl_clients->usual_activity_services($id),
                'activities'=>$activities,
                'invoices'=>$invoices,
            )
        );

        $this->layout->buffer(
            array(
                array(
                    'content',
                    'clients/activity_history'
                )
            )
        );

        $this->layout->render();
    }
   public function add_activity()
    {
        $service_name=$_POST['service_name'];
        $amount=$_POST['amount'];
        $reminder=$_POST['reminder'];
        $remarks=$_POST['remarks'];
        $id=$_POST['id'];
        $data=array(
            'client_id'=>$id,
            'service_name'=>$service_name,
            'amount'=>$amount,
            'reminder'=>$reminder,
            'remarks'=>$remarks
            );
        $this->mdl_clients->add_activity($data);
        echo "Done";
    }

   


    public function addinvoicesheet()
    {
        $post = $this->input->post(); 
        $count = count($post['tenant_name']);
        
        for ($i = 0; $i < $count; $i++) {

            $data = [
                'invoice_date'              => $post['invoice_date'],
                'room_no'                   => $post['room_no'][$i],
                'tenant_name'               => $post['tenant_name'][$i],
                'rant'                      => $post['rant'][$i],
                'miscellaneous'             => $post['miscellaneous'][$i],
                'old_electricity_reading'   => $post['old_electricity_reading'][$i],
                'new_electricity_reading'   => $post['new_electricity_reading'][$i],
                'total_electricity_reading' => $post['total_electricity_reading'][$i],
                'electricity_bill'          => $post['electricity_bill'][$i],
                'remark'                    => $post['remark'][$i],
                'client_id'                 => $post['client_id'][$i],
            ];

            $client_id = $post['client_id'][$i];
            $last_electric_reading_data = [
                'last_electric_reading' => $post['total_electricity_reading'][$i],
            ];
            $this->clients_invoice_items->update($client_id, $last_electric_reading_data);


            $invoice = [
                'user_id'               => 1,
                'client_id'             => $post['client_id'][$i],
                'invoice_group_id'      => 3,
                'invoice_status_id'     => 1,
                'invoice_date_created'  => $post['invoice_date'],
                'invoice_time_created'  => date('H:i:s'),
                'invoice_date_modified' => date('Y-m-d H:i:s'),
                'invoice_date_due'      => $post['invoice_date'],
                'invoice_terms'         => 'direct',
                'invoice_url_key'       => bin2hex(random_bytes(8)),
            ];

            $invoice_id = $this->clients_invoice->insert_invoice($invoice); 

            $invoice_items = [
                'invoice_id'            => $invoice_id,
                'item_tax_rate_id'      => 0,
                'item_date_added'       => $post['invoice_date'],
                'item_name'             => 'Rent',
                'item_quantity'         => 1,
                'item_price'            => $post['rant'][$i],
                'item_order '         => 1,
            ];

            $invoice_items2 = [
                'invoice_id'            => $invoice_id,
                'item_tax_rate_id'      => 0,
                'item_date_added'       => $post['invoice_date'],
                'item_name'             => 'Miscellaneous',
                'item_quantity'         => 1,
                'item_price'            => $post['miscellaneous'][$i],
                'item_order '         => 1,
            ];

            $invoice_items3 = [
                'invoice_id'            => $invoice_id,
                'item_tax_rate_id'      => 0,
                'item_date_added'       => $post['invoice_date'],
                'item_name'             => 'Electricity Bill',
                'item_description'      => 'Old Electricity Reading = ' . $post['old_electricity_reading'][$i] .
                               ', New Electricity Reading = ' . $post['new_electricity_reading'][$i] .
                               ', Total Electricity Reading = ' . $post['total_electricity_reading'][$i] .
                               ', Rate Unit = ' . get_setting('electrical_bill', '', true),
                'item_quantity'         => 1,
                'item_price'            => $post['electricity_bill'][$i],
                'item_order '         => 1,
            ];

            $this->invoice_sheets->insert_user($data);  

            $invoice_item_id1 = $this->clients_invoice_items->insert_invoice_items($invoice_items);
            $invoice_item_id2 =  $this->clients_invoice_items->insert_invoice_items($invoice_items2);
            $invoice_item_id3 = $this->clients_invoice_items->insert_invoice_items($invoice_items3);

            
            $rant_amount = (float) $post['rant'][$i];
            $miscellaneous_amount = (float) $post['miscellaneous'][$i];
            $electricity_bill_amount = (float) $post['electricity_bill'][$i];

           $total_amount = (float) $post['rant'][$i] + (float) $post['miscellaneous'][$i] + (float) $post['electricity_bill'][$i];

            $invoice_amount1 = [
                'item_id'            => $invoice_item_id1,
                'item_subtotal'      =>$rant_amount,
                'item_tax_total'     => 0.00,
                'item_discount'      => 0.00,
                'item_total'         => $rant_amount,
            ];

            $invoice_amount2 = [
                'item_id'            => $invoice_item_id2,
                'item_subtotal'      =>$miscellaneous_amount,
                'item_tax_total'     => 0.00,
                'item_discount'      => 0.00,
                'item_total'         =>$miscellaneous_amount,
            ];

            $invoice_amount3 = [
                'item_id'            => $invoice_item_id3,
                'item_subtotal'      =>$electricity_bill_amount,
                'item_tax_total'     => 0.00,
                'item_discount'      => 0.00,
                'item_total'         => $electricity_bill_amount,
            ];

            $this->clients_invoice_items->insert_invoice_items_amount($invoice_amount1);
            $this->clients_invoice_items->insert_invoice_items_amount($invoice_amount2);
            $this->clients_invoice_items->insert_invoice_items_amount($invoice_amount3);


            $final_invoice_amount = [
                'invoice_id'         => $invoice_id,
                'invoice_sign'       => 1,
                'invoice_item_subtotal' => $total_amount,
                'invoice_item_tax_total' => 0.00,
                'invoice_tax_total' => 0.00,
                'invoice_total'  => $total_amount,
                'invoice_paid'   =>0.00,
                'invoice_balance' => $total_amount,
            ];

            $this->clients_invoice_items->insert_final_amount($final_invoice_amount);

        }

        redirect('invoices/recurring/invoicesheet');
    }



}

