<?php
include_once('/var/www/share.com/develop.share.com/dev-direr/'.'Config.inc.php');
echo $APP_PATH;
echo '<br>以下是目录下的内容列表： <br>';
//这是列出当前目录简单情况的php文件,后续可把TA做成类，如同其文件名一样。
print <<<TABLE
    <table> <thead> <tr>
<th>文件名</th>
<th>文件大小</th>
<th>创建时间</th>
<th>上次修改时间</th>
<th>上次访问时间</th>
</tr>
<tr>
TABLE;

$abs_current_dir = '/var/www/share.com/develop.share.com/dev-direr';
$arr_files_names = scandir($abs_current_dir);
include_once('SuffixeslistModel.class.php');
include_once('FilesrouterController.class.php');
include_once('FolderslistModel.class.php');
include_once('FoldersrouterController.class.php');
foreach ($arr_files_names as $name)
{
    if(!$name){
       die('have not get $name');
    }else{
        echo '<br>-------------------------------------------------output-end<br><br><br><br>ouput-start++++++++++++++++++++++++++<br>the name is: ';
        var_dump($name);
        echo '<br>';
    }
    if(!is_dir($name))
    {
	    $ext = get_extension($name);  //这是从$_GET数组中获得的'nodeclicked'的值.
        //####****####****@@@@ the next line can be put in the config.inc.php(gloabal variable) file.
	    $bool_allow_the_suffixes_list = true;
	    $ahref = call_user_func('get_ahref_this_file', $name, $arr_readable_types, $bool_allow_the_suffixes_list, $ext);
    }else{
        //####****####****@@@@ the next line can be put in the config.inc.php(gloabal variable) file.
        $bool_allow_the_folders_list = true;
        $ahref = call_user_func('get_ahref_this_folder', $name, $arr_readable_folders, $bool_allow_the_folders_list);
    }
    echo '<br>the $ahref is: ';
    var_dump($ahref);
    call_user_func('tail_table_print', $name, $ahref);
}
echo '</thead></table>';
echo "------------以上是最后的php文件的输出--------------<br>";

function tail_table_print($node_para, $href)
{
    if(is_link($node_para)){
        $link_yes_string = '是';
        $arr_stat = lstat($node_para);
    }else {
        $link_yes_string = '否';
        $arr_stat = stat($node_para);
    }
    $a_element_string = '<a style="text-decoration:none;" href='.$href.'>'.$node_para."</a>";
    echo   '<td>'.$a_element_string.'</td>';
    echo   '<td>'.$arr_stat['size'].'</td>';
    echo   '<td>'.$link_yes_string.'</td>';
    echo   '<td>'.$arr_stat['ctime'].'</td>';
    echo   '<td>'.$arr_stat['mtime'].'</td>';
    echo   '<td>'.$arr_stat['atime'].'</td>';
    echo '</tr>';
}
