<?php
/*
$Prooter = isset($_GET['Prooter'])?$_GET['Prooter']:NULL;
$pshowing = isset($_GET['pshowing'])?$_GET['pshowing']:NULL;
if($Prooter != NULL && $pshowing != NULL && class_exists($Prooter) && method_exists($Prooter, $pshowing)) {
    $cObj = new $Prooter();
    $cObj->$pshowing();
}else{
    var_dump($_GET);
    echo '<br>';
    var_dump($pshowing);
    echo '<br>找不到控制器或方法';
    //exit;
}
*/

define('URL_HOST', $_SERVER['SERVER_NAME']);
define('ABS_WEB_DIR', $_SERVER['DOCUMENT_ROOT']);
define('DEFAULT_SHOW_PATH', '.');
define('DEFAULT_NODE_NAME', '');
$bool_allow_the_folders_list = true;
$bool_allow_the_suffixes_list = true;
class Node{
    public $parent_page_path;
    public $node_name;
    public $path_node_in_root;
    public $node_entire_url;
    public $node_abs_path;
    public function __construct($parent_page_path, $node_name)
    {
        $this->node_name = $node_name;
        var_dump($parent_page_path);
        $this->parent_page_path = $parent_page_path;
        if(!($node_name === '' && empty($node_name))){
            $this->path_node_in_root = '/'.$this->parent_page_path.'/'.$this->node_name;
        }else{
            $this->path_node_in_root = '/'.$this->parent_page_path;
        }
        $this->path_node_in_root= realpath($this->path_node_in_root);
        if(substr($this->path_node_in_root, strlen($this->path_node_in_root)-1) === '/'){
            $this->path_node_in_root = substr($this->path_node_in_root, 0, strlen($this->path_node_in_root)-2);
        }
        var_dump($this->path_node_in_root);
        echo 'dirname($this->path_node_in_root): ';
        $this->node_entire_url = constant('URL_HOST').$this->path_node_in_root;
        var_dump($this->node_entire_url);
        $this->node_abs_path = constant('ABS_WEB_DIR').$this->path_node_in_root;
        echo '<br>var_dump the constant ABS_WEB_DIR.(init Node): ';
        var_dump(constant('ABS_WEB_DIR'));
        echo '<br>var_dump the $this->node_abs_path(init Node): ';
        var_dump($this->node_abs_path);
        echo '<br>';
        var_dump(scandir(dirname($this->node_abs_path)));
        echo '<br>';
        $this->isdir = is_dir($this->node_abs_path);
        $this->islink = is_link($this->node_abs_path);
    }
}

class DirRequesting extends Node
{
    public $string_table_head;
    public $arrin;
    public function __construct($parent_page_path, $node_name){
        parent::__construct($parent_page_path, $node_name);
        $this->arrin = scandir($this->node_abs_path);
    }

    public function table_head(){
         $string_table_head = '<br>以下是目录下的内容列表： <br>';
         $string_table_head = '<table> <thead> <tr>';
         $string_table_head .= '<th>文件名</th>';
         $string_table_head .= '<th>文件大小</th>';
         $string_table_head .= '<th>是否软连接</th>';
         $string_table_head .= '<th>创建时间</th>';
         $string_table_head .= '<th>上次修改时间</th>';
         $string_table_head .= '<th>上次访问时间</th>';
         $string_table_head .= '</tr> <tr>';
         echo $string_table_head;
    }
    public function table_foot(){
        echo '</thead></table>';
        echo '<br>------------以上是最后的php文件的输出--------------<br>';
    }
}

class NodeDetail
{
    public $name;
    public $strislink;
    public $strdetail;
    public $arr_detail;
    public $size;
    public $ctime;
    public $mtime;
    public $atime;
    public $ahref;
    public $atagstr;
    public function __construct($abspath)
    {
        $this->name = substr($abspath, strrpos($abspath, '/'));
        $this->strislink = is_link($abspath) ? '是' : '否';
        //$this->detail = is_link($abspath) ? 'lstat' : 'stat';
        if(is_link($abspath)){
            $this->arr_detail = lstat($abspath);
        }else{
            $this->arr_detail = stat($abspath);
        }
        $this->size = $this->arr_detail['size'];
        $this->ctime = $this->arr_detail['ctime'];
        $this->mtime = $this->arr_detail['mtime'];
        $this->atime = $this->arr_detail['atime'];
        $this->atime = $this->arr_detail['atime'];
        $this->ahref = $SERVER['SERVER_NAME'].substr($abspath, strlen($_SERVER['DOCUMENT_ROOT']));
        //echo __METHOD__.'echo the $ahref: ';
        $this->atagstr = '<a style="text-decoration:none;" href='.$ahref.'>'.$this->name."</a>";
    }
    public function tableout()
    {
        $nodestrdetail .=  '<tr>';
        $nodestrdetail .=  '<td>'.$this->atagstr.'</td>';
        $nodestrdetail .=  '<td>'.$this->size.'</td>';
        $nodestrdetail .=  '<td>'.$this->strislink.'</td>';
        $nodestrdetail .=  '<td>'.$this->ctime.'</td>';
        $nodestrdetail .=  '<td>'.$this->mtime.'</td>';
        $nodestrdetail .=  '<td>'.$this->atime.'</td>';
        $nodestrdetail .=  '</tr>';
        echo $nodestrdetail;
    }
}

class File extends Node
{
    public function __construct($parent_page_path, $node_name){
        parent::__construct($parent_page_path, $node_name);
    }
    public function openfile(){
        header('Location: https://www.baidu.com');
        //header('Location: '.realpath($_SERVER['SERVER_NAME'].'/'.$dir_page.path.'/'.$node_name));
    }

}



if(empty($_GET['pp']) OR is_null($_GET['pp'])){
    $dir_inroot_request = constant('DEFAULT_SHOW_PATH');
    echo 'I have not get the path: ';
    var_dump($dir_inroot_request);
}else{
    $dir_inroot_request = $_GET['pp'];
    var_dump($dir_inroot_request);
};

if(empty($_GET['nn']) OR is_null($_GET['nn'])){
    $node_name_request = constant('DEFAULT_NODE_NAME');
}else{
    $node_name_request = $_GET['nn'];
}
echo 'judge: ';
var_dump(realpath($_SERVER['DOCUMENT_ROOT'].'/'.$dir_inroot_request.'/'.$node_name_request));
if(is_dir(realpath($_SERVER['DOCUMENT_ROOT'].'/'.$dir_inroot_request.'/'.$node_name_request))){
    $dr = new DirRequesting($dir_inroot_request, $node_name_request);
    $dr->table_head();
    foreach($dr->arrin as $name){
        $absnode = $dr->node_abs_path.'/'.$name;
        $nd = new NodeDetail($absnode);
        $nd->tableout();
    }
    $dr->table_foot();
    //$n = new Node($dir_inroot_request, $node_name_request);
    var_dump($nd->arr_detail);
}else{
    $f = new File($dir_inroot_request, $node_name_request);
    $f->openfile();
}
