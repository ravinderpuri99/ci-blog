<?php
defined('BASEPATH') or exit ('No direct script access allowed.');

class Users extends CI_Controller{

	//Register User
	public function register(){

		$data['title'] = 'Sign Up';

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Userame', 'required|callback_check_username_exists');
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

		if($this->form_validation->run() === FALSE){

			$this->load->view('templates/header');
			$this->load->view('users/register', $data);
			$this->load->view('templates/footer');

		}else{

			//Encrypt password
			$enc_password = md5($this->input->post('password'));

			$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'username' => $this->input->post('username'),
						'password' => $enc_password,
						'zipcode' => $this->input->post('zipcode'),
						'status' => 1
					);

			$this->user_model->register($data);

			//Set message
			$this->session->set_flashdata('user_registered', 'Your account create successfully. You can login now.');

			redirect('posts');
		}
	}


	//Login User
	public function login(){

		$data['title'] = 'Sign In';

		$this->form_validation->set_rules('username', 'Userame', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE){

			$this->load->view('templates/header');
			$this->load->view('users/login', $data);
			$this->load->view('templates/footer');

		}else{

			$username = $this->input->post('username');
			//Encrypt password
			$enc_password = md5($this->input->post('password'));

			$user_id = $this->user_model->login($username, $enc_password);

			if($user_id){

				$user_data = array(
								'user_id' => $user_id,
								'username' => $username,
								'logged_in' => true
							);

				$this->session->set_userdata($user_data);

				//Set message
				$this->session->set_flashdata('user_loggedin', 'Your are now logged in.');

				redirect('posts');

			}else{

				//Set message
				$this->session->set_flashdata('login_failed', 'Invalid Login.');

				redirect('users/login');
			}
		}
	}


	//Logout user
	public function logout(){

		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');

		$this->session->set_flashdata('user_loggedout', 'Logged out.');

		redirect('users/login');
	}

	//Check if username exists
	public function check_username_exists($username){

		$this->form_validation->set_message('check_username_exists', 'Username already exists. Please choose a different one.');
		if($this->user_model->check_username_exists($username)){
			return true;
		}else{
			return false;
		}
	}

	//Check if email exists
	public function check_email_exists($email){

		$this->form_validation->set_message('check_email_exists', 'Email already exists. Please choose a different one.');
		if($this->user_model->check_email_exists($email)){
			return true;
		}else{
			return false;
		}
	}
}