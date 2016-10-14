<?php
parse_str($_SERVER['QUERY_STRING'], $query);
$p;
foreach($query as $key => $value){
    $GLOBALS['p'] = $value;
}
$p = $p ? realpath($p) : '/home/catkeenalert/test.png';
$p = str_replace('+', ' ', $p);
function viewByPath($filepath=""){
if(file_exists($filepath)){
$content = file_get_contents($filepath);
$finfo = finfo_open(FILEINFO_MIME_TYPE);
header("Content-type:".finfo_file($finfo, $filepath));
header("Content-length:".strlen($content));
echo $content;
die();
}else{
return false;
}
}
call_user_func('viewByPath', $p);