<?php 
	class Product_model extends CI_Model{

		public function index($subcategory_id,$per_page,$offset){
			$this->db->select();
			$this->db->from('products');
			$this->db->join('categories','products.category_id=categories.category_id');
			$this->db->where('products.category_id',$subcategory_id);
			$this->db->limit($per_page);
			$this->db->offset($offset);
			$this->db->order_by('products.product_price');
			$q=$this->db->get();

			return $q->result();
		}

		function search($product_title){
			$this->db->select();
			$this->db->from('products');
			$this->db->like('product_title', $product_title);
			$this->db->limit(15);
			$q=$this->db->get();

			return $q->result();
		}

		public function numberPro($subcategory_id){

			$this->db->select();
			$this->db->from('products');
			$this->db->where('category_id',$subcategory_id);
			$q=$this->db->get();

			return $q->num_rows();

		}

		public function getFavPro(){
			$this->db->select();
			$this->db->from('products');
			$this->db->where('status',1);
			$this->db->limit(6);
			$this->db->order_by('product_id', 'RANDOM');
			$q=$this->db->get();

			return $q->result();
		}

		public function getFavProAdmin(){
			$this->db->select();
			$this->db->from('products');
			$this->db->where('status',1);
			$this->db->order_by('product_id');
			$q=$this->db->get();

			return $q->result();
		}

		public function numberFavPro(){

			$this->db->select();
			$this->db->from('products');
			$this->db->where('status',1);
			$q=$this->db->get();

			return $q->num_rows();

		}

		public function removeFavPro($product_id){
			$data=array(
				'status'=>'0'
			);

			$this->db->where('product_id',$product_id);
			$this->db->update('products',$data);
		}

		public function addFavPro($product_id){
			$data=array(
				'status'=>'1'
			);

			$this->db->where('product_id',$product_id);
			$this->db->update('products',$data);
		}

		public function getNormalPro($product_title){
			$this->db->select();
			$this->db->from('products');
			$this->db->like('product_title',$product_title);
			$this->db->where('status',0);
			$this->db->limit(15);
			$q=$this->db->get();

			return $q->result();			
		}

		public function showProduct($product_id){
			$this->db->select();
			$this->db->from('products');
			$this->db->where('product_id',$product_id);
			$q=$this->db->get();

			return $q->result();
		}

		public function getPopularPro(){
			$this->db->select();
			$this->db->from('products');
			$this->db->order_by('views', 'desc');
			$this->db->limit(8);
			$q=$this->db->get();

			return $q->result();
		}

		public function plus($product_id){
			$this->db->select('product_id, views');
			$this->db->from('products');
			$this->db->where('product_id',$product_id);
			$q=$this->db->get();

			foreach($q->result() as $product){
				$views=$product->views;
				$views++;

				$data=array(
					'views'=>$views
				);

				$this->db->where('product_id',$product_id);
				$this->db->update('products',$data);
			}

			return $q->result();
		}

		public function changeNumber($product_id, $number){
			$this->db->select('product_id, number');
			$this->db->from('products');
			$this->db->where('product_id',$product_id);
			$q=$this->db->get();

			foreach($q->result() as $product){
				$num=$product->number;
				$num-=$number;

				$data=array(
					'number'=>$num
				);

				$this->db->where('product_id',$product_id);
				$this->db->update('products',$data);
			}

			return $q->result();
		}

		public function delete_product($product_id){
			$this->deleteProductComments($product_id);

			$this->db->select();
			$this->db->from('products');
			$this->db->where('product_id',$product_id);
			$product=$this->db->get();
			foreach($product as $pro){
				@unlink(APPPATH."../images/products/thumbs/".$pro->image1);
				@unlink(APPPATH."../images/products/thumbs/".$pro->image2);
				@unlink(APPPATH."../images/products/thumbs/".$pro->image3);
			}

			$this->db->where('product_id',$product_id);
			$this->db->delete('products');
		}

		public function addProduct($product_title,$product_description,$subcategory_id,$product_price,$product_number,$image1_name,$image2_name,$image3_name){
			$data=array(
				'product_title'=>$product_title,
				'product_description'=>$product_description,
				'category_id'=>$subcategory_id,
				'product_price'=>$product_price,
				'number'=>$product_number,
				'image1'=>$image1_name,
				'image2'=>$image2_name,
				'image3'=>$image3_name,
			);

			$q=$this->db->insert('products',$data);

			if($q){
				return true;
			}
		}

		public function editProduct($product_id,$product_title,$product_description,$subcategory_id,$product_price,$product_number,$image1_name,$image2_name,$image3_name){
			$q=$this->showProduct($product_id);
			if($image1_name==""){
				foreach($q as $product){
					$image1_name=$product->image1;
				}
			}

			if($image2_name==""){
				foreach($q as $product){
					$image2_name=$product->image2;
				}
			}

			if($image3_name==""){
				foreach($q as $product){
					$image3_name=$product->image3;
				}
			}

			$data=array(
				'product_title'=>$product_title,
				'product_description'=>$product_description,
				'category_id'=>$subcategory_id,
				'product_price'=>$product_price,
				'number'=>$product_number,
				'image1'=>$image1_name,
				'image2'=>$image2_name,
				'image3'=>$image3_name
			);
			
			$this->db->where('product_id',$product_id);
			$q=$this->db->update('products',$data);

			if($q){
				return true;
			}		
		}

		public function product_stats($offset, $limit, $title){
			$q = $this->db->select()
						->from('products')
						->join('categories', 'products.category_id=categories.category_id')
						->like('product_title' , $title)
						->offset($offset)
						->limit($limit)
						->get()
						->result();

			return $q;
		}

		public function stats_number_change($id, $val){
			$data = array(
				'number' => $val
			);

			$this->db->where('product_id', $id)
						->update('products', $data);
		}

		public function count($title){
			return $this->db->select()
							->from('products')
							->like('product_title', $title)
							->get()
							->num_rows();
		}
	}
?>