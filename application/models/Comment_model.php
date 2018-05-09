<?php
defined('BASEPATH') OR exit ('No direct script access allowed.');

class Comment_model extends CI_Model{

	public function __construct(){

		parent::__construct();
	}

	public function create_comment($data){

		$query = $this->db->insert('comments', $data);
		return $query;
	}

	public function get_comments($post_id){

		$query = $this->db->get_where('comments', array('post_id' => $post_id));
		return $query->result_array();
	}
}