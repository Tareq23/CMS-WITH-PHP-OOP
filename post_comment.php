<?php 
                    
if($_SERVER['REQUEST_METHOD']=='POST')
{
    //echo $_POST['comment_token'];
    // echo Input::get('comment_token');
    // echo '<br>'.Session::get('comment_token');
    //die();

    echo 'token success';
    if(Token::check(Input::get('comment_token'),'comment_token'))
    {

    $validate = new Validate();
    $validate->validation(array(
        'author' => array(
            'require' => true
        ),
        'email' => array(
            'require' => true
        ),
        'comment' => array(
            'require' => true,
            'min' => 10,
            'max' => 1000
        )
    ));
    $errors = $validate->error();
        if(!count($errors))
        {
            $input = array(
                'comment_post_id' => Input::get('post_id'),
                'comment_author' => Input::get('author'),
                'comment_email' => Input::get('email'),
                'comment_content' => Input::get('comment')
            );
            $insert = DB::connect()->insert('comments',$input);
            if($insert->count())
            {
                DB::connect()->update('posts',array('post_comment_count'=>$post->post_comment_count+1),'=',array('post_id'=>Input::get('post_id')));
            }
        }
        else{
            foreach($errors as $error)
            {
                echo $error.'<br>';
            }   
        }   
    }
}
?>


<form action="" method="post">
    <div class="form-group">
        <label for="author">Author Name</label>
        <input type="text" id="author" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" class="form-control" name="email">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="comment" rows="3"></textarea>
    </div>
    <input type="hidden" name="comment_token" value="<?php echo Token::generate('comment_token');?>" >
    <button type="submit" name = "create_comment" class="btn btn-primary">Submit</button>
</form>