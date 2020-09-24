<?php 


require_once '../init/init.php';




if(Input::exists($_SERVER['REQUEST_METHOD']))
{
    if(Token::check(Input::get('login_token'),'login_token'))
    {
        $validate = new Validate();
        $validate->validation(array(
            'username' => array(
                'require' => true,
                'min' => 3,
                'max' => 20
            ),
            'password' => array(
                'require' => true,
                'min' => 6,
                'max' => 50
            )
        ));
        if(!count($validate->error()))
        {
            $user = DB::connect()->get('users','=',array('user_name'=>Input::get('username')))->fetch();
            if($user->count())
            {
                $user = $user->result();
                if($user->user_password===Hash::getHashValue(Input::get('password')))
                {
                    Session::put('user','loged');
                    Session::put('user_role',$user->user_role);
                    Session::put('username',$user->user_name);
                   
                }
            }
        }
        else{
            print_r($validate->error());
        }
    }
}
header('location:../index.php');










