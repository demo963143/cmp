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
 * Class User_Controller
 */
class Editor_Controller extends User_Controller
{
    /**
     * User_Controller constructor.
     * @param string $required_key
     * @param integer $required_val
     */
 public function __construct()
    {
        parent::__construct('user_type', 3);
    }
}
