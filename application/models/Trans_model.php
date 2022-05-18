<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Trans_model extends CI_Model{

		public function get_forwarded_document($user_id){

			$sql = 'select distinct docket_no,fwd_at from td_document where fwd_to ="2" ' ;
            $result = $this->db->query($sql)->result();
			return $result;
			
		}


	}	
?>
