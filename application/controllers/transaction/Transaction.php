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
	
	//  ***** List for forwarded document   *****   //
	public function index(){
		//$data['forwarded']  = $this->trans_model->get_forwarded_document($this->session->userdata('uloggedin')->id);
		$where = array('a.forwarded_by=b.id'=>NULL);
		$select = array('a.*','b.first_name');
		$data['forwarded'] = $this->master->f_get_particulars('td_doc_track a,md_users b',$select,$where,0);
		$this->load->view('common/header');
		$this->load->view('transaction/forwarded_docket',$data);
		$this->load->view('common/footer');
	}

	//  *****  List of files used table  td_file  *****    //
	public function file(){
		$data['files'] = $this->master->f_get_particulars('td_file',NULL,NULL,0);
		$this->load->view('common/header');
		$this->load->view('transaction/file',$data);
		$this->load->view('common/footer');
	}

	//   ******  View for creating add view Screen   *****    //
	public function create_file(){
		$data['depts'] = $this->master->f_get_particulars('md_department',NULL,NULL,0);
		$data['dockets']  = $this->trans_model->get_forwarded_document($this->session->userdata('uloggedin')->id);
		$this->load->view('transaction/createfile',$data);
	}

	//   ******  get file type  on ajax call by selecting department   *****   //
	public function getfiletype(){
		$dept = $this->input->post('dept');
		$data = $this->master->f_get_particulars('md_file_type',array('file_name','file_no'),array('dept_id'=>$dept),0);
		echo json_encode($data);
	}

	// ******  Generate file  on file type  using table td_file  ******  //
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
						'note_sheet'=> $this->input->post('editor1'),
						'created_by' => $this->session->userdata('uloggedin')->id,
						'created_at'=> date("Y-m-d h:i:s")
		               );
		$id = $this->master->f_insert('td_file',$data_array);
		redirect('index.php/transaction/file');

	}

	//  ****   Code for docket detail  using and td_document,td_docket_no
	public function docket_detail(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$where = array('docket_no' => $this->input->post('docket_no'));
			$docket_no = trim($this->input->post('docket_no'));
			$query = $this->db->get_where('td_docket_no', array('docket_no =' => $docket_no))->result();
			if(count($query) > 0){

			   $data['docs']  = $this->master->f_get_particulars('td_document',NULL,array('fwd_flag' => 'Y'),0);
			   $view = $this->load->view('transaction/documentblock',$data);
			   return $view;

			}else{
				echo 0;
			}
			
		}
	}
	//  *****  Code for  Document list by docket no    *****   // 
	public function docket_view(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
		  $dwhere = array('a.created_by=b.id'=>NULL,
							'a.docket_no'=>trim($this->input->post('docket_no')));
		  $data['dkt']   = $this->master->f_get_particulars('td_docket_no a,md_users b',array('a.*','b.first_name'),$dwhere,1);
		  $where = array('docket_no' => trim($this->input->post('docket_no')));
		  $data['docs']  = $this->master->f_get_particulars('td_document',NULL,$where,0);
		  $data['status'] = $this->master->f_get_particulars('td_doc_track',array('ifnull(count(*),0) as cnt'),array('docket_no' => $this->input->post('docket_no')),1);
		  $data['remarks'] = $this->master->f_get_particulars('td_doc_track',array('remarks'),
		  								array('docket_no' => $this->input->post('docket_no'),
											  'fwd_to' =>$this->session->userdata('uloggedin')->id ),1);
		  $view = $this->load->view('transaction/docket_view',$data);
		  return $view;
		}
	}
	public function docdetail(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
		  $fdetail = explode('/',$this->input->post('docket_no'));
		  $where = array('docket_no' => $fdetail[0]);
		  $data['docs']   = $this->master->f_get_particulars('td_document',NULL,NULL,0);
		  $data['fileno'] = $fdetail[1];
		  $whereu = array('dept != '=>'Dispatch');
		  $data['users'] = $this->master->f_get_particulars('md_users',NULL,$whereu,0);
		  $view = $this->load->view('transaction/documentdetail',$data);
		  return $view;
		}

	}

	//   Code for printing notesheet after generating file using table td_file  ****  ///
	public function print_notesheet(){
		$fileno = $this->input->get('fileno');
		$data['notesheet'] = $this->master->f_get_particulars('td_file',NULL,array('file_no'=>$fileno),1);
		$this->load->view('transaction/notesheet',$data);
		
	}

	//    Code for editing file detail using table td_file    *****   ///
	public function editfile(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$data_array =array('docket_no' => $this->input->post('docket'),
								'note_sheet'=>$this->input->post('editor1'),
								'modified_by' =>$this->session->userdata('uloggedin')->id ,
							    'modified_at' =>date("Y-m-d h:i:s")
							);
			$where  = array('file_no'=>$this->input->post('fileno'));
			$this->master->f_edit('td_file',$data_array,$where);

		redirect('index.php/transaction/file');
		}else{
		$fdetail = explode('/',$this->input->get('filedetail'));
		$data['fdetail'] = $this->master->f_get_particulars('td_file',NULL,array('file_no' =>$fdetail[1] ),1);
		$data['depts']   = $this->master->f_get_particulars('md_department',NULL,NULL,0);
		$data['dockets'] = $this->trans_model->get_forwarded_document('td_document');
		$this->load->view('transaction/editfile',$data);
		}

	}

	//   ******    Code for deleting file using table td_file     *****  ///
	public function del_file(){
		
		$where = array('file_no'=>$this->input->post('fileno'));
		$res = $this->db->delete('td_file', $where);
		$affected_rows = $this->db->affected_rows();
		if($affected_rows == 0){
			echo 0;
		}else{
			echo 1;
		}

	}

	//  *****  Code for forwarding file to respect department using table td_track_file  *****  ///  
	public function file_forward(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			$data = array(
				    'fwd_dt' => date('Y-m-d'),
					'file_no'=> $this->input->post('fileno'),
					'remarks' => $this->input->post('remarks'),
					'fwd_status' => $this->input->post('fwd_status'),
					'fwd_to' =>$this->input->post('user'),
					'created_by' =>$this->session->userdata('uloggedin')->id,
					'created_at' =>date("Y-m-d h:i:s"));
			$this->master->f_insert('td_track_file',$data);
			redirect('index.php/transaction/file');
		}

	}

	/// *****  Code  for track file on using table td_track_file ****   //
	public function file_track(){

		$where = array('a.fwd_to=b.id'=>NULL);
		$data['files'] = $this->master->f_get_particulars('td_track_file a,md_users b',NULL,$where,0);
		$this->load->view('common/header');
		$this->load->view('transaction/file_track',$data);
		$this->load->view('common/footer');

	}

	
}
