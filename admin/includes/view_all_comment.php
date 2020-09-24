<?php 
                        

    $comments = DB::connect()->getAll('comments')->fetchAll()->result();

    
    if(Input::exists($_SERVER['REQUEST_METHOD'])){
        if(isset($_GET['delete_comment']))
        {
            DB::connect()->delete('comments','=',array('comment_id'=>Input::get('delete_comment')));
            //header('Location:comment.php');
        }
        else if(isset($_GET['approve_comment']))
        {
            DB::connect()->update('comments',array('comment_status'=>'Approve'),'=',array('comment_id'=>Input::get('approve_comment')));
        }
        else if(isset($_GET['unapprove_comment']))
        {
            DB::connect()->update('comments',array('comment_status'=>'Unapprove'),'=',array('comment_id'=>Input::get('unapprove_comment')));
        }
    }



?>

<?php 


// $post_type = $_SERVER['REQUEST_METHOD'];

// if(Input::exists($post_type))
// {

//     $posts_delete = DB::connect()->delete('posts','=',array('post_id'=>Input::get('delete_post')));//->fetch()->result();
//     if($posts_delete->count()){
//     }
// }


?>


<table class="table table-hover table-bordered">

    <thead>
        <tr>
            <th>Comment Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Email</th>
            <th>Date</th>
            <th>In Response To</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
            <!-- <th>Update</th> -->
        </tr>
    </thead>
    <tbody>
        <?php foreach($comments as $comment): ?>
        <tr>
            <td><?php  echo $comment->comment_id;  ?></td>
            <td><?php  echo $comment->comment_author;  ?></td>
            <td><?php  echo $comment->comment_content;  ?></td>
            <td><?php  echo $comment->comment_status;  ?></td>
            <td><?php  echo $comment->comment_email; ?></td>
            <td><?php  echo $comment->comment_date;  ?></td>
            <?php $posts = DB::connect()->get('posts','=',array('post_id'=>$comment->comment_post_id))->fetch()->result(); ?>
            <td><a href="../post.php?post_id=<?php echo $posts->post_id;?>"><?php echo $posts->post_title;?></a></td>
            <td><a href="comment.php?approve_comment=<?php echo $comment->comment_id; ?>">Approve</a></td>
            <td><a href="comment.php?unapprove_comment=<?php echo $comment->comment_id; ?>">Unapprove</a></td>
            <td><a href="comment.php?delete_comment=<?php echo $comment->comment_id; ?>">Delete</a></td>
            
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>

