<?php 
                        

    $users = DB::connect()->getAll('users')->fetchAll()->result();


?>

<?php 


$post_type = $_SERVER['REQUEST_METHOD'];

if(Input::exists($post_type))
{

    $user_delete = DB::connect()->delete('users','=',array('user_id'=>Input::get('delete_user')));//->fetch()->result();
    if($user_delete->count()){
    }
}


?>


<table class="table table-hover table-bordered">

    <thead>
        <tr>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>User Image</th>
            <th>User Role</th>

            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            
            <td><?php  echo $user->user_name;  ?></td>
            <td><?php  echo $user->user_firstname;  ?></td>
            <td><?php  echo $user->user_lastname;  ?></td>
            <td><?php  echo $user->user_email  ?></td>
            <td><img style="width:80px;height:auto;" src="../img/<?php  echo $user->user_name  ?>" alt="Default Image"></td>
            <td><?php  echo $user->user_role;  ?></td>
            
            <td><a href="users.php?delete_user=<?php echo $user->user_id; ?>">Delete</a></td>
            <td><a href="users.php?source=update_user&user_id=<?php echo $user->user_id; ?>">Update</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>