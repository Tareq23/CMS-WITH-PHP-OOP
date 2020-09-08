<?php 

class DB{

    private static $_connect = null;
    private $_pdo,$_count=0,$_result=null,$_error=false,$_stmt;

    public function __construct()
    {
        try{
            $this->_pdo = new PDO("mysql:host=localhost;dbname=cms","root","");
            //echo "successfully connected";
        }
        catch(PDOException $e)
        {
            //echo "something worng";
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

    private function query($sql,$fields = array())
    {   
        $this->_count=0;
        $this->_error=false;
        $this->_result = null;
        if($this->_stmt = $this->_pdo->prepare($sql))
        {
            //echo '<br>'.$sql.'<br>';
            //die();
            if(count($fields))
            {
                $index = 1;
                foreach($fields as $field)
                {
                    $this->_stmt->bindParam($index,$field);
                    $index++;
                }
            }
            if($this->_stmt->execute())
            {
                $this->_count = $this->_stmt->rowCount();
            }else{
                $this->_error = true;
            }
        }
        return $this;
    }
    public function error()
    {
        return $this->_error;
    }
    public function count()
    {
        return $this->_count;
    }
    public function result()
    {
        return $this->_result;
    }
    public function fetch()
    {
        $this->_result = $this->_stmt->fetch(PDO::FETCH_OBJ);
        return $this;
    }
    public function fetchAll()
    {
        $this->_result = $this->_stmt->fetchAll(PDO::FETCH_OBJ);
        return $this;
    }
    public function insert($table,$fields)
    {
        if(count($fields))
        {
            $columns = '';
            $value = '';
            $cnt = 1;
            foreach($fields as $key => $field)
            {
                $columns .= $key;
                $value .='?';
                if($cnt<count($fields))
                {
                    $columns .= ',';
                    $value .= ',';
                }
                $cnt++;
            }
            $sql = "INSERT INTO {$table}({$columns}) VALUES ({$value})";
            return $this->query($sql,$fields);
        }
        else{
            $this->_count = 0;
        }
    }
    private function checkOperator($operator='')
    {
        $operators = array('>','<','>=','<=','=','LIKE');
        return (in_array($operator,$operators))?true:false;
    }
    public function delete($table=null,$operator,$fields=array())
    {
        if(count($fields)&&$this->checkOperator($operator))
        {
            $condition_field = array_keys($fields);
            $sql = "DELETE FROM {$table} WHERE {$condition_field} {$operator} ?";
            return $this->query($sql,$fields);
        }
    }
    public function update($table=null,$fields=array(),$operator='',$condition = array())
    {
        if(count($fields)&&$this->checkOperator($operator))
        {
            $columns = '';
            $cnt = 1;
            $value = '';
            $condition_field = array_keys($condition);
            foreach($fields as $key => $field)
            {
                $columns .= $key . '=?';
                if($cnt<count($fields))
                {
                    $columns .= ',';
                    $value .= ',';
                }
            }
            $sql = "UPDATE {$table} SET {$columns} WHERE {$condition_field} {$operator} {$condition[$condition_field]}";
            return $this->query($sql,$fields);
        }

    }
    public function get($table,$operator,$fields = array())
    {
        if(count($fields)&&$this->checkOperator($operator))
        {
            $condition_field = array_keys($fields);
            $sql = "SELECT * FROM {$table} WHERE {$condition_field[0]} {$operator} ?";
            return $this->query($sql,$fields);
        }

    }
    public function getAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        return $this->query($sql);
    }
    public function addTable()
    {

    }
    public function deleteTable()
    {

    }
    public function addColumn()
    {

    }
    public function deleteColumn()
    {

    }
    public function updateColumn()
    {

    }
}