<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Onlinesale_model extends CI_Model
{
    
    public $table = 'orders';

    var $column = array(
        'id',
        'product_list',
        'pickup_address',
        'delivery_address',
        'delivery_date',
        'delivery_time',
        'pickup_date',
        'pickup_time',
        'instructions',
        'shipping_cost',
        'coupan',
        'sub_total',
        'total_amount',
        'user_id',
        'status'
    );
    var $order = array(
        'id' => 'desc'
    );

    public function __construct(){
        parent::__construct();
        $this->load->database(); // Default DB
        $this->db2 = $this->load->database('second_db', TRUE);
    }

    private function _get_datatables_query($year)
    {

        $this->db2->select("*");
        $this->db2->from($this->table);
        $i = 0;
        // $this->db->where('store_id',$this->session->userdata('store_id'));
        $this->db2->where('vendor_id',$this->session->userdata('store_id'));
        foreach ($this->column as $item) {
            if($_POST['search']['value']){
               $_POST['search']['value'] = ltrim($_POST['search']['value'], '0');
               ($i === 0) ? $this->db2->like($item, $_POST['search']['value']) : $this->db2->or_like($item, $_POST['search']['value']);
               if($year !=null){
                    $this->db2->where("DATE_FORMAT(created_at, '%Y')= $year");
               }
               $column[$i] = $item;
               $i++;
            }
        }
        
        if (isset($_POST['order'])){
            $this->db2->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
                $order = $this->order;
                $this->db2->order_by(key($order), $order[key($order)]);
        }
    }
  

    function get_datatables($year)
    {
        $this->_get_datatables_query($year);

        if ($_POST['length'] != - 1)
            $this->db2->limit($_POST['length'], $_POST['start']);
        
        $query = $this->db2->get();
        //echo $this->db2->last_query();die;
        return $query->result();
    }
   
    public function last_id()
    {
        $this->db2->select_max("id");
        $result= $this->db2->get($this->table)->row();
        return $result->id;
    }
    
    public function count_all($where)
    {
        $this->db2->from($this->table);
        
        $this->db2->where($where);
        $this->db2->where('vendor_id',$this->session->userdata('store_id'));
        return $this->db2->count_all_results();
    }
    
    function count_filtered($year)
    {
        $this->_get_datatables_query($year);
        $query = $this->db2->get();
        return $query->num_rows();
    }


}