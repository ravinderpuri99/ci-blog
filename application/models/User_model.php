<?php
defined('BASEPATH') or exit ('No direct script access allowed.');
 
/**
* 
*/
class User_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function register($data){

		//Insert user
		$query = $this->db->insert('users', $data);
		return $query;
	}


	public function login($username, $password){

		$this->db->where('username', $username);
		$this->db->where('password', $password);

		$query = $this->db->get('users');
		if($query->num_rows() != ''){

			return $query->row(0)->id; 
		}else{
			return false;
		}

	}


	public function check_username_exists($username){

		$query = $this->db->get_where('users', array('username' => $username));

		if(empty($query->row_array())){
			return true;
		}else{
			return false;
		}
	}

	public function check_email_exists($email){

		$query = $this->db->get_where('users', array('email' => $email));

		if(empty($query->row_array())){
			return true;
		}else{
			return false;
		}
	}
}