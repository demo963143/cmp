<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posale_model extends CI_Model
{
    public $table = 'posale';

    public $column = array(
        'id',
    );
    var $order = array(
        'id' => 'desc'
    );

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {

         $this->db->select("*");
          $this->db->from($this->table);
        $i = 0;
        
        foreach ($this->column as $item) {
            if ($_POST['search']['value']){
                $_POST['search']['value'] = ltrim($_POST['search']['value'], '0');
            ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $this->db->order_by('posale.id','DESC');
            $this->db->where('posale.store_id',$this->session->userdata('store_id'));
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
  

    function get_datatables()
    {
        $this->_get_datatables_query();

        if ($_POST['length'] != - 1)
            $this->db->limit($_POST['length'], $_POST['start']);
        
        $query = $this->db->get();
        return $query->result();
    }
   
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
    }
    
    public function get_all($where=null)
    {
        $this->db->from($this->table);
        $this->db->where('store_id',$this->session->userdata('store_id'));
        if($where != null)
        {
        $this->db->where($where);
        }
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

    public function save($posale)
    {
        $this->db->insert($this->table, $posale);
        return $this->db->insert_id();
    }
    
    public function update($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
    
    public function update_service($data,$id,$parent)
    {
        $this->db->where('parent', $parent);
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete_by_id($where)
    {
        $this->db->where($where);
        $this->db->delete($this->table);
    }
    public function last_id()
    {
        $this->db->select_max("id");
        $result= $this->db->get($this->table)->row();
        return $result->id;
    }
    
    public function get_allserch($where=null)
    {
        $this->db->from($this->table);
        $this->db->where('store_id',$this->session->userdata('store_id'));
        $this->db->where('additional_product',1);
        if($where != null)
        {
        $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    
    
    
    public function checkdata_edit($id)
    {
        $this->db->from($this->table);
        $this->db->where('sale_id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    
   
   
    public function delete_data($store_id)
    {
        $this->db->where('store_id', $store_id);
        $this->db->where('product_update', 1);
        $this->db->delete('posale');
    
        if ($this->db->affected_rows() > 0) {
            return true; 
        } else {
            return false;
        }
    }
   
    
    
    
}