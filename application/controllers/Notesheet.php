<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notesheet extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Notesheet_model','notesheet_model');
		//For User's Authentication
        if(!isset($this->session->userdata('uloggedin')->phone_no)){
            redirect('auth/verification/');
        }
    }
	
	//  ***** List for forwarded document   *****   //
	public function index(){
		//$data['forwarded']  = $this->trans_model->get_forwarded_document($this->session->userdata('uloggedin')->id);
		// $where = array('a.forwarded_by=b.id'=>NULL);
		// $select = array('a.*','b.first_name');
		// $data['forwarded'] = $this->master->f_get_particulars('td_doc_track a,md_users b',$select,$where,0);
		// $this->load->view('common/header');
		// $this->load->view('transaction/forwarded_docket',$data);
		// $this->load->view('common/footer');
	}

	public function salary_notesheet(){
            //Employee Ids for Salary List
            $salary['empstatus']=$this->notesheet_model->f_get_empstatus();
			$sladetail=$this->notesheet_model->f_get_particulars('td_salary',NULL,array('file_no'=>$this->input->get('fileno')),1);
            $salary['salarydetail'] = $this->notesheet_model->f_get_particulars('td_salary',NULL,array('file_no'=>$this->input->get('fileno')),1);
			$select     =   array("emp_code");
            $where      =   array(
							"emp_catg"  =>  $sladetail->catg_cd,
							"emp_status" => 'A'
                        );
		    
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

                "sal_year = '".$sladetail->sal_year."' GROUP BY emp_no, emp_name"      =>  NULL

            );
			unset($where);
			$where = array (

                "sal_month"     =>  $sladetail->sal_month,
                "sal_year"      =>  $sladetail->sal_year,
				//"emp_catg"      =>  $this->input->post('category')
                "emp_catg = '". $this->input->post('category')."' GROUP BY emp_no,emp_name" =>  NULL

            );

            $salary['count']              =   $this->notesheet_model->f_get_particulars("td_pay_slip", $select, $where, 0);
            unset($where);
    
            $where = array ("sal_month"     =>  $sladetail->sal_month,
                            "sal_year"      =>  $sladetail->sal_year,
                            "emp_catg"      =>  $sladetail->catg_cd);

			$salary['content']     =   $this->notesheet_model->f_get_particulars("td_pay_slip_notesheet", NULL, $where, 0);
            $salary['empstatus']=$this->notesheet_model->f_get_empstatus();
            $this->load->view('common/header');
            $this->load->view("ptint/salary_notesheet", $salary);
            $this->load->view('common/footer');
	}



	
}
