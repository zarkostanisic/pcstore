<?php
	class Subcategory_model extends CI_Model{
		public function getSub(){
			$q=$q= $q= $this->db->select()
						->from('categories')
						->where('parent_id !=', 0)
						->order_by('category_title')
						->get();
			return $q->result();
		}

		public function numSub(){
			$q=$this->db->get_where('categories', 'parent_id != 0');

			return $q->num_rows();
		}

		public function adminGetSub($limit,$offset){
			$this->db->select();
			$this->db->from('categories');
			$this->db->where('parent_id !=', 0);
			$this->db->order_by('category_id','desc');
			$this->db->limit($limit);
			$this->db->offset($offset);
			$q=$this->db->get();

			return $q->result();
		}
		
		public function getOneSub($subcategory_id){
			$this->db->where('category_id',$subcategory_id);
			$q=$this->db->get('categories');
			
			return $q->result();
		}

		public function deleteSubcategory($subcategory_id){
			$this->db->select();
			$this->db->from('comments');
			$this->db->join('products','comments.product_id=products.product_id');
			$this->db->where('products.category_id',$subcategory_id);
			$comments=$this->db->get();
			foreach($comments->result() as $comment){
				$this->db->where('comment_id',$comment->comment_id);
				$this->db->delete('comments');
			}

			$this->db->select();
			$this->db->from('products');
			$this->db->join('categories','products.category_id=categories.category_id');
			$this->db->where('categories.category_id',$subcategory_id);
			$products=$this->db->get();

			foreach($products->result() as $product){
				$this->db->where('product_id',$product->product_id);
				$this->db->delete('products');

				@unlink(APPPATH."../images/products/thumbs/".$product->image1);
				@unlink(APPPATH."../images/products/thumbs/".$product->image2);
				@unlink(APPPATH."../images/products/thumbs/".$product->image3);
			}

			$this->db->where('category_id',$subcategory_id);
			$q=$this->db->delete('categories');

			if($q){
				return true;
			}
		}

		public function addSubcategory($subcategory_title,$category_id){
			$data=array(
				'parent_id'=>$category_id,
				'category_title'=>$subcategory_title
			);

			$q=$this->db->insert('categories',$data);

			if($q){
				return true;
			}
		}

		public function adminGetOneSubcat($subcategory_id){
			$this->db->select();
			$this->db->from('categories');
			$this->db->where('category_id',$subcategory_id);
			$q=$this->db->get();

			return $q->result();
		}

		public function editSubcat($subcategory_id,$subcategory_title,$category_id){
			$data=array(
				'parent_id'=>$category_id,
				'category_title'=>$subcategory_title
			);
			$this->db->where('category_id',$subcategory_id);
			$q=$this->db->update('categories',$data);

			if($q){
				return true;
			}
		}
	}
?>