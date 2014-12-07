<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
	class MY_Controller extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->library('cart');

			$this->top();
			$this->navigation();
			$this->left_menu();
			$this->right_menu();
			$this->footer();
		}

		public function left_menu(){	
			$this->load->model('category_model');
			$this->load->model('subcategory_model');

			$data['categories']=$this->category_model->getCat();
			$data['subcategories']=$this->subcategory_model->getSub();

			$this->load->vars($data);
		}

		public function right_menu(){
 			$this->load->model('product_model');

			$data['popular_products']=$this->product_model->getPopularPro();

			$this->load->vars($data);
		}

		public function top(){
			$user_role=$this->session->userdata('role');

			if($user_role){
				$data['user']=$this->session->userdata('username');
				$data['user_profile_id']=$this->session->userdata('id');
				$data['login']="loged";
			}else{
				$data['login']="login";
			}
	
			$data['search']="search";

			$this->load->vars($data);
		}

		public function navigation(){
			$user_role=$this->session->userdata('role');

			if($user_role=="admin"){
				$data['navigation']="admin_navigation";
			}else if($user_role=="user"){
				$data['navigation']="user_navigation";
			}else{
				$data['navigation']="navigation";
			}

			$this->load->vars($data);
		}

		public function footer(){
			$user_role=$this->session->userdata('role');

			if($user_role=="admin"){
				$data['footer']="admin_footer";
			}else if($user_role=="user"){
				$data['footer']="user_footer";
			}else{
				$data['footer']="footer";
			}

			$this->load->vars($data);
		}

		public function admin(){
			$user_role=$this->session->userdata('role');

			if($user_role!="admin"){
				redirect($this->config->base_url());
			}
		}
	}
?>