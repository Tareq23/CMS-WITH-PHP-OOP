<?php include_once 'includes/header.php';?>



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
                <div>
                    <?php
                    $update_id = (isset($_GET['update_id']))?$_GET['update_id']: '';
                    $category = DB::connect()->get('categories','=',array('cat_id'=>$update_id))->fetch()->result(); 
                    if(isset($_REQUEST['update_category']))
                    {
                        if(Token::check($_POST['token'])){
                            if(!empty($_POST['cat_title']))
                            {
                                $cat_title = $_POST['cat_title'];
                                // $cat_title;
                                //die();
                                $update = DB::connect()->update('categories',array('cat_title'=>$cat_title),'=',array('cat_id'=>$category->cat_id));
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-xs-6">
                    <a class="btn btn-primary" href="categories.php">Back</a>
                    <form action="" method="post">
                    
                        <div class="form-group">
                            <label for="cat-title">Update Category</label>
                            <input class = "form-control" type="text"id="cat-title"name="cat_title"value="<?php echo $category->cat_title;?>">
                        </div>
                        <input name="token"type="hidden"value="<?php echo Token::generate(); ?>">
                        <div class="form-group">
                            <input class = "btn btn-primary" type="submit"name="update_category" value="Update Category">
                        </div> 
                    </form>
                </div>
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <?php
                            
                            $categories = DB::connect()->getAll('categories')->fetchAll()->result();
                        ?>
                        <thead>
                            <tr>
                                <th>Category Id</th>
                                <th>Category Title</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($categories as $category): ?>
                            <tr>
                                <td><?php echo $category->cat_id; ?></td>
                                <td><?php echo $category->cat_title; ?></td>
                                <td>
                                    <td><a href="?delete_id=<?php echo $category->cat_id;?>">Delete</a></td>
                                    <td><a href="update_category.php?update_id=<?php echo $category->cat_id;?>">Update</a></td>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>

                </div>
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