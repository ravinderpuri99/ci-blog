<?php
defined('BASEPATH') OR exit ('No direct script access allowed.');

class Comments extends CI_Controller{

	public function create($post_id){

		$slug = $this->input->post('slug');

		$data['post'] = $this->posts_model->get_posts($slug);

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('body', 'Body', 'required');

		if($this->form_validation->run() === FALSE){

			$this->load->view('templates/header');
			$this->load->view('posts/view', $data);
			$this->load->view('templates/footer');
		
		}else{

			$data = array(
						'post_id' => $post_id,
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'body' => $this->input->post('body'),
						'status' => 1
					);

			$this->comment_model->create_comment($data);
			redirect('posts/'.$slug);
		}
	}
}