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
        return date('<b>M,</b><b>d,</b><b>Y</b>', $stamp);
    }else if($days){
        return "<b>{$strDays}</b><span>D,</span><b>{$strHours}</b><span>H ago</span>";
    }else if($hours){
        return "<b>{$strHours}</b><span>H,</span><b>{$strMinutes}</b><span>M ago</span>";
    }else if($minutes){
        return "<b>{$strMinutes}</b><span>M,</span><b>{$strSeconds}</b><span>S ago</span>";
    }else{
        return "<b>Less </b><b>than</b><b>1<span>M</span></b>";
    }
}
