<?php
echo '+++++++++++++++';
include_once('SuffixeslistModel.class.php');
function get_ahref_this_file($this_file, $arr_suffix_list, $bool_allow, $extension)
{
    /*
    echo '<br>';
    var_dump($extension);
    echo '<br>';
    var_dump($arr_suffix_list);
    echo '<br>';
    var_dump($bool_allow);
    echo '<br>';
    var_dump($this_file);
    */
    echo '<br>';
    //$ext_in_the_suffix_list = true;
    //$ext_in_the_suffix_list = false;
    $ext_in_the_suffix_list = in_array($extension, $arr_suffix_list);
    echo '<br>'.'如果$extension在$arr_suffix_list中就will var_dump(ture), now var_dump($ext_in_the_suffix_list): ';
    var_dump($ext_in_the_suffix_list); 
    echo '<br>'.'var_dump函数处理url_jump函数收到的参数$bool_allow: ';
    var_dump($bool_allow);
echo '<br>'.'---------------';
    $allow_read = $bool_allow ? $ext_in_the_suffix_list : !$ext_in_the_suffix_list;
    //var_dump($allow_read);
    if(!($allow_read)){
        echo 'I will set the a tag href as Disallowread.tpl.php?nodefrom='.$this_file;
        $ahref = 'Disallowread.tpl.php?nodefrom='.$this_file;
    }else{
        echo 'I will set the a tag href as '.$this_file;
        $ahref = $this_file;
    }
    return $ahref;
}
function get_extension($filename)
{
    //return '.'.end(explode('.', $filename));
    return strrchr($filename, '.');
    //return substr(strrchr($filename, '.'), 1);
}

