<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product_model extends CI_Model
{
    public $table = 'products';

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
    
    public function save($data)
    {
        print_r($data); die;
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    private function _get_datatables_query()
    {
        $state = $this->session->userdata('store_id');
        
        //  print_r($state); die;
       
        $this->db->select("*");
        $this->db->from($this->table);
        $i = 0;
        
        // $this->db->where('products.store_id',$this->session->userdata('store_id'));

        $this->db->or_where("JSON_CONTAINS(ironingnormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(ironingexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundrynormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryironnormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryironexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(drywashnormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(drywashexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);

        
        foreach ($this->column as $item) {
            if ($_POST['search']['value']){
                $_POST['search']['value'] = ltrim($_POST['search']['value'], '0');
            ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $this->db->order_by('products.id','DESC');
            
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
    
    // public function get_all()
    // {
    //     $this->db->from($this->table);
    //     $this->db->where('store_id',$this->session->userdata('store_id'));
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    
    
    public function search($col, $value, $table)
    {
       
        $this->db->select('*');
		$this->db->from($table);
		//$this->db->where('store_id',$this->session->userdata('store_id'));
		
		$state = $this->session->userdata('store_id');
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
		
		$this->db->like($col, $value);
		$query = $this->db->get();

        return $query->result();
    }
    
    
    public function get_all()
    {
        $state = $this->session->userdata('store_id');
        $this->db->select("
            products.*,
            categories.name AS category_name,
            categories.id AS category_id
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
        
        $this->db->order_by('products.created_at', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }
    
    
    public function get_by_category($id)
    {
        // Get the current store ID from the session
        $state = $this->session->userdata('store_id');
       
        $this->db->select("
            products.*,
            categories.name AS category_name,
            categories.id AS category_id
        ");
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->or_where('category_id',$id);
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
    
        // Execute the query and return results
        $query = $this->db->get();
        return $query->result();
    }
  

    function get_datatables()
    {
        $this->_get_datatables_query();

        if ($_POST['length'] != - 1){
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }
   
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function insert($data)
    { 
        $this->db->insert('products',$data);
        return  $this->db->insert_id();                
    }
    
    
    public function count_all()
    {
        $this->db->from($this->table);
          $state = $this->session->userdata('store_id');
        // $this->db->where('store_id',$this->session->userdata('store_id'));
        $this->db->or_where("JSON_CONTAINS(ironingnormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(ironingexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundrynormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryironnormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryironexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        return $this->db->count_all_results();
    }
    
    
    // public function get_by_id_edit($id)
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
    //   // print_r($query->row()); die;
        
    //     return $query->row();
    // }
    
    
    public function update($data, $id) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows(); 
    }
    
    
    
    
    public function get_by_id_edit($id)
    {
        $this->db->select("
            products.*,
            categories.name AS category_name,
            categories.id AS category_id
        ");
        $this->db->from($this->table);
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->where('products.id', $id);
        $query = $this->db->get();
    
        $product = $query->row();
    
        if ($product) {
            $product->ironingnormal = $this->extract_inr($product->ironingnormal);
            $product->ironingexpress = $this->extract_inr($product->ironingexpress);
            $product->laundrynormal = $this->extract_inr($product->laundrynormal);
            $product->laundryexpress = $this->extract_inr($product->laundryexpress);
            $product->laundryironnormal = $this->extract_inr($product->laundryironnormal);
            $product->laundryironexpress = $this->extract_inr($product->laundryironexpress);
            $product->drywashnormal = $this->extract_inr($product->drywashnormal);
            $product->drywashexpress = $this->extract_inr($product->drywashexpress);
        }
    
        return $product;
    }

    private function extract_inr($json_string)
    {
        $decoded = json_decode($json_string, true);
        if (is_array($decoded) && !empty($decoded)) {
            return $decoded[0]['inr']; 
        } else {
            return ''; 
        }
    }
    
    
    
  
    
    public function get_by_id($id)
    {
        $this->db->select("
                products.*,
                categories.name AS category_name,
                categories.id AS category_id,"); 
        $this->db->from($this->table);
        $this->db->join('categories','categories.id = products.category_id','left');
        $this->db->where('products.id', $id);
        $query = $this->db->get();
        //print_r($this->db->last_query()); die;
        return $query->row();
    }
    
   
    public function get_kilo_by_id($proname)
    {
        $state = $this->session->userdata('store_id');
       
        $this->db->select("
                products.*,
                categories.name AS category_name,
                categories.id AS category_id,"); 
        $this->db->from($this->table);
        $this->db->join('categories','categories.id = products.category_id','left');
        $this->db->where('products.name', $proname);
        $this->db->where("JSON_CONTAINS(ironingnormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->where("JSON_CONTAINS(ironingexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->where("JSON_CONTAINS(laundrynormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->where("JSON_CONTAINS(laundryexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->where("JSON_CONTAINS(laundryironnormal, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $this->db->where("JSON_CONTAINS(laundryironexpress, '{\"franchise\": [\"$state\"]}')", NULL, FALSE);
        $query = $this->db->get();
        //print_r($this->db->last_query()); die;
        return $query->row();
    }
    
    
    
    
    public function last_id()
    {
        $this->db->select_max("id");
        $result= $this->db->get($this->table)->row();
        return $result->id;
    }

    public function get_icons()
    {
        $this->db->from('icons');
        $query = $this->db->get();
        return $query->result();
    }
    
    
    
    public function get_product_model($id)
    {
        $this->db->select("
            products.id,products.num,products.name,
            categories.name AS category_name,
            categories.id AS category_id
        ");
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->group_start();
        $this->db->or_where("JSON_CONTAINS(ironingnormal, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(ironingexpress, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundrynormal, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryexpress, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryironnormal, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryironexpress, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
         $this->db->or_where("JSON_CONTAINS(drywashnormal, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
         $this->db->or_where("JSON_CONTAINS(drywashexpress, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->group_end();
        $query = $this->db->get();
        return $query->result();
    }
    
    
    public function get_product_model_search($id, $search)
    {
        $this->db->select("
            products.id,
            products.num,
            products.name,
            categories.name AS category_name,
            categories.id AS category_id
        ");
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->group_start();
        $this->db->or_where("JSON_CONTAINS(ironingnormal, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(ironingexpress, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundrynormal, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryexpress, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryironnormal, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(laundryironexpress, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(drywashnormal, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->or_where("JSON_CONTAINS(drywashexpress, '{\"franchise\": [\"$id\"]}')", NULL, FALSE);
        $this->db->group_end();
        $this->db->like('products.name', $search);
        $query = $this->db->get();
        return $query->result();
    }

    
    
    public function delete_by_id($id) {
         $this->db->where('id', $id);
         $this->db->delete('products');
        return $this->db->affected_rows(); 
    }
    
    
   
    


}