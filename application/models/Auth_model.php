<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    protected $table = 'users';

    public $column = array(
        'name',
        'email',
    );

    var $order = array(
        'id' => 'desc'
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function validation($email,$password)
    {
        $q = $this
        ->db
		->where('email',$email)
		->where('password',md5(sha1($password)))
		->limit(1)
		->where('status',1)
		->get($this->table);
        if($q->num_rows() > 0){
            return $q->row();
        }
        return FALSE;
    }
    
     public function accountvalidation($email,$password)
    {
        $q = $this
        ->db
		->where('email',$email)
		->where('password',md5(sha1($password)))
		->limit(1)
		->where('accout_active',0)
		->get($this->table);
        if($q->num_rows() > 0){
            return $q->row();
        }
        return FALSE;
    }
    
    
    

    private function _get_datatables_query()
    {

         $this->db->select("*");
          $this->db->from("users");
        $i = 0;
        
        foreach ($this->column as $item) {
            if ($_POST['search']['value']){
                $_POST['search']['value'] = ltrim($_POST['search']['value'], '0');
            ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $this->db->order_by('users.id','ASC');
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
        return $this->db->count_all_results();
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

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}