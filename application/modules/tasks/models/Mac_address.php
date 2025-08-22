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
 * Class Mdl_Tasks
 */
class Mac_address extends Response_Model
{
    public $table = 'ip_macaddress';
    
    public function save_mac($mac) {
        
        $data = array(
            'mac_address' => $mac,
            'created_at' => date('Y-m-d H:i:s')
        );
       
        return $this->db->insert('ip_macaddress', $data);
    
    }
    

   
 
}
