<?php
date_default_timezone_set('Asia/Chongqing');
function generateTimeStr($stamp){
    $past = time() - $stamp;
    $days = floor($past / (24 * 60 * 60));
    $strDays = $days >= 10 ? $days : '0'.$days;
    $past = $past - $days * (24 * 60 * 60);
    $hours = floor($past / (60 * 60));
    $strHours = $hours >= 10 ? $hours : '0'.$hours;
    $past = $past - $hours * (60 * 60);
    $minutes = floor($past / 60);
    $strMinutes = $minutes >= 10 ? $minutes : '0'.$minutes;
    $seconds = $past - $minutes * 60;
    $strSeconds = $seconds >= 10 ? $seconds : '0'.$seconds;

    if($days > 7){
        return date('M,d,Y', $stamp);
    }else if($days){
        return "{$strDays}D,{$strHours}H ago";
    }else if($hours){
        return "{$strHours}H,{$strMinutes}M ago";
    }else if($minutes){
        return "{$strMinutes}M,{$strSeconds}S ago";
    }else{
        return "Less than 1M";
    }
}