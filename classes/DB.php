<?php 



class DB{

    private static $_connect = null;
    private $_pdo;

    public function __construct()
    {
        try{
            $this->_pdo = new PDO("mysql:host=localhost;dbname=cms","root","");
            echo "successfully connected";
        }
        catch(PDOException $e)
        {
            echo "something worng";
            die($e->getMessage());
        }
    }
    public static function connect()
    {
        if(self::$_connect===null)
        {
            self::$_connect = new DB();
        }
        return self::$_connect;
    }
}

DB::connect();




