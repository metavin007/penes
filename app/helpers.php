<?php

function find_value_percent($value, $percent) {
    $total = (($value * $percent) / 100);
    return $total;
}

function DateThai($strDate)
 {
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));
  $strHour= date("H",strtotime($strDate));
  $strMinute= date("i",strtotime($strDate));
  $strSeconds= date("s",strtotime($strDate));
  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
 }

function format_address_for_pdf($house_no, $address_detail, $moo, $soi, $road, $tambon, $amphur, $province, $zipcode) {
    $text = '';
    if ($house_no) {
        $text .= $house_no;
    }
    if ($address_detail) {
        $text .= $address_detail;
    }
    if ($moo) {
        $text .= ' ม.' . $moo;
    }
    if ($soi) {
        $text .= ' ซ.' . $soi;
    }
    if ($road) {
        $text .= ' ถ.' . $road;
    }
    if ($tambon) {
        $text .= ' ต.' . $tambon;
    }
    if ($amphur) {
        $text .= ' อ.' . $amphur;
    }
    if ($province) {
        $text .= ' จ.' . $province;
    }
    if ($zipcode) {
        $text .= $zipcode;
    }
    return $text;
}

function date_format_system_not_time($date) {
    return date('d-m-Y', strtotime($date));
}

function date_format_system_not_second($date) {
    return date('d-m-Y H:i', strtotime($date));
}

function date_format_system($date) {
    return date('d-m-Y H:i:s', strtotime($date));
}

function date_format_database($date) {
    return date('Y-m-d H:i:s', strtotime($date));
}

function convert_number_to_strin_thai($number) {
    $txtnum1 = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
    $txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
    $number = str_replace(",", "", $number);
    $number = str_replace(" ", "", $number);
    $number = str_replace("บาท", "", $number);
    $number = explode(".", $number);
    if (sizeof($number) > 2) {
        return 'ทศนิยมหลายตัวนะจ๊ะ';
        exit;
    }
    $strlen = strlen($number[0]);
    $convert = '';
    for ($i = 0; $i < $strlen; $i++) {
        $n = substr($number[0], $i, 1);
        if ($n != 0) {
            if ($i == ($strlen - 1) AND $n == 1) {
                $convert .= 'เอ็ด';
            } elseif ($i == ($strlen - 2) AND $n == 2) {
                $convert .= 'ยี่';
            } elseif ($i == ($strlen - 2) AND $n == 1) {
                $convert .= '';
            } else {
                $convert .= $txtnum1[$n];
            }
            $convert .= $txtnum2[$strlen - $i - 1];
        }
    }

    $convert .= 'บาท';
    if ($number[1] == '0' OR $number[1] == '00' OR
            $number[1] == '') {
        $convert .= 'ถ้วน';
    } else {
        $strlen = strlen($number[1]);
        for ($i = 0; $i < $strlen; $i++) {
            $n = substr($number[1], $i, 1);
            if ($n != 0) {
                if ($i == ($strlen - 1) AND $n == 1) {
                    $convert .= 'เอ็ด';
                } elseif ($i == ($strlen - 2) AND
                        $n == 2) {
                    $convert .= 'ยี่';
                } elseif ($i == ($strlen - 2) AND
                        $n == 1) {
                    $convert .= '';
                } else {
                    $convert .= $txtnum1[$n];
                }
                $convert .= $txtnum2[$strlen - $i - 1];
            }
        }
        $convert .= 'สตางค์';
    }
    return $convert;
}

function convert_month_number_to_month_thai($number) {
    $months = array(1 => "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน"
        , "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน"
        , "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    return $months[$number];
}
