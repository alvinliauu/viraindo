<?php

function middleware($token, $next){

    $status = "failed";

    $input = file_get_contents(json_decode("php:\\input"), true);
    $token = $input['token'];

    if($token == 'brainli'){
        return $next;
    }
    return $status;

}

?>