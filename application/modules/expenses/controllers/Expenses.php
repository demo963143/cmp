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
 * Class expenses
 */
class Expenses extends Admin_Controller
{
    /**
     * expenses constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mdl_expenses');
    }

    /**
     * @param int $page
     */
    public function index($page = 0)
    {
        $this->mdl_expenses->paginate(site_url('expenses/index'), $page);
        $expenses = $this->mdl_expenses->result();

        $this->layout->set(
            array(
                'expenses' => $expenses,
                'filter_display' => true,
                'filter_placeholder' => trans('filter_expenses'),
                'filter_method' => 'filter_expenses'
            )
        );

        $this->layout->buffer('content', 'expenses/index');
        $this->layout->render();
    }

    /**
     * @param null $id
     */
    public function form($id = null)
    {
        if ($this->input->post('btn_cancel')) {
            redirect('expenses');
        }
		//save expenses
        if ($this->mdl_expenses->run_validation()) {
            $id = $this->mdl_expenses->save($id);
            redirect('expenses');
        }

        if (!$this->input->post('btn_submit')) {

            $prep_form = $this->mdl_expenses->prep_form($id);

            if ($id and !$prep_form) {
                show_404();
            }
        } 

        $this->load->model('payment_methods/mdl_payment_methods');
        $this->layout->set(
            array(
                'payment_methods' => $this->mdl_payment_methods->get()->result(),
            )
        );

        $this->layout->buffer('content', 'expenses/form');
        $this->layout->render();
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $this->mdl_expenses->delete($id);
        redirect('expenses');
    }

}
