<?php 
	class Category_model extends CI_Model{
		public function getCat(){
			$q= $this->db->get_where('categories', 'parent_id = 0');
			
			return $q->result();
		}

		public function numCat(){
			$q=$this->db->get_where('categories', 'parent_id = 0');

			return $q->num_rows();
		}

		public function adminGetCat($limit,$offset){
			$this->db->select();
			$this->db->from('categories');
			$this->db->where('parent_id', 0);
			$this->db->order_by('category_id','desc');
			$this->db->limit($limit);
			$this->db->offset($offset);
			$q=$this->db->get();
			return $q->result();
		}

		public function deleteCategory($category_id){
			$this->db->select();
			$this->db->from('comments');
			$this->db->join('products','comments.product_id=products.product_id');
			$this->db->join('categories','products.category_id=categories.category_id');
			$this->db->where('categories.parent_id',$category_id);
			$comments=$this->db->get();

			foreach($comments->result() as $comment){
				$this->db->where('comment_id',$comment->comment_id);
				$this->db->delete('comments');
			}

			$this->db->select();
			$this->db->from('products');
			$this->db->join('categories','products.category_id=categories.category_id');
			$this->db->where('categories.parent_id',$category_id);
			$products=$this->db->get();

			foreach($products->result() as $product){
				$this->db->where('product_id',$product->product_id);
				$this->db->delete('products');

				@unlink(APPPATH."../images/products/thumbs/".$product->image1);
				@unlink(APPPATH."../images/products/thumbs/".$product->image2);
				@unlink(APPPATH."../images/products/thumbs/".$product->image3);
			}

			$this->db->where('parent_id',$category_id);
			$this->db->delete('categories');

			$this->db->where('category_id',$category_id);
			$q=$this->db->delete('categories');

			if($q){
				return true;
			}
		}

		public function addCategory($category_title){
			$data=array(
				'category_title'=>$category_title,
			);

			$q=$this->db->insert('categories',$data);

			if($q){
				return true;
			}
		}

		public function adminGetOneCat($category_id){
			$this->db->select();
			$this->db->from('categories');
			$this->db->where('category_id',$category_id);
			$q=$this->db->get();

			return $q->result();
		}

		public function editCat($category_id,$category_title){
			$data=array(
				'category_title'=>$category_title
			);

			$this->db->where('category_id',$category_id);
			$q=$this->db->update('categories',$data);

			if($q){
				return true;
			}
		}
	}
?>