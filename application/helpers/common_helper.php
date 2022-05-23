<?php 


function totaldocument($docket_no){
    $CI = &get_instance(); 
    $CI->load->database();
    $sql = 'SELECT count(docket_no) as cnt FROM `td_document` where docket_no="'.$docket_no.'" ';
    $result = $CI->db->query($sql)->row(); 
    return  $result->cnt;
}

?>