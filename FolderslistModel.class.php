<?php
include_once('/var/www/share.com/develop.share.com/dev-direr/'.'Config.inc.php');
/*
 *该文件扮演的角色是后缀的储存和加工,可根据需要修改或扩展该文件,也可以在任何需要的地方引入该文件.
 *该文件的功能可以用数据库技术实现.
 */
$arr_readable_types_lower_2d = array(
    'Configures' => array('.git','.gitignore','.idea',),
    'SelfParent' => array('.','..'),
    'Documents' => array('Documents'),
    'Downloads' => array('Downloads'),
    'Configures' => array('Pictures','Movies','Musics',),
    //'Others' => array('.git','.gitignore','.idea','testdir',),
    //the link folder support will comming latter.
    'Link' => array('catkeenalert'),  //Link folder
);

/*
function add_lower_and_upper_nonrepeat_sorted_indexnumbered($arr_origin_2d)
{
    foreach ($arr_origin_2d as $arr_origin_sub_1d) {
        foreach ($arr_origin_sub_1d as $arr_origin_element) {
            $arr_tmp[] = $arr_origin_element;
            $arr_tmp[] = strtoupper($arr_origin_element);
            $arr_tmp[] = strtolower($arr_origin_element);
            $arr_product = array_values(array_unique($arr_tmp));
        }
    }
    return $arr_product;
}
*/
include_once('ArrayextendModel.class.php');
$arr_readable_folders = call_user_func('add_lower_and_upper_nonrepeat_sorted_indexnumbered', $arr_readable_types_lower_2d);
//var_dump($arr_readable_types);
//echo 'I am Suf*.<br>';