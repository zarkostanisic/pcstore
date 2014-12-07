<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Admin_products extends MY_Controller{
		
		var $product_title;
		var $product_description;
		var $product_id;
		var $subcategory_id;
		var $product_price;
		var $product_number;

		public function __construct(){
			parent::__construct();
			parent::admin();
		}

		public function add(){
			if($this->input->post('submit')){
				$product_title=$this->input->post('product_title');
				$product_description=$this->input->post('product_description');
				$subcategory_id=$this->input->post('subcategory_id');
				$product_price=$this->input->post('product_price');
				$product_number=$this->input->post('product_number');

				$this->form_validation->set_rules('product_title','Product_title','trim|required|product_check|min_length[5]|max_length[20]|is_unique[products.product_title]');
				$this->form_validation->set_rules('product_description','Product_description','trim|required|description_check|min_length[5]|max_length[1000]');
				$this->form_validation->set_rules('subcategory_id','subcategory_id','is_natural_no_zero');
				$this->form_validation->set_rules('product_price','Product_price','trim|required|decimal');
				$this->form_validation->set_rules('product_number','Product_number','trim|required|integer');

				$this->form_validation->set_error_delimiters("<p class='errors'>","</p>");
				$this->form_validation->set_message('required','Ne moze biti prazno');
				$this->form_validation->set_message('product_check','Samo brojevi, slova i "-"');
				$this->form_validation->set_message('min_length','Unos prekratak');
				$this->form_validation->set_message('max_length','Unos predugačak');
				$this->form_validation->set_message('description_check','Samo brojevi, slova i "- , . : /"');
				$this->form_validation->set_message('is_natural_no_zero','Izaberite podkategoriju');
				$this->form_validation->set_message('decimal','Unos u formatu "100.00"');
				$this->form_validation->set_message('is_unique','Proizvod već postoji');
				$this->form_validation->set_message('integer','Unesi samo broj');

				if($this->form_validation->run()==true){
					$this->load->library('upload');

					$config['allowed_types']="jpeg|jpg|gif|png";
					$config['upload_path']=APPPATH."../images/products";
					$config['max_size']=2000;
					$config['file_name']=mdate("%Y%m%d%H%i%s");

					$this->upload->initialize($config);

					$this->load->library('image_lib');

					$image1_data['file_name']="";
					$image2_data['file_name']="";
					$image3_data['file_name']="";


					if($this->upload->do_upload('image2')){
						$image2_data=$this->upload->data('image2');
						$config['source_image']=$image2_data['full_path'];
						$config['new_image']=APPPATH."../images/products/thumbs/";
						$config['maintain_ratio']=true;
						$config['width']=400;
						$config['height']=200;

						$this->image_lib->initialize($config);

						$this->image_lib->resize();
					}

					if($this->upload->do_upload('image3')){
						$image3_data=$this->upload->data('image3');
						$config['source_image']=$image3_data['full_path'];
						$config['new_image']=APPPATH."../images/products/thumbs";
						$config['maintain_ratio']=true;
						$config['width']=400;
						$config['height']=200;

						$this->image_lib->initialize($config);

						$this->image_lib->resize();
					}

					if($this->upload->do_upload('image1')){
						$image1_data=$this->upload->data('image1');
						$config['source_image']=$image1_data['full_path'];
						$config['new_image']=APPPATH."../images/products/thumbs";
						$config['maintain_ratio']=true;
						$config['width']=400;
						$config['height']=200;

						$this->image_lib->initialize($config);

						$this->image_lib->resize();

						$q=$this->product_model->addProduct($product_title,$product_description,$subcategory_id,$product_price,$product_number,$image1_data['file_name'],$image2_data['file_name'],$image3_data['file_name']);

						@unlink($image1_data['full_path']);
						@unlink($image2_data['full_path']);
						@unlink($image3_data['full_path']);

						if($q){
							$data['errors']="Proizvod uspešno dodat<script type='text/javaScript'>$('input[type=text], textarea').val('');</script>";
						}else{
							$data['errors']="Greška";						
						}
					}else{
						$data['error_image1']="Izaberite sliku do 2MB. Jpg,gif,png";
					}
				}
			}

			$data['title'] = "Dodaj proizvode";
			$data['content']="admin_add_products_content";

			$this->load->view("includes/template",$data);
		}

		public function delete(){
			$data['title'] = "Izbriši proizvode";
			$data['content']="admin_delete_products_content";

			$this->load->view("includes/template",$data);
		}

		public function delete_show_products(){
			$product_title=$this->input->post('product_title');

			$data['products']=$this->product_model->search($product_title);

			$this->load->view('admin_delete_products_show_content',$data);
		}

		public function delete_product(){
			$product_id=$this->input->post('product_id');
			$product_title=$this->input->post('product_title');

			$q=$this->product_model->showProduct($product_id);

			foreach($q as $product){
				@unlink(APPPATH."../images/products/thumbs/".$product->image1);
				@unlink(APPPATH."../images/products/thumbs/".$product->image2);
				@unlink(APPPATH."../images/products/thumbs/".$product->image3);
			}

			$this->product_model->delete_product($product_id);

			$data['products']=$this->product_model->search($product_title);

			$this->load->view('admin_delete_products_show_content',$data);		
		}

		public function edit(){
			$data['title'] = "Izmeni proizvode";
			$data['content']="admin_edit_products_content";

			$this->load->view("includes/template",$data);
		}

		public function edit_show_products(){
			$product_title=$this->input->post('product_title');

			$data['products']=$this->product_model->search($product_title);

			$this->load->view('admin_edit_products_show_content',$data);
		}

		public function edit_product($product_id){
			$products=$this->product_model->showProduct($product_id);
			
			foreach($products as $product){
				$data['title'] = "Izmeni proizvod: " . $product->product_title;
			}

			$data['products'] = $products;

			if($this->input->post('submit')){
				$product_title=$this->input->post('product_title');
				$product_description=$this->input->post('product_description');
				$subcategory_id=$this->input->post('subcategory_id');
				$product_price=$this->input->post('product_price');
				$product_number=$this->input->post('product_number');
				$product_id=$this->input->post('product_id');

				$this->form_validation->set_rules('product_title','Product_title','trim|required|product_check|min_length[5]|max_length[20]');
				$this->form_validation->set_rules('product_description','Product_description','trim|required|description_check|min_length[5]|max_length[1000]');
				$this->form_validation->set_rules('subcategory_id','subcategory_id','is_natural_no_zero');
				$this->form_validation->set_rules('product_price','Product_price','trim|required|decimal');
				$this->form_validation->set_rules('product_number','Product_number','trim|required|integer');

				$this->form_validation->set_error_delimiters("<p class='errors'>","</p>");
				$this->form_validation->set_message('required','Ne moze biti prazno');
				$this->form_validation->set_message('product_check','Samo brojevi, slova i "-"');
				$this->form_validation->set_message('min_length','Unos prekratak');
				$this->form_validation->set_message('max_length','Unos predugačak');
				$this->form_validation->set_message('description_check','Samo brojevi, slova i "- , . /"');
				$this->form_validation->set_message('is_natural_no_zero','Izaberite podkategoriju');
				$this->form_validation->set_message('decimal','Unos u formatu "100.00"');
				$this->form_validation->set_message('is_unique','Proizvod već postoji');
				$this->form_validation->set_message('integer','Unesite ceo broj');

				if($this->form_validation->run()==true){
					$this->load->library('upload');

					$config['allowed_types']="jpeg|jpg|gif|png";
					$config['upload_path']=APPPATH."../images/products";
					$config['max_size']=2000;
					$config['file_name']=mdate("%Y%m%d%H%i%s");

					$this->upload->initialize($config);

					$this->load->library('image_lib');

					$image1_data['file_name']="";
					$image2_data['file_name']="";
					$image3_data['file_name']="";


					if($this->upload->do_upload('image2')){
						$image2_data=$this->upload->data('image2');

						$config['source_image']=$image2_data['full_path'];
						$config['new_image']=APPPATH."../images/products/thumbs";
						$config['maintain_ratio']=true;
						$config['width']=400;
						$config['height']=200;

						$this->image_lib->initialize($config);

						$this->image_lib->resize();

						foreach($data['products'] as $product){
							@unlink(APPPATH."../images/products/thumbs/".$product->image2);
						}
					}

					if($this->upload->do_upload('image3')){
						$image3_data=$this->upload->data('image3');

						$config['source_image']=$image3_data['full_path'];
						$config['new_image']=APPPATH."../images/products/thumbs";
						$config['maintain_ratio']=true;
						$config['width']=400;
						$config['height']=200;

						$this->image_lib->initialize($config);

						$this->image_lib->resize();

						foreach($data['products'] as $product){
							@unlink(APPPATH."../images/products/thumbs/".$product->image3);
						}
					}

					if($this->upload->do_upload('image1')){
						$image1_data=$this->upload->data('image1');

						$config['source_image']=$image1_data['full_path'];
						$config['new_image']=APPPATH."../images/products/thumbs";
						$config['maintain_ratio']=true;
						$config['width']=400;
						$config['height']=200;

						$this->image_lib->initialize($config);

						$this->image_lib->resize();

						foreach($data['products'] as $product){
							@unlink(APPPATH."../images/products/thumbs/".$product->image1);
						}
						
					}

					@unlink($image2_data['full_path']);
					@unlink($image3_data['full_path']);
					@unlink($image1_data['full_path']);

					$q=$this->product_model->editProduct($product_id,$product_title,$product_description,$subcategory_id,$product_price,$product_number,$image1_data['file_name'],$image2_data['file_name'],$image3_data['file_name']);

					if($q){
						$data['products']=$this->product_model->showProduct($product_id);
						$data['errors']="Proizvod uspešno izmenjen";
					}else{
						$data['errors']="Greška";						
					}
				}
			}

			$data['content']="admin_edit_product_content";

			$this->load->view("includes/template",$data);
		}

		public function extract(){
			$data['title'] = "Izdvoj proizvode";
			$data['content']="admin_extract_products_content";

			$this->load->view("includes/template",$data);
		}

		public function extract_show_product(){
			$product_title=$this->input->post('product_title');

			$data['products']=$this->product_model->getNormalPro($product_title);

			$this->load->view('admin_extract_product_show_content',$data);	
		}

		public function extract_product(){
			$product_id=$this->input->post('product_id');
			$product_title=$this->input->post('product_title');

			$this->product_model->addFavPro($product_id);

			$data['products']=$this->product_model->getNormalPro($product_title);

			$this->load->view('admin_extract_product_show_content',$data);
		}

		public function favorite(){
			$product_id=$this->uri->segment(3);
			$offset=$this->uri->segment(4);
			if($product_id!="0"){
				$this->product_model->removeFavPro($product_id);
			}

			$this->load->library('pagination');

			$config['base_url']=$this->config->base_url()."administration/favorite_products/0/";
			$config['total_rows']=$this->product_model->numberFavPro();
			$config['per_page']=9;
			$config['uri_segment']=4;
			$config['first_url']=$this->config->base_url()."administration/favorite_products";

			$this->pagination->initialize($config);

			$data['offset']=$offset;
			$data['products']=$products=$this->product_model->getFavProAdmin($config['per_page'],$offset);

			$data['title'] = "Izdvojeni proizvodi";
			$data['content']="admin_favorite_products_content";

			$this->load->view("includes/template",$data);
		}

		public function manage_stats(){
			$data['title'] = "Stanje proizvoda";
			$data['content'] = "admin_product_stats_content";

			$this->load->view('includes/template', $data);
		}

		public function stats_show(){
			$title = "";
			$offset = 0;

			if($this->uri->segment(3)){
				$offset=$this->uri->segment(3);
			}

			if($this->input->post('title')){
				$title = $this->input->post('title');
			}
			$this->load->library('pagination');
			
			$limit = 20;

			$config['base_url']=$this->config->base_url().'admin_products/stats_show';
			$config['per_page']=$limit;
			$config['total_rows']=$this->product_model->count($title);
			$config['uri_segment']=3;
			$config['first_url']=$this->config->base_url().'admin_products/stats_show/0';

			$this->pagination->initialize($config);

			$data['products'] = $this->product_model->product_stats($offset, $limit, $title);
			$data['offset'] = $offset;
			$this->load->view('admin_product_stats_show_content', $data);
		}

		public function number(){
			$id = $this->input->post('id');

			$products = $this->product_model->showProduct($id);

			foreach($products as $product){
				echo "<input type='text' id='" . $product->product_id . "' value='" . $product->number . "' style='width:60px;' class='product_stats_input'/>";
			}
		}

		public function change(){
			$id = $this->input->post('id');
			$val = $this->input->post('val');

			$this->product_model->stats_number_change($id, $val);

			$products = $this->product_model->showProduct($id);

			foreach($products as $product){
				echo $product->number;
			}			
		}

	}

?>