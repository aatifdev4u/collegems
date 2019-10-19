<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('user_id'))
            return redirect('welcome/login');
    }

    public function dashboard(){
        $this->load->model('queries');
        $users = $this->queries->viewAllColleges();
        $this->load->view('dashboard', ['users' => $users]);
    }

    public function addCollege(){
        $this->load->view('addCollege');
    }

    public function createCollege(){
        $this->form_validation->set_rules('collegename', 'College', 'required');
		$this->form_validation->set_rules('branch', 'Branch', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        
        
            // echo '<pre>';
            // print_r($this->input->post());
            // echo '</pre>';
            // exit();
        if($this->form_validation->run() ){
            $data = $this->input->post();
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            // exit();
			$this->load->model('queries');
			
			if($this->queries->makeCollege($data)){
				$this->session->set_flashdata('message', 'College created successfully');
			}else{
                $this->session->set_flashdata('message', 'Failed to Create College');
            }
            return redirect('admin/addCollege');

		}else{
            $this->addCollege();
		}
    }

    public function addCoadmin(){
        $this->load->model('queries');
        $roles = $this->queries->getRoles();
        $colleges = $this->queries->getColleges();
		$this->load->view('addCoadmin', ['roles' => $roles, 'colleges' => $colleges]);
    }

    public function createCoadmin(){
		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('college_id', 'College Name', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('role_id', 'Role', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confpwd', 'confirmation password Again', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        
        // echo '<pre>';
        // print_r($this->input->post());
        // echo '</pre>';
        // exit();

		if($this->form_validation->run() ){
			// echo "Validated passed successfullly";
			$data = $this->input->post();
			$data['password'] = sha1($this->input->post('password'));
			$data['confpwd'] = sha1($this->input->post('confpwd'));
			// echo '<pre>';
			// print_r($data);
            // echo '</pre>';
            // exit();
			$this->load->model('queries');
			if($this->queries->registerCoadmin($data)){
				$this->session->set_flashdata('message', 'Co Admin Created Successfully');	
			}else{
				$this->session->set_flashdata('message', 'Failed to create Co Admin');
            }
            return redirect('admin/addCoadmin');

		} else {
			// echo validation_errors();
			$this->addCoadmin();
		}

	}

    public function addStudent(){
        $this->load->model('queries');
        $colleges = $this->queries->getColleges();
        $this->load->view('addStudent', ['colleges' => $colleges]);
    }

    public function createStudent(){
        $this->form_validation->set_rules('studentname', 'Student Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('college_id', 'College Name', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('course', 'Course', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		if($this->form_validation->run() ){
			echo "Validated passed successfullly";
			$data = $this->input->post();
			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';
			$this->load->model('queries');
			if($this->queries->createStudent($data)){
				$this->session->set_flashdata('message', 'Successfully added Student');	
			}else{
				$this->session->set_flashdata('message', 'Failed to add student');
            }
            return redirect('admin/addStudent');

		} else {
			// echo validation_errors();
			$this->addStudent();
		}
    }

    public function viewStudents($college_id){
        $this->load->model('queries');
        $students = $this->queries->getStudents($college_id);
        $this->load->view('viewStudents', ['students' => $students]);
    }

    public function editStudent($id){
        $this->load->model('queries');
        $studentData = $this->queries->getStudentRecord($id);
        $colleges = $this->queries->getColleges();
        // echo '<pre>';
        // print_r($studentData);
        // echo '</pre>';
        // exit();
        $this->load->view('editStudent', ['studentData' => $studentData, 'colleges' => $colleges ]);
    }

    public function modifyStudent($id){
        $this->form_validation->set_rules('studentname', 'Student Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('college_id', 'College Name', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('course', 'Course', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		if($this->form_validation->run() ){
			echo "Validated passed successfullly";
			$data = $this->input->post();
			$this->load->model('queries');
			if($this->queries->updateStudent($data, $id)){
				$this->session->set_flashdata('message', 'Successfully updated Student record');	
			}else{
				$this->session->set_flashdata('message', 'Failed to update student');
            }
            return redirect("admin/editStudent/{$id}");

		} else {
			// echo validation_errors();
			$this->editStudent();
		}
    }

    public function deleteStudent($id){
        $this->load->model('queries');
        if($this->queries->deleteStudentRecord($id)){
            return redirect('admin/dashboard');
        }
       
    }

    public function coadmins(){
        $this->load->model('queries');
        $coadmins = $this->queries->viewAllColleges();
        $this->load->view('viewCoadmins', ['coadmins' => $coadmins]);
    }
}