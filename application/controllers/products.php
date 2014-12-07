<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Products extends MY_Controller{
		var $product_title;
		var $product_description;
		var $product_id;
		var $subcategory_id;
		var $product_price;

		public function __construct(){
			parent::__construct();
			$this->load->model('comment_model');
		}

		public function search(){

			$product_title=$this->input->post('product_title_search');

			$this->form_validation->set_rules('product_title_search', 'Product_title_search', 'trim|required|alpha_numeric|min_length[1]|max_length[30]');
			$this->form_validation->set_error_delimiters('<p class="errors">', '</p>');
			$this->form_validation->set_message('required','*');
			$this->form_validation->set_message('min_length','*');
			$this->form_validation->set_message('max_length','*');
			$this->form_validation->set_message('alpha_numeric','*');
			if($this->form_validation->run()==true){
				$data['products']=$this->product_model->search($product_title);
			}else{
				$data['products']="";
			}

			$data['title'] = "Pretraga";
			$data['content']="search_content";

			$this->load->view("includes/template",$data);
		}

		public function show(){
			$this->load->library('pagination');

			$subcategory_id=$this->uri->segment(3);
			$offset=$this->uri->segment(4);
			
			$number_products=$this->product_model->numberPro($subcategory_id);

			$config['base_url']=$this->config->base_url()."products/show/".$subcategory_id;
			$config['total_rows']=$number_products;
			$config['per_page']=6;
			$config['uri_segment']=4;

			$this->pagination->initialize($config);

			$data['products']=$this->product_model->index($subcategory_id,$config['per_page'],$offset);
			$one_sub=$this->subcategory_model->getOneSub($subcategory_id);
			
			foreach($one_sub as $sub){
				$data['title'] = $sub->category_title;
			}
			
			$data['one_sub'] = $one_sub;

			if(count($data['products'])==0){
				$data['products']="";
			}

			$data['content']="product_content";

			$this->load->view("includes/template",$data);
		}

		public function show_product($product_id){
			if(isset($product_id)){
				if($this->input->post('submit')){
					$date=mdate("%Y-%m-%d %H:%i:%s");
					$product_id=$this->input->post('product_id');
					$comment=$this->input->post('comment');
					$user_id=$this->session->userdata('id');

					$this->form_validation->set_rules('comment','Comment','trim|required|comment_check|min_length[2]|max_length[1000]');

					$this->form_validation->set_error_delimiters("<p class='errors'>","</p>");
					$this->form_validation->set_message('required','*');
					$this->form_validation->set_message('comment_check','*');
					$this->form_validation->set_message('min_length','*');
					$this->form_validation->set_message('max_length','*');

					if($this->form_validation->run()==true){
						$q=$this->comment_model->addComments($product_id,$comment,$user_id,$date);

						if($q==true){
							$data['errors']="Komentar uspešno dodat";
						}else{
							$data['errors']="Greška";
						}
					}
				}

				$this->load->library('pagination');

				$offset=$this->uri->segment(4);

				$products=$this->product_model->showProduct($product_id);

				foreach($products as $product){
					$data['title'] = $product->product_title;
				}
				$data['products'] = $products;
				$data['comments']=array();

				$number_products=$this->comment_model->numberCom($product_id);

				$config['base_url']=$this->config->base_url()."products/show_product/".$product_id;
				$config['total_rows']=$number_products;
				$config['per_page']=6;
				$config['uri_segment']=4;
				$config['suffix']="#tab2";
				$config['first_url']=$this->config->base_url()."products/show_product/".$product_id."#tab2";

				$this->pagination->initialize($config);

				$data['comments']=$this->comment_model->getComments($product_id,$config['per_page'],$offset);

				$data['content']="product_show_content";

				$this->load->view("includes/template",$data);
			}else{
				redirect($this->config->base_url());
			}
		}
	}
?>