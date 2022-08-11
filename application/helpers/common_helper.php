<?php 

    function getIndianCurrency($number)
    {
            $decimal = round($number - ($no = floor($number)), 2) * 100;
            $hundred = null;
            $digits_length = strlen($no);
            $i = 0;
            $str = array();
            $words = array(0 => '', 1 => 'One', 2 => 'Two',
                3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
                7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
                13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
                16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
                19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
                40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
                70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
            $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
            while( $i < $digits_length ) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += $divider == 10 ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
                } else $str[] = null;
            }
            $Rupees = implode('', array_reverse($str));
            $paise = ($decimal) ? "and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
            return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise .' Only.';
    }
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
    function user_fist($id){
        $CI = &get_instance(); 
        $CI->load->database();
        $sql = 'SELECT * FROM md_users where a.id = "'.$id.'" ';
        $result = $CI->db->query($sql)->row(); 
        if($result){
            return  $result;
        }else{
            return  'Not found';
        }
    }

?>