<?PHP
//$rodomStr = '一';
//echo call_user_func('subStrTailByWidth', $rodomStr, 14);
function subStrTailByWidth($str, $numLimitSpecial) {
    $employIndex = mb_strlen($str, 'utf8') - 1;
    while
        (
            $width + 2 <= $numLimitSpecial  //判断在限定的宽度内还有字符截取名额
            &&   count($alphaEmployedArray) + 1 <= mb_strlen($str, 'UTF-8')
        ){
        $alphaEmployedArray[] = mb_substr($str, $employIndex, 1, 'utf8');
        $width = ord(mb_substr($str, $employIndex, 1, 'utf8')) > 127 ? $width + 2 : $width + 1;
        $employIndex -= 1;
    }

    $theString = '';
    for($i = count($alphaEmployedArray) -i; $i >= 0; $i--){
        $theString .= $alphaEmployedArray[$i];
    }
    return $theString;
}
?>