<?php 
	class Comment_model extends CI_Model{

		public function numberCom($product_id){

			$this->db->select();
			$this->db->from('comments');
			$this->db->where('product_id',$product_id);
			$q=$this->db->get();

			return $q->num_rows();

		}

		public function numberComRec(){

			$this->db->select();
			$this->db->from('comments');
			$this->db->where('status',0);
			$q=$this->db->get();

			return $q->num_rows();

		}

		public function getComments($product_id,$per_page,$offset){
			$this->db->select();
			$this->db->from('comments');
			$this->db->join('users','comments.user_id=users.user_id');
			$this->db->where('comments.product_id',$product_id);
			$this->db->where('comments.status',1);
			$this->db->order_by('comments.comment_id', 'desc');
			$this->db->limit($per_page);
			$this->db->offset($offset);
			$q=$this->db->get();

			return $q->result();
		}

		public function getCommentsRec(){
			$this->db->select();
			$this->db->from('comments');
			$this->db->join('users','comments.user_id=users.user_id');
			$this->db->where('comments.status',0);
			$this->db->order_by('comments.comment_id', 'desc');
			$q=$this->db->get();

			return $q->result();			
		}

		public function addComments($product_id,$comment,$user_id,$date){
			$data=array(
				'product_id'=>$product_id,
				'comment'=>$comment,
				'user_id'=>$user_id,
				'date'=>$date,
				'status'=>0
			);
			
			$q=$this->db->insert('comments',$data);

			if($q){
				return true;
			}
		}

		public function deleteComment($comment_id){
			$this->db->where('comment_id',$comment_id);
			$this->db->delete('comments');
		}

		public function allowComment($comment_id){
			$this->db->where('comment_id',$comment_id);
			$this->db->set('status',1);
			$this->db->update('comments');
		}

		public function deleteProductComments($product_id){
			$this->db->where('product_id',$product_id);
			$this->db->delete('comments');
		}
	}