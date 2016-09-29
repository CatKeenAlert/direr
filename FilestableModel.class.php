<?php
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
$arr_files_names = scandir($abs_current_dir);
foreach ($arr_files_names as $name)
{
    call_user_func('table_print', $name);
}
echo '</thead></table>';
echo "------------以上是最后的php文件的输出--------------<br>";



function table_print($nodeclicked)
{
    if(is_link($nodeclicked)){
        $link_yes_string = '是';
        $arr_stat = lstat($nodeclicked);
    }else {
        $link_yes_string = '否';
        $arr_stat = stat($nodeclicked);
    }
    //var_dump($arr_stat);
    //if(!$arr_stat)
//    {
//        echo '当前目录是个符号连接。';
//    }
    //$current_dir_file_url= $url_current_dir.'/'.$nodeclicked;
    $current_dir_file_url= $url_current_dir.'RouterController.class.php?nodeclicked='.$nodeclicked;
    $a_element_string = "<a style='text-decoration:none;' href=$current_dir_file_url>".$nodeclicked."</a>";
    echo   '<td>'.$a_element_string.'</td>';
    echo   '<td>'.$arr_stat['size'].'</td>';
    echo   '<td>'.$link_yes_string.'</td>';
    echo   '<td>'.$arr_stat['ctime'].'</td>';
    echo   '<td>'.$arr_stat['mtime'].'</td>';
    echo   '<td>'.$arr_stat['atime'].'</td>';
    echo '</tr>';
}
