<?php
include_once('/var/www/share.com/develop.share.com/dev-direr/'.'Config.inc.php');
echo '<br>'.':('.'<br>';
$nodefrom = $_GET['nodefrom'];
//####****####****@@@@ if the '$bool_allow_the_folders_list' & '$bool_allow_the_suffixes_list' would be put in the config.inc.php, next two line must be change.
$string_ext_in_the_suffix_list = $ext_in_the_suffix_list ? '在':'不在';
$list = is_dir($nodefrom) ? 'FolderslistModel.class.php' : 'SuffixeslistModel.class.php';
$file_bool_allow = 'GettableModel.class.php';
$para_name_bool_allow = is_dir($nodefrom) ? '$bool_allow_the_folders_list' : '$bool_allow_the_suffixes_list';
//$bool_allow can not get redirect, but if this page show, means that the @nodefrom does not be allowed to read. so I can get it value by next line.
$string_bool_allow = $ext_in_the_suffix_list ? 'false' : 'true';
$error_readdisallow_info = '由于该文件后缀';
$error_readdisallow_info .= $string_ext_in_the_suffix_list.$list.'定义的后缀列表中,而';
$error_readdisallow_info .= $file_bool_allow.'中'.$para_name_bool_allow.'被设置为'.$string_bool_allow.'所以不能正常访问.';
echo $error_readdisallow_info;
//这里在后边实现跳会上一页的功能
