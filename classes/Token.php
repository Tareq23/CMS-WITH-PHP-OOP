<?php



class Token{
    public function __construct()
    {

    }
    public static function generate($name='token')
    {
        return Session::put($name,md5(uniqid()));
    }
    public static function check($value,$name='token')
    {
        // echo 'value -> '.$value.'<br>';
        // echo 'session-get -> '.Session::get($name);
        if(Session::exists($name)&&$value==Session::get($name))
        {
            Session::delete($name);
            return true;
        }
        return false;
    }
}








