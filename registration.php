<?php  include "includes/header.php"; ?>


   <!-- Navigation -->
   
<?php  include "includes/navigation.php"; ?>
<?php 

require_once 'init/init.php';

// if($_SERVER['REQUEST_METHOD']==='GET')
// {
//     header('location:registration.php');
// }

if($_SERVER['REQUEST_METHOD']==='POST')
{
    
    if(Token::check(Input::get('token_register'),'token_register')){
    $validate = new Validate();
    $validate->validation(array(
        'username' => array(
            'require' => true,
            'unique' => 'users',
            'max' => 30,
            'min' => 3
        ),
        'password' => array(
            'require' => true,
            'min' => 6,
            'max' => 30
        ),
        'confirm_password' => array(
            'require' => true,
            'match' => 'password'
        ),
        'email' => array(
            'require' => true,
            'unique' => 'users'
        )
    ));
    if(!count($validate->error()))
    {
        // echo 'yOU CAN insert data in your database';

        $password = Hash::generateHash(Input::get('password'));
        
        $input = array(
            'user_name' => Input::get('username'),
            'user_firstname' => 'empty',
            'user_lastname' => 'empty',
            'user_image' => 'default.jpg',
            'user_role' => 'subscriber',
            'user_password' => Hash::generateHash(Input::get('password')),
            'user_email' => Input::get('email')
        );
        $insert = DB::connect()->insert('users',$input);

        if($insert->count())
        {
            echo "<script> alert('successfully registered'); </script>";
            Session::put('user_role','subscriber');
            Session::put('username',Input::get('username'));
            header('location:index.php');
        }
    }
    else{
        foreach($validate->error() as $error)
        {
            echo $error.'<br>';
        }
    }
}
}

?>
    
 
    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form action="" method="post" >
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="c_password" class="sr-only">Confirm Password</label>
                            <input type="password" name="confirm_password" id="key" class="form-control" placeholder="Confirm Password">
                        </div>
                        <input type="hidden" name="token_register" value = "<?php echo Token::generate('token_register'); ?>">
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
