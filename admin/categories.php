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
                    if(isset($_REQUEST['add_category']))
                    {
                        if(Token::check($_POST['token'])){
                            if(!empty($_POST['cat_title']))
                            {
                                $cat_title = $_POST['cat_title'];
                                //$_POST['cat_title'] = '';
                                $insert = DB::connect()->insert('categories',array('cat_title'=>$cat_title));
                                if($insert->count())
                                {
                                    //Token::delete('token');
                                    echo 'Successfully inserted';
                                }
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-xs-6">
                    <form action="" method="post">
                    
                        <div class="form-group">
                            <label for="cat-title">Add Category</label>
                            <input class = "form-control" type="text"id="cat-title"name="cat_title">
                        </div>
                        <input name="token"type="hidden"value="<?php echo Token::generate(); ?>">
                        <div class="form-group">
                            <input class = "btn btn-primary" type="submit"name="add_category" value="Add Category">
                        </div> 
                    </form>
                </div>
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <?php
   
                            $delete_id = (isset($_GET['delete_id']))?$_GET['delete_id']:'';
                            DB::connect()->delete('categories','=',array('cat_id'=>$delete_id));
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