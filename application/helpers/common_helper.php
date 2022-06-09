<?php 

    function totaldocument($docket_no){
        $CI = &get_instance(); 
        $CI->load->database();
        $sql = 'SELECT count(docket_no) as cnt FROM `td_document` where docket_no="'.$docket_no.'" ';
        $result = $CI->db->query($sql)->row(); 
        return  $result->cnt;
    }
    function docketfrdto($docket_no){
        $CI = &get_instance(); 
        $CI->load->database();
        $sql = 'SELECT ifnull(b.first_name,0) as fname FROM md_users b,td_document a where a.fwd_to = b.id and
        a.docket_no="'.$docket_no.'" ';
        $result = $CI->db->query($sql)->row(); 
        if($result){
            return  $result->fname;
        }else{
            return  'Not found';
        }
    }
    function docketfrdby($docket_no,$var){
        $CI = &get_instance(); 
        $CI->load->database();
        $sql = 'SELECT ifnull(b.first_name,0) as fname,a.fwd_at FROM md_users b,td_document a where a.fwd_to = b.id and
        a.docket_no="'.$docket_no.'" ';
        $result = $CI->db->query($sql)->row(); 
        if($result){
            if($var=='NAME'){
                return  $result->fname;
            }else{
                return  $result->fwd_at;
            }
            
        }else{
            return  'Not found';
        }
    }


?>