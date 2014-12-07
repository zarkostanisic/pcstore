<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Admin_users extends MY_Controller{
		
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
			parent::admin();

			$this->load->model('user_model');
		}

		public function manage(){
			$data['title'] = "Korisnici";
			$data['content']="admin_users_content";

			$this->load->view("includes/template",$data);
		}

		public function show(){
			$username=$this->input->post('username');

			$data['users']=$this->user_model->search($username);

			$this->load->view('admin_users_show_content',$data);
		}

		public function delete(){
			$user_id=$this->input->post('id');

			$this->user_model->delete($user_id);
		}

		public function edit($user_id){
			$this->load->model('user_model');
			$this->load->model('city_model');
			$data['cities']=$this->city_model->getCity();

			$data['errors']="";

			if($this->input->post('change')){
				$user_id= $this->input->post('user_id');
				$first_name=$this->input->post('first_name');
				$last_name=$this->input->post('last_name');
				$password=$this->input->post('password');
				$email=$this->input->post('email');
				$phone=$this->input->post('phone');
				$city=$this->input->post('city');

				$this->form_validation->set_rules('first_name','First_name','trim|required|utf_8|min_length[3]|max_length[30]');
				$this->form_validation->set_rules('last_name','last_name','trim|required|utf_8|min_length[3]|max_length[30]');
				if($password != ""){
					$this->form_validation->set_rules('password','password','trim|required|alpha_numeric|min_length[3]|max_length[30]|matches[password2]');
				}else{
					$password = "";
				}
				
				$this->form_validation->set_rules('email','email','trim|required|valid_email');
				$this->form_validation->set_rules('phone','phone','trim|required|numeric|max_length[10]');
				$this->form_validation->set_rules('city','City','is_natural_no_zero');
				
				$this->form_validation->set_error_delimiters('<p class="errors">','</p>');

				$this->form_validation->set_message('required','Ne može biti prazno');
				$this->form_validation->set_message('min_length','Unos prekratak');
				$this->form_validation->set_message('max_length','Unos prekratak');
				$this->form_validation->set_message('matches','Šifre nisu iste');
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
						$image_name = "";
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

						$user = $this->user_model->getUser($user_id);
						foreach($user as $u){
							@unlink(APPPATH."../images/users/".$u->image);
							@unlink(APPPATH."../images/users/small/".$u->image);
						}
					}
					$q=$this->user_model->userEdit($user_id,$password,$first_name,$last_name,$email,$phone,$image_name,$city);
					if($q==true){
						$data['errors']="Izmena uspešna";	
					}else{
						$data['errors']="Greška";	
					}
				}
			}
			$users = $this->user_model->getUser($user_id);

			
			foreach($users as $user){
				$data['title'] = "Izmeni korisnika: " . $user->username;
			}

			$data['content'] = "admin_user_edit_content";
			$data['users'] = $users;

			$this->load->view('includes/template', $data);
		}

	}

?>