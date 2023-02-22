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
					    'a.fwd_to' => $this->session->userdata('uloggedin')->id,
					   '1 order by a.fwd_dt desc' => NULL);
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
		  
		  $data['fdocs']  = $this->master->f_get_particulars('td_file_document',NULL,$fwhere,0);
		  $data['depts'] = $this->master->f_get_particulars('md_department',NULL,NULL,0);
		  $data['fileno'] = $fdetail[1];
		  $whereu = array('dept != '=>'Dispatch',
		                  'id !=' => $this->session->userdata('uloggedin')->id
		                  );
		  $data['users'] = $this->master->f_get_particulars('md_users',NULL,$whereu,0);
		  unset($where);
		  $where = array('forwarded_by'=>$this->session->userdata('uloggedin')->id,
						 'file_no' =>$fdetail[1]);
		  $data['filestatus'] = $this->master->f_get_particulars('td_track_file',NULL,$where,1);
		  $data['filedtl'] = $this->master->f_get_particulars('td_file a,md_users b',array('a.*','b.first_name','b.last_name','b.designation'),array('a.created_by = b.id'=> NULL,'a.file_no'=>$fdetail[1]),1);
		  $ft = substr($fdetail[1],0,4); 
		  $data['docs']   = $this->master->f_get_particulars('td_document',NULL,array('docket_no'=>$data['filedtl']->docket_no),0); 
		  $data['filetype'] = $this->master->f_get_particulars('md_file_type',array('file_name'),array('file_no'=>$ft),1);
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
		  $data['comment_author'] = $this->master->f_get_particulars('td_track_file a,md_users b',array('a.*','b.first_name','b.designation'),array('a.forwarded_by = b.id'=> NULL,'file_no' =>$fdetail[1]),0);
		  $view = $this->load->view('ceo/file_dtls',$data);
		  return $view;
		}
	}

	public function file_forward(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			$result = $this->master->f_get_particulars('td_file',NULL,array('file_no'=> $this->input->post('fileno')),1);
			if($fc == 'R'){
			$user = $this->input->post('user');
			 }else{
			 	$user = $result->created_by;
			 }
			// if($user != '' ){
			
			// }
			$fc = $this->input->post('fwd_status');
			$fn = $this->input->post('fileno');
			if($fc == 'A'){

				$data = array(
				    'fwd_dt' => date('Y-m-d'),
					'file_no'=> $this->input->post('fileno'),
					'remarks' => $this->input->post('remarks'),
					'fwd_status' => $this->input->post('fwd_status'),
					'fwd_dept'=> $result->dept_no,
					'fwd_to'  => $this->input->post('user'),
					'forwarded_by' =>$this->session->userdata('uloggedin')->id,
					'forwarded_at' =>date("Y-m-d h:i:s"));
			       $this->master->f_insert('td_track_file',$data);
				     //  SMS SEND CODE    //
				$userdtl = $this->master->f_get_particulars('md_users',NULL,array('id'=> trim($this->input->post('user'))),1);
				$depdtl  = $this->master->f_get_particulars('md_department',NULL,array('sl_no'=> $result->dept_no),1);
				$first_name = ($userdtl->first_name); 
				$mobile_no = $userdtl->phone_no;
				$department_name =  $depdtl->short_code;
				$sender_name = ucfirst($this->session->userdata('uloggedin')->first_name);
				$template = 'Dear '.$first_name.' File No. '.$fn.' has been forwarded to you from '.$department_name.' department by '.$sender_name.',for your necessary action.-WBMCCF';
				
				$sms_send = $this->master->sendsms($mobile_no,$template);
                //  SMS SEND CODE    //
				$this->session->set_flashdata('success', 'File Forwarded Successfully');
			}
			elseif($fc == 'FS'){
				$data_array = array('close_status' => '1',
									'close_by'=>$this->session->userdata('uloggedin')->id,
									'close_dt'=> date('Y-m-d h:i:s')
			                    );
				$this->master->f_edit('td_file',$data_array,array('file_no'=>$this->input->post('fileno')));
                //  SMS SEND CODE    //
				$userdtl = $this->master->f_get_particulars('md_users',NULL,array('id'=> $result->created_by),1);
				$depdtl  = $this->master->f_get_particulars('md_department',NULL,array('sl_no'=> $result->dept_no),1);
				$first_name = ($userdtl->first_name); 
				$mobile_no = $userdtl->phone_no;
				$department_name =  $depdtl->short_code;
				$sender_name = ucfirst($this->session->userdata('uloggedin')->first_name);
				$template = 'Dear '.$first_name.' File No. '.$fn.' has been forwarded to you from '.$department_name.' department by '.$sender_name.',for your necessary action.-WBMCCF';
				$sms_send = $this->master->sendsms($mobile_no,$template);
                //  SMS SEND CODE    //
				if($this->input->post('module') == 'L'){

					$data_arrays  = array ('approval_status' => 'A',
					'approved_dt'  => date("Y-m-d"),
					 'approved_by' => 'CEO');
                    $wheres  = array('docket_no' => $this->input->post('docket_no'));
                    $this->notesheet_model->f_edits('td_leave_dtls',$data_arrays,$wheres);
				}
				$this->session->set_flashdata('success', 'File Submitted and closed Successfully');
			}else{

				$this->master->f_edit('td_file',array('creater_forward'=> '0'),array('file_no'=> $this->input->post('fileno')));
				$this->session->set_flashdata('error', 'File rejected and closed Successfully');
			}
			redirect('index.php/ceo/');
		}

	}
	
}
