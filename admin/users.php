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
                            Welcome To Admin
                            <small>author</small>
                        </h1>
                        



                        <?php 
                        
                        
                        if(isset($_GET['source'])) $source = $_GET['source'];
                        else{
                            $source = '';
                        }
                        switch($source)
                        {
                            case 'add_user':
                                include_once 'includes/add_user.php';
                            break;
                            case 'update_user':
                                include_once 'includes/update_user.php';
                            break;
                            // case 'delete_post':
                            //     include_once 'includes/delete_post.php';
                            // break;
                            case '200':
                                echo '200 pages';
                            break;
                            default:
                            include_once 'includes/view_all_user.php';
                        break;   
                        }


                        
                        ?>


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