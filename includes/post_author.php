<?php

// echo Input::get('author').'<br>';
$user = DB::connect()->orderBy(array('post_id'))->get('posts','=',array('post_author'=>Input::get('author')))->fetchAll();
$posts = $user->result();

foreach($posts as $post):
?>

<h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?post_id=<?php echo $post->post_id;?>"><?php echo $post->post_title ;?></a>
                </h2>
                <p class="lead">
                    Created By <a href="post.php?author=<?php echo $post->post_author;?>&post_id=<?php echo $post->post_id;?>"><?php echo $post->post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post->post_date;?></p>
                <hr>
                <a href="post.php?post_id=<?php echo $post->post_id;?>">
                <img class="img-responsive" src="img/<?php echo $post->post_image;?>" alt="Default Image">
                </a>
                <hr>
                <p><?php echo substr($post->post_content,0,strlen($post->post_content)/3); ?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post->post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                     
                    
                    
                    <?php 
                        include_once 'post_comment.php';
                        $comments = DB::connect()->get('comments','=',array('comment_post_id'=>$post->post_id))->fetchAll()->result();
                    ?>
                    
                    
                    
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php foreach($comments as $comment){
                    if($comment->comment_status=='Approve'){    
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">author:<?php echo $comment->comment_author; ?>
                            <small><?php echo $comment->comment_date; ?></small>
                        </h4>
                        <?php echo $comment->comment_content; ?>
                    </div>
                </div>
                    <?php }}?>

<?php endforeach;?>
