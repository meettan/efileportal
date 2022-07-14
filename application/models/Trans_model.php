<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Trans_model extends CI_Model{

		public function get_forwarded_document($user_id){

			$sql = 'select distinct t1.docket_no,t1.forwarded_at from td_doc_track t1
			LEFT JOIN td_file t2 ON t2.docket_no = t1.docket_no
            WHERE t2.docket_no IS NULL
			AND t1.fwd_to ="'.$user_id.'" ' ;
            $result = $this->db->query($sql)->result();
			return $result;
		}


	}	
?>
