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
class Clienteditor extends Editor_Controller
{
    /**
     * Clients constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mdl_clients');
    }

    public function index()
    {
        // Display active clients by default
        redirect('clienteditor/status/active');
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

        $this->mdl_clients->with_total_balance()->paginate(site_url('clienteditor/status/' . $status), $page);
        $clients = $this->mdl_clients->result();

        $this->layout->set(
            array(
                'records' => $clients,
                'filter_display' => true,
                'filter_placeholder' => trans('filter_clients'),
                'filter_method' => 'filter_clients'
            )
        );

        $this->layout->buffer('content', 'clienteditor/index');
         $this->layout->render('layout_editor');
    }

    /**
     * @param null $id
     */
    public function form($id = null)
    {
        if ($this->input->post('btn_cancel')) {
            redirect('clienteditor');
        }

        // Set validation rule based on is_update
        if ($this->input->post('is_update') == 0 && $this->input->post('client_name') != '') {
            $check = $this->db->get_where('ip_clients', array(
                'client_name' => $this->input->post('client_name'),
                'client_surname' => $this->input->post('client_surname')
            ))->result();

            if (!empty($check)) {
                $this->session->set_flashdata('alert_error', trans('client_already_exists'));
                redirect('clienteditor/form');
            }
        }

        if ($this->mdl_clients->run_validation()) {
            $id = $this->mdl_clients->save($id);

            $this->load->model('custom_fields/mdl_client_custom');
            $result = $this->mdl_client_custom->save_custom($id, $this->input->post('custom'));

            if ($result !== true) {
                $this->session->set_flashdata('alert_error', $result);
                $this->session->set_flashdata('alert_success', null);
                redirect('clienteditor/form/' . $id);
                return;
            } else {
                redirect('clienteditor/view/' . $id);
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

        $this->layout->buffer('content', 'clienteditor/form');
         $this->layout->render('layout_editor');
    }

    /**
     * @param int $client_id
     */
    public function view($client_id)
    {
		
        $this->load->model('clienteditor/mdl_client_notes');
        $this->load->model('clienteditor/mdl_invoices');
        $this->load->model('clienteditor/mdl_quotes');
        $this->load->model('clienteditor/mdl_payments');
        $this->load->model('clienteditor/mdl_custom_fields');
        $this->load->model('clienteditor/mdl_client_custom');

        $client = $this->mdl_clients->with_total()->with_total_balance()->with_total_paid()->where('ip_clients.client_id', $client_id)->get()->row();
   
  $custom_fields = $this->mdl_client_custom->get_by_client($client_id)->result();

        //$this->mdl_client_custom->prep_form($client_id);

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
                    'clienteditor/partial_notes'
                ),
                array(
                    'content',
                    'clienteditor/view'
                )
            )
        );

        $this->layout->render('layout_editor');
    }

    /**
     * @param int $client_id
     */
    public function delete($client_id)
    {
        $this->mdl_clients->delete($client_id);
        redirect('clienteditor');
    }
	
	public function view_invoice($invoice_id)
    {
        $this->load->model(
            array(
                'clienteditor/mdl_items',
                'clienteditor/mdl_tax_rates',
                'clienteditor/mdl_payment_methods',
                'clienteditor/mdl_invoice_tax_rates',
                'clienteditor/mdl_custom_fields',
            )
        );

        $this->load->helper("custom_values");
        $this->load->helper("client");
        $this->load->model('units/mdl_units');
        $this->load->module('payments');

        $this->load->model('clienteditor/mdl_custom_values');
        $this->load->model('clienteditor/mdl_invoice_custom');

        $this->db->reset_query();

        /*$invoice_custom = $this->mdl_invoice_custom->where('invoice_id', $invoice_id)->get();

        if ($invoice_custom->num_rows()) {
            $invoice_custom = $invoice_custom->row();

            unset($invoice_custom->invoice_id, $invoice_custom->invoice_custom_id);

            foreach ($invoice_custom as $key => $val) {
                $this->mdl_invoices->set_form_value('custom[' . $key . ']', $val);
            }
        }*/

        $fields = $this->mdl_invoice_custom->by_id($invoice_id)->get()->result();
        $invoice = $this->mdl_invoices->get_by_id($invoice_id);

        if (!$invoice) {
            show_404();
        }

        $custom_fields = $this->mdl_custom_fields->by_table('ip_invoice_custom')->get()->result();
        $custom_values = [];
        foreach ($custom_fields as $custom_field) {
            if (in_array($custom_field->custom_field_type, $this->mdl_custom_values->custom_value_fields())) {
                $values = $this->mdl_custom_values->get_by_fid($custom_field->custom_field_id)->result();
                $custom_values[$custom_field->custom_field_id] = $values;
            }
        }

        foreach ($custom_fields as $cfield) {
            foreach ($fields as $fvalue) {
                if ($fvalue->invoice_custom_fieldid == $cfield->custom_field_id) {
                    // TODO: Hackish, may need a better optimization
                    $this->mdl_invoices->set_form_value(
                        'custom[' . $cfield->custom_field_id . ']',
                        $fvalue->invoice_custom_fieldvalue
                    );
                    break;
                }
            }
        }

        $this->layout->set(
            array(
                'invoice' => $invoice,
                'items' => $this->mdl_items->where('invoice_id', $invoice_id)->get()->result(),
                'invoice_id' => $invoice_id,
                'tax_rates' => $this->mdl_tax_rates->get()->result(),
                'invoice_tax_rates' => $this->mdl_invoice_tax_rates->where('invoice_id', $invoice_id)->get()->result(),
                'units' => $this->mdl_units->get()->result(),
                'payment_methods' => $this->mdl_payment_methods->get()->result(),
                'custom_fields' => $custom_fields,
                'custom_values' => $custom_values,
                'custom_js_vars' => array(
                    'currency_symbol' => get_setting('currency_symbol'),
                    'currency_symbol_placement' => get_setting('currency_symbol_placement'),
                    'decimal_point' => get_setting('decimal_point')
                ),
                'invoice_statuses' => $this->mdl_invoices->statuses()
            )
        );

        if ($invoice->sumex_id != null) {
            $this->layout->buffer(
                array(
                    array('modal_delete_invoice', 'invoices/modal_delete_invoice'),
                    array('modal_add_invoice_tax', 'invoices/modal_add_invoice_tax'),
                    array('modal_add_payment', 'payments/modal_add_payment'),
                    array('content', 'invoices/view_sumex')
                )
            );
        } else {
            $this->layout->buffer(
                array(
                    array('modal_delete_invoice', 'invoices/modal_delete_invoice'),
                    array('modal_add_invoice_tax', 'invoices/modal_add_invoice_tax'),
                    array('modal_add_payment', 'payments/modal_add_payment'),
                    array('content', 'invoices/view')
                )
            );
        }

        $this->layout->render();
    }


}
