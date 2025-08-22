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
 * Class Mdl_Payments
 */
class Mdl_Expenses extends Response_Model
{
    public $table = 'ip_expenses';
    public $primary_key = 'ip_expenses.exp_id';
    public $validation_rules = 'validation_rules';

    public function default_select()
    {
        $this->db->select("*");
    }

    public function default_order_by()
    {
        $this->db->order_by('ip_expenses.exp_id DESC');
    }

    public function default_join()
    {
        $this->db->join('ip_payment_methods', 'ip_payment_methods.payment_method_id = ip_expenses.exp_payment_method_id', 'left');
    }

    /**
     * @return array
     */
    public function validation_rules()
    {
        return array(
            'exp_date' => array(
                'field' => 'exp_date',
                'label' => trans('date'),
                'rules' => 'required'
            ),
            'exp_amount' => array(
                'field' => 'exp_amount',
                'label' => trans('payment'),
                'rules' => 'required'
            ),
            'exp_payment_method_id' => array(
                'field' => 'exp_payment_method_id',
                'label' => trans('payment_method')
            ),
            'exp_note' => array(
                'field' => 'exp_note',
                'label' => trans('note')
            )
        );
    }

    /**
     * @param $amount
     * @return bool
     */
 /*   public function validate_payment_amount($amount)
    {
        $amount = (float)standardize_amount($amount);
        $invoice_id = $this->input->post('invoice_id');
        $payment_id = $this->input->post('payment_id');

        $invoice = $this->db->where('invoice_id', $invoice_id)->get('ip_invoice_amounts')->row();

        if ($invoice == null) {
            return false;
        }

        $invoice_balance = (float)$invoice->invoice_balance;

        if ($payment_id) {
            $payment = $this->db->where('payment_id', $payment_id)->get('ip_payments')->row();

            $invoice_balance = $invoice_balance + (float)$payment->payment_amount;
        }

        $invoice_balance = (float)$invoice_balance;

        if ($amount > $invoice_balance) {
            $this->form_validation->set_message('validate_payment_amount', trans('payment_cannot_exceed_balance'));
            return false;
        }

        return true;
    }*/

    /**
     * @param null $id
     * @param null $db_array
     * @return bool|int|null
     */
    public function save($id = null, $db_array = null)
    {
        $db_array = ($db_array) ? $db_array : $this->db_array();
        
      //  $this->load->model('invoices/mdl_invoice_amounts');

        // Save the payment
        $id = parent::save($id, $db_array);

        return $id;
    }

    /**
     * @return array
     */
    public function db_array()
    {
        $db_array = parent::db_array();

        $db_array['exp_date'] = date_to_mysql($db_array['exp_date']);
        $db_array['exp_amount'] = standardize_amount($db_array['exp_amount']);

        return $db_array;
    }

    /**
     * @param null $id
     */
    public function delete($id = null)
    {
        // Delete the expenses
        parent::delete($id);

    }

    /**
     * @param null $id
     * @return bool
     */
    public function prep_form($id = null)
    {
        if (!parent::prep_form($id)) {
            return false;
        }

        if (!$id) {
            parent::set_form_value('exp_date', date('Y-m-d'));
        }

        return true;
    }

    /**
     * @param $client_id
     * @return $this
     */
    public function by_client($client_id)
    {
        $this->filter_where('ip_clients.client_id', $client_id);
        return $this;
    }
     public function expenses_sum()
    {
           return $this->db->select('sum(exp_amount)as total')->from('ip_expenses')->where('DATE(exp_created_at)',date("Y-m-d"))->get()->row();
    }
   /* public function expenses_sum_by_date($start_date,$end_date)
    { 
        return $this->db->select('sum(IFNULL(exp_amount, 0))as total')->from('ip_expenses')
                ->where('DATE(exp_created_at) BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"')->get()->row();
    }*/
    public function expenses_sum_by_date($start_date=null,$end_date=null,$search=null)
    {
      //  echo $search;
      //  die;
      if($search)
        {
            $start_date="";
            $end_date="";
            if($search=="7")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +6 day" ) );
            }else if($search=="15")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +15 day" ) );
            }else if($search=="month")
            {
                $start_date=date('Y-m-01');
                $end_date= date('Y-m-t');
            }
        }  
        return $this->db->select('sum(IFNULL(exp_amount, 0))as total')->from('ip_expenses')
                ->where('DATE(exp_created_at) BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"')->get()->row();
    }
}
