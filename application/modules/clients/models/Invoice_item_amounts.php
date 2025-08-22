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
class Invoice_item_amounts extends Response_Model
{
    public $table = 'ip_invoice_item_amounts';

    public function insert_amount($invoice_items_amount) 
    {
        return $this->db->insert('ip_invoice_item_amounts', $invoice_items_amount);
    }

   

	
}
