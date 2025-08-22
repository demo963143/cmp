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
 * Class Recurring
 */
class Recurring extends Admin_Controller
{
    /**
     * Recurring constructor.
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_invoices_recurring');
        $this->load->model('mdl_sheets');
    }

    /**
     * @param int $page
     */

    public function index($page = 0)
    {
        $this->mdl_invoices_recurring->paginate(site_url('invoices/recurring'), $page);
        $recurring_invoices = $this->mdl_invoices_recurring->result();

        $this->layout->set('recur_frequencies', $this->mdl_invoices_recurring->recur_frequencies);
        $this->layout->set('recurring_invoices', $recurring_invoices);
        $this->layout->buffer('content', 'invoices/index_recurring');
        $this->layout->render();
    }

    /**
     * @param $invoice_recurring_id
     */
    public function stop($invoice_recurring_id)
    {
        $this->mdl_invoices_recurring->stop($invoice_recurring_id);
        redirect('invoices/recurring/index');
    }

    /**
     * @param $invoice_recurring_id
     */
    public function delete($invoice_recurring_id)
    {
        $this->mdl_invoices_recurring->delete($invoice_recurring_id);
        redirect('invoices/recurring/index');
    }



    public function invoicesheet()
    {
        $data['invoice_sheets'] = $this->mdl_sheets->get_all(); 
        $this->layout->buffer('content', 'invoices/invoice_sheet', $data);
        $this->layout->render();
    }

    public function createinvoicesheet($page = 0)
    {
        $this->layout->buffer('content', 'invoices/create-invoice-sheet');
        $this->layout->render();
    }

   




















}
