<?php
require_once('./config.inc.php');
function get_arr_url_and_abspath_node_clicked($node_clicked)
{
    if(is_link($node_clicked))
    {
        $link_node_target_node = readlink($node_clicked);
        $bool_link_target_is_in_root = !(strpos($link_node_target_node, __DIR__) === false);
        if($bool_link_target_is_in_root)
        {
           $the_arr = call_user_func('get_arr_url_and_abspath_normal', $node_clicked);
           return $the_arr;
        }else{
            $the_arr = array(
                'abs_path_node_clicked' => readlink($node_clicked),
                'url_node_clicked' => call_user_func('get_url_with_url_root', $node_clicked)
            );
            return $the_arr;
        }
    }else{
        $the_arr = call_user_func('get_arr_url_and_abspath_normal', $node_clicked);
        return $the_arr;
    }
}
function get_arr_url_and_abspath_normal($node_get_normal){
    $url_node_clicked = call_user_func('get_url_with_url_root', $node_get_normal);
    $abs_path_node_clicked = __DIR__.'/'.$node_get_normal;
    $arr_url_add_abspath_normal =  array(
        'url_node_clicked' => $url_node_clicked,
        'abs_path_node_clicked' => $abs_path_node_clicked
    );
    return $arr_url_add_abspath_normal;
}
function get_url_with_url_root($node_clicked)
{
    $url_root = $_SERVER['SERVER_NAME'];
    $dir_in_root = substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']));
    $url_with_url_root = $url_root.$dir_in_root.'/'.$node_clicked;
    return $url_with_url_root;
}
$node = $_GET['node'];
//include('FilesrouterController.class.php');
echo '<br>'.'hello, I am FilepathController.class.php'.'<br>';
if(!is_array(get_arr_url_and_abspath_node_clicked($node))){
    die('I have not get the array!');
}else{
//    var_dump(get_arr_url_and_abspath_node_clicked($node));
}
$arr_url_and_abspath_node_clicked = call_user_func('get_arr_url_and_abspath_node_clicked', $node);
//var_dump($arr_url_and_abspath_node_clicked);
$url_node_this_clicked = $arr_url_and_abspath_node_clicked['url_node_clicked'];
echo 'URL中提交过来的被点击节点的链接已生成: '.$url_node_this_clicked;
$abs_current_dir = $abs_current_this_clicked = $arr_url_and_abspath_node_clicked['abs_path_node_clicked'];
echo '<br>URL中提交过来的被点击节点的abspath已生成: '.$abs_current_this_clicked;
//echo '<br>var_dump the $abs_current_dir: '.$abs_current_dir;
include('GettableModel.class.php');
