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
                   $posts =  DB::connect()->get('posts','=',array('post_status'=>'published'))->fetchAll()->result();
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
                   Created By <a href="post.php?author=<?php echo $post->post_author;?>&post_id=<?php echo $post->post_id; ?>"><?php echo $post->post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post->post_date;?></p>
                <hr>
                <a href="post.php?post_id=<?php echo $post->post_id; ?>">
                    <img class="img-responsive" src="img/<?php echo $post->post_image;?>" alt="Default Image">
                </a>
                <hr>
                <p><?php echo substr($post->post_content,0,strlen($post->post_content)/3); ?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post->post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    


                <hr>
                   <?php endforeach;?>
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