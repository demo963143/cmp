<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orderstatus_model extends CI_Model
{
    public $table = 'sales';

    var $column = array(
        'id',
        'clientname',
        'tax',
        'discount',
        'total',
        'created_by',
        'totalitems',
        'status'
    );
    var $order = array(
        'id' => 'desc'
    );

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query($year)
    {

         $this->db->select("*");
          $this->db->from($this->table);
        $i = 0;
        
        foreach ($this->column as $item) {
            if ($_POST['search']['value']){
                $_POST['search']['value'] = ltrim($_POST['search']['value'], '0');
            ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $this->db->order_by('sales.id','DESC');
            if($year !=null)
            {
                $this->db->where("DATE_FORMAT(created_at, '%Y')= $year");
            }
            $column[$i] = $item;
            $i ++;
            }
        }
        
        if (isset($_POST['order'])) 
         {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else 
            if (isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
    }
  

    function get_datatables($year)
    {
        $this->_get_datatables_query($year);

        if ($_POST['length'] != - 1)
            $this->db->limit($_POST['length'], $_POST['start']);
        
        $query = $this->db->get();
        return $query->result();
    }
   
    function count_filtered($year)
    {
        $this->_get_datatables_query($year);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($where)
    {
        $this->db->from($this->table);
        
        $this->db->where($where);
        
        return $this->db->count_all_results();
    }
    public function get_all($where=null)
    {
        $this->db->from($this->table);
        //$this->db->where('store_id',$this->session->userdata('store_id'));

        if($where != null)
        {
        $this->db->where($where);
        }
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function gen_pdf($startdate,$enddate)
    {
        $this->db->from($this->table);
        //$this->db->where('store_id',$this->session->userdata('store_id'));
        if($startdate != null && $enddate != null)
        {
            $this->db->where('created_at BETWEEN "'. $startdate. '" and "'. $enddate.'"');
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_items($where)
    {
        $this->db->from('sale_items');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($where)
    {
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();
        
        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function save_item($data)
    {
        $this->db->insert('sale_items', $data);
        return $this->db->insert_id();
    }

    public function update($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($where)
    {
        $this->db->where($where);
        $this->db->delete($this->table);
    }
    public function delete_items($id_sale)
    {
        $this->db->where('sale_id',$id_sale);
        $this->db->delete('sale_items');
    }
    public function last_id()
    {
        $this->db->select_max("id");
        $result= $this->db->get($this->table)->row();
        return $result->id;
    }
    public function get_sum_total($id)
    {
          $this->db->select("total");
          $this->db->from($this->table);
          $this->db->where('client_id',$id);
          $this->db->select_sum('total');
          $result = $this->db->get()->row();  
           if($result->total)
            return $result->total;
          else 
            return 0;
    }
    public function get_sum_paid($id)
    {
          $this->db->select("paid");
          $this->db->from($this->table);
          $this->db->where('client_id',$id);
          $this->db->select_sum('paid');
          $result = $this->db->get()->row();  
           if($result->paid)
            return $result->paid;
          else 
            return 0;
    }
    public function sum_sale($where)
    {
          $this->db->select("total");
          $this->db->from($this->table);
          $this->db->where($where);
          $this->db->select_sum('total');
          $result = $this->db->get()->row();  
           if($result->total)
            return $result->total;
          else 
            return 0;
    }
    public function taxamount_sale($where)
    {
          $this->db->select("taxamount");
          $this->db->from($this->table);
          $this->db->where($where);
          $this->db->select_sum('taxamount');
          $result = $this->db->get()->row();  
           if($result->taxamount)
            return $result->taxamount;
          else 
            return 0;
    }
    public function discountamount_sale($where)
    {
          $this->db->select("discountamount");
          $this->db->from($this->table);
          $this->db->where($where);
          $this->db->select_sum('discountamount');
          $result = $this->db->get()->row();  
           if($result->discountamount)
            return $result->discountamount;
          else 
            return 0;
    }
    public function paid_sale($where)
    {
          $this->db->select("paid");
          $this->db->from($this->table);
          $this->db->where($where);
          $this->db->select_sum('paid');
          $result = $this->db->get()->row();  
           if($result->paid)
            return $result->paid;
          else 
            return 0;
    }
    public function top_product($year,$limit)
    {
          $this->db->select("name, product_id, sum(qt) AS totalquantity");
          $this->db->from('sale_items');
          $this->db->where("DATE_FORMAT(date, '%Y')= $year");
          $this->db->group_by('product_id'); 
          $this->db->order_by('SUM(qt) DESC'); 
          $this->db->limit($limit);
          $result = $this->db->get();  
          return $result->result();
    }
    


}