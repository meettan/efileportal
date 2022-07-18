<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Notesheet_model extends CI_Model{
		//public $db2 = null;
		function __construct() {
			parent::__construct();
			//$db2 = $this->load->database('db2', TRUE);

			//$db2 = $this->load->database('db2', TRUE);
		}

		public function f_get_particulars($table_name, $select=NULL, $where=NULL, $flag=NULL) {
			$db2 = $this->load->database('db2', TRUE);
			if(isset($select)) {
				$db2->select($select);
			}
	
			if(isset($where)) {
				$db2->where($where);
			}
	
			$result		=	$db2->get($table_name);
			if($flag == 1) {
				return $result->row();
			}else {
				return $result->result();
			}
	
		}
		public function f_get_particulars_in($table_name, $where_in=NULL, $where=NULL) {
			$db2 = $this->load->database('db2', TRUE);
			if(isset($where)){
				$db2->where($where);
			}
			if(isset($where_in)){
				$db2->where_in('emp_no', $where_in);
			}
			$result	=	$db2->get($table_name);
			
			return $result->result();
		}
		public function f_edits($table_name, $data_array, $where) {
			$db2 = $this->load->database('db2', TRUE);
			$db2->where($where);
			$db2->update($table_name, $data_array);
			return;
		}

		public function f_get_empstatus() {
			$db2 = $this->load->database('db2', TRUE);
			$sql	=	"SELECT distinct emp_status from  md_employee ";
			$result = $db2->query($sql);
			return $result->result();
		}
		public function f_get_attendance() {
			$db2 = $this->load->database('db2', TRUE);
			$sql = "SELECT emp_cd, MAX(trans_dt) trans_dt FROM td_attendance
				GROUP BY emp_cd";
												  
			$result		=	$db2->query($sql);	
			if($result->num_rows() > 0){

				foreach($result->result() as $row) {
					$where = array(
						"emp_cd"	=>	$row->emp_cd,
						"trans_dt"	=>	$row->trans_dt
					);
					$data[] = $this->f_get_particulars("td_attendance", NULL, $where, 1);
				}
				return $data;
			}
			else{
				return false;
			}

		}




	}	
?>
