<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	public function index()
	{
		// $this->load->view('home');
		$this->load->model('queries');
		$chkAdminExist = $this->queries->chkAdminExist();
		
		$this->load->view('home', ['chkAdminExist' => $chkAdminExist]);
	}

	public function adminRegister(){
		$this->load->model('queries');
		$roles = $this->queries->getRoles();
		$this->load->view('register', ['roles' => $roles]);
	}

	public function adminSignup(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('role_id', 'Role', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confpwd', 'confirmation password Again', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		if($this->form_validation->run() ){
			echo "Validated passed successfullly";
			$data = $this->input->post();
			$data['password'] = sha1($this->input->post('password'));
			$data['confpwd'] = sha1($this->input->post('confpwd'));
			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';
			$this->load->model('queries');
			if($this->queries->registerAdmin($data)){
				$this->session->set_flashdata('message', 'Admin Registered Successfully');
				return redirect('welcome/adminRegister');
			}else{
				$this->session->set_flashdata('message', 'Admin failed to Registered');
				return redirect('welcome/adminRegister');
			}

		} else {
			// echo validation_errors();
			$this->adminRegister();
		}

	}

	public function login(){
		if($this->session->userdata('user_id'))
            return redirect('admin/dashboard');
		$this->load->view('login');
	}

	public function signIn(){
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		if($this->form_validation->run() ){
			$email = $this->input->post('email');
			$password = sha1($this->input->post('password'));
			$this->load->model('queries');
			$userExists = $this->queries->adminExists($email, $password);
			if($userExists && $userExists->role_id == '1'){
				$sessionData = [
					'user_id' => $userExists->user_id,
					'username' => $userExists->username,
					'email' => $userExists->email,
					'role_id' => $userExists->role_id
				];
				$this->session->set_userdata($sessionData);
				return redirect('admin/dashboard');
			}else{
				$sessionData = [
					'user_id' => $userExists->user_id,
					'username' => $userExists->username,
					'email' => $userExists->email,
					'role_id' => $userExists->role_id,
					'college_id' => $userExists->college_id
				];
				$this->session->set_userdata($sessionData);
				return redirect('users/dashboard');
			}

		}else{
			$this->session->set_flashdata('message', 'Email or Password is incorrect');
			return redirect('welcome/login');
		}
	}

	public function logout(){
		$this->session->unset_userdata("user_id");
		return redirect('welcome/login');
	}

}
