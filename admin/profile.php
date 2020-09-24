<?php 

include_once 'includes/header.php';

?>
    <div id="wrapper">





        <!-- Navigation -->
        <?php 
        
        include_once 'includes/navigation.php';

        ?>





        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To <?php if(Session::exists('user_role'))echo Session::get('user_role'); ?>
                            <small><?php if(Session::exists('username'))echo Session::get('username'); ?></small>
                        </h1>
 
                    </div>
                </div>
                <!-- /.row -->
                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->





<?php
    include_once 'includes/footer.php';
?>