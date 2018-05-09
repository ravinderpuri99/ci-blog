<?php

class Category_model extends CI_Model{

	public function __construct(){

		parent::__construct();
	}

	public function create_category($data){

		$query = $this->db->insert('category', $data);
		return $query;
	}

	public function get_categories(){

		$this->db->order_by('name');
		$query = $this->db->get('category');
		return $query->result_array();
	}

	public function get_category($id){

		$query = $this->db->get_where('category', array('id' => $id));
		return $query->row();
	}

	public function delete_category($id){

		$this->db->where('id', $id);
		$this->db->delete('category');
		return true;

	}

}