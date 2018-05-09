<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller{

	public function index($offset = 0){

		//Pagination Config
		$config['base_url'] = base_url(). 'posts/index/';
		$config['total_rows'] = $this->db->count_all('posts');
		$config['per_page'] = 3;
		$config['uri_segment'] = 3;
		// Produces: class="myclass"
		$config['attributes'] = array('class' => 'pagination-links');

		//Init Pagination
		$this->pagination->initialize($config);

		$data['title'] = 'Latest Posts';

		$data['posts'] = $this->posts_model->get_posts(FALSE, $config['per_page'], $offset);

		$this->load->view('templates/header');
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer');
	}

	public function view($slug = NULL){

		$data['post'] = $this->posts_model->get_posts($slug);

		$post_id = $data['post'][0]['id'];

		$data['comments'] = $this->comment_model->get_comments($post_id);
	
		if(empty($data['post'])){

			show_404();
		}

		$data['title'] = $data['post'][0]['title'];

		$this->load->view('templates/header');
		$this->load->view('posts/view', $data);
		$this->load->view('templates/footer');
	}


	public function create(){

		//Check Login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$data['title'] = 'Create Post';


		$data['categories'] = $this->posts_model->get_categories();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if($this->form_validation->run() === FALSE){

			$this->load->view('templates/header');
			$this->load->view('posts/create', $data);
			$this->load->view('templates/footer');

		}else{

			
			$config['upload_path'] = './assets/images/posts/';
			$config['overwrite'] = TRUE;
			$config["allowed_types"] = 'jpg|jpeg|png|gif'; 
			$config['max_size'] = '8192'; 
			$config['max_width'] = '2000'; 
			$config['max_height'] = '2000'; 

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('post_image')){

				$errors = array('error' => $this->upload->display_errors()); 
				$post_image = 'noimage.jpg';

			}else{

				$data = array('upload_data' => $this->upload->data());
				$post_image = $_FILES['post_image']['name']; 
			}

			$slug = url_title($this->input->post('title'));

			$data = array(
						'title' => $this->input->post('title'),
						'category_id' => $this->input->post('category_id'),
						'user_id' => $this->session->userdata('user_id'),
						'slug' => $slug,
						'description' => $this->input->post('description'), 
						'post_image' => $post_image,
						'status' => 1
					);

			$this->posts_model->create_post($data);
			//Set message
			$this->session->set_flashdata('post-created', 'Your post has been created successfully.');
			redirect('posts');
		}
	}


	public function delete($id){

		//Check Login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$this->posts_model->delete_post($id);
		//Set message
		$this->session->set_flashdata('post-delete', 'Your post deleted.');
		redirect('posts');
	}


	public function edit($slug){

		//Check Login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$data['post'] = $this->posts_model->get_posts($slug);

		//Check user
		if($this->session->userdata('user_id') != $data['post'][0]['user_id']){

			 redirect('posts');
		} 	

		$data['categories'] = $this->posts_model->get_categories();
	
		if(empty($data['post'])){

			show_404();
		}

		$data['title'] = 'Edit Post';

		$this->load->view('templates/header');
		$this->load->view('posts/edit', $data);
		$this->load->view('templates/footer');
	}

	public function update(){

		//Check Login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}

		$id = $this->input->post('id');

		$slug = url_title($this->input->post('title'));

		$data = array(
					'title' => $this->input->post('title'),
					'category_id' => $this->input->post('category_id'),
					'slug' => $slug,
					'description' => $this->input->post('description'), 
					'status' => 1
				);

		$this->posts_model->update_post($id, $data);
		//Set message
		$this->session->set_flashdata('post-updated', 'Your post has been updated successfully.');
		redirect('posts');
	}
}