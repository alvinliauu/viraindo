<?php

$key = "viraindo jaya";

$yes = encrypt($key, "#v1r41nd0");

print_r($yes);

$dec = decrypt($key, "W5F0XuIPL3c=");

print_r($dec);

function encrypt($key, $text){
    
    // Store the cipher method
    $ciphering = "AES-128-CTR";
    
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    
    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';
    
    $value = openssl_encrypt($text, $ciphering, $key, $options, $encryption_iv);
    
    return $value;

}

function decrypt($key, $text){
    
    // Store the cipher method
    $ciphering = "AES-128-CTR";
    
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    
    // Non-NULL Initialization Vector for encryption
    $decryption_iv = '1234567891011121';
    
    $value = openssl_decrypt($text, $ciphering, $key, $options, $decryption_iv);
    
    return $value;

}


?>