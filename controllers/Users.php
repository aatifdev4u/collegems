<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {
    
    public function dashboard(){
        $college_id = $this->session->userdata('college_id');
        $this->load->model('queries');
        $students = $this->queries->getStudents($college_id);
        $this->load->view('users', ['students' => $students]);
    }
}