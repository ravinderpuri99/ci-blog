<?php

class Posts_model extends CI_Model{

	public function __construct(){

		parent::__construct();
	}

	public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE){

		if($limit){
			$this->db->limit($limit, $offset);
		}
		if($slug === FALSE){

			$this->db->order_by('posts.id', 'DESC');
			$this->db->join('category', 'category.id = posts.category_id');
			$query = $this->db->get('posts');
			return $query->result_array();
		}

		$query = $this->db->get_where('posts', array('slug' => $slug));
		return $query->result_array();
	}


	public function create_post($data){

		$query = $this->db->insert('posts', $data);
		return $query;

	}

	public function delete_post($id){

		$this->db->where('id', $id);
		$this->db->delete('posts');
		return true;

	}

	public function update_post($id, $data){

		$this->db->where('id', $id);
		$this->db->update('posts', $data);
	}

	public function get_categories(){

		$this->db->order_by('name');
		$query = $this->db->get('category');
		return $query->result_array();
	}

	public function get_posts_by_category($category_id){

		$this->db->order_by('posts.id', 'DESC');
		$this->db->join('category', 'category.id = posts.category_id');
		$query = $this->db->get_where('posts', array('category_id' => $category_id));
		return $query->result_array();
	}
}