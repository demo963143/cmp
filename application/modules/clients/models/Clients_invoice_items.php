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
class Clients_invoice_items extends Response_Model
{
    public $table = 'ip_invoice_items';

    public function insert_invoice_items($invoice_items) 
    {
       // return $this->db->insert('ip_invoice_items', $invoice_items);
       $this->db->insert('ip_invoice_items', $invoice_items);
       return $this->db->insert_id();
    }


    public function insert_invoice_items_amount($invoice_amount) 
    {
        return $this->db->insert('ip_invoice_item_amounts', $invoice_amount);
    }

    public function insert_final_amount($final_invoice_amount) 
    {
        return $this->db->insert('ip_invoice_amounts', $final_invoice_amount);
    }


    public function update($id, $data)
    {
        $this->db->where('client_id', $id);
        return $this->db->update('ip_clients', $data);
    }

	
}
