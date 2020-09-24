<?php


function user_online(){
$session = session_id();
$time = time();
$time_out_in_seconds = 60;
$time_out = $time - $time_out_in_seconds;
$query = DB::connect()->get('users_online','=',array('session'=>$session));

if(!$query->count())
{
    DB::connect()->insert('users_online',array('session'=>$session,'time'=>$time));
}
else{
    DB::connect()->update('users_online',['time'=>$time],'=',['session'=>$session]);
}

global $count_online = DB::connect()->get('users_online','<',['time'=>$time])->count();
return $count_online;
}