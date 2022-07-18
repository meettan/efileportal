<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_verify extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Login_Process');
		
    }
	
	public function index(){
        $email_id = $this->input->get('email_id');
        $otp = $this->input->get('otp');
		$where  =  array('email'=>$email_id,
			              'otp'=>$otp);
		$data   = array('user_approve' => '1');
		$this->master->f_edit('md_users',$data,$where);
		$this->session->set_flashdata('success', 'Registration verification completed.');
		redirect(base_url());
		
	}
	
}
