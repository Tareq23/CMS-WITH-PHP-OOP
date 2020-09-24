<div class="col-md-4">



    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method = "post">    
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <input name="search_token"type="hidden"value="<?php echo Token::generate('search_token'); ?>">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    <!-- /.input-group -->
    </div>
    <div class="well">
        <a class="btn btn-primary" href="registration.php">New Register</a>
    </div>


    <!-- login group-->
    <?php //if(Session::exists('user')): ?>
    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method = "post">    
            <div class="input-group">
                <span>Username: </span>
                <input name="username" type="text" class="form-control" placehodler="Enter Username">
            </div>
            <div class="input-group">
                <span>Password: </span>
                <input type="password" name="password" placehoder="Enter Your Password" class="form-control">
                <input name="login_token"type="hidden"value="<?php echo Token::generate('login_token'); ?>">
                <span class="input-group">
                    <button name="login" class="btn btn-primary" type="submit">login
                        <!-- <span class="glyphicon glyphicon-search"></span> -->
                    </button>
                </span>
            </div>
        </form>
    <!-- /.input-group -->
    </div>
    <?php //endif; ?>







    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            

            <div class="col-lg-6">
                <ul class="list-unstyled">

                <?php 
                    $categories = DB::connect()->getAll('categories')->fetchAll()->result();
                    $cnt = 1;
                    foreach($categories as $category){
                        if($cnt>3)break;
                        $cnt++;
                ?>
                    <li><a href="category.php?cat_id=<?php echo $category->cat_id; ?>"><?php echo $category->cat_title;?></a>
                    <?php } ?>
                </ul>
            </div>

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>