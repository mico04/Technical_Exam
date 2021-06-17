<?php

class Palindrome
{
    public static function checkPalindrome($word)
    {
         $str = 'level';
    $strLen = strlen($str)-1;
    $revStr = '';
    for($i=$strLen; $i>=0; $i--){
        $revStr.=$str[$i];
    }
    if($revStr == $str){
        $final = 'True';
    }
    else{
        $final = "False";
    }
    return $final;
        
    }

}

//Do not change this part
echo Palindrome:: checkPalindrome ('Deleveled');

?>