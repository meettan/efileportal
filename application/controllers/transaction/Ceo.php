<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ceo extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Trans_model','trans_model');
		$this->load->model('Notesheet_model','notesheet_model');
        if(!isset($this->session->userdata('uloggedin')->phone_no)){
            redirect('auth/verification/');
        }
    }
	
	//  ***** List for forwarded document   *****   //
	public function index(){
		
		$where = array('a.fwd_to=b.id'=>NULL,
					    'a.fwd_to' => $this->session->userdata('uloggedin')->id);
		$data['files'] = $this->master->f_get_particulars('td_track_file a,md_users b',NULL,$where,0);
		$this->load->view('common/header');
		$this->load->view('ceo/file_track',$data);
		$this->load->view('common/footer');
	}
	
}
