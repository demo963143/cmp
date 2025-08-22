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
 * Class Mdl_Clients
 */
class Mdl_Clients extends Response_Model
{
    public $table = 'ip_clients';
    public $primary_key = 'ip_clients.client_id';
    public $date_created_field = 'client_date_created';
    public $date_modified_field = 'client_date_modified';

    public function default_select()
    {
        $this->db->select(
            'SQL_CALC_FOUND_ROWS ' . $this->table . '.*, ' .
            'CONCAT(' . $this->table . '.client_name, " ", ' . $this->table . '.client_surname) as client_fullname'
            , false);
    }

    public function default_order_by()
    {
        $this->db->order_by('ip_clients.client_name');
    }

    public function validation_rules()
    {
        return array(
            'client_name' => array(
                'field' => 'client_name',
                'label' => trans('client_name'),
                'rules' => 'required'
            ),
            'client_active' => array(
                'field' => 'client_active'
            ),
            'client_address_1' => array(
                'field' => 'client_address_1'
            ),
            'client_address_2' => array(
                'field' => 'client_address_2'
            ),
            'refrence_reletion' => array(
                'field' => 'refrence_reletion'
            ),
            'reference_no' => array(
                'field' => 'reference_no'
            ),
            'reference_name' => array(
                'field' => 'reference_name'
            ),
            'refrence_reletion2' => array(
                'field' => 'refrence_reletion2'
            ),
            'reference_no2' => array(
                'field' => 'reference_no2'
            ),
            'reference_name2' => array(
                'field' => 'reference_name2'
            ),
            'security_amount' => array(
                'field' => 'security_amount'
            ),
            'client_city' => array(
                'field' => 'client_city'
            ),
            'client_state' => array(
                'field' => 'client_state'
            ),
            'client_zip' => array(
                'field' => 'client_zip'
            ),
            'client_country' => array(
                'field' => 'client_country'
            ),
            'client_phone' => array(
                'field' => 'client_phone'
            ),
            'client_fax' => array(
                'field' => 'client_fax'
            ),
            'client_mobile' => array(
                'field' => 'client_mobile'
            ),
            'client_email' => array(
                'field' => 'client_email'
            ),
           
            'client_gst_no' => array(
                'field' => 'client_gst_no'
            ),
            'client_adhaar_no' => array(
                'field' => 'client_adhaar_no'
            ),
            // SUMEX
            'client_birthdate' => array(
                'field' => 'client_birthdate',
                // 'rules' => 'callback_convert_date'
            ),
            'client_gender' => array(
                'field' => 'client_gender'
            ),
            'document_file_name' => array(
                'field' => 'document_file_name',
            ),
            'tenant_file_name' => array(
                'field' => 'tenant_file_name',
            ),
            'employee_file_name' => array(
                'field' => 'employee_file_name',
            ),
            'student_file_name' => array(
                'field' => 'student_file_name',
            ),
            'document_type' => array(
                'field' => 'document_type',
            ),

            'father_name' => array(
                'field' => 'father_name',
            ),

            'father_no' => array(
                'field' => 'father_no',
            ),

            'mother_name' => array(
                'field' => 'mother_name',
            ),

            'mother_no' => array(
                'field' => 'mother_no',
            ),

            'room_no' => array(
                'field' => 'room_no',
            ),
        );
    }

   


  

 


    /**
     * @param int $amount
     * @return mixed
     */
    function get_latest($amount = 10)
    {
        return $this->mdl_clients
            ->where('client_active', 1)
            ->order_by('client_id', 'DESC')
            ->limit($amount)
            ->get()
            ->result();
    }

    /**
     * @param $input
     * @return string
     */
    function fix_avs($input)
    {
        if ($input != "") {
            if (preg_match('/(\d{3})\.(\d{4})\.(\d{4})\.(\d{2})/', $input, $matches)) {
                return $matches[1] . $matches[2] . $matches[3] . $matches[4];
            } else if (preg_match('/^\d{13}$/', $input)) {
                return $input;
            }
        }

        return "";
    }

    function convert_date($input)
    {
        $this->load->helper('date_helper');

        if ($input == '') {
            return '';
        }

        return date_to_mysql($input);
    }

    public function db_array()
    {
        $db_array = parent::db_array();

        if (!isset($db_array['client_active'])) {
            $db_array['client_active'] = 0;
        }

        return $db_array;
    }

    /**
     * @param int $id
     */
    public function delete($id)
    {
        parent::delete($id);

        $this->load->helper('orphan');
        delete_orphans();
    }

    /**
     * Returns client_id of existing client
     *
     * @param $client_name
     * @return int|null
     */
    public function client_lookup($client_name)
    {
        $client = $this->mdl_clients->where('client_name', $client_name)->get();

        if ($client->num_rows()) {
            $client_id = $client->row()->client_id;
        } else {
            $db_array = array(
                'client_name' => $client_name
            );

            $client_id = parent::save(null, $db_array);
        }

        return $client_id;
    }

    public function with_total()
    {
        $data=$this->filter_select('IFnull((SELECT SUM(invoice_total) FROM ip_invoice_amounts WHERE invoice_id IN (SELECT invoice_id FROM ip_invoices WHERE ip_invoices.client_id = ip_clients.client_id)), 0) AS client_invoice_total', false);
        return $this;
    }

    public function with_total_paid()
    {
        $this->filter_select('IFnull((SELECT SUM(invoice_paid) FROM ip_invoice_amounts WHERE invoice_id IN (SELECT invoice_id FROM ip_invoices WHERE ip_invoices.client_id = ip_clients.client_id)), 0) AS client_invoice_paid', false);
        return $this;
    }

    public function with_total_balance()
    {
        $this->filter_select('IFnull((SELECT SUM(invoice_balance) FROM ip_invoice_amounts WHERE invoice_id IN (SELECT invoice_id FROM ip_invoices WHERE ip_invoices.client_id = ip_clients.client_id)), 0) AS client_invoice_balance', false);
        return $this;
    }

    public function is_inactive()
    {
        $this->filter_where('client_active', 0);
        return $this;
    }

    /**
     * @param $user_id
     * @return $this
     */
    public function get_not_assigned_to_user($user_id)
    {
        $this->load->model('user_clients/mdl_user_clients');
        $clients = $this->mdl_user_clients->select('ip_user_clients.client_id')
            ->assigned_to($user_id)->get()->result();

        $assigned_clients = [];
        foreach ($clients as $client) {
            $assigned_clients[] = $client->client_id;
        }

        if (count($assigned_clients) > 0) {
            $this->where_not_in('ip_clients.client_id', $assigned_clients);
        }

        $this->is_active();
        return $this->get()->result();
    }

    public function is_active()
    {
        $this->filter_where('client_active', 1);
        return $this;
    }   
    
    public function usual_invoice_services($id)
    {
       $query = $this->db->query("SELECT count(item_name) as number, item_name FROM ip_invoice_items  ii
                        left join ip_invoices i on ii.invoice_id=i.invoice_id
                        left join ip_clients c on i.client_id=c.client_id
                        where i.client_id=$id
                        GROUP by ii.item_name
                        HAVING count(item_name)>=3");
                        
        $data= $query->result();
        return $data;
    }
    public function usual_activity_services($id)
    {
       $query = $this->db->query("SELECT count(`service_name`) as number,service_name FROM ip_client_activities WHERE client_id=$id
                                    GROUP by service_name
                                    HAVING count(service_name)>=3");
                     
        $data= $query->result();
        return $data;
    }
    public function add_activity($data)
    {
       return $this->db->insert('ip_client_activities',$data);
        
    }
    public function get_activities($id)
    {
        $this->db->where('client_id',$id);
        $this->db->order_by('act_created_at', 'DESC');
        return $this->db->get('ip_client_activities')->result();
        
    }
    public function get_invoice_by_client($id)
    {
            $this->db->select("*")->from('ip_invoices')
                     ->where('client_id',$id)
                     ->join('ip_invoice_items', 'ip_invoices.invoice_id = ip_invoice_items.invoice_id','LEFT')
                     ->join('ip_tax_rates', 'ip_invoice_items.item_tax_rate_id = ip_tax_rates.tax_rate_id','LEFT');
           return $this->db->order_by('ip_invoices.invoice_id DESC')->get()->result();
    }
	public function search_birthdays($search=null)
    {
     /*   if(!$start_date)
        {
            $start_date=date("Y-m-d");
            $end_date= date( "Y-m-d");
             $where="(DAY(DATE(client_birthdate)) BETWEEN DAY('$start_date') and DAY('$end_date'))
    				and (Month(DATE(client_birthdate)) BETWEEN MONTH('$start_date') AND MONTH('$end_date'))";
            $this->db->where($where);
            $this->db->select('*');
            $data=$this->db->from('ip_clients')->get()->result();
        }else{
            $start_date=date("Y-m-d",strtotime($start_date));
            $end_date= date( "Y-m-d",strtotime($end_date));
             $where="(Month(DATE(client_birthdate)) BETWEEN MONTH('$start_date') AND MONTH('$end_date'))";
            $this->db->where($where);
            $this->db->select('*');
            $data=$this->db->from('ip_clients')->get()->result();
        }*/
        
      if($search)
        {
            $start_date="";
            $end_date="";
            if($search=="7")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +6 day" ) );
            }else if($search=="15")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +15 day" ) );
            }else if($search=="month")
            {
                $start_date=date('Y-m-01');
                $end_date= date('Y-m-t');
            }
             $where="(Month(DATE(client_birthdate)) BETWEEN MONTH('$start_date') AND MONTH('$end_date'))";
            $this->db->where($where);
            $this->db->select('*');
            $data=$this->db->from('ip_clients')->get()->result();
        
        }else{
    		$where="DAY(DATE(client_birthdate))=DAY(DATE(CURRENT_TIMESTAMP))
    				and Month(DATE(client_birthdate))=Month(DATE(CURRENT_TIMESTAMP))";
            $this->db->where($where);
            $this->db->select('*');
            $data=$this->db->from('ip_clients')->get()->result();
        }    
            
             return $data;
	/*	if($search)
		{
            $start_date="";
            $end_date="";
            if($search=="7")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +6 day" ) );
            }else if($search=="15")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +15 day" ) );
            }else if($search=="month")
            {
                $start_date=date('Y-m-01');
                $end_date= date('Y-m-t');
            }
             $where="(DAY(DATE(client_birthdate)) BETWEEN DAY('$start_date') and DAY('$end_date'))
    				and (Month(DATE(client_birthdate)) BETWEEN MONTH('$start_date') AND MONTH('$end_date'))";
            $this->db->where($where);
            $this->db->select('*');
            $data=$this->db->from('ip_clients')->get()->result();
           // echo $this->db->last_query();
           // die;
			
		}else{
    		$where="DAY(DATE(client_birthdate))=DAY(DATE(CURRENT_TIMESTAMP))
    				and Month(DATE(client_birthdate))=Month(DATE(CURRENT_TIMESTAMP))";
            $this->db->where($where);
            $this->db->select('*');
            $data=$this->db->from('ip_clients')->get()->result();
        }*/
        
		
	}
	public function search_anniversary($search=null)
    {
     /*   if(!$start_date)
        {
            $start_date=date("Y-m-d");
            $end_date= date( "Y-m-d");
    		$where="(DAY(DATE(client_anniversary)) BETWEEN DAY('$start_date') and DAY('$end_date'))
    				and (Month(DATE(client_anniversary)) BETWEEN MONTH('$start_date') AND MONTH('$end_date'))";
            $this->db->where($where);
            $this->db->select('*');
            $data=$this->db->from('ip_clients')->get()->result();
            
        }else{
            $start_date=date("Y-m-d",strtotime($start_date));
            $end_date= date( "Y-m-d",strtotime($end_date));
    		$where="(Month(DATE(client_anniversary)) BETWEEN MONTH('$start_date') AND MONTH('$end_date'))";
            $this->db->where($where);
            $this->db->select('*');
            $data=$this->db->from('ip_clients')->get()->result();
        }*/
        
      if($search)
        {
            $start_date="";
            $end_date="";
            if($search=="7")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +6 day" ) );
            }else if($search=="15")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +15 day" ) );
            }else if($search=="month")
            {
                $start_date=date('Y-m-01');
                $end_date= date('Y-m-t');
            }
    		$where="(Month(DATE(client_anniversary)) BETWEEN MONTH('$start_date') AND MONTH('$end_date'))";
            $this->db->where($where);
            $this->db->select('*');
            $data=$this->db->from('ip_clients')->get()->result();
        
        }else{
		$where="DAY(DATE(client_anniversary))=DAY(DATE(CURRENT_TIMESTAMP))
				and Month(DATE(client_anniversary))=Month(DATE(CURRENT_TIMESTAMP))";
        $this->db->where($where);
        $this->db->select('*');
        $data=$this->db->from('ip_clients')->get()->result();
        }  
        return $data;
	/*	if($search)
		{
            $start_date="";
            $end_date="";
            if($search=="7")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +6 day" ) );
            }else if($search=="15")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +15 day" ) );
            }else if($search=="month")
            {
                $start_date=date('Y-m-01');
                $end_date= date('Y-m-t');
            }
            
    		$where="(DAY(DATE(client_anniversary)) BETWEEN DAY('$start_date') and DAY('$end_date'))
    				and (Month(DATE(client_anniversary)) BETWEEN MONTH('$start_date') AND MONTH('$end_date'))";
            $this->db->where($where);
            $this->db->select('*');
            $data=$this->db->from('ip_clients')->get()->result();
           // echo $this->db->last_query();
           // die;
			
		}else{
		$where="DAY(DATE(client_anniversary))=DAY(DATE(CURRENT_TIMESTAMP))
				and Month(DATE(client_anniversary))=Month(DATE(CURRENT_TIMESTAMP))";
        $this->db->where($where);
        $this->db->select('*');
        $data=$this->db->from('ip_clients')->get()->result();
        }
        return $data;*/
		
	}
	
    public function search_activities($data=null)
    {
      /*  if(!$start_date)
        {
            $start_date=date("Y-m-d");
            $end_date= date( "Y-m-d");
        }else{
            $start_date=date("Y-m-d",strtotime($start_date));
            $end_date= date( "Y-m-d",strtotime($end_date));
        }*/
        
            $start_date="";
            $end_date="";
      if($data)
        {
            if($data=="7")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +6 day" ) );
            }else if($data=="15")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +15 day" ) );
            }else if($data=="month")
            {
                $start_date=date('Y-m-01');
                $end_date= date('Y-m-t');
            }
        
        }else{
            $start_date=date("Y-m-d");
            $end_date=date("Y-m-d");
            
        }    
                $query=$this->db->query("SELECT * FROM ip_client_activities 
                                        join ip_clients on ip_client_activities.client_id=ip_clients.client_id
                                         WHERE ((reminder = 'Fortnightly' AND ((DAY(act_created_at) BETWEEN DAY('$start_date') and DAY('$end_date')) OR ((DAY(DATE_ADD(DATE(act_created_at), INTERVAL 15 DAY))) BETWEEN DAY('$start_date') and DAY('$end_date')))) 
                                        || (reminder = 'Monthly' AND	(DAY(act_created_at) BETWEEN DAY('$start_date') AND DAY('$end_date'))) 
                                        || (reminder = 'Quarterly' AND ((DAY(act_created_at)) BETWEEN DAY('$start_date') AND DAY('$end_date')) AND ((MONTH(act_created_at) BETWEEN MONTH('$start_date') AND MONTH('$end_date')) || (MONTH(act_created_at) BETWEEN MONTH(DATE_ADD('$start_date', INTERVAL 3 MONTH)) and MONTH(DATE_ADD('$end_date', INTERVAL 3 MONTH))) 
                                        || (MONTH(act_created_at) BETWEEN MONTH(DATE_ADD('$start_date', INTERVAL 6 MONTH)) and MONTH(DATE_ADD('$end_date', INTERVAL 6 MONTH))) || (MONTH(act_created_at) BETWEEN MONTH(DATE_ADD('$start_date', INTERVAL 9 MONTH)) and MONTH(DATE_ADD('$end_date', INTERVAL 9 MONTH)))))
                                        || (reminder = 'Yearly' AND ((DAY(act_created_at)) BETWEEN DAY('$start_date') and DAY('$end_date')) AND ((MONTH(act_created_at) BETWEEN MONTH('$start_date') and MONTH('$end_date')))))  and (DATE(act_created_at)!=DATE(CURRENT_TIMESTAMP)) ORDER by (SELECT count(*) FROM ip_invoices as total  where client_id=ip_client_activities.client_id) DESC
                                        ");
                $data= $query->result();
        return $data;
     //   }
        /*else{
        $query=$this->db->query("SELECT * FROM ip_client_activities 
                                join ip_clients on ip_client_activities.client_id=ip_clients.client_id
                                 WHERE ((reminder = 'Fortnightly' AND (DAY(act_created_at)=DAY(DATE(CURRENT_TIMESTAMP)) OR (DAY(DATE_ADD(DATE(act_created_at), INTERVAL 15 DAY)))=DAY(DATE(CURRENT_TIMESTAMP)))) 
                                || (reminder = 'Monthly' AND	DAY(act_created_at)=DAY(DATE(CURRENT_TIMESTAMP))) 
                                || (reminder = 'Quarterly' AND (DAY(act_created_at))=DAY(DATE(CURRENT_TIMESTAMP)) AND ((MONTH(act_created_at)=MONTH(DATE(CURRENT_TIMESTAMP))) || (MONTH(act_created_at)=MONTH(DATE_ADD(DATE(CURRENT_TIMESTAMP), INTERVAL 3 MONTH))) 
                                || (MONTH(act_created_at)=MONTH(DATE_ADD(DATE(CURRENT_TIMESTAMP), INTERVAL 6 MONTH))) || (MONTH(act_created_at)=MONTH(DATE_ADD(DATE(CURRENT_TIMESTAMP), INTERVAL 9 MONTH)))))
                                || (reminder = 'Yearly' AND (DAY(act_created_at))=DAY(DATE(CURRENT_TIMESTAMP)) AND (MONTH(act_created_at)=MONTH(DATE(CURRENT_TIMESTAMP)))))  and (DATE(act_created_at)!=DATE(CURRENT_TIMESTAMP)) ORDER by (SELECT count(*) FROM ip_invoices as total  where client_id=ip_client_activities.client_id) DESC");
        $data= $query->result();
        }*/
    }
    public function clients_count()
    {
           return $this->db->select('count(*)as clients')->from('ip_clients')->where('DATE(client_date_created)',date("Y-m-d"))->get()->row();
    }
    public function clients_count_by_date($start_date=null,$end_date=null,$search=null)
    {
      if($search)
        {
            $start_date="";
            $end_date="";
            if($search=="7")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +6 day" ) );
            }else if($search=="15")
            {
                $start_date=date("Y-m-d");
                $end_date= date( "Y-m-d", strtotime( "$start_date +15 day" ) );
            }else if($search=="month")
            {
                $start_date=date('Y-m-01');
                $end_date= date('Y-m-t');
            }
        }  
           return $this->db->select('count(*)as clients')->from('ip_clients')
                ->where('DATE(client_date_created) BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"')->get()->row();
    }



  





}
