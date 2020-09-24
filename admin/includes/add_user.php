<?php 


    $post_type = $_SERVER['REQUEST_METHOD'];
    if(Input::exists($post_type))
    {
        if(Token::check(Input::get('token')))
        {
            $validate = new Validate();
            $validate->validation(array(
                'username' => array(
                    'require' => true,
                    'max' => 2,
                    'max' => 100,
                ),
                'firstname' => array(
                    'require' => true,
                    'max' => 30,
                    'min'=> 3
                ),
                'lastname' => array(
                    'require' => true
                ),
                'email' => array(
                    'require' => true,
                    'max' => 80
                ),
                'userrole' => array(
                    'require' => true
                ),
                'password' => array(
                    'require' => true,
                    'min'=>6,
                    'max' => 50
                ),
                'c_password' => array(
                    'require' => true,
                    'match' => 'password'
                ),
                'image' => array(
                    'require' => true
                )
            ));
            // echo count($validate->error()).'<br>';
            // var_dump($validate->error());
            //die();
            $GLOBALS['flag'] = true;
            $GLOBALS['check'] = 'not exists';
            if(!count($validate->error()))
            {
                $GLOBALS['errors'] = $validate->error();
                $em = DB::connect()->get('users','=',array('user_email'=>Input::get('email')))->fetch();
                $un = DB::connect()->get('users','=',array('user_name'=>Input::get('username')))->fetch();
                if($em->count()||$un->count())
                {
                    $errors['exists'] = "Username or email already exists";
                    $GLOBALS['flag']=false;
                    $GLOBALS['check'] = 'exists';
                }
            }else{
                $GLOBALS['flag']=false;
            }
            $flag = $GLOBALS['flag'];
            if($flag)
            {
                //echo $flag.'<br>';
                $img_name = $_FILES['image']['name'];
                $img_tmp = $_FILES['image']['tmp_name'];
                $path = '../img/'.$img_name;

                $input = array(
                    'user_name' => Input::get('username'),
                    'user_firstname' => Input::get('firstname'),
                    'user_lastname' => Input::get('lastname'),
                    'user_password' => Input::get('password'),
                    'user_role' => Input::get('userrole'),
                    'user_email'=>Input::get('email'),
                    'user_image' => $img_name
                );

                // echo "<pre>";
                // print_r($input);

                $user = DB::connect()->insert('users',$input);
                if($user->count())
                {
                    Session::put('success_user',"Successfully User Added");
                    move_uploaded_file($img_tmp,$path);
                }          
            }
            else{
                $errors = $validate->error(); //$GLOBALS['error'];
                if($GLOBALS['check']==='exists'){
                    $errors['exists'] = 'Username or Email already exists';
                }
                // echo '<br><pre>';
                // print_r($errors);
                // die();
                foreach($errors as $error)
                {
                    echo $error.'<br>';
                }
            }
        }
    }


?>

<?php if(Session::exists('success_user')){ ?>
    <div class="success">
        <p><?php echo "User Added : ";?> <a href="./users.php">View User</a> <?php Session::delete('success_user');?></p>
    </div>
<?php 
}
?>
<div>
    <h2>Add New User</h2>
</div>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">

        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control">

    </div>
    <div class="form-group">
        <label for="userrole">User Role</label>
        <select class="form-control" name="userrole" id="post-category-id">
            <option selected value="">Select</option>
            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="form-group">

        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname" class="form-control">

    </div>
    <div class="form-group">

        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname" class="form-control">

    </div>
    <div class="form-group">
        <label for="email">User Email</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">

        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">

        <label for="c_password">Confirm Password</label>
        <input type="password" name="c_password" id="c_password" class="form-control">
    </div>
    <div class="form-group">

        <label for="user-image">User Image</label>
        <input type="file" name="image" id="user-image" class="form-control">

    </div>
    
    <div class="form-group">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" class="btn btn-primary" name="add_user" value="ADD User">
    </div>
</form>