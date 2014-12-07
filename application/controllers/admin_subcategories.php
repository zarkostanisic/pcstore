<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Admin_subcategories extends MY_Controller{
		
		var $subcategory_title;
		var $subcategory_id;
		var $category_id;

		public function __construct(){
			parent::__construct();
			parent::admin();
		}

		public function manage(){

			if($this->input->post('submit')){/*Insert subcategory*/
				$subcategory_title=$this->input->post('subcategory_title');
				$category_id=$this->input->post('category_id');

				$this->form_validation->set_rules('subcategory_title','Subcategory_title','trim|required|utf_8_space|min_length[4]|max_length[20]');
				$this->form_validation->set_rules('category_id','Category_id','is_natural_no_zero');
				$this->form_validation->set_error_delimiters("<p class='errors'>","</p>");
				$this->form_validation->set_message('required','Ne može biti prazno');
				$this->form_validation->set_message('min_length','Unos prekratak');
				$this->form_validation->set_message('max_length','Unos prekratak');
				$this->form_validation->set_message('utf_8_space','Možete uneti samo slova');
				$this->form_validation->set_message('is_natural_no_zero','Izaberite kategoriju');

				if($this->form_validation->run()==true){
					$q=$this->subcategory_model->addSubcategory($subcategory_title,$category_id);

					if($q==true){
						$data['errors']="Podkategorija uspešno dodata<script type='text/javaScript'>$('input[type=text]').val('');</script>";
						$data['subcategories']=$this->subcategory_model->getSub();
					}else{
						$data['errors']="Greška";
					}
				}
			}

			if($this->uri->segment(3)){/*Delete subcategory*/
				$subcategory_id=$this->uri->segment(3);

				$q=$this->subcategory_model->deleteSubcategory($subcategory_id);

				if($q==true){
					$data['subcategories']=$this->subcategory_model->getSub();
				}
			}

			$this->load->library('pagination');

			$config['base_url']=$this->config->base_url()."administration/subcategories/0/";
			$config['per_page']=10;
			$config['total_rows']=$this->subcategory_model->numSub();
			$config['first_url']=$this->config->base_url()."administration/subcategories";
			$config['uri_segment']=4;

			$this->pagination->initialize($config);

			$offset=$this->uri->segment(4);

			$data['offset']=$offset;
			$data['admin_subcategories']=$this->subcategory_model->adminGetSub($config['per_page'],$offset);

			$data['title'] = "Podkategorije";
			$data['content']="admin_subcategories_content";

			$this->load->view("includes/template",$data);
		}

		function edit($subcategory_id){
			if($this->input->post('submit')){/*Update subcategory*/
				$subcategory_title=$this->input->post('subcategory_title');
				$category_id=$this->input->post('category_id');
				$subcategory_id=$this->input->post('subcategory_id');

				$this->form_validation->set_rules('subcategory_title','Subcategory_title','trim|required|utf_8_space|min_length[4]|max_length[20]');
				$this->form_validation->set_rules('category_id','Category_id','is_natural_no_zero');
				$this->form_validation->set_error_delimiters("<p class='errors'>","</p>");
				$this->form_validation->set_message('required','Ne može biti prazno');
				$this->form_validation->set_message('min_length','Unos prekratak');
				$this->form_validation->set_message('max_length','Unos prekratak');
				$this->form_validation->set_message('utf_8_space','Možete uneti samo slova');
				$this->form_validation->set_message('is_natural_no_zero','Izaberite kategoriju');

				if($this->form_validation->run()==true){
					$q=$this->subcategory_model->editSubcat($subcategory_id,$subcategory_title,$category_id);

					if($q==true){
						$data['errors']="Podkategorija uspešno izmenjena";
						$data['subcategories']=$this->subcategory_model->getSub();
					}else{
						$data['errors']="Greška";
					}
				}
			}

			$subcategory=$this->subcategory_model->adminGetOneSubcat($subcategory_id);

			foreach($subcategory as $subcat){
				$data['title'] = "Izmeni podkategoriju: " . $subcat->category_title;
			}

			$data['subcategory'] = $subcategory;
			$data['content']="admin_subcat_edit_content";

			$this->load->view("includes/template",$data);
		}

	}

?>