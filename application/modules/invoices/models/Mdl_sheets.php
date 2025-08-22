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
class Mdl_sheets extends Response_Model
{
    public $table = 'ip_invoice_sheets';

 
    // public function get_all()
    // {
    //     return $this->db->order_by('created_at', 'DESC')->get('ip_invoice_sheets')->result(); 
    // }
   
    public function get_all()
    {
        $this->db->select('ip_invoice_sheets.*,ip_clients.client_name');
        $this->db->from('ip_invoice_sheets');
        $this->db->join('ip_clients', 'ip_invoice_sheets.client_id = ip_clients.client_id', 'left');
        $this->db->order_by('ip_invoice_sheets.created_at', 'DESC');
        return $this->db->get()->result();
    }
    

	
}
