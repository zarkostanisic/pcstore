<?php 
	class User_model extends CI_Model{
        public function login($username,$password){
			$this->db->select();
			$this->db->from('users');
			$this->db->join('roles','users.role_id=roles.role_id');
			$this->db->where('username',$username);
			$this->db->where('password',md5($password));
			$q=$this->db->get();

			if($q->num_rows()==1){
				return $q->result();
			}else{
				return false;
			}
		}

		public function registration($username,$password,$first_name,$last_name,$email,$phone,$image_name,$city){
			$user_data=array(
					'username'=>$username,
					'password'=>md5($password),
					'role_id'=>"2",
					'first_name'=>$first_name,
					'last_name'=>$last_name,
					'email'=>$email,
					'phone'=>$phone,
					'image'=>$image_name,
					'city'=>$city
				);
			$q=$this->db->insert('users',$user_data);
			if($q){
				return true;
			}
		}

		public function getUser($user_id){
			$this->db->select();
			$this->db->from('users');
			$this->db->join('cities', 'users.city=cities.city_id', 'left');
			$this->db->where('users.user_id', $user_id);

			$q = $this->db->get();

			return $q->result();
		}

		public function userEdit($user_id,$password,$first_name,$last_name,$email,$phone,$image_name,$city){
			$user_data = array();

			if($password != ""){
				$user_data['password'] = md5($password);
			}

			if($image_name != ""){
				$user_data['image'] = $image_name;
			}

			
			$user_data['first_name']=$first_name;
			$user_data['last_name']=$last_name;
			$user_data['email']=$email;
			$user_data['phone']=$phone;
			$user_data['city']=$city;

			$this->db->where('user_id', $user_id);
			$q=$this->db->update('users', $user_data);

			if($q){
				return true;
			}
		}

		function search($username){
			$this->db->select();
			$this->db->from('users');
			$this->db->like('username', $username);
			$this->db->limit(15);
			$q=$this->db->get();

			return $q->result();
		}

		function delete($id){
			$this->db->where('user_id',$id);
			$this->db->delete('users');
		}
	}
 ?>