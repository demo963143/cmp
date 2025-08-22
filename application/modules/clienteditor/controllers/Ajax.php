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
 * Class Ajax
 */
class Ajax extends Editor_Controller
{
    public $ajax_controller = true;

    public function name_query()
    {
        // Load the model & helper
        $this->load->model('clienteditor/mdl_clients');

        $response = array();

        // Get the post input
        $query = $this->input->get('query');

        if (empty($query)) {
            echo json_encode($response);
            exit;
        }

        // Search for clients
        $escapedQuery = $this->db->escape_str($query);
        $escapedQuery = str_replace("%", "", $escapedQuery);
        $clients = $this->mdl_clients
            ->where('client_active', 1)
            ->having('client_name LIKE \'' . $escapedQuery . '%\'')
            ->or_having('client_surname LIKE \'' . $escapedQuery . '%\'')
            ->or_having('client_fullname LIKE \'' . $escapedQuery . '%\'')
            ->order_by('client_name')
            ->get()
            ->result();

        foreach ($clients as $client) {
            $response[] = array(
                'id' => $client->client_id,
                'text' => htmlsc(format_client($client)),
            );
        }

        // Return the results
        echo json_encode($response);
    }

    public function save_client_note()
    {
        $this->load->model('clienteditor/mdl_client_notes');

        if ($this->mdl_client_notes->run_validation()) {
            $this->mdl_client_notes->save();

            $response = array(
                'success' => 1,
                'new_token' => $this->security->get_csrf_hash(),
            );
        } else {
            $this->load->helper('json_error');
            $response = array(
                'success' => 0,
                'new_token' => $this->security->get_csrf_hash(),
                'validation_errors' => json_errors(),
            );
        }

        echo json_encode($response);
    }
	public function modal_create_quote()
    {
        $this->load->module('layout_editor');
        $this->load->model('clienteditor/mdl_invoice_groups');
        $this->load->model('clienteditor/mdl_tax_rates');
        $this->load->model('clienteditor/mdl_clients');

        $data = array(
            'invoice_groups' => $this->mdl_invoice_groups->get()->result(),
            'tax_rates' => $this->mdl_tax_rates->get()->result(),
            'client' => $this->mdl_clients->get_by_id($this->input->post('client_id')),
            'clients' => $this->mdl_clients->get_latest(),
        );

        $this->layout->load_view('clienteditor/modal_create_quote', $data);
    }
	
	    public function create()
    {
        $this->load->model('quotes/mdl_quotes');

        if ($this->mdl_quotes->run_validation()) {
            $quote_id = $this->mdl_quotes->create();

            $response = array(
                'success' => 1,
                'quote_id' => $quote_id
            );
        } else {
            $this->load->helper('json_error');
            $response = array(
                'success' => 0,
                'validation_errors' => json_errors()
            );
        }

        echo json_encode($response);
    }

    public function load_client_notes()
    {
        $this->load->model('clienteditor/mdl_client_notes');
        $data = array(
            'client_notes' => $this->mdl_client_notes->where('client_id', $this->input->post('client_id'))->get()->result()
        );

        $this->layout->load_view('clienteditor/partial_notes', $data);
    }
	
	 public function modal_create_invoice()
    {
        $this->load->module('layout_editor');
        $this->load->model('clienteditor/mdl_invoice_groups');
        $this->load->model('clienteditor/mdl_tax_rates');
        $this->load->model('clienteditor/mdl_clients');

        $data = array(
            'invoice_groups' => $this->mdl_invoice_groups->get()->result(),
            'tax_rates' => $this->mdl_tax_rates->get()->result(),
            'client' => $this->mdl_clients->get_by_id($this->input->post('client_id')),
            'clients' => $this->mdl_clients->get_latest(),
        );

        $this->layout->load_view('clienteditor/modal_create_invoice', $data);
    }
	
	  public function create_invoice()
    {
        $this->load->model('clienteditor/mdl_invoices');

        if ($this->mdl_invoices->run_validation()) {
            $invoice_id = $this->mdl_invoices->create();

            $response = array(
                'success' => 1,
                'invoice_id' => $invoice_id
            );
        } else {
            $this->load->helper('json_error');
            $response = array(
                'success' => 0,
                'validation_errors' => json_errors()
            );
        }

        echo json_encode($response);
    }


}
