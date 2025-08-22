<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expence_model extends CI_Model
{
    public $table = 'expences';

    public $column = array(
        'reference',
        'note',
        'date',
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
          $this->db->select("expences.*, 
          categorie_expences.name AS namecategory");
          $this->db->from($this->table);
          $this->db->join('categorie_expences','categorie_expences.id = expences.category_id');

          $i = 0;
          $this->db->where('expences.store_id',$this->session->userdata('store_id'));
        foreach ($this->column as $item) {
            if ($_POST['search']['value']){
                $_POST['search']['value'] = ltrim($_POST['search']['value'], '0');
            ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $this->db->order_by('expences.id','DESC');
            
            if($year !=null)
            {
                $this->db->where("DATE_FORMAT(date, '%Y')= $year");
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
   
    // function count_filtered($year)
    // {
    //     $this->_get_datatables_query($year);
    //     $this->db->where('store_id',$this->session->userdata('store_id'));
    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }
    
    function count_filtered($year)
    {
        $this->_get_datatables_query($year);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($year)
    {
        if($year !=null)
        {
          $this->db->where("DATE_FORMAT(date, '%Y')= $year");
        }
        $this->db->where('store_id',$this->session->userdata('store_id'));
        $this->db->from($this->table);
        return $this->db->count_all_results();

    }
    public function get_all()
    {
        $this->db->from($this->table);
        $this->db->where('store_id',$this->session->userdata('store_id'));
        $query = $this->db->get();

        return $query->result();
    }
    
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
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
    public function sum_expences($where)
    {
          $this->db->select("amount");
          $this->db->from($this->table);
          $this->db->where($where);
          $this->db->where('store_id',$this->session->userdata('store_id'));
          $this->db->select_sum('amount');
          $result = $this->db->get()->row();  
           if($result->amount)
            return $result->amount;
          else 
            return 0;
    }
}