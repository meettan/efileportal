<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Login_Process');
		//For User's Authentication
        if(!isset($this->session->userdata('uloggedin')->phone_no)){
            
            redirect('auth/verification/');

        }
    }
	
	public function index(){

		$where  =  array('user_approve'=>'0');
		$data['users']  = $this->master->f_get_particulars('md_users',NULL,$where,0);
		$this->load->view('uservalidation/header');
		$this->load->view('uservalidation/dashboard',$data);
		$this->load->view('uservalidation/footer');
	}

	public function edit($id){
		$where  =  array('id'=>$id);
		$data['user']   = $this->master->f_get_particulars('md_users',NULL,$where,1);
		$this->load->view('uservalidation/header');
		$this->load->view('uservalidation/edit',$data);
		$this->load->view('uservalidation/footer');
	}

	public function useractivate(){

		$data_array = array('user_type'=>$this->input->post('user_type'),
							'user_approve'=>'1',
							'approve_by'=> $this->session->userdata('uloggedin')->phone_no,
							'approve_dt'=>date("Y-m-d h:i:s")
						   );
		$where    = array('id' =>$this->input->post('id') );
		$data     = $this->master->f_edit('md_users',$data_array,$where);
		//if($data){
			echo '<script>alert("User status updated successfully.")</script>';
			//$this->session->set_flashdata("success","User status updated successfully."); 
			$where  =  array('user_approve'=>'0');
			$data['users']  = $this->master->f_get_particulars('md_users',NULL,$where,0);
			$this->load->view('uservalidation/header');
			$this->load->view('uservalidation/dashboard',$data);
			$this->load->view('uservalidation/footer');
		//}
	}
	
}
