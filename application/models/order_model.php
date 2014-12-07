<?php 
	class Order_model extends CI_Model{
		public function getOrder($limit, $offset){
			$orders = $this->db->get_where('order', 'status = 0')->result();

			foreach($orders as $order){
				$articles = $this->db->select()
									->from('article')
									->where('order_id', $order->order_id)
									->get()
									->result();

				$order_date = strtotime($order->order_date);
				$last_date = $order_date + 1296000;
				$now = strtotime(date("Y-m-d H:i:s"));
				
				if($now > $last_date){
					foreach($articles as $article){
						$product_id = $article->product_id;
						$qty = $article->qty;

						$product = $this->db->select()
											->from('products')
											->where('product_id', $product_id)
											->get()
											->row();

						$new_qty = $product->number + $qty;

						$data = array(
							'number' => $new_qty
						);

						$this->db->where('product_id', $product_id)
									->update('products', $data);
					}

					$this->db->where('order_id', $order->order_id)->delete('order');
					$this->db->where('order_id', $order->order_id)->delete('article');

				}
			} 

			$q = $this->db->select()
						->from('order')
						->join('users', 'order.user_id=users.user_id')
						->limit($limit)
						->offset($offset)
						->order_by('order.order_id', 'DESC')
						->get();

			return $q->result();				
		}

		public function order($user_id){
			$data = array(
				'user_id' => $user_id,
				'order_date' => date('Y-m-d H:i:s'),
				'status' => 0
			);

			$this->db->insert('order', $data);

			return $this->db->insert_id('order');
		}

		public function article($order, $product_id, $qty){
			$data = array(
				'order_id' => $order,
				'product_id' => $product_id,
				'qty' => $qty
			);

			$this->db->insert('article', $data);
		}

		public function count(){
			return $this->db->count_all('order');
		}

		public function show($order_id){
			$user = $this->db->select()
							->from('users')
							->join('order', 'users.user_id=order.user_id')
							->join('cities', 'users.city=cities.city_id')
							->where('order.order_id', $order_id)
							->get()
							->result();

			$order = $this->db->select()
							->from('order')
							->where('order_id', $order_id)
							->get()
							->result();

			$article = $this->db->select()
							->from('products')
							->join('article', 'products.product_id=article.product_id')
							->where('article.order_id', $order_id)
							->get()
							->result();

			$data = array(
				'user' => $user,
				'order' => $order,
				'article' => $article
			);

			return $data;
		}

		public function confirm($order_id){
			$data = array(
				'status' => 1,
				'realization_date' => date('Y-m-d H:i:s')
			);

			$this->db->where('order_id', $order_id)
						->update('order', $data);
		}

		public function reset($order_id){
			$articles = $this->db->select()
								->from('article')
								->where('order_id', $order_id)
								->get()
								->result();

			foreach($articles as $article){
				$product_id = $article->product_id;
				$qty = $article->qty;

				$product = $this->db->select()
									->from('products')
									->where('product_id', $product_id)
									->get()
									->row();

				$new_qty = $product->number + $qty;

				$data = array(
					'number' => $new_qty
				);

				$this->db->where('product_id', $product_id)
							->update('products', $data);
			}

			$this->db->where('order_id', $order_id)
						->delete('article');

			$this->db->where('order_id', $order_id)
						->delete('order');
		}
	}
?>