<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaction extends CI_Controller {

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
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$data['fr_date'] = $this->input->post('fr_date');
			$data['to_date'] = $this->input->post('to_date');	
		
		$select = array('a.*','b.first_name');
		$where  = array('a.created_by = b.id' => NULL,
		                'a.created_by'=>$this->session->userdata('uloggedin')->id,
						'a.file_date >=' => $data['fr_date'],
						'a.file_date <=' => $data['to_date'],
						'a.creater_forward'=> '0',
						'1 order by a.file_date desc'=>NULL);
		$data['files'] = $this->master->f_get_particulars('td_file a,md_users b',$select,$where,0);
		$this->load->view('common/header');
		$this->load->view('transaction/file',$data);
		$this->load->view('common/footer');
		}else{
			$data['fr_date'] = date("Y-m-d", strtotime("-1 months"));
			$data['to_date'] = date("Y-m-d");
		$select = array('a.*','b.first_name');
		$where  = array('a.created_by = b.id' => NULL,
		                'a.created_by'=>$this->session->userdata('uloggedin')->id,
						'a.file_date >=' => $data['fr_date'],
						'a.file_date <=' => $data['to_date'],
						'a.creater_forward'=> '0',
						'1 order by a.file_date desc'=>NULL);
		$data['files'] = $this->master->f_get_particulars('td_file a,md_users b',$select,$where,0);
		$this->load->view('common/header');
		$this->load->view('transaction/file',$data);
		$this->load->view('common/footer');
		}
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
		// $this->form_validation->set_rules('received_from', 'Received from', 'required');
		// $this->form_validation->set_rules('bill_memo_no', 'Bill/Memo no', 'required');
		// $this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('docket', 'Docket no', 'required');
		if ($this->form_validation->run() == TRUE)
		{

		$sess = SESSION_YEAR;
		$data  = $this->master->f_get_particulars('td_file','ifnull(max(sl_no),0) as sl_no',NULL,1);
		$sl    = $data->sl_no;
		$file_type = $this->input->post('filetype');
		$data_array = array(
						'file_date' => date('Y-m-d'),
						'sl_no'     => ($sl+1),
						'fin_year'  => $this->session->userdata('session_year_id'),
						'dept_no'   => $this->input->post('dept'),
						'module'    => $this->input->post('module'),
						'docket_no' => $this->input->post('docket'),
					//	'received_from' => $this->input->post('received_from'),
					//	'bill_memo_no' => $this->input->post('bill_memo_no'),
					//	'subject' => $this->input->post('subject'),
						'file_no'   => $file_type.'-'.$sess.'-'.($sl+1),
						'note_sheet'=> $this->input->post('editor1'),
						'created_by' => $this->session->userdata('uloggedin')->id,
						'created_at'=> date("Y-m-d h:i:s")
		               );
		    $id = $this->master->f_insert('td_file',$data_array);
			// $file      = $_FILES["fileToUpload"]["name"];
			// $name      = $this->input->post('name');
			// $error = '';
			// $error_count = 0 ;
			// $success_count = 0;
			// $file_no = $file_type.'-'.$sess.'-'.($sl+1);
			// //$old = umask(0);
			// $target_dir = './uploads/'.$file_no.'/';
			// if(!file_exists($target_dir)){
			// 	if (!mkdir($target_dir, 0777, true)) {
			// 		$error = 'Failed to create directories...';
			// 	}
			// }
			// for($key=0;$key<sizeof($file);$key++){
			// 	$filename=$_FILES["fileToUpload"]["name"][$key];
			// 	$tmp = explode('.', $filename);
			// 	$extension = end($tmp);
			// 	$newfilename=$key.time().".".$extension;
			// 	$target_file = $target_dir . $newfilename;
			// 	$uploadOk = 1;
			// 	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// 	if ($_FILES["fileToUpload"]["size"][$key] > 8000000) {
			// 	$error .= "Sorry, your file is too large.";
			// 	$uploadOk = 0;
			// 	}
			// 	//Allow certain file formats
			// 	if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "pdf"){
			// 	$error .= "only JPG, JPEG, PDF  files are allowed.";
			// 	$uploadOk = 0;
			// 	}
			// 	if ($uploadOk == 1) {
			// 		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
			// 			$data_array = array(
			// 				'upload_dt'  => date('Y-m-d'),
			// 				'file_no'  => $file_no,
			// 				'name'       => $name[$key],
			// 				'document'   => $newfilename,
			// 				'upld_by'    => $this->session->userdata('uloggedin')->id,
			// 				'upld_at'    => date("Y-m-d h:i:s")
			// 			);
			// 			$id = $this->master->f_insert('td_file_document',$data_array);
			// 			$success_count++;
			// 		}else{
			// 			$error_count++;
			// 		}
			// 	}
			// }
		redirect('index.php/transaction/file');
		}else{
			$validation = validation_errors();
			$this->session->set_flashdata('error', $validation.' File Not Created');
			redirect('index.php/transaction/file');
		}
	}

	public function docket_content_detail(){
			$module = $this->input->post('module');
			$docket_no = $this->input->post('docket_no');
		$string = '';
		if($module == 'L') {
			$data = $this->notesheet_model->f_get_particulars('td_leave_dtls',NULL,array('docket_no'=>$docket_no),1) ;
			if($data){
				$bata['leave'] = $this->notesheet_model->f_get_particulars('td_leave_dtls',NULL,array('docket_no'=>$docket_no),1) ;
			return $this->load->view('transaction/leave/leave_data',$bata);
			}else{
				return	$string ='';
			}
		}else if($module == 'S'){

			$salary['empstatus']=$this->notesheet_model->f_get_empstatus();
			$sladetail=$this->notesheet_model->f_get_particulars('td_salary',NULL,array('docket_no'=>$docket_no),1);
            $salary['salarydetail'] = $this->notesheet_model->f_get_particulars('td_salary',NULL,array('docket_no'=>$docket_no),1);
			$select     =   array("emp_code");
            $where      =   array(
							"emp_catg"  =>  $sladetail->catg_cd,
							"emp_status" => 'A');
            $emp_id     =   $this->notesheet_model->f_get_particulars("md_employee", $select, $where, 0);

            //Temp variable for emp_list
            $eid_list   =   [];
            for($i = 0; $i < count($emp_id); $i++) {

                array_push($eid_list, $emp_id[$i]->emp_code);
            }
            //List of Salary Category wise
			
            unset($where);
            $where = array (
                "sal_month"     =>  $sladetail->sal_month,
                "sal_year"      =>  $sladetail->sal_year
            );
           
            $salary['list']              =  $this->notesheet_model->f_get_particulars_in("td_pay_slip", $eid_list, $where);
            $salary['attendance_dtls']   =  $this->notesheet_model->f_get_attendance();

            //Employee Group Count
            unset($select);
            unset($where);

            $select =   array(
                "emp_no", "emp_name", "COUNT(emp_name) count"
            );

            $where  =   array(
                "sal_month"     =>  $sladetail->sal_month,
                "sal_year = '".$sladetail->sal_year."' GROUP BY emp_no, emp_name" =>  NULL
            );
			unset($where);
			$where = array (

                "sal_month"     =>  $sladetail->sal_month,
                "sal_year"      =>  $sladetail->sal_year,
                "emp_catg = '". $sladetail->catg_cd."' GROUP BY emp_no,emp_name" =>  NULL
            );

            $salary['count']              =   $this->notesheet_model->f_get_particulars("td_pay_slip", $select, $where, 0);
            unset($where);
    
            $where = array ("sal_month"     =>  $sladetail->sal_month,
                            "sal_year"      =>  $sladetail->sal_year,
                            "emp_catg"      =>  $sladetail->catg_cd);

			$salary['content']     =   $this->notesheet_model->f_get_particulars("td_pay_slip_notesheet", NULL, $where, 0);
            $salary['empstatus']=$this->notesheet_model->f_get_empstatus();
			return $this->load->view('transaction/salary/salary_data',$salary);
		}
		echo $string;
	}
	public function docket_remark_detail(){
		$module = $this->input->post('module');
		$docket_no = $this->input->post('docket_no');
		
	    $string = '';
		if($module == "L") {
			
			$data = $this->notesheet_model->f_get_particulars('td_leave_dtls',NULL,array('docket_no'=>$docket_no),1) ;
			
			if($data){
				$leave = $this->notesheet_model->f_get_particulars('td_leave_dtls',NULL,array('docket_no'=>$docket_no),1) ;
                
				if($leave->leave_type == 'CL'){ $lea = 'Casual Leave';}
								else if($leave->leave_type == 'ML'){ $lea = 'Medical Leave';}
								else if($leave->leave_type == 'EL'){ $lea = 'Earned Leave';}
								else if($leave->leave_type == 'OD'){ $lea = 'Off Day';}
							
				$string .= '<p>So Sri '.$leave->emp_name.' has requested to adjust the leaves in '.$lea.' ground.</p>';
				$string .= "<p>Put up to CEO through ARCS and Deputy Manager for perusal and taking necessary action please. </p>" ;           
							
				echo  $string; 
			}else{
				echo  $string; 
			}
		}
	//echo $string;
    }

	//  ****   Code for docket detail  using and td_document,td_docket_no
	public function docket_detail(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$where = array('docket_no' => $this->input->post('docket_no'));
			$docket_no = trim($this->input->post('docket_no'));
			$query = $this->db->get_where('td_docket_no', array('docket_no =' => $docket_no))->result();
			//if(count($query) > 0){
			   $data['docs']  = $this->master->f_get_particulars('td_document',NULL,array('docket_no'=>$docket_no,'fwd_flag' => 'Y'),0);
			   $view = $this->load->view('transaction/documentblock',$data);
			   return $view;

			//}else{
			//	echo 0;
			//}
			
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
		  $fwhere = array('file_no' => $fdetail[1]);
		  $data['docs']   = $this->master->f_get_particulars('td_document',NULL,$where,0);
		  $data['fdocs']  = $this->master->f_get_particulars('td_file_document',NULL,$fwhere,0);
		  $data['fileno'] = $fdetail[1];
		  $whereu = array('dept != '=>'Dispatch');
		  $data['users'] = $this->master->f_get_particulars('md_users',NULL,$whereu,0);
		  unset($where);
		  $where = array('a.fwd_to = b.id'=>NULL,
			              'a.forwarded_by'=>$this->session->userdata('uloggedin')->id,
						 'a.file_no' =>$fdetail[1]);
		 		 
		  $data['filestatus'] = $this->master->f_get_particulars('td_track_file a,md_users b',array('a.forwarded_at','a.remarks','b.first_name'),$where,1);
		  $data['filedtl'] = $this->master->f_get_particulars('td_file',NULL,array('file_no'=>$fdetail[1]),1);
		  $str2 = substr($fdetail[1],0,1); 
		  if($str2 == 'L') {
			$data['leave'] = $this->notesheet_model->f_get_particulars('td_leave_dtls',NULL,array('docket_no'=>$fdetail[0]),1) ;
          
		  }else{
			$data['leave'] = '';
		  }
		  $view = $this->load->view('transaction/documentdetail',$data);
		  return $view;
		}

	}

	//   Code for printing notesheet after generating file using table td_file  ****  ///
	public function print_notesheet(){
		$fileno = $this->input->get('fileno');
		$data['notesheet'] = $this->master->f_get_particulars('td_file',NULL,array('file_no'=>$fileno),1);
		$data['comment_author'] = $this->master->f_get_particulars('td_track_file a,md_users b',array('a.*','b.first_name'),array('a.forwarded_by = b.id'=> NULL,'file_no' =>$fileno),0);
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
		$str2 = substr($fdetail[1],0,1); 
		  if($str2 == 'L') {
			$data['leave'] = $this->notesheet_model->f_get_particulars('td_leave_dtls',NULL,array('docket_no'=>$fdetail[0]),1) ;
		  }else{
			$data['leave'] = '';
		  }
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
			$result = $this->master->f_get_particulars('td_file',NULL,array('file_no'=> $this->input->post('fileno')),1);
			$url = $this->input->post('url');
			$data = array(
				    'fwd_dt' => date('Y-m-d'),
					'file_no'=> $this->input->post('fileno'),
					//'remarks' => $this->input->post('remarks'),
					'fwd_status' => 'A',
					'fwd_dept'=> $result->dept_no,
					'fwd_to'  => $this->input->post('user'),
					'forwarded_by' =>$this->session->userdata('uloggedin')->id,
					'forwarded_at' =>date("Y-m-d h:i:s"));
			$this->master->f_insert('td_track_file',$data);
			$created_by = $this->input->post('created_by');
			if($created_by == $this->session->userdata('uloggedin')->id){
				$this->master->f_edit('td_file',array('creater_forward'=> '1'),array('file_no'=> $this->input->post('fileno')));
			}
			$this->session->set_flashdata('success', 'File Forwarded Successfully');
			if($url == 'file'){
				redirect('index.php/transaction/file');
			}else{
				redirect('index.php/transaction/forwarded_file');
			}
			
		}

	}
	public function file_reject(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			$result = $this->master->f_get_particulars('td_file',NULL,array('file_no'=> $this->input->post('fileno')),1);
			$url = $this->input->post('url');
			$data = array(
				    'fwd_dt' => date('Y-m-d'),
					'file_no'=> $this->input->post('fileno'),
					'remarks' => $this->input->post('remarks'),
					'fwd_status' => 'R',
					'fwd_dept'=> $result->dept_no,
					'fwd_to'  => $result->created_by,
					'forwarded_by' =>$this->session->userdata('uloggedin')->id,
					'forwarded_at' =>date("Y-m-d h:i:s"));
			$this->master->f_insert('td_track_file',$data);
			//$created_by = $this->input->post('created_by');
			$this->master->f_edit('td_file',array('creater_forward'=> '0'),array('file_no'=> $this->input->post('fileno')));
			$this->session->set_flashdata('error', 'File Rejected Successfully');

			$url = base_url().'index.php/transaction/forwarded_file';
			
			echo $url;
		}

	}
	
	public function forwarded_file(){
        $data['title']   = 'Forward Files';
		$where = array('a.forwarded_by=b.id'=>NULL,
		               'a.file_no = c.file_no'=>NULL,
					    'a.forwarded_by' => $this->session->userdata('uloggedin')->id);
		$data['files'] = $this->master->f_get_particulars('td_track_file a,md_users b,td_file c',array('a.*','b.first_name','b.last_name','c.docket_no'),$where,0);
		$this->load->view('common/header');
		$this->load->view('transaction/track_fwd/file_track',$data);
		$this->load->view('common/footer');

	}
	public function forward_file(){
        $data['title']   = 'Received Files';
		$where = array('a.forwarded_by=b.id'=>NULL,
		               'a.file_no = c.file_no'=>NULL,
					    'a.fwd_to' => $this->session->userdata('uloggedin')->id);
		$data['files'] = $this->master->f_get_particulars('td_track_file a,md_users b,td_file c',array('a.*','b.first_name','b.last_name','c.docket_no'),$where,0);
		$selects = array('a.*','b.first_name');
		$wheres  = array('a.created_by = b.id' => NULL,
		                'a.created_by'=>$this->session->userdata('uloggedin')->id,
						'a.creater_forward'=> '0',
						'1 order by a.file_date desc'=>NULL);
		$data['filess'] = $this->master->f_get_particulars('td_file a,md_users b',$selects,$wheres,0);
		$this->load->view('common/header');
		$this->load->view('transaction/track_fwd/fwd_file',$data);
		$this->load->view('common/footer');

	}

	/// *****  Code  for track file on using table td_track_file ****   //
	public function file_track(){
		$data['title']   = 'Received Files';
		$where = array('a.forwarded_by=b.id'=>NULL,
		               'a.file_no = c.file_no'=>NULL,
					    'a.fwd_to' => $this->session->userdata('uloggedin')->id);
		$data['files'] = $this->master->f_get_particulars('td_track_file a,md_users b,td_file c',array('a.*','b.first_name','b.last_name','c.docket_no'),$where,0);
		$this->load->view('common/header');
		$this->load->view('transaction/track_fwd/file_track',$data);
		$this->load->view('common/footer');

	}
	public function filedetail(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
		  $fdetail = explode('/',$this->input->post('docket_no'));
		  $data['url']   = $this->input->post('url');
		  $where = array('docket_no' => $fdetail[0]);
		  $fwhere = array('file_no' => $fdetail[1]);
		  $data['fstatus'] = $fdetail[2];
		 
		  $data['docs']   = $this->master->f_get_particulars('td_document',NULL,$where,0);
		  $data['fdocs']  = $this->master->f_get_particulars('td_file_document',NULL,$fwhere,0);
		  $data['depts'] = $this->master->f_get_particulars('md_department',NULL,NULL,0);
		  $data['fileno'] = $fdetail[1];
		  $whereu = array('dept != '=>'Dispatch',
		                  'id !=' => $this->session->userdata('uloggedin')->id);
		  $data['users'] = $this->master->f_get_particulars('md_users',NULL,$whereu,0);
		  unset($where);
		  $where = array('forwarded_by'=>$this->session->userdata('uloggedin')->id,
						 'file_no' =>$fdetail[1]);
		  $data['filestatus'] = $this->master->f_get_particulars('td_track_file',NULL,$where,1);
		  $data['filedtl'] = $this->master->f_get_particulars('td_file a,md_users b',array('a.*','b.first_name','b.last_name','b.designation'),array('a.created_by = b.id'=> NULL,'a.file_no'=>$fdetail[1]),1);
		  //echo $data['filedtl']->application_no;die();
		  $ft = substr($fdetail[1],0,4); 
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
		  $view = $this->load->view('transaction/track_fwd/file_dtls',$data);
		  return $view;
		}
	}


	public function edit_forward_file(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$data_array =array('docket_no' => $this->input->post('docket'),
								'note_sheet'=>$this->input->post('editor1'),
								'modified_by' =>$this->session->userdata('uloggedin')->id ,
							    'modified_at' =>date("Y-m-d h:i:s")
							);
			$where  = array('file_no'=>$this->input->post('fileno'));
			$this->master->f_edit('td_file',$data_array,$where);

		redirect('index.php/transaction/file_track');
		}else{
		$fdetail = explode('/',$this->input->get('filedetail'));
		$data['fdetail'] = $this->master->f_get_particulars('td_file',NULL,array('file_no' =>$fdetail[1] ),1);
		$data['depts']   = $this->master->f_get_particulars('md_department',NULL,NULL,0);
		$data['dockets'] = $this->trans_model->get_forwarded_document('td_document');
		$str2 = substr($fdetail[1],0,1); 
		  if($str2 == 'L') {
			$data['leave'] = $this->notesheet_model->f_get_particulars('td_leave_dtls',NULL,array('docket_no'=>$fdetail[0]),1) ;
		  }else{
			$data['leave'] = '';
		  }
		$this->load->view('transaction/edit_forward_file',$data);
		}

	}
	

	
}
