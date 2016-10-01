<?php
include_once('/var/www/share.com/develop.share.com/dev-direr/'.'Config.inc.php');
echo '+++++++++++++++';
include_once('FolderslistModel.class.php');
function get_ahref_this_folder($this_folder, $arr_folders_list, $bool_allow)
{
    /*
    echo '<br>';
    var_dump($this_folder);
    echo '<br>';
    var_dump($arr_folders_list);
    echo '<br>';
    var_dump($bool_allow);
    echo '<br>';
    var_dump($url_thetrue_node);
    */
    echo '<br>';
    //$ext_in_the_folders_list = true;
    //$ext_in_the_folders_list = false;
    $ext_in_the_folders_list = in_array($this_folder, $arr_folders_list);
    echo '<br>'.'如果$this_folder在$arr_folders_list中就will var_dump(ture), now var_dump($ext_in_the_folders_list): ';
    var_dump($ext_in_the_folders_list);
    echo '<br>'.'var_dump函数处理url_jump函数收到的参数$bool_allow: ';
    var_dump($bool_allow);
echo '<br>'.'---------------';
    $allow_read = $bool_allow ? $ext_in_the_folders_list : !$ext_in_the_folders_list;
    //var_dump($allow_read);
    if(!($allow_read)){
        echo 'I will set the a tag href as Disallowread.tpl.php?nodefrom='.$this_folder;
        $ahref = 'Disallowread.tpl.php?nodefrom='.$this_folder;
    }else{
        echo 'I will set the a tag href as '.$this_folder;
        $ahref = $this_folder;
    }
    return $ahref;
}

