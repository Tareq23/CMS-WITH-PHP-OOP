<?php



class Input
{

    public static function exists($request = 'POST')
    {
        switch($request)
        {
            case 'POST':
                return (!empty($_POST))?true:false;
            break;
            case 'GET':
                return (!empty($_GET))?true:false;
            break;
        }
        return false;
    }
    public static function get($item)
    {
        //echo "$_POST[$item]<br>";
        if(!empty($_POST[$item])) return $_POST[$item];
        else if(!empty($_GET[$item])) return $_GET[$item];
        //else if(!empty($_FILES[$item]['name'])) return $_FILES[$item]['name'];
        return '';
    }
}




