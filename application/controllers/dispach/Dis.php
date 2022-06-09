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
		  $data['dockets']  = $this->master->f_get_particulars('td_docket_no',NULL,NULL,0);
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
			//print_r($file);
			//die();
			// Check if image file is a actual image or fake image
			// $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$key]);
			// if($check == false) {
			// 	$uploadOk = 0;
			// 	//$error .= "File is an image - " . $check["mime"] . ".";
			// }

			// Check file size   500000=> 500KB file  allow size 100KB
			if ($_FILES["fileToUpload"]["size"][$key] > 100000) {
			$error .= "Sorry, your file is too large.";
			$uploadOk = 0;
			}

			//Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "pdf" && $imageFileType != "xlsx" && $imageFileType != "txt" && $imageFileType != "docx") {
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
					//echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$key])). " has been uploaded.";
				}
			}
		
		}
       redirect(base_url().'index.php/dispach/upload/');
	
	}

	//  *****  Code for deleting document   *****    //
	public function del_doc(){

		$data = explode('/',$this->input->post('sl_no'));
		$where = array('sl_no'=>$data[0]);
		$path  = $_SERVER['DOCUMENT_ROOT'].'/eportal/uploads/'.$data[1].'/'.$data[2];
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
		
		$dwhere = array('fin_year'=>$this->session->userdata('session_year_id'),
						'status'=>'0');
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
		
			if(count($query) > 0){
				$uwhere = array('dept != '=>'Dispatch');
		        $data['users'] = $this->master->f_get_particulars('md_users',NULL,$uwhere,0);
			    $select  = array('a.*','b.first_name');
		        $where   = array('a.created_by = b.id' => NULL,
								'a.docket_no'  => trim($this->input->post('docket_no'))
								);
				$data['docket']  = $this->master->f_get_particulars('td_docket_no a,md_users b',$select,$where,1);
				$data['docs']    = $this->master->f_get_particulars('td_document',NULL,array('fwd_flag' => 'N'),0);
				$view = $this->load->view('dispach/documentblock',$data);
				return $view;

			}else{

				return 0;
			}
	
		}
	}

	public function forward_doc(){

		$data_array  = array('fwd_flag'=>'Y',
							'fwd_to' => $this->input->post('user'),
							'fwd_by' => $this->session->userdata('uloggedin')->id,
							'fwd_at' => date("Y-m-d h:i:s")
							);
		$where =array('docket_no' => $this->input->post('docket_no'));					 
		$this->master->f_edit('td_document',$data_array, $where);
		$this->master->f_edit('td_docket_no',array('status' => '1'), $where);
		$this->session->set_flashdata('success', 'Docket Forwarded Successfully');

		redirect('index.php/dispach/forward');
	}

	//     Search document view page
	public function searchdoc(){

		$this->load->view('common/header');
		$this->load->view('dispach/search_doc');
		$this->load->view('common/footer');
	}

	//     ******     Document detail on docket number   ******   ///
	public function docket_detaillist(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			
			$where = array('docket_no' => $this->input->post('docket_no'));
			$docket_no = trim($this->input->post('docket_no'));
			$query = $this->db->get_where('td_docket_no', array('docket_no =' => $docket_no))->result();
		
			if(count($query) > 0){
				$select = array('a.*','b.first_name');
				$where = array('a.fwd_to = b.id' => NULL,
							   'a.fwd_flag' => 'Y');

			   $data['docs']  = $this->master->f_get_particulars('td_document a,md_users b',$select,$where,0);
			   $view = $this->load->view('dispach/document_detailist',$data);
			   return $view;

			}else{
				echo 0;
			}
			
		}
	}

	
}
