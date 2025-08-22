<?php
defined('BASEPATH') or exit('No direct script access allowed');
	// check if a user logged in 
if (!function_exists('is_login')) {
   function is_login()
   {
      $ci = &get_instance();
      if (!$ci->session->userdata('laundry_acess')) {
         redirect("auth");
      }
   }
}
// Logout and  unset sessions
if (!function_exists('auth_logout')) {
   function auth_logout()
   {
      $ci = &get_instance();
      $ci->session->unset_userdata('user_id');
      $ci->session->unset_userdata('role_id');
      $ci->session->unset_userdata('laundry_acess');
      $ci->session->unset_userdata('store_id');
      redirect('auth');
   }
}
// Get User Info
if (!function_exists('user_info')) {
   function user_info()
   {
      $ci = &get_instance();
      $data = $ci->db->get_where('users', array('id' => $ci->session->userdata('user_id')))->row();
      return $data;
   }
}
//Get settings
if (!function_exists('settings')) {
   function settings()
   {
      $ci = &get_instance();
      $data = $ci->db->get_where('settings', array('store_id' => $ci->session->userdata('store_id')))->row();
      return $data;
   }
}
// --------format price ------------
if (!function_exists('format_price')) {
   function format_price($price)
   {
      return number_format($price, 2, '.', '');
   }
}
// --------check permission---------
if (!function_exists('permission')) {
   function permission()
   {
      $ci = &get_instance();
      $ci->load->database();
      if ($ci->session->userdata('role_id') != 1) {
         redirect('app/error_permission');
      }
   }
}
if (!function_exists('permission_link')) {
   function permission_link()
   {
      $ci = &get_instance();
      $ci->load->database();
      if ($ci->session->userdata('role_id') == 1) {
         return true;
      }
      return false;
   }
}
if (!function_exists('months')) {
   function months($text = null)
   {
      $ci = &get_instance();
      $ci->load->database();
      $data = $ci->db->get('months');
      return $data->result();
   }
}
if (!function_exists('label')) {
   function label($text = null)
   {
      return $text;
   }
}
