<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_history extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Login_Process');
		//For User's Authentication
        if(!isset($this->session->userdata('uloggedin')->id)){

            redirect(base_url());
        }
    }
	
	public function index(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$file_no = trim($this->input->post('file_no'));
			$data['filedtl'] = $this->master->f_get_particulars('td_file a,md_users b',array('a.*','b.first_name','b.last_name'),array('a.created_by = b.id'=> NULL,'a.file_no'=>$file_no),1);
			$data['comment_author'] = $this->master->f_get_particulars('td_track_file a,md_users b',array('a.*','b.first_name'),array('a.forwarded_by = b.id'=> NULL,'file_no' =>$file_no),0);
			return $this->load->view('file_history/file_movement',$data);
		}
		else{
			$this->load->view('common/header');
		    $this->load->view('file_history/search_file');
		    $this->load->view('common/footer');
		}
		
	}
	
}
