<?php 
    class Queries extends CI_Model{

        public function getRoles(){
            $roles = $this->db->get('tbl_roles');
            if($roles->num_rows() > 0 ) {
                return $roles->result();
            }
        }

        public function getColleges(){
            $colleges = $this->db->get('tbl_college');
            if($colleges->num_rows() > 0 ) {
                return $colleges->result();
            }
        }

        public function registerAdmin($data){
            return $this->db->insert('tbl_users', $data);
        }

        public function chkAdminExist(){
            $chkAdmin = $this->db->where('role_id', '1')->get('tbl_users');
            if($chkAdmin->num_rows() > 0 ){
                return $chkAdmin->num_rows();
            }
        }

        public function adminExists($email, $password){
            $chkUser = $this->db->where(['email' => $email, 'password' => $password])
                            ->get('tbl_users');
            if($chkUser->num_rows() > 0){
                return $chkUser->row();
            }
        }

        public function makeCollege($data){
            return $this->db->insert('tbl_college', $data);
        }

        public function registerCoadmin($data){
            return $this->db->insert('tbl_users', $data);
        }

        public function viewAllColleges(){
          $this->db->select(['tbl_users.user_id', 'tbl_users.email', 'tbl_college.college_id', 
                'tbl_users.username', 'tbl_users.gender','tbl_college.collegename',
                'tbl_college.branch', 'tbl_roles.rolename']);
            $this->db->from('tbl_college');
            $this->db->join('tbl_users', 'tbl_users.college_id = tbl_college.college_id');
            $this->db->join('tbl_roles', 'tbl_roles.role_id = tbl_users.role_id');
            $users = $this->db->get();
            return $users->result();  
        }

        public function createStudent($data){
            return $this->db->insert('tbl_students', $data);
        }

        public function getStudents($college_id){
            $this->db->select(['tbl_college.collegename', 'tbl_students.studentname',
            'tbl_students.email', 'tbl_students.gender', 'tbl_students.id',
            'tbl_students.course']);
            $this->db->from('tbl_students');
            $this->db->join('tbl_college', 'tbl_college.college_id = tbl_students.college_id');
            $this->db->where(['tbl_students.college_id' => $college_id]);
            $students = $this->db->get();
            return $students->result();
        }

        public function getStudentRecord($id){
            $this->db->select(['tbl_college.collegename', 'tbl_college.college_id', 'tbl_students.studentname',
            'tbl_students.email', 'tbl_students.gender', 'tbl_students.id',
            'tbl_students.course']);
            $this->db->from('tbl_students');
            $this->db->join('tbl_college', 'tbl_college.college_id = tbl_students.college_id');
            $this->db->where(['tbl_students.id' => $id]);
            $studentData = $this->db->get();
            return $studentData->row();
        }

        public function updateStudent($data, $id){
            return $this->db->where('id', $id)->update('tbl_students', $data);
        }

        public function deleteStudentRecord($id){
            return $this->db->delete('tbl_students', ['id' => $id]);
        }
    }

?>