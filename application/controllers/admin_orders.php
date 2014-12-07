<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Admin_orders extends MY_Controller{

		var $order_id;
		
		public function __construct(){
			parent::__construct();
			parent::admin();

			$this->load->model('order_model');
		}

		public function show(){
			$this->load->library('pagination');
			

			$limit = 10;

			$data['title'] = "Narudžbine";
			$data['content'] = "admin_order_content";

			$config['base_url']=$this->config->base_url().'administration/order/0/';
			$config['per_page']=$limit;
			$config['total_rows']=$this->order_model->count();
			$config['uri_segment']=4;
			$config['first_url']=$this->config->base_url().'/administration/order';

			$offset=$this->uri->segment(4);

			$this->pagination->initialize($config);
			$data['offset']=$offset;
			$data['orders']= $this->order_model->getOrder($limit,$offset);

			$this->load->view('includes/template', $data);
		}

		public function info(){
			$order_id = $this->uri->segment(3);

			if($this->input->post('confirm')){
				$this->order_model->confirm($order_id);

				$data['success'] = "Porudžbina uspešno realizovana";
			}

			if($this->input->post('reset')){
				$this->order_model->reset($order_id);

				$data['success'] = "Porudžbina je uspešno poništena";
			}

			$all = $this->order_model->show($order_id);

			$data['users'] = $all['user'];
			$data['orders'] = $all['order'];
			$data['articles'] = $all['article'];

			$data['title'] = "Narudžbine";
			$data['content'] = "admin_order_info_content";

			$this->load->view('includes/template', $data);
		}

	}

?>