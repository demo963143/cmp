<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LanguageSwitcher extends CI_Controller
{
  public function __construct() {
    parent::__construct();  
  }
  function switchLang($language = null) {
    $this->load->model('store_model','store');
    $language = ($language != "") ? $language : "english";
    $this->session->set_userdata('site_lang', $language);
    $this->store->update(array('language' => $language),$this->session->userdata('store_id'));
    redirect($_SERVER['HTTP_REFERER']);

     
  }
}
