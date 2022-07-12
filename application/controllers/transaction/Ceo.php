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
	public function filedetail(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
		  $fdetail = explode('/',$this->input->post('docket_no'));
		  $where = array('docket_no' => $fdetail[0]);
		  $fwhere = array('file_no' => $fdetail[1]);
		  $data['docs']   = $this->master->f_get_particulars('td_document',NULL,$where,0);
		  $data['fdocs']  = $this->master->f_get_particulars('td_file_document',NULL,$fwhere,0);
		  $data['fileno'] = $fdetail[1];
		  $whereu = array('dept != '=>'Dispatch');
		  $data['users'] = $this->master->f_get_particulars('md_users',NULL,$whereu,0);
		  unset($where);
		  $where = array('forwarded_by'=>$this->session->userdata('uloggedin')->id,
						 'file_no' =>$fdetail[1]);
		  $data['filestatus'] = $this->master->f_get_particulars('td_track_file',NULL,$where,1);
		  $data['filedtl'] = $this->master->f_get_particulars('td_file',NULL,array('file_no'=>$fdetail[1]),1);
		  $str2 = substr($fdetail[1],0,1); 
		  if($str2 == 'L') {
			if($data['filedtl'] ){
				$data['leave'] = $this->notesheet_model->f_get_particulars('td_leave_dtls',NULL,array('docket_no'=>$data['filedtl']->docket_no),1) ;
			}else{
				$data['leave'] = '';
			}
		  }else{
			$data['leave'] = '';
		  }
		  $data['comment_author'] = $this->master->f_get_particulars('td_track_file a,md_users b',array('a.*','b.first_name'),array('a.forwarded_by = b.id'=> NULL,'file_no' =>$fdetail[1]),0);
		  $view = $this->load->view('ceo/file_dtls',$data);
		  return $view;
		}
	}

	public function file_forward(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			$user = $this->input->post('user');
			if($user != '' ){
			$data = array(
				    'fwd_dt' => date('Y-m-d'),
					'file_no'=> $this->input->post('fileno'),
					'remarks' => $this->input->post('remarks'),
					'fwd_status' => $this->input->post('fwd_status'),
					'fwd_to' =>$this->input->post('user'),
					'forwarded_by' =>$this->session->userdata('uloggedin')->id,
					'forwarded_at' =>date("Y-m-d h:i:s"));
			$this->master->f_insert('td_track_file',$data);
			}
			$fc = $this->input->post('cf');
			
			if($fc == 1){
				$data_array = array('close_status' => '1',
									'close_by'=>$this->session->userdata('uloggedin')->id,
									'close_dt'=> date('Y-m-d h:i:s')
			                    );
				$this->master->f_edit('td_file',$data_array,array('file_no'=>$this->input->post('fileno')));
			}
			redirect('index.php/ceo/');
		}

	}
	
}
