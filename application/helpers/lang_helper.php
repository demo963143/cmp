<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('display')) {

    function display($text = null)
    {
        $ci =& get_instance();
        $ci->load->database();
        $table  = 'language';
        $phrase = 'phrase';
        
         
         if($ci->session->userdata('site_lang'))
         {
           $language  = $ci->session->userdata('site_lang');
         }
         else
         {
            $language  = 'english';
         }
        
 
        if (!empty($text)) {

            if ($ci->db->table_exists($table)) { 

                if ($ci->db->field_exists($phrase, $table)) { 

                    if ($ci->db->field_exists($language, $table)) {

                        $row = $ci->db->select($language)
                              ->from($table)
                              ->where($phrase, $text)
                              ->get()
                              ->row(); 

                        if (!empty($row->$language)) {
                            return ucfirst($row->$language);
                        } else {
                            return false;
                        }

                    } else {
                        return false;
                    }

                } else {
                    return false;
                }

            } else {
                return false;
            }            
        } else {
            return false;
        }  

    }
 
}
if (!function_exists('languages')) {
    function languages()
       { 
            $ci =& get_instance();
            $ci->load->database();
            $ci->load->dbforge();
           if ($ci->db->table_exists("language")) { 
   
                   $fields =  $ci->db->field_data("language");
   
                   $i = 1;
                   foreach ($fields as $field)
                   {  
                       if ($i++ > 2)
                       $result[$field->name] = ucfirst($field->name);
                   }
   
                   if (!empty($result)) return $result;
    
   
           } else {
               return false; 
           }
       }
   }

 

// $autoload['helper'] =  array('language_helper');

