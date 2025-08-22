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
class Invoice_sheets extends Response_Model
{
    public $table = 'ip_invoice_sheets';

    public function insert_user($data) 
    {
        return $this->db->insert('ip_invoice_sheets', $data);
    }

   

	
}
