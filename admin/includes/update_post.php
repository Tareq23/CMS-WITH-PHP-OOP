<?php 


$post_type = $_SERVER['REQUEST_METHOD'];

if(Input::exists($post_type))
{

    $posts = DB::connect()->get('posts','=',array('post_id'=>Input::get('post_id')))->fetch()->result();
    //print_r($posts);
}
?>
<?php 


    $post_type = $_SERVER['REQUEST_METHOD'];
    if(Input::exists($post_type))
    {
        if(Token::check(Input::get('token')))
        {
            $validate = new Validate();
            $validate->validation(array(
                'post_title' => array(
                    'require' => true,
                    'max' => 2,
                    'max' => 100,
                ),
                'post_author' => array(
                    'require' => true,
                    'max' => 30,
                    'min'=> 3
                ),
                'post_category' => array(
                    'require' => true
                ),
                'post_content' => array(
                    'require' => true,
                    'min' => 100
                ),
                'post_tags' => array(
                    'require' => true,
                    'min'=>3,
                    'max' => 100
                ),
                'post_status' => array(
                    'require' => true,
                    'min'=>3,
                    'max' => 50
                )
                // 'post_image' => array(
                //     'require' => true
                // )
            ));
            // echo count($validate->error()).'<br>';
           // var_dump($validate->error());
            //die();
            if(!count($validate->error()))
            {
                $img_name = $posts->post_image;
                if($_FILES['post_image']['error']==0){
                    $path = '../img/'.$img_name;
                    unset($path);
                    $img_name = $_FILES['post_image']['name'];
                    $img_tmp = $_FILES['post_image']['tmp_name'];
                    $path = '../img/'.$img_name;
                    move_uploaded_file($img_tmp,$path);
                }

                $input = array(
                    'post_title' => Input::get('post_title'),
                    'post_author' => Input::get('post_author'),
                    'post_tags' => Input::get('post_tags'),
                    'post_category_id' => Input::get('post_category'),
                    'post_content' => Input::get('post_content'),
                    'post_status' => Input::get('post_status'),
                    'post_image' => $img_name
                );

                // echo "<pre>";
                // print_r($input);
                // echo '<br><br>';
                //echo Input::get('post_id');
                //die();
                $insert = DB::connect()->update('posts',$input,'=',array(
                    'post_id' => Input::get('post_id')
                ));
                if($insert->count())
                {
                    Session::put('success',"Successfully Post Updated");
                    // ob_start();
                    //header('location:../posts.php');
                    // ob_end_flush();
                }          
            }
            else{
                $errors = $validate->error();
                foreach($errors as $error)
                {
                   // echo $error.'<br>';
                }
            }
        }
    }


?>




<?php if(Session::exists('success')){ 


///here success information;


}

?>
<div>
    <h2>Edit post</h2>
</div>
<div class="col-md-6">
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">

        <label for="post-title">Post Title</label>
        <input type="text" value="<?php echo $posts->post_title; ?>" id="post-title" name="post_title" class="form-control">

    </div>
    <div class="form-group">
        <?php 
            $categories = DB::connect()->getAll('categories')->fetchAll()->result();    
        ?>
        <label for="post-category-id">Post Category</label>
        <select class="form-control" name="post_category" id="post-category-id">
            <?php foreach($categories as $category): ?>
            <option <?php if($category->cat_id==$posts->post_category_id) echo "selected"; ?> value="<?php echo $category->cat_id; ?>"><?php echo $category->cat_title;?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">

        <label for="post-status">Post Status</label>
        <select class="form-control" name="post_status" id="post-status">
            <option <?php if($posts->post_status==='draft'):?>selected<?php endif;?> value="draft">Draft</option>
            <option <?php if($posts->post_status==='published'):?>selected<?php endif;?> value="published">Published</option>
        </select>
    </div>
    <div class="form-group">

        <label for="post-author">Post Author</label>
        <input type="text" value="<?php echo $posts->post_author; ?>" name="post_author" id="post-author" class="form-control">

    </div>
    <div class="form-group">

        <label for="post-image">Post Image</label>
        <img style="width:50px;height:auto;" src="../img/<?php echo $posts->post_image;?>" alt="Previous Image">
        <input type="file" name="post_image" id="post-image" class="form-control">

    </div>
    <div class="form-group">

        <label for="post-content">Post Content</label>
        <textarea class="form-control" name="post_content" id="post-content" cols="30" rows="10"><?php echo $posts->post_content; ?>
        </textarea>

    </div>
    <div class="form-group">

        <label for="post-tag">Post Tag</label>
        <input type="text" value="<?php echo $posts->post_tags;?>" name="post_tags" id="post-tag" class="form-control">

    </div>
    <div class="form-group">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" class="btn btn-primary" name="update_post" value="Publish Post">
    </div>
</form>
</div>