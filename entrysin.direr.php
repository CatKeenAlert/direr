<?php
print <<<HTML
<html><head>
<meta http-equiv = "progma" content = "no-cache" />
<style>
    body{
        align: center;
    }
</style>
</head><body>
\n
HTML;

parse_str($_SERVER['QUERY_STRING'], $query);
$p;
foreach($query as $key => $value){
    $GLOBALS['p'] = $value;
}
$p = $p ? realpath($p) : '/home/catkeenalert';
echo '<h3>Current Full Path ($p) is: '.$p.'</h3>'."\n";

function generateTable(){
    global $p;
    $inners = scandir($p);
    echo '<table>'."\n";
    echo "<thead><tr>
<th id='head-name-head'>HeadOfNodeName</th>
<th id='typehead'>Type</th>
<th class='head'>TailOfNodeName</th>
<th class='head'>SizeOfNode</th>
<th class='headtime'>CtimeOfNode</th>
<th class='headtime'>MtimeOfNode</th>
</tr></thead><tbody>";
    $hidePrefix = array('#', '-');
    require_once('subStrTailByWidth.php');
    foreach($inners as $value){
        if(!in_array(substr($value, 0, 1), $hidePrefix)){
            $href = call_user_func('generateUrl', $value);
            $tailName = $value;
            $tailName = strlen($tailName) <= 11 ? $tailName : '···'.call_user_func('subStrTailByWidth', $tailName, 12);
            $headName = $value;
            $headName = strlen($headName) <= 11 ? $headName : substr($headName, 0, 11).'···';
            $tableStr = '';
            $tableStr .= call_user_func('generateNodesDetailHtmlStr', $p.'/'.$value, $href, $headName, $tailName);
            echo $tableStr;
        }
    }
    echo '</tbody></table>';
}
call_user_func('generateTable');
echo '<script src="http://cdn.bootcss.com/jquery/3.1.1/jquery.slim.min.js"></script>';
echo '<script src="style.css.js"></script>';
echo '</body></html>';

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

function generateNodesDetailHtmlStr($nodePath, $href, $headName, $tailName) {
    $nodeDetailArray = is_link($nodePath) ? lstat($nodePath) : stat($nodePath);
        $nodeDetails = '';
        //$nodeDetails .= '<td>'
        /*由于尚不明确的原因,$openstr要单独提出来求值,直接写入<td></td>中就会跳出<tr></tr>,可能于多层调用或字符连接有关.*/

        $nodeType = is_dir($nodePath) ? 'Fold' : 'Leaf';
        $nodeDetails .= '<td><a class='.$nodeType.' href= '.$href.' >'.$headName.'</a></td>'."\n";
        $nodeDetails .= '<td class="type">'.$nodeType.'</td>'."\n";
        $nodeDetails .= '<td><a class='.$nodeType.' href= '.$href.' >'.$tailName.'</a></td>'."\n";
        $nodeDetails .= '<td class="size">&nbsp;'.$nodeDetailArray['size'].'</td>'."\n";

        include_once('generateTimeStr.php');
        $ctimeStr = call_user_func('generatetimestr', $nodeDetailArray['ctime']);
        $nodeDetails .= '<td class="time">'.$ctimeStr.'</td>'."\n";
        $mtimeStr = call_user_func('generatetimestr', $nodeDetailArray['mtime']);
        $nodeDetails .= '<td class="time">'.$mtimeStr.'</td>'."\n";
        $nodeDetails .= '</tr>'."\n";
        return $nodeDetails;
}
