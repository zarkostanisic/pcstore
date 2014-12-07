<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Admin_categories extends MY_Controller{
		var $category_title;
		var $category_id;

		public function __construct(){
			parent::__construct();
			parent::admin();
		}

		public function index(){
			$data['title'] = "Administracija";
			$data['content']="admin_content";

			$this->load->view("includes/template",$data);
		}

		public function manage(){

			if($this->input->post('submit')){/*Insert category*/
				$category_title=$this->input->post('category_title');

				$this->form_validation->set_rules('category_title','Category_title','trim|required|utf_8_space|min_length[4]|max_length[20]');
				$this->form_validation->set_error_delimiters("<p class='errors'>","</p>");
				$this->form_validation->set_message('required','Ne može biti prazno');
				$this->form_validation->set_message('min_length','Unos prekratak');
				$this->form_validation->set_message('max_length','Unos prekratak');
				$this->form_validation->set_message('utf_8_space','Možete uneti samo slova');

				if($this->form_validation->run()==true){
					$q=$this->category_model->addCategory($category_title);

					if($q==true){
						$data['categories']=$this->category_model->getCat();
						$data['errors']="Kategorija uspešno dodata<script type='text/javaScript'>$('input[type=text]').val('');</script>";
					}else{
						$data['errors']="Greška";
					}
				}
			}

			if($this->uri->segment(3)){/*Delete category*/
				$category_id=$this->uri->segment(3);

				$q=$this->category_model->deleteCategory($category_id);

				if($q==true){
					$data['categories']=$this->category_model->getCat();					
				}
			}

			$this->load->library('pagination');

			$config['base_url']=$this->config->base_url().'administration/categories/0/';
			$config['per_page']=10;
			$config['total_rows']=$this->category_model->numCat();
			$config['uri_segment']=4;
			$config['first_url']=$this->config->base_url().'/administration/categories';

			$offset=$this->uri->segment(4);

			$this->pagination->initialize($config);
			$data['offset']=$offset;
			$data['admin_categories']=$this->category_model->adminGetCat($config['per_page'],$offset);

			$data['title'] = "Kategorije";
			$data['content']="admin_categories_content";

			$this->load->view("includes/template",$data);
		}

		public function edit($category_id){
			if($this->input->post('submit')){
				$category_id=$this->input->post('category_id');
				$category_title=$this->input->post('category_title');

				$this->form_validation->set_rules('category_title','Category_title','trim|required|utf_8_space|min_length[4]|max_length[20]|is_unique[categories.category_title]');

				$this->form_validation->set_error_delimiters("<p class='errors'>","</p>");
				$this->form_validation->set_message('required','Ne može biti prazno');
				$this->form_validation->set_message('min_length','Unos prekratak');
				$this->form_validation->set_message('max_length','Unos prekratak');
				$this->form_validation->set_message('is_unique','Kategorija već postoji');
				$this->form_validation->set_message('utf_8_space','Možete uneti samo slova');

				if($this->form_validation->run()==true){
					$q=$this->category_model->editCat($category_id,$category_title);
					if($q==true){
						$data['categories']=$this->category_model->getCat();
						$data['errors']="Kategorija uspešno izmenjena";
					}else{
						$data['errors']="Greška";
					}
				}
			}

			$category=$this->category_model->adminGetOneCat($category_id);
			
			foreach($category as $cat){
				$data['title'] = "Izmeni kategoriju: " . $cat->category_title;
			}

			$data['category'] = $category;

			$data['content']="admin_cat_edit_content";

			$this->load->view("includes/template",$data);
		}

	}
?>