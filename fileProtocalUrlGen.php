<?php
require_once('./config.inc.php');
print <<<HTML
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>fileProtocalUrlGen</title>
    </head>
    <body>
HTML;
//echo "<a href='file://".$pathDefault."/Manules/phpmanule/man/res/about.html'>example-node</a>";

parse_str($_SERVER['QUERY_STRING'], $query);
$p;
foreach($query as $key => $value){
    $GLOBALS['p'] = $value;
}
if(!isset($p)) exit('$p has not been definde before reference.');
$p = $p ? realpath($p) : "{$pathDefault}/Manules/phpmanule/man/res/book.pdo.html";  //如果$_GET中p参数为空就为$p指定路径

$searchTerm = end(explode('/', $p)); //exit($searchTerm);
//exit((string)strrpos($searchTerm, '.'));
$searchTerm = substr($searchTerm, 0, strrpos($searchTerm, '.'));
$theFileProtocalUrl = 'file://'.$p;
echo "<a href={$theFileProtocalUrl}>{$searchTerm}</a>";

echo '</body> </html>';
