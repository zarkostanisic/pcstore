<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User extends MY_Controller{
        var $user_id;
        var $username;
        var $first_name;
        var $last_name;
        var $password;
        var $email;
        var $phone;
        var $city;
        
		public function __construct(){
			parent::__construct();

			$this->load->model('user_model');
			$this->load->model('city_model');
		}

		public function login(){
			$data['products']=$this->product_model->getFavPro(2,0);

			$username=$this->input->post('username_login');
			$password=$this->input->post('password_login');

			$this->form_validation->set_rules('username_login', 'Username', 'trim|required|alpha_numeric|min_length[5]|max_length[30]');
			$this->form_validation->set_rules('password_login', 'Password', 'trim|required|alpha_numeric|min_length[5]|max_length[30]');
			
			$this->form_validation->set_error_delimiters('<p class="errors">', '</p>');

			$this->form_validation->set_message('required','*');
			$this->form_validation->set_message('min_length','*');
			$this->form_validation->set_message('max_length','*');
			$this->form_validation->set_message('alpha','*');
			$this->form_validation->set_message('alpha_numeric','*');

			$data['title'] = "Početna";
			$data['login']="login";

			if($this->form_validation->run()==true){
				$data['login']=$this->user_model->login($username,$password);

				if($data['login']!=false){
					foreach($data['login'] as $login){
						$info=array(
							'username' => $login->username,
							'role' => $login->role_title,
							'id' => $login->user_id
						);						
					}

					$this->session->set_userdata($info);
					$data['user_profile_id'] = $this->session->userdata('id');
					$data['login']="loged";
				}else{
					$data['login']="login";
				}
				
			}

			$data['user']=$this->session->userdata('username');
			$user_role=$this->session->userdata('role');

			if($user_role=="admin"){
				$data['navigation']="admin_navigation";
				$data['footer']="admin_footer";	
			}else if($user_role=="user"){
				$data['navigation']="user_navigation";
				$data['footer']="user_footer";				
			}else{
				$data['navigation']="navigation";
				$data['footer']="footer";				
			}

			$data['content']="home_content";

			$this->load->view("includes/template",$data);
		}

		public function logout(){
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('role');
			$this->session->unset_userdata('id');
			$this->session->sess_destroy();
			redirect($this->config->base_url());
		}

		public function profile($user_id){
			$this->load->model('user_model');

			$users = $this->user_model->getUser($user_id);

			foreach($users as $user){
				$data['title'] = "Profil: " . $user->username; 
			}
			
			$data['users'] = $users;
			$data['content'] = "profile_content";

			$this->load->view('includes/template', $data);
		}

		public function registration(){

			$data['errors']="";

			if($this->input->post('submit')){
				$first_name=$this->input->post('first_name');
				$last_name=$this->input->post('last_name');
				$username=$this->input->post('username');
				$password=$this->input->post('password');
				$email=$this->input->post('email');
				$phone=$this->input->post('phone');
				$city=$this->input->post('city');

				$this->form_validation->set_rules('first_name','First_name','trim|required|utf_8|min_length[3]|max_length[30]');
				$this->form_validation->set_rules('last_name','last_name','trim|required|utf_8|min_length[3]|max_length[30]');
				$this->form_validation->set_rules('username','Username','trim|required|alpha_numeric|min_length[5]|max_length[30]|is_unique[users.username]');
				$this->form_validation->set_rules('password','password','trim|required|alpha_numeric|min_length[3]|max_length[30]|matches[password2]');
				$this->form_validation->set_rules('email','email','trim|required|valid_email');
				$this->form_validation->set_rules('phone','phone','trim|required|numeric|max_length[10]');
				$this->form_validation->set_rules('city','City','is_natural_no_zero');
				
				$this->form_validation->set_error_delimiters('<p class="errors">','</p>');

				$this->form_validation->set_message('required','Ne može biti prazno');
				$this->form_validation->set_message('min_length','Unos prekratak');
				$this->form_validation->set_message('max_length','Unos prekratak');
				$this->form_validation->set_message('matches','Šifre nisu iste');
				$this->form_validation->set_message('is_unique','Korisničko ime postoji');
				$this->form_validation->set_message('alpha','Mođete uneti samo slova');
				$this->form_validation->set_message('alpha_numeric','Možete uneti brojeve i slova');
				$this->form_validation->set_message('valid_email','Format nije tačan');
				$this->form_validation->set_message('numeric','Možete uneti samo brojeve');
				$this->form_validation->set_message('utf_8','Možete uneti samo slova');
				$this->form_validation->set_message('is_natural_no_zero','Izaberite grad');

				if($this->form_validation->run()==true){

					$config=array(
						'allowed_types'=>"jpg|jpeg|gif|png",
						'upload_path'=>APPPATH."../images/users"
					);

					$this->load->library('upload',$config);
					if(!($this->upload->do_upload('image'))){
						$data['errors']="Morate izabrati sliku";
					}else{

						$image_data=$this->upload->data('image');
						$image_name=$image_data['file_name'];

						$config=array(
							'source_image'=>$image_data['full_path'],
							'new_image'=>APPPATH."../images/users/small",
							'maintain_ration'=>true,
							'width'=>150,
							'height'=>100
						);

						$this->load->library('image_lib',$config);
						$this->image_lib->resize();

						$q=$this->user_model->registration($username,$password,$first_name,$last_name,$email,$phone,$image_name,$city);
						if($q==true){
							$data['errors']="Registracija uspešna<script type='text/javaScript'>$('input[type=text], textarea').val('');</script>";	
						}else{
							$data['errors']="Greška";	
						}
					}
				}
			}

			$data['cities']=$this->city_model->getCity();

			$data['title'] = "Registracija";
			$data['content']="registration_content";

			$this->load->view("includes/template",$data);
		}
	}
?>