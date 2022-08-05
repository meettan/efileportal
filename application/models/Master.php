<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Model {

    public function f_get_particulars($table_name, $select=NULL, $where=NULL, $flag=NULL) {
        
        if(isset($select)) {
            $this->db->select($select);
        }

        if(isset($where)) {
            $this->db->where($where);
        }

        $result		=	$this->db->get($table_name);

        if($flag == 1) {
            return $result->row();
        }else {
            return $result->result();
        }

    }

    //For Where in Clause for employees
    public function f_get_particulars_in($table_name, $where_in=NULL, $where=NULL) {

        if(isset($where)){
            $this->db->where($where);
        }

        if(isset($where_in)){
            $this->db->where_in('sl_no', $where_in);
        }
        
        $result	=	$this->db->get($table_name);
        return $result->result();
    }

    public function f_get_distinct($table_name, $select=NULL, $where=NULL) {

        $this->db->distinct();
        if(isset($select)) {
            $this->db->select($select);
        }

        if(isset($where)) {
            $this->db->where($where);
        }

        $result		=	$this->db->get($table_name);
        return $result->result();
        
    }

    //For inserting row

    public function f_insert($table_name, $data_array) {

        $this->db->insert($table_name, $data_array);
        return $this->db->affected_rows();

    }

    //For Inserting Multiple Row

    public function f_insert_multiple($table_name, $data_array){

        $this->db->insert_batch($table_name, $data_array);
        return;

    }

    //For Editing row

    public function f_edit($table_name, $data_array, $where) {

        $this->db->where($where);
        $this->db->update($table_name, $data_array);
        return;
    }

    //For Deliting row

    public function f_delete($table_name, $where) {

        $this->db->delete($table_name, $where);
        return;
    }
    public function sendsms($to,$message){

        $data_array = array('mobile_no'=>$to,'message'=>$message);
        $id = $this->f_insert('send_sms',$data_array);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://bulksms.sssplsales.in/api/api_http.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('username' => 'SYNERGIC','password' => 'SYN@526RGC','senderid' => 'SYNRGC','to' => '9007507220','text' => 'Dear lokesh File No. Demo123 has been forwarded to you from administration department by arka,for your necessary action.-SYNERGIC','route' => 'Informative','type' => 'text'),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }
    

}