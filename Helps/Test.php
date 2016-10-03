<?php
include_once('/var/www/share.com/develop.share.com/dev-direr/'.'Config.inc.php');
echo '<br>I am '.__FILE__.'<br>Now I display APP_PATH: '.APP_PATH;
echo '<br>I am $_SERVER["SCRIPT_NAME"]: '.$_SERVER['SCRIPT_NAME'];
echo '<br>I am dirname($_SERVER["SCRIPT_NAME"]: )'.dirname($_SERVER["SCRIPT_NAME"]);