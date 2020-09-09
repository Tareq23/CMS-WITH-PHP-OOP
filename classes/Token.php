<?php



class Token{
    public function __construct()
    {

    }
    public static function generate()
    {
        return Session::put('token',md5(uniqid()));
    }
    public static function check($value)
    {
        if(Session::exists('token')&&$value===Session::get('token'))
        {
            Session::delete('token');
            return true;
        }
        return false;
    }
}








