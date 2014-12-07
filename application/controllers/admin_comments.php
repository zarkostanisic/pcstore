<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Admin_comments extends MY_Controller{

        var $product_id;
        var $comment_id;
        var $product_title;
        
		public function __construct(){
			parent::__construct();
			parent::admin();
			$this->load->model('comment_model');
		}

		public function show(){
			$data['title'] = "Komentari";
			$data['content']="admin_comments_content";

			$this->load->view("includes/template",$data);			
		}

		public function show_comments(){
			$product_title=$this->input->post('product_title');

			$data['products']=$this->product_model->search($product_title);

			$this->load->view('admin_comments_show_content',$data);			
		}

		public function manage($product_id){
			$product=$this->product_model->showProduct($product_id);
			foreach($product as $pro){
				$data['title'] = "Komentari prozivoda: " . $pro->product_title;
			}
			
			$data['product'] = $product;
			

			$offset=$this->uri->segment(5);
			$comment_id=$this->uri->segment(4);
			if($comment_id!=0){
				$this->comment_model->deleteComment($comment_id);
			}

			$this->load->library('pagination');

			$config['base_url']=$this->config->base_url()."administration/product_show_comments/".$product_id."/0/";
			$config['total_rows']=$this->comment_model->numberCom($product_id);
			$config['per_page']=6;
			$config['uri_segment']=5;
			$config['first_url']=$this->config->base_url()."administration/product_show_comments/".$product_id;

			$this->pagination->initialize($config);

			$data['comments']=$this->comment_model->getComments($product_id,$config['per_page'],$offset);
			$data['product_id']=$product_id;
			$data['offset']=$offset;
			$data['content']="admin_product_show_comment_content";

			$this->load->view("includes/template",$data);	
		}

		public function manage_received(){
			$comment_id = $this->uri->segment(4);
			if($this->uri->segment(3) == "allow"){
				$this->comment_model->allowComment($comment_id);
			}

			if($this->uri->segment(3) == "delete"){
				$this->comment_model->deleteComment($comment_id);
			}

			$data['title'] = "Pristigli komentari";
			$data['comments']=$this->comment_model->getCommentsRec();
			$data['content']="admin_received_comments_content";

			$this->load->view("includes/template",$data);	
		}

	}

?>