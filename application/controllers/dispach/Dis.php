<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dis extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Login_Process');
		$this->load->helper('common');
		//For User's Authentication
        if(!isset($this->session->userdata('uloggedin')->phone_no)){
            redirect('auth/verification/');
        }
    }

	//  *****  Code Docket Number List  ***** //
	public function index(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			$data['start_date'] = $this->input->post('from_dt');;
			$data['end_date'] = $this->input->post('to_dt');
		}else{
			$data['start_date'] = date('Y-m-d', strtotime('-30 days')); //date('Y-m-01');
			$data['end_date'] = date('Y-m-d');
		}
        $select  = array('a.*','b.first_name');
		$where   = array('a.created_by = b.id' => NULL,
						'a.docket_dt >=' => $data['start_date'],
						'a.docket_dt <=' => $data['end_date'],
						'a.created_by' => $this->session->userdata('uloggedin')->id,
					    '1 order by a.docket_dt desc' => NULL );
		$data['dockets']   = $this->master->f_get_particulars('td_docket_no a,md_users b',$select,$where,0);
		$this->load->view('common/header');
		$this->load->view('dispach/docket',$data);
		$this->load->view('common/footer');
	}

	//  *****  Code for generate Docket list    *****  //
	public function gen_docket(){
		$where = array('fin_year' => 1);
		$sess = SESSION_YEAR;
		$data  = $this->master->f_get_particulars('td_docket_no','ifnull(max(sl_no),0) as sl_no',NULL,1);
		$sl    = $data->sl_no;
		$data_array = array(
						'docket_dt' => date('Y-m-d'),
						'fin_year'  => $this->session->userdata('session_year_id'),
						'sl_no'     => ($sl+1),
						'docket_no' => $sess.'-'.($sl+1),
						'created_by' => $this->session->userdata('uloggedin')->id,
						'created_at'=> date("Y-m-d h:i:s")
		               );
		$id = $this->master->f_insert('td_docket_no',$data_array);
		if($id){
			echo 'Docket No '.$sess.'-'.($sl+1).' generated Scessfully';
		}else{
			echo 'Docket No not generated Scessfully';
		}

	}

	//  *****   Code for uploaded list for data in docket no  *****   //
	public function upload(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
		  $where = array('group by docket_no' => NULL);	
		  //$data['dockets']  = $this->master->f_get_particulars('td_docket_no',NULL,NULL,0);
		  $data['dockets']  = $this->input->post('docket_no');
		  $view = $this->load->view('dispach/uploaddata',$data);
		  return $view;
		}else{
			$sql = 'select DISTINCT docket_no from td_document';
            $data['docs']  = $this->db->query($sql)->result();
			$this->load->view('common/header');
			$this->load->view('dispach/doclist',$data);
			$this->load->view('common/footer');
		}

	}

	//  *****  Code for  Document list by docket no    *****   // 
	public function docdetail(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
		  $dwhere = array('a.created_by=b.id'=>NULL);
		  $data['dkt']   = $this->master->f_get_particulars('td_docket_no a,md_users b',array('a.*','b.first_name'),$dwhere,1);
		  $where = array('docket_no' => $this->input->post('docket_no'));
		  $data['docs']  = $this->master->f_get_particulars('td_document',NULL,$where,0);
		  $data['status'] = $this->master->f_get_particulars('td_doc_track',array('ifnull(count(*),0) as cnt'),array('docket_no' => $this->input->post('docket_no')),1);
		  $view = $this->load->view('dispach/documentdetail',$data);
		  return $view;
		}
	}

	//  *****  Code for  Valid Docket No *****   // 
	public function docket_check(){

		$docket_no = trim($this->input->post('docket_no'));
		$query = $this->db->get_where('td_docket_no', array('docket_no =' => $docket_no))->result();
		echo count($query);
	}

	//  *****  Code for  Adding Document *****   // 
	public function add_doc(){

		$docket_no = $this->input->post('docket_no');
		$name = $this->input->post('name');
		$file      = $_FILES["fileToUpload"]["name"];
		$error = '';
		$error_count = 0 ;
		$success_count = 0;
		//$old = umask(0);
		$target_dir = './uploads/'.$docket_no.'/';
		// to mkdir() must be specified.
		if(!file_exists($target_dir)){
			if (!mkdir($target_dir, 0777, true)) {
				$error = 'Failed to create directories...';
			}
		}
        //foreach($_FILES["fileToUpload"]["tmp_name"] as $key=>$tmp_name) {
		for($key=0;$key<sizeof($file);$key++){
			$filename=$_FILES["fileToUpload"]["name"][$key];
			//$extension=end(explode(".", $filename));
			$tmp = explode('.', $filename);
            $extension = end($tmp);
			$newfilename=$key.time().".".$extension;
			//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$key]);
			$target_file = $target_dir . $newfilename;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
			// Check if image file is a actual image or fake image
			// if($check == false) {
			//echo (mime_content_type($_FILES["fileToUpload"]["tmp_name"][$key]));
			// 	$uploadOk = 0;
			// 	//$error .= "File is an image - " . $check["mime"] . ".";
			// }
					// 1000000 => 1MB
			if ($_FILES["fileToUpload"]["size"][$key] > 8000000) {
			$error .= "Sorry, your file is too large.";
			$uploadOk = 0;
			}
			//Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "pdf"){
			//&& $imageFileType != "xlsx" && $imageFileType != "txt" && $imageFileType != "docx"
			//echo "Sorry, only JPG, JPEG, PNG  files are allowed.";
			$error .= "only JPG, JPEG, PDF  files are allowed.";
			$uploadOk = 0;
			}
           
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 1) {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
					$data_array = array(
						'upload_dt'  => date('Y-m-d'),
						'docket_no'  => $docket_no,
						'name'       => $name[$key],
						'document'   => $newfilename,
						'remarks'    => $this->input->post('remarks'),
						'upld_by'    => $this->session->userdata('uloggedin')->id,
						'upld_at'    => date("Y-m-d h:i:s")
					);
					$id = $this->master->f_insert('td_document',$data_array);
					$success_count++;

				}else{
					$error_count++;
				}
			}
		
		}
		
		if( $error_count > 0){
			echo '<script language="javascript">';
			echo 'alert("'.$error_count.' Document Server not Allowing to upload Document")';
			echo '</script>';
			$this->session->set_flashdata('success', ''.$success_count.' Document Uploaded Successfully');
			redirect(base_url().'index.php/dispach/');
		}else{
			$this->session->set_flashdata('success', ''.$success_count.' Document Uploaded Successfully');
			redirect(base_url().'index.php/dispach/');
		}
	
	}

	//  *****  Code for deleting document   *****    //
	public function del_doc(){

		$data = explode('/',$this->input->post('sl_no'));
		$where = array('sl_no'=>$data[0]);
		//$path  = $_SERVER['DOCUMENT_ROOT'].'/eportal/uploads/'.$data[1].'/'.$data[2];
		$path  = 'uploads/'.$data[1].'/'.$data[2];
		unlink($path); 
		$res = $this->db->delete('td_document', $where);
		$affected_rows = $this->db->affected_rows();
		if($affected_rows == 0){
			echo 0;
		}else{
			echo 1;
		}
	}

	//  *****  Code for Forward From Dispatch   *****    //
	public function forward(){
		$dwhere = array(//'docket_no in(SELECT distinct docket_no from td_document)'=>NULL,
			            'fin_year'=>$this->session->userdata('session_year_id'),
						'created_by'=> $this->session->userdata('uloggedin')->id,
						'status'=>'0'
					     );
		$data['dockets'] = $this->master->f_get_particulars('td_docket_no',array('docket_no'),$dwhere,0);
		$this->load->view('common/header');
		$this->load->view('dispach/forward',$data);
		$this->load->view('common/footer');
	}

	//   *****   Get document detail on particular docket   *****  //
	public function docket_detail(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			
			$where = array('docket_no' => $this->input->post('docket_no'));
			$docket_no = trim($this->input->post('docket_no'));
			$query = $this->db->get_where('td_document', array('docket_no =' => $docket_no))->result();
		
			//if(count($query) > 0){
				$uwhere = array('dept != '=>'Dispatch',
				              //  'id !=' => $this->session->userdata('uloggedin')->id
							);
		        $data['users'] = $this->master->f_get_particulars('md_users',NULL,$uwhere,0);
				$data['depts'] = $this->master->f_get_particulars('md_department',NULL,NULL,0);
			    $select  = array('a.*','b.first_name');
		        $where   = array('a.created_by = b.id' => NULL,
								 'a.docket_no'  => trim($this->input->post('docket_no'))
								);
				$data['docket']  = $this->master->f_get_particulars('td_docket_no a,md_users b',$select,$where,1);
				$data['docs']    = $this->master->f_get_particulars('td_document',NULL,array('fwd_flag' => 'N','docket_no =' => $docket_no),0);
				$view = $this->load->view('dispach/documentblock',$data);
				return $view;
			// }else{
			// 	return 0;
			// }
	
		}
	}

	public function forward_doc(){

		// $this->form_validation->set_rules('received_from', 'Received from', 'required');
		// $this->form_validation->set_rules('bill_memo_no', 'Bill/Memo no', 'required');
		// $this->form_validation->set_rules('subject', 'Subject', 'required');
		// $this->form_validation->set_rules('docket_no', 'Docket no', 'required');
		// $docket_no = $this->input->post('docket_no');
		// if ($this->form_validation->run() == TRUE)
		// {
		$data_array  = array('fwd_dt'  => date('Y-m-d'),
							'docket_no'=>$this->input->post('docket_no'),
		                    'remarks'  => $this->input->post('remarks'),
							'fwd_to' => $this->input->post('user'),
							'fwd_dept' => $this->input->post('dept'),
							'forwarded_by' => $this->session->userdata('uloggedin')->id,
							'forwarded_at' => date("Y-m-d h:i:s")
							);
		$where =array('docket_no' => $this->input->post('docket_no'));
		$docket_array = array('status' => '1',
							  'received_from' => $this->input->post('received_from'),
							  'bill_memo_no' => $this->input->post('bill_memo_no'),
							  'subject' => $this->input->post('subject')
						    );
		$forward_doc_array =  array('fwd_flag'=>'Y',
									'fwd_dept'=>$this->input->post('dept'),
									'fwd_to' => $this->input->post('user'),
									'fwd_by' => $this->session->userdata('uloggedin')->id,
									'fwd_at' => date("Y-m-d h:i:s")
								);			 
		$this->master->f_edit('td_document',$forward_doc_array, $where);
		$this->master->f_insert('td_doc_track',$data_array);
		$this->master->f_edit('td_docket_no',$docket_array, $where);
		$this->session->set_flashdata('success', 'Docket Forwarded Successfully');
		redirect('index.php/dispach/forward');
		// }else{
        //     $validation = validation_errors();
		// 	$this->session->set_flashdata('error', $validation.$docket_no.' Docket Not Forwarded');
		//     redirect('index.php/dispach/forward');
		// }
	}

	//     Search document view page
	public function searchdoc(){
        if($_SERVER['REQUEST_METHOD']=="POST"){

			$data['start_date'] = $this->input->post('from_dt');;
			$data['end_date'] = $this->input->post('to_dt');
			$select  = array('a.*','b.first_name');
			$where   = array('a.created_by = b.id' => NULL,
							'a.docket_dt >=' => $data['start_date'],
							'a.docket_dt <=' => $data['end_date'],
							'1 order by a.docket_dt desc' => NULL );
			$data['dockets']   = $this->master->f_get_particulars('td_docket_no a,md_users b',$select,$where,0);
			$this->load->view('common/header');
			$this->load->view('dispach/search_doc',$data);
			$this->load->view('common/footer');

		}else{
			$data['dockets']   =  '';
			$data['start_date']   =  '';
			
			$this->load->view('common/header');
			$this->load->view('dispach/search_doc',$data);
			$this->load->view('common/footer');
		}
		
	}

	//     ******     Document detail on docket number   ******   ///
	public function docket_detaillist(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			
			$where = array('docket_no' => $this->input->post('docket_no'));
			$docket_no = trim($this->input->post('docket_no'));
			$query = $this->db->get_where('td_document', array('docket_no =' => $docket_no))->result();
		
			
				$select  = array('a.*','b.first_name');
				$where   = array('a.created_by = b.id' => NULL,
							'a.docket_no' => $docket_no );
			   $data['dockets']   = $this->master->f_get_particulars('td_docket_no a,md_users b',$select,$where,0);
			   $view = $this->load->view('dispach/document_detailist',$data);
			   return $view;

			
			
		}
	}

	
}
