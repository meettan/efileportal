<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Trans_model extends CI_Model{

		public function get_forwarded_document($user_id){

			$sql = 'select distinct docket_no,forwarded_at from td_doc_track where fwd_to ="'.$user_id.'" ' ;
            $result = $this->db->query($sql)->result();
			return $result;
			
		}


	}	
?>
