<?php
print <<<HTML
<html><head>
<meta http-equiv = "progma" content = "no-cache" />
</head><body>
\n
HTML;

parse_str($_SERVER['QUERY_STRING'], $query);
$p;
foreach($query as $key => $value){
    $GLOBALS['p'] = $value;
}
$p = $p ? realpath($p) : '/home/catkeenalert';
echo '<h3>$p'." is {$p}</h3>\n";
function generateUrl($nodeName){
global $p;
if(is_dir($p.'/'.$nodeName)){
    $urlPrefix = "entrysin.direr.php?p=".$p;

}else{
    $urlPrefix = strpos($p, $_SERVER['DOCUMENT_ROOT']) === 0 ?
               'http://'.$_SERVER['SERVER_NAME'].substr($p, strlen($_SERVER['DOCUMENT_ROOT']))
             : 'ViewFileByMime.php?p='.$p;
    }
return str_replace(' ', '+', $urlPrefix.'/'.$nodeName);
}

function generateNodeDetails($nodePath) {
    $nodeDetailArray = is_link($nodePath) ? lstat($nodePath) : stat($nodePath);
        $nodeDetails = '';
        //$nodeDetails .= '<td>'
        /*由于尚不明确的原因,$openstr要单独提出来求值,直接写入<td></td>中就会跳出<tr></tr>,可能于多层调用或字符连接有关.*/
        $openStr = is_dir($nodePath) ? '目录' : '文件';
        $nodeDetails .= '<td>'.$openStr.'</td>'."\n";
        $nodeDetails .= '<td>'.$nodeDetailArray['size'].'<td>'."\n";
        $nodeDetails .= '<td>'.$nodeDetailArray['ctime'].'<td>'."\n";
        $nodeDetails .= '<td>'.$nodeDetailArray['mtime'].'<td>'."\n";
        return $nodeDetails;
}

function generateTable(){
    global $p;
    $inners = scandir($p);
    echo '<table>'."\n";
    echo "<thead><tr>
<th>(尾)文件(夹)名</th>
<th>类型</th>
<th>文件大小</th>
<th>创建时间</th>
<th>修改时间</th>
</tr></thead><tbody>";
    $hidePrefix = array('#', '-');
    require_once('subStrByWidth.php');
    foreach($inners as $value){
        if(!in_array(substr($value, 0, 1), $hidePrefix)){
            $href = call_user_func('generateUrl', $value);
            $tableStr = '';
            $formatName = $value;
            //$formatName = strlen(call_user_func('subStrbywidth', $value, 10));
            $formatName = strlen($formatName) <= 11 ? $formatName : '···'.call_user_func('subStrbywidth', $value, 12);
            $tableStr .= "<tr><td><a href= $href >".$formatName.'</a></td>'."\n";
            $tableStr .= call_user_func('generateNodeDetails', $p.'/'.$value);
            $tableStr .= '</tr>'."\n";
            echo $tableStr;
        }
    }
echo '</tbody></table>';
}
generateTable();
echo '</body></html>';
