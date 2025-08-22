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

    public function add()
    {
        $this->load->model('payments_editor/mdl_payments');

        if ($this->mdl_payments->run_validation()) {
            $this->mdl_payments->save();

            $response = array(
                'success' => 1
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

    public function modal_add_payment()
    {
        $this->load->module('layout_editor');
        $this->load->model('payments_editor/mdl_payments');
        $this->load->model('clienteditor/mdl_payment_methods');

        $data = array(
            'payment_methods' => $this->mdl_payment_methods->get()->result(),
            'invoice_id' => $this->input->post('invoice_id'),
            'invoice_balance' => $this->input->post('invoice_balance'),
            'invoice_payment_method' => $this->input->post('invoice_payment_method')
        );

        $this->layout->load_view('payments_editor/modal_add_payment', $data);
    }

}
