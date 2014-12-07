<?php 
	class Order extends MY_Controller{
		var $user_id;
		var $product_id;
		var $number;
        var $total;
		public function __construct(){
			parent::__construct();
		}
		
		public function show_cart(){
			$data['title'] = "Korpa";
			$data['content'] = "shop_content";
			$data['cart'] = $this->cart->contents();

			$this->load->view('includes/template', $data);
		}

		public function show(){
			$this->load->view('shop_show_content');		
		}

		public function add(){
			$this->load->model('product_model');

			$product_id = $this->input->post('product_id');
			$number = $this->input->post('number');
			$cart = $this->cart->contents();

			$products = $this->product_model->showProduct($product_id);

			foreach($products as $product){
				$num = $product->number;
			}

			$error = 0;
			foreach($cart as $item){
				if($num >= $number){
					if($product_id == $item['id']){
						$error = 1;

						$data = array(
							"rowid" => $item['rowid'],
							"qty" => $number
						);
						$this->cart->update($data);	
					}
				}else{
					$error = 1;

					echo "Nemamo toliko proizvoda na lageru. Trenutno je broj proizvoda " . $num . ".";
				}
			}

			if($error == 0){

				if(count($products) == 1){
					foreach($products as $product){
						if($num >= $number){
							$data = array(
								"id" => $product->product_id,
								"name" => $product->product_title,
								"qty" => $number,
								"price" => $product->product_price
							);

							$this->cart->insert($data);
						}else{
							echo "Nemamo toliko proizvoda na lageru. Trenutno je broj proizvoda " . $product->number . ".";
						}
					}
				}
			}


		}

		public function remove(){
			$id = $this->input->post('id');
			$data = array(
				"rowid" => $id,
				"qty" => "0"
			);

			$this->cart->update($data);
		}

		public function number(){
			$this->load->view('shop_number');
		}

		public function change(){
			$this->load->model('product_model');

			$product_id = $this->input->post('id');

			$number = $this->input->post('number');
			$value = $this->input->post('value');

			$products = $this->product_model->showProduct($product_id);

			foreach($products as $product){
				$num = $product->number;
			}

			if($num >= $value){
				$rowid = $this->input->post('rowid');
				if($value > 0){
					$data = array(
						"rowid" => $rowid,
						"qty" => $value
					);

					$this->cart->update($data);
				}	
			}else{
				$error = 1;

				echo "Nemamo toliko proizvoda na lageru. Trenutno je broj proizvoda " . $num . ".";
			}
		}

		public function confirm(){
			$user_role=$this->session->userdata('role');

			$this->load->model('user_model');
			$user_id = $this->session->userdata('id');
			$data['sender'] = $this->user_model->getUser($user_id);
			$data['title'] = "Potvrdi kupovinu";

			if($user_role != ""){
				$data['cart'] = $this->cart->contents();
				$data['total'] = $this->cart->total();

				$this->load->view('shop_confirm', $data);
			}else{
				$this->load->view('shop_error', $data);
			}
		}

		public function send(){
			$cart = $this->cart->contents();

			$this->load->model('order_model');

			if(count($cart) > 0){

				$this->load->model('product_model');
				$this->load->model('user_model');
				
				$total = $this->cart->total();
				$user_id = $this->session->userdata('id');

				$user = $this->user_model->getUser($user_id);

				foreach($user as $u){
					$user_id = $u->user_id; 
				}

				$order = $this->order_model->order($user_id);

				foreach($cart as $item){
					$product_id = $item['id'];
					$qty = $item['qty'];
 
					$this->product_model->plus($product_id);

					$this->product_model->changeNumber($product_id, $qty);

					$this->order_model->article($order, $product_id, $qty);
				}
				
				$data['error'] = "Porudžbina je uspešno poslata";

				$this->cart->destroy();

			}else{
				$data['error'] = "Vaša korpa je prazna, izaberite proizvode";
			}

			$data['title'] = "Slanje porudžbine";
			
			$this->load->view('shop_send', $data);
		}
	}
?>