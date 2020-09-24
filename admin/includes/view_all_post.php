<?php 


$post_type = $_SERVER['REQUEST_METHOD'];

if(Input::exists($post_type))
{

    $posts_delete = DB::connect()->delete('posts','=',array('post_id'=>Input::get('delete_post')));//->fetch()->result();
    if($posts_delete->count()){
    }
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
    // if(Token::check('bulk_token'))
    // {
    // }
    //echo Input::get('bulkOption');
    $checkBoxArray = Input::get('checkBoxArray');
    $checkBoxArray = is_array($checkBoxArray)?$checkBoxArray:array();
    foreach($checkBoxArray as $post_id)
    {
        $bulk_option = Input::get('bulkOption');
        switch($bulk_option)
        {
            case 'published':
                DB::connect()->update('posts',array('post_status'=>'published'),'=',array('post_id'=>$post_id));
            break;
            case 'delete':
                DB::connect()->delete('posts','=',array('post_id'=>$post_id));
            break;
            case 'draft':
                DB::connect()->update('posts',array('post_status'=>'draft'),'=',array('post_id'=>$post_id));
            break;
        }
    }
    //print_r($checkBoxArray);
}

$posts = DB::connect()->getAll('posts')->fetchAll()->result();
?>

<form action="" method="post">
    <table class="table table-hover table-bordered">
            <div style="padding:0px;" id="bulkOptionContainer" class="col-md-4">
            
                <select class="form-control" name="bulkOption" id="">
                    <option value="">Select Once</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                </select>

            </div>
            <div class="col-md-4">
                
                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
            </div>

        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Post Category</th>
                <th>Post Title</th>
                <th>Post Author</th>
                <th>Post Date</th>
                <th>Post Image</th>
                <!-- <th>Post Content</th> -->
                <th>Post Tags</th>
                <th>Comments</th>
                <th>Post Status</th>
                <th>Post Users</th>
                <th>View Count</th>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($posts as $post): ?>
            <tr>
                <?php $category = DB::connect()->get('categories','=',array('cat_id'=>$post->post_category_id))->fetch()->result(); ?>
                <td><input  type="checkbox" class="checkBox" name="checkBoxArray[]" value="<?php echo $post->post_id; ?>"></td>
                <td><?php  echo $category->cat_title;  ?></td>
                <td><?php  echo $post->post_title;  ?></td>
                <td><?php  echo $post->post_author;  ?></td>
                <td><?php  echo $post->post_date;  ?></td>
                <td><img style="width:80px;height:auto;" src="../img/<?php  echo $post->post_image;  ?>" alt="Default Image"></td>
                <td><?php  echo $post->post_tags;  ?></td>
                <td><?php  echo $post->post_comment_count;  ?></td>
                <td><?php  echo $post->post_status;  ?></td>
                <td><?php  echo $post->post_user;  ?></td>
                <td><?php  echo $post->post_view_count;  ?></td>
                <td><a onClick=\"javascript:return delete_confirm('Are you sure want to delete this?')\" href="posts.php?delete_post=<?php echo $post->post_id; ?>">Delete</a></td>
                <td><a href="posts.php?source=update_post&post_id=<?php echo $post->post_id; ?>">Update</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</form>