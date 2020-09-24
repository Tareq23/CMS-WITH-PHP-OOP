<?php
require_once 'init/init.php';

$obj = DB::connect()->getAll('categories')->fetchAll()->result();

include_once  'includes/header.php';
?>

    <!-- Navigation -->
        <?php include_once 'includes/navigation.php'; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php 
                   if($_SERVER['REQUEST_METHOD']==='GET'&&(!empty(Input::get('post_id')))&&(!empty(Input::get('author'))))
                   {
                        // $user = DB::connect()->orderBy(array('post_id'))->get('posts','=',array('post_author'=>Input::get('author')))->fetchAll();

                        // if($user->count())
                        // {
                        //     echo "Have more than one or equal post";
                        // }
                    
                       include 'includes/post_author.php';
                   }
                   else if($_SERVER['REQUEST_METHOD']==='GET'&&(!empty(Input::get('post_id'))))
                   {
                       $post =  DB::connect()->get('posts','=',array('post_id'=>Input::get('post_id')))->fetch()->result();
                       $update = DB::connect()->update('posts',array('post_view_count'=>($post->post_view_count+1)),'=',array('post_id'=>Input::get('post_id')));
                   //foreach($posts as $post):
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
                    by <a href="post.php?author=<?php echo $post->post_author;?>&post_id=<?php echo $post->post_id;?>"><?php echo $post->post_author;?></a>
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
                <!-- Comment -->
                <!-- <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. -->
                        <!-- Nested Comment -->
                     <!--   <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div> -->
                        <!-- End Nested Comment --><!--
                    </div>
                </div>        -->
    
    

                <hr>
                   <?php
                }
                
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->

            <?php include_once 'includes/sidebar.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php 

    include_once 'includes/footer.php';

?>