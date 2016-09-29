<?php
$root = $_SERVER['DOCUMENT_ROOT'];
echo '当前网站根目录的绝对路径是'.$root.'<br>';
if(!($root == $abs_current_dir))
{
    $length = strlen($root);
    $current_dir_in_root = substr($abs_current_dir, $length);
    //echo '当前目录在网站根目录中的目录： '.$current_dir_in_root;
}else{
    //echo '当前目录就是网站根目录或是符号连接。';
    $current_dir_in_root = '';
}
echo '当前项目绝对路径是： '.$APP_PATH;
$url_root = $_SERVER['SERVER_NAME'];
$url_current_dir = 'http://'.$url_root.$current_dir_in_root;
echo '<br>';
echo '当前目录对应的URL是： '.$url_current_dir;
echo '<br>------------以上是中间的php文件的输出--------------<br><br>';
require $APP_PATH."/FilestableModel.class.php";
?>