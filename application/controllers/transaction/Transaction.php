<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Trans_model','trans_model');
		//For User's Authentication
        if(!isset($this->session->userdata('uloggedin')->phone_no)){
            redirect('auth/verification/');
        }
    }
	
	public function index(){
		$data['docs']  = $this->trans_model->get_forwarded_document('td_document');
		$this->load->view('common/header');
		$this->load->view('transaction/forwarded_docket',$data);
		$this->load->view('common/footer');
	}
	public function file(){
		$data['files'] = $this->master->f_get_particulars('td_file',NULL,NULL,0);
		$this->load->view('common/header');
		$this->load->view('transaction/file',$data);
		$this->load->view('common/footer');
	}
	public function create_file(){
		$data['depts'] = $this->master->f_get_particulars('md_department',NULL,NULL,0);
		$data['dockets']  = $this->trans_model->get_forwarded_document('td_document');
		$this->load->view('transaction/createfile',$data);
	}
	public function getfiletype(){
		$dept = $this->input->post('dept');
		$data = $this->master->f_get_particulars('md_file_type',array('file_name','file_no'),array('dept_id'=>$dept),0);
		echo json_encode($data);
	}
	public function generatefile(){

		$sess = SESSION_YEAR;
		$data  = $this->master->f_get_particulars('td_file','ifnull(max(sl_no),0) as sl_no',NULL,1);
		$sl    = $data->sl_no;
		$file_type = $this->input->post('filetype');
		$data_array = array(
						'file_date' => date('Y-m-d'),
						'sl_no'     => ($sl+1),
						'fin_year'  => $this->session->userdata('session_year_id'),
						'dept_no'   => $this->input->post('dept'),
						'docket_no' => $this->input->post('docket'),
						'file_no'   => $file_type.'-'.$sess.'-'.($sl+1),
						'created_by' => $this->session->userdata('uloggedin')->phone_no,
						'created_at'=> date("Y-m-d h:i:s")
		               );
		$id = $this->master->f_insert('td_file',$data_array);
		redirect('index.php/transaction/file');

	}

	public function docket_detail(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			
			$where = array('docket_no' => $this->input->post('docket_no'));
			$docket_no = trim($this->input->post('docket_no'));
			$query = $this->db->get_where('td_docket_no', array('docket_no =' => $docket_no))->result();
		
			if(count($query) > 0){

			   $data['docs']  = $this->master->f_get_particulars('td_document',NULL,array('fwd_flag' => 'Y'),0);
			   $view = $this->load->view('dispach/documentblock',$data);
			   return $view;

			}else{
				echo 0;
			}


			
		  }
	}

	
}
