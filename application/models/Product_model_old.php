<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product_model extends CI_Model
{
    public $table = 'products_old';

    public $column = array(
        'id',
        'name',
        'num',
    );

    var $order = array(
        'id' => 'desc'
    );

    public function __construct()
    {
        parent::__construct();
    }

    // private function _get_datatables_query()
    // {

    //     $this->db->select("*");
    //     $this->db->from($this->table);
    //     $i = 0;
        
    //     $this->db->where('products.store_id',$this->session->userdata('store_id'));
        
    //     //print_r($this->session->userdata('store_id')); die;
        
    //     foreach ($this->column as $item) {
    //         if ($_POST['search']['value']){
    //             $_POST['search']['value'] = ltrim($_POST['search']['value'], '0');
    //         ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
    //         $this->db->order_by('products.id','DESC');
            
    //         $column[$i] = $item;
    //         $i ++;
    //         }
    //     }
        
    //     if (isset($_POST['order'])) 
    //      {
    //         $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    //     } else 
    //         if (isset($this->order)) {
    //             $order = $this->order;
    //             $this->db->order_by(key($order), $order[key($order)]);
    //         }
    // }
  
   // change 27-12-2024
    private function _get_datatables_query()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $i = 0;
        $this->db->where('products_old.store_id',$this->session->userdata('store_id'));
        foreach ($this->column as $item) {
            if ($_POST['search']['value']){
                $_POST['search']['value'] = ltrim($_POST['search']['value'], '0');
            ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $this->db->order_by('products_old.id','DESC');
            
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
        $this->db->where('store_id',$this->session->userdata('store_id'));
        return $this->db->count_all_results();
    }
    
   
    public function get_all()
    {
        $this->db->from($this->table);
        $this->db->where('store_id',$this->session->userdata('store_id'));
        $query = $this->db->get();
        return $query->result();
    }
    
    
    
    
    
    
    
    
    
    
    // change 28-12-2024
    // public function get_by_id($id)
    // {
    //     $this->db->select("
    //             products.*,
    //             categories.name AS category_name,
    //             categories.id AS category_id,
    //             "); 
    //     $this->db->from($this->table);
    //     $this->db->join('categories','categories.id = products.category_id','left');
    //     $this->db->where('products.id', $id);
    //     $query = $this->db->get();
        
    //     return $query->row();
    // }
    
    
    public function get_by_id($id)
    {
        $this->db->select("
                products_old.*,
                categories.name AS category_name,
                categories.id AS category_id,
                "); 
        $this->db->from($this->table);
        $this->db->join('categories','categories.id = products_old.category_id','left');
        $this->db->where('products_old.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    
    public function get_by_category($category_id)
    {
        $this->db->from($this->table);
        $this->db->where('category_id', $category_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function insert($data)
    { 
        $this->db->insert('products',$data);
        return  $this->db->insert_id();                
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
    public function count()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function get_icons()
    {
        $this->db->from('icons');
        $query = $this->db->get();
        return $query->result();
    }

    // 07-02-2023//
    public function search($col, $value, $table)
    {
        $this->db->select('*');
		$this->db->from($table);
		$this->db->where('store_id',$this->session->userdata('store_id'));
		$this->db->like($col, $value);
		$query = $this->db->get();

        return $query->result();
    }

    public function getPosByDate($date, $table){
        $this->db->select('*');
		$this->db->from($table);
		$this->db->where('store_id',$this->session->userdata('store_id'));
		$this->db->where('DATE(created_at) =', date('Y-m-d',strtotime($date)));
		$query = $this->db->get();

        return $query->result();
        
    }

}