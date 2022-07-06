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

	public function salary_notesheet(){
            $salary['empstatus']=$this->notesheet_model->f_get_empstatus();
			$sladetail=$this->notesheet_model->f_get_particulars('td_salary',NULL,array('file_no'=>$this->input->get('fileno')),1);
            $salary['salarydetail'] = $this->notesheet_model->f_get_particulars('td_salary',NULL,array('file_no'=>$this->input->get('fileno')),1);
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
            $salary['remarks']  = $this->master->f_get_particulars('td_track_file',NULL,array('file_no'=>$this->input->get('fileno')),0);
            $this->load->view('common/header');
            $this->load->view("ptint/salary_notesheet", $salary);
            $this->load->view('common/footer');
	}

    public function leave_notesheet(){

        $file_no = $this->input->get('fileno');
        $result  = $this->master->f_get_particulars('td_file',array('application_no'),array('file_no'=>$file_no),1);
        $data['data'] = $this->notesheet_model->f_get_particulars('td_leave_dtls',NULL,array('docket_no'=>$result->application_no),1) ;
        $this->load->view('common/header');
        $this->load->view("ptint/leave_notesheet", $data);
        $this->load->view('common/footer');
    }



	
}
