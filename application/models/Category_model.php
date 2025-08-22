<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    public $table = 'categories';

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

    private function _get_datatables_query()
    {

         $this->db->select("*");
          $this->db->from($this->table);
        $i = 0;
        $this->db->where('categories.store_id',$this->session->userdata('store_id'));
        foreach ($this->column as $item) {

            if ($_POST['search']['value']){
                $_POST['search']['value'] = ltrim($_POST['search']['value'], '0');
            ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $this->db->order_by('categories.id','DESC');
            
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
        $query = $this->db->get();
    }
    
    
    
    public function categories_all()
    {
        $this->db->from($this->table);
        $this->db->where('store_id',$this->session->userdata('store_id'));
        $query = $this->db->get();
        return $query->result();
    }
    
    
    public function get_all()
    {
        // Get the current store ID from the session
        $state = $this->session->userdata('store_id');
        // Start building the query
        $this->db->select("
            products.name as product_name,
            categories.name AS name,
            categories.id AS id
        ");
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->group_start();
        $this->db->or_where("JSON_CONTAINS(ironingnormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(ironingexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundrynormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryironnormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryironexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(drywashnormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(drywashexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->group_end();
        $this->db->group_by('categories.id');
        // Execute the query and return results
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
}