<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Start CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">


                    <?php 

                        require_once 'init/init.php';
                        $categories = DB::connect()->getAll('categories')->fetchAll()->result();

                        foreach($categories as $category)
                        {
                            ?>
                            <li><a href="category.php?cat_id=<?php echo $category->cat_id; ?>"><?php echo $category->cat_title; ?></a></li>
                            <?php
                        }

                    if(Session::get('user_role')==='admin'): ?>
                    
                    <li><a href="admin">Admin</a></li>
                    <?php endif;
                    ?>
                </ul>
                <?php if(Session::exists('user_role')): ?>
                <ul class="nav navbar-nav navbar-right top-nav">
                    <li><a href="admin/profile.php">Welcome to <?php echo Session::get('username'); ?></a></li>
                </ul>
                <?php endif; ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>