<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register_model extends CI_Model
{
    public $table = 'registers';

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

    private function _get_datatables_query($start,$end)
    {

         $this->db->select("*");
          $this->db->from($this->table);
        $i = 0;
        $this->db->where('registers.store_id',$this->session->userdata('store_id'));
        foreach ($this->column as $item) {
            if ($_POST['search']['value']){
                $_POST['search']['value'] = ltrim($_POST['search']['value'], '0');
            ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $this->db->order_by('registers.id','DESC');
            
            if($start !=null && $end !=null)
            {
                $this->db->where('date BETWEEN "'. $start. '" and "'. $end.'"');
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
    function get_datatables($start,$end)
    {
        $this->_get_datatables_query($start,$end);

        if ($_POST['length'] != - 1)
            $this->db->limit($_POST['length'], $_POST['start']);
        
        $query = $this->db->get();
        return $query->result();
    }
   
    function count_filtered($start,$end)
    {
        $this->_get_datatables_query($start,$end);
        
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($start,$end)
    {
        $this->db->from($this->table);
        $this->db->where('registers.store_id',$this->session->userdata('store_id'));
        return $this->db->count_all_results();
    }
    public function get_all($where=null)
    {
        $this->db->from($this->table);
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

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
    public function last_id()
    {
        $this->db->select_max("id");
        $result= $this->db->get($this->table)->row();
        return $result->id;
    }
    public function totalRevenue($where=array())
    {
          $this->db->select('SUM(cash_total) + SUM(cheque_total) as total', FALSE);
          $this->db->from($this->table);
          $this->db->where($where);
          $result = $this->db->get()->row();  
           if($result->total)
            return $result->total;
          else 
            return 0;
    }
}