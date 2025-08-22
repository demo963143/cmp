<?php
class Language extends CI_Controller {
	private $table  = "language";
    private $phrase = "phrase";
	public function __construct() {
		parent::__construct();
        // check if a user logged in : helpers/auth_helper
		is_login();
		$this->load->vars(array('activemn' => 'language'));
		$this->load->dbforge();

	   }
	// load languages view Page
	public function index()
	{
		$data['languages']    = $this->languages();
		$data['content_page']=$this->load->view('language/index' ,$data,true);
		$this->load->view('tpl/template' ,$data);
	}
    // load phrases view Page
	public function phrase()
    {
        $data['languages']    = $this->languages();
        $data['phrases']      = $this->phrases();
        $data['content_page']      = $this->load->view('language/phrase',$data,true); 
        $this->load->view('tpl/template',$data);
    }
     // load languages list
	public function languages()
    { 
        if ($this->db->table_exists($this->table)) { 

                $fields = $this->db->field_data($this->table);

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
    // add Language
	public function addLanguage()
    { 
        $language = preg_replace('/[^a-zA-Z0-9_]/', '', $this->input->post('language',true));
        $language = strtolower($language);
        $direction = $this->input->post('derect');

        if (!empty($language)) {
            if (!$this->db->field_exists($language, $this->table)) {
                $this->dbforge->add_column($this->table, [
                    $language => [
                        'type' => 'TEXT'
                    ]
                ]); 
                
                 $this->session->set_flashdata('message', display('successfully_added'));
                 redirect('language');
            } 
        } else {
            $this->session->set_flashdata('exception', display('try_again'));
        }
        redirect('language');
	}
    //  edit Phrase
	public function editPhrase($language = null)
    { 
        $data['language'] = $language;
        $data['phrases']  = $this->phrases();
        $data['content_page']  = $this->load->view('language/phrases_edit', $data, true); 
        $this->load->view('tpl/template' ,$data);
	}
    //  phrases list
	public function phrases()
    {
        if ($this->db->table_exists($this->table)) {

            if ($this->db->field_exists($this->phrase, $this->table)) {

                return $this->db->order_by($this->phrase,'asc')
                    ->get($this->table)
                    ->result();

            }  

        } 

        return false;
	}
    // add Lebel
	public function addLebel() { 
        $language = $this->input->post('language');
        $phrase   = $this->input->post('phrase', true);
        $lang     = $this->input->post('lang', true);

        if (!empty($language)) {

            if ($this->db->table_exists($this->table)) {

                if ($this->db->field_exists($language, $this->table)) {

                    if (sizeof($phrase) > 0)
                    for ($i = 0; $i < sizeof($phrase); $i++) {
                        $this->db->where($this->phrase, $phrase[$i])
                            ->set($language,$lang[$i])
                            ->update($this->table); 

                    }  
                    $this->session->set_flashdata('message', display('successfully_added'));
                    redirect('language/editPhrase/'.$language);

                }  

            }
        } 

        $this->session->set_flashdata('exception', display('try_again'));
        redirect('language/editPhrase/'.$language);
	}
    // add Phrase
	public function addPhrase() {  
		permission('phrase_add');
	   $lang = $this->input->post('phrase'); 

	   if (sizeof($lang) > 0) {

		   if ($this->db->table_exists($this->table)) {

			   if ($this->db->field_exists($this->phrase, $this->table)) {

				   foreach ($lang as $value) {

					   $value = preg_replace('/[^a-zA-Z0-9_]/', '', $value);
					   $value = strtolower($value);

					   if (!empty($value)) {
						   $num_rows = $this->db->get_where($this->table,[$this->phrase => $value])->num_rows();

						   if ($num_rows == 0) { 
							   $this->db->insert($this->table,[$this->phrase => $value]); 
								$this->session->set_flashdata('message', display('successfully_added'));
						   } else {
							   $this->session->set_flashdata('exception', 'Phrase already exists!');
						   }
					   }   
				   }  

				   redirect('language/phrase');
			   }  

		   }
	   } 

	   $this->session->set_flashdata('exception', display('try_again'));
	   redirect('language/phrase');
   }


	
	
}
