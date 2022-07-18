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
	    $query = $this->db->get_where('md_users', array('email'=>$email_id,'otp'=>$otp,'user_approve' => '0'))->num_rows();
	
		if ($query > 0){
		$where  =  array('email'=>$email_id,
			              'otp'=>$otp,
						  'user_approve' => '0');
		$data   = array('user_approve' => '1');
		$this->master->f_edit('md_users',$data,$where);
		$this->session->set_flashdata('success', 'Registration verification completed.Please login With your credential');
	    }else{
			$this->session->set_flashdata('error', 'Verification link expired');	
		}
		redirect(base_url());
		
	}
	
}
