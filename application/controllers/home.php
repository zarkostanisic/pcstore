<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Home extends MY_Controller {

		public function __construct(){
			parent::__construct();
		}

		public function index(){
			$data['products']=$this->product_model->getFavPro();

			$data['content']="home_content";
			$data['title'] = "Početna";

			$this->load->view("includes/template",$data);
		}

		public function about(){
			$data['content'] = "about_content";
			$data['title'] = "O nama";
			
			$this->load->view('includes/template', $data);
		}

		public function contact(){
			$data['errors'] = "";

			if($this->input->post('send')){
				$sender = $this->input->post('sender');
				$email = $this->input->post('email');
				$message = $this->input->post('message');

				$this->form_validation->set_rules('sender','Sender','trim|required|alpha|min_length[5]|max_length[30]');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[5]');

				$this->form_validation->set_error_delimiters('<p class="errors">', '</p>');

				$this->form_validation->set_message('alpha','Samo slova');
				$this->form_validation->set_message('min_length','Najmanje 5 karaktera');
				$this->form_validation->set_message('max_length','Najviše 30 karaktera');
				$this->form_validation->set_message('required','Polje je obavezno');
				$this->form_validation->set_message('valid_email','Pogrešan format');

				if($this->form_validation->run() == true){
					$this->load->library('email');

					$this->email->set_mailtype('text');
					$this->email->set_newline('\r\n');

					$this->email->from("Poruka sa sajta: " . $email);
					$this->email->to('stanisic.zarko_127-9@ict.edu.rs');
					$this->email->subject($sender);
					$this->email->message($message);

					if($this->email->send()){
						$data['errors'] = "Poruka uspešno poslata";
					}
				}
			}

			$data['title'] = "Kontakt";
			$data['content'] = "contact_content";

			$this->load->view("includes/template", $data);
		}
	}
?>