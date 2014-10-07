<?php
function mycrypt($pass,$salt,$rounds = 9){

$saltChars = array_merge(range('A','Z'),range('a','z'), range(0,9));
    if($salt == null){
        for($i = 0; $i <22; $i++){
                $saltshaker .= $saltChars[array_rand($saltChars)];
            }
        $salt = sprintf('$2a$%02d$', $rounds).$saltshaker;
    }
        return crypt($pass,$salt);
        $salt = null;
}

?>
