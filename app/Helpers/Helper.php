<?php // Code within app\Helpers\Helper.php

    function formatDateThai($strDate) {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("d",strtotime($strDate));
        $strHour= date("H",strtotime($strDate));
        $strMinute= date("i",strtotime($strDate));
        $strSeconds= date("s",strtotime($strDate));
        //$strMonthCut = Array("" , "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฟษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        // $strMonthCut = Array("","01","02","03","04","05","06","07","08","09","10","11","12");
        $strMonthThai=$strMonthCut[$strMonth];

        return $strDay." ".$strMonthThai." ".$strYear;
    }

    function formatDateThaiShort($strDate) {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("d",strtotime($strDate));
        $strHour= date("H",strtotime($strDate));
        $strMinute= date("i",strtotime($strDate));
        $strSeconds= date("s",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];

        return $strDay." ".$strMonthThai." ".substr($strYear,2,3);
    }

    function formatDateThaiLong($strDate) {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("d",strtotime($strDate));
        $strHour= date("H",strtotime($strDate));
        $strMinute= date("i",strtotime($strDate));
        $strSeconds= date("s",strtotime($strDate));
        $strMonthCut = Array("" , "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฟษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];

        return $strDay." ".$strMonthThai." ".$strYear;
    }
    const BAHT_TEXT_NUMBERS = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
    const BAHT_TEXT_UNITS = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
    const BAHT_TEXT_ONE_IN_TENTH = 'เอ็ด';
    const BAHT_TEXT_TWENTY = 'ยี่';
    const BAHT_TEXT_INTEGER = 'ถ้วน';
    const BAHT_TEXT_BAHT = 'บาท';
    const BAHT_TEXT_SATANG = 'สตางค์';
    const BAHT_TEXT_POINT = 'จุด';
    
    /**
     * Convert baht number to Thai text
     * @param double|int $number
     * @param bool $include_unit
     * @param bool $display_zero
     * @return string|null
     */
    function baht_text ($number, $include_unit = true, $display_zero = true)
    {
        if (!is_numeric($number)) {
            return null;
        }
    
        $log = floor(log($number, 10));
        if ($log > 5) {
            $millions = floor($log / 6);
            $million_value = pow(1000000, $millions);
            $normalised_million = floor($number / $million_value);
            $rest = $number - ($normalised_million * $million_value);
            $millions_text = '';
            for ($i = 0; $i < $millions; $i++) {
                $millions_text .= BAHT_TEXT_UNITS[6];
            }
            return baht_text($normalised_million, false) . $millions_text . baht_text($rest, true, false);
        }
    
        $number_str = (string)floor($number);
        $text = '';
        $unit = 0;
    
        if ($display_zero && $number_str == '0') {
            $text = BAHT_TEXT_NUMBERS[0];
        } else for ($i = strlen($number_str) - 1; $i > -1; $i--) {
            $current_number = (int)$number_str[$i];
    
            $unit_text = '';
            if ($unit == 0 && $i > 0) {
                $previous_number = isset($number_str[$i - 1]) ? (int)$number_str[$i - 1] : 0;
                if ($current_number == 1 && $previous_number > 0) {
                    $unit_text .= BAHT_TEXT_ONE_IN_TENTH;
                } else if ($current_number > 0) {
                    $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
                }
            } else if ($unit == 1 && $current_number == 2) {
                $unit_text .= BAHT_TEXT_TWENTY;
            } else if ($current_number > 0 && ($unit != 1 || $current_number != 1)) {
                $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
            }
    
            if ($current_number > 0) {
                $unit_text .= BAHT_TEXT_UNITS[$unit];
            }
    
            $text = $unit_text . $text;
            $unit++;
        }
    
        if ($include_unit) {
            $text .= BAHT_TEXT_BAHT;
    
            $satang = explode('.', number_format($number, 2, '.', ''))[1];
            $text .= $satang == 0
                ? BAHT_TEXT_INTEGER
                : baht_text($satang, false) . BAHT_TEXT_SATANG;
        } else {
            $exploded = explode('.', $number);
            if (isset($exploded[1])) {
                $text .= BAHT_TEXT_POINT;
                $decimal = (string)$exploded[1];
                for ($i = 0; $i < strlen($decimal); $i++) {
                    $text .= BAHT_TEXT_NUMBERS[$decimal[$i]];
                }
            }
        }
    
        return $text;
    }

    function formatCard($val) {
        $strvalue = substr($val,0,1).'-'.substr($val,1,4).'-'.substr($val,5,5).'-'.substr($val,10,2).'-'.substr($val,12,1);
        return $strvalue;
    }