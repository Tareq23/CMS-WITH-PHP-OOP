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
                ),
                'post_image' => array(
                    'require' => true
                )
            ));
            // echo count($validate->error()).'<br>';
           // var_dump($validate->error());
            //die();
            if(!count($validate->error()))
            {
                $img_name = $_FILES['post_image']['name'];
                $img_tmp = $_FILES['post_image']['tmp_name'];
                $path = '../img/'.$img_name;

                $input = array(
                    'post_title' => Input::get('post_title'),
                    'post_author' => Input::get('post_author'),
                    'post_tags' => Input::get('post_tags'),
                    'post_category_id' => Input::get('post_category'),
                    'post_content' => Input::get('post_content'),
                    'post_status' => Input::get('post_status'),
                    'post_image' => $img_name
                );

                echo "<pre>";
                print_r($input);
                echo '<br><br>';
                $insert = DB::connect()->insert('posts',$input);
                if($insert->count())
                {
                    Session::put('success',"Successfully Post Added");
                    move_uploaded_file($img_tmp,$path);
                }          
            }
            else{
                $errors = $validate->error();
                foreach($errors as $error)
                {
                    echo $error.'<br>';
                }
            }
        }
    }


?>

<?php if(Session::exists('success')){ ?>
    <div class="success">
        <p><?php echo $_SESSION['success'] ;Session::delete('success');?></p>
    </div>
<?php 
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">

        <label for="post-title">Post Title</label>
        <input type="text" id="post-title" name="post_title" class="form-control">

    </div>
    <div class="form-group">
        <?php 
            $categories = DB::connect()->getAll('categories')->fetchAll()->result();    
        ?>
        <label for="post-category-id">Post Category</label>
        <select class="form-control" name="post_category" id="post-category-id">
            <?php foreach($categories as $category): ?>
            <option value="<?php echo $category->cat_id; ?>"><?php echo $category->cat_title;?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">

        <label for="post-author">Post Author</label>
        <input type="text" name="post_author" id="post-author" class="form-control">

    </div>
    <div class="form-group">

        <label for="post-image">Post Image</label>
        <input type="file" name="post_image" id="post-image" class="form-control">

    </div>
    <div class="form-group">

        <label for="post-content">Post Content</label>
        <textarea class="form-control" name="post_content" id="post-content" cols="30" rows="10"></textarea>

    </div>
    <div class="form-group">

        <label for="post-tag">Post Tag</label>
        <input type="text" name="post_tags" id="post-tag" class="form-control">

    </div>
    <div class="form-group">

        <label for="post-status">Post Status</label>
        <input type="text" name="post_status" id="post-status" class="form-control">
    </div>
    <div class="form-group">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" class="btn btn-primary" name="add_post" value="Publish Post">
    </div>
</form>