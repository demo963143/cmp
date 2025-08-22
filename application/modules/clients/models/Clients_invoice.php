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
 * Class Invoice_sheets
 */
class Clients_invoice extends Response_Model
{
    public $table = 'ip_invoices';

    public function insert_invoice($invoice) 
    {
        $this->db->insert('ip_invoices', $invoice);
        return $this->db->insert_id();
    }

   

	
}
