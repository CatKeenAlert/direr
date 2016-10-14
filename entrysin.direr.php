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

function generateTable(){
    global $p;
    $inners = scandir($p);
    echo '<table>'."\n";
    $hidePrefix = array('#', '-');
    foreach($inners as $value){
        if(!in_array(substr($value, 0, 1), $hidePrefix)){
            $href = call_user_func('generateUrl', $value);
            echo "<tr><td><a href= $href >".$value.'</a></td></tr>'."\n";
        }
    }
echo '</table>';
}
generateTable();
echo '</body></html>';
