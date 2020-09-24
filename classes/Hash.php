<?php

// $pepper = 'ciwerty*kdi*&3$48y738*3k4!';
// $pwd = $_POST['password'];
// $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
// $pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);

// echo $pepper.'<br>';
// echo $pwd_peppered.'<br>';
// echo $pwd_hashed.'<br>';


class Hash
{
    private static $pepper = "aeioupqrstuvwxyzmnbcdfgh";
    public static function getHashValue($value)
    {
        return self::generateHash($value);
    }
    public static function generateHash($value)
    {
        //$password_peppered  = hash_hmac("sha256",$value,self::$pepper);
        //return password_hash($password_peppered,PASSWORD_ARGON2ID);
        return sha1($value);
    }
}



