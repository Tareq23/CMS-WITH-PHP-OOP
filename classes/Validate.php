<?php

class Validate{
    private $_db,$_error=array(),$_count=0;
    public function __construct()
    {

    }

    public function validation($items) 
    {
        foreach($items as $item => $rules)
        {
            foreach($rules as $rule => $value)
            {
                if($item=='post_image'&&$rule=='require')
                {
                    if($_FILES[$item]['name']==""||$_FILES[$item]['size']==0)
                    {
                        $this->_error[$item] = "{$item} must be require";
                    }
                }
                else if($rule==='require'&&empty(Input::get($item)))
                {
                    //echo "{$item} must be required";
                    $this->_error[$item] = "{$item} must be required";
                }
                else
                {
                    switch($rule)
                    {
                        case 'max':
                            if(strlen(Input::get($item))>$value)
                            {
                                $_error[$item] = "Must be less than {$value} characters";
                            }
                        break;
                        case 'min':
                            if(strlen(Input::get($item))<$value)
                            {
                                $_error[$item] = "Must be greater than {$value} characters";
                            }
                        break;
                        case 'match':
                            
                        break;
                        case 'unique':
                        break;
                    }
                }
            }
        }
    }
    public function error()
    {
        return $this->_error;
    }

}







