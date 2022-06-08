<?php  defined('BASEPATH') OR exit('No direct script access allowed');

	class Login_Process extends CI_Model{

		public function f_select_password($user_id){
			$this->db->select('password');
			$this->db->where('phone_no',$user_id);
			$this->db->where('user_approve','1');
			$data=$this->db->get('md_users');

			if($data->num_rows() > 0 )
			{
				return $data->row();
			}
			else
			{
				return false;
			}
		}

		public function f_insert_audit_trail($user_id){

			$time = date("Y-m-d h:i:s");
			$pcaddr = $_SERVER['REMOTE_ADDR'];

			$value = array('login_dt'=> $time,
				       'user_id' => $user_id,
			      	       'terminal_name'=>$pcaddr);
			$this->db->insert('td_audit_trail',$value);
		}

		public function f_get_user_inf($user_id){
			$this->db->select('*');
			$this->db->where('phone_no',$user_id);
			$data=$this->db->get('md_users');
			return $data->row();
		}
	
		public function f_get_kms_inf($sl_no){

			$this->db->select('*');
			$this->db->where('sl_no',$sl_no);
			$data = $this->db->get('mm_kms_yr');
			return $data->row();

	    }


		public function f_get_kms_yr(){

			$this->db->select('*');
			$data = $this->db->get('mm_kms_yr');
			return $data->result();
		}
		public function f_update_audit_trail($user_id){
			$time = date("Y-m-d h:i:s");
			$sl_no= $this->session->userdata('sl_no')->sl_no;
			$value= array('logout'=>$time);
			$this->db->where('sl_no',$sl_no);
			$this->db->update('td_audit_trail',$value);
		}
		
		public function f_get_parameters($sl_no){
			$this->db->select('param_value');
			$this->db->where('sl_no',$sl_no);
			$data=$this->db->get('md_parameters');

			if($data->num_rows() > 0 ){
				return $data->row();
			}else{
				return false;
			}
		}
		
		public function f_audit_trail_value($user_id){
    		$this->db->select_max('sl_no');
    		$this->db->where('user_id', $user_id);
    		$details = $this->db->get('td_audit_trail');
    		return $details->row();
    	}

	}	
?>
