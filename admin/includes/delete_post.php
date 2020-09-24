<?php 


$post_type = $_SERVER['REQUEST_METHOD'];

if(Input::exists($post_type))
{
    $posts = DB::connect()->delete('posts','=',array('post_id'=>Input::get('delete_id')));//->fetch()->result();
    if($posts->count()){
    header('location:posts.php');
    }
    else{
        echo 'problem faceing';
    }
}





