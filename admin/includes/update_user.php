<?php
 


    $post_type = $_SERVER['REQUEST_METHOD'];
    if(Input::exists($post_type)&&$post_type=='POST')
    {
        if(Token::check(Input::get('token')))
        {
            $validate = new Validate();
            $validate->validation(array(
                
                'firstname' => array(
                    'require' => true,
                    'max' => 30,
                    'min'=> 3
                ),
                'lastname' => array(
                    'require' => true
                ),
                'userrole' => array(
                    'require' => true
                ),
                'password' => array(
                    'min' => (!empty(Input::get('password')))?6:0,
                    'max' => (!empty(Input::get('password')))?30:0
                ),
                'c_password' => array(
                    'match' => 'password'
                )
                
            ));
            // echo count($validate->error()).'<br>';
            // var_dump($validate->error());
            //die();
            $GLOBALS['flag'] = true;
            $GLOBALS['check'] = 'not exists';
            if(!count($validate->error()))
            {
                $input = array(
                   // 'user_name' => Input::get('username'),
                    'user_firstname' => Input::get('firstname'),
                    'user_lastname' => Input::get('lastname'),
                    //'user_password' => Input::get('password'),
                    'user_role' => Input::get('userrole')
                    //'user_email'=>Input::get('email'),
                    //'user_image' => $img_name
                );

                // echo "<pre>";
                // print_r($input);

                $user = DB::connect()->update('users',$input,'=',array('user_id'=>Input::get('user_id')));
                if($user->count())
                {
                    Session::put('success_user',"Successfully User Updated");
                    //header('location:../users.php');
                    //move_uploaded_file($img_tmp,$path);
                }
                if(!empty(Input::get('password'))){
                    $user = DB::connect()->update('users',array('user_password'=>Hash::generateHash(Input::get('password'))),'=',array('user_id'=>Input::get('user_id')));
                }          
            }
            else{
                $errors = $validate->error(); //$GLOBALS['error'];
                
                foreach($errors as $error)
                {
                    echo $error.'<br>';
                }
            }
        }
    }


?>

<?php if(Session::exists('success')){ ?>
    <div class="success">
        <p><?php echo $_SESSION['success'] ;Session::delete('success');?></p>
    </div>
<?php 
}
?>
<div>
    <h2>Update User</h2>
</div>

<form action="" method="post" enctype="multipart/form-data">
<!-- 
    <div class="form-group">

        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control">

    </div> -->

    <?php
    if(isset($_GET['user_id']))
    {
     $user = DB::connect()->get('users','=',array('user_id'=>Input::get('user_id')))->fetch()->result();
    }
    ?>
    <div class="form-group">

        <label for="firstname">First Name</label>
        <input type="text" value="<?php echo $user->user_firstname; ?>" name="firstname" id="firstname" class="form-control">

    </div>
    <div class="form-group">

        <label for="lastname">Last Name</label>
        <input type="text" value="<?php echo $user->user_lastname; ?>" name="lastname" id="lastname" class="form-control">

    </div>
    <div class="form-group">
        <label for="userrole">User Role</label>
        <select class="form-control" name="userrole" id="post-category-id">
            <!-- <option selected value="">Select</option> -->
            <option <?php if($user->user_role=='subscriber') echo "selected"; ?> value="subscriber">Subscriber</option>
            <option <?php if($user->user_role=='admin') echo "selected"; ?> value="admin">Admin</option>
        </select>
    </div>
    <!-- <div class="form-group">
        <label for="email">User Email</label>
        <input type="email" name="email" id="email" class="form-control">
    </div> -->
    <div class="form-group">

        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">

        <label for="c_password">Confirm Password</label>
        <input type="password" name="c_password" id="c_password" class="form-control">
    </div>
    <!-- <div class="form-group">

        <label for="user-image">User Image</label>
        <input type="file" name="image" id="user-image" class="form-control">

    </div>
     -->
    <div class="form-group">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
    </div>
    <?php  ?>
</form>