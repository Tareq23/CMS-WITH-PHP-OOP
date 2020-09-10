<?php 
                        

    $posts = DB::connect()->getAll('posts')->fetchAll()->result();


?>
<table class="table table-hover table-bordered">

    <thead>
        <tr>
            <th>Post Id</th>
            <th>Post Category Id</th>
            <th>Post Title</th>
            <th>Post Author</th>
            <th>Post Date</th>
            <th>Post Image</th>
            <th>Post Content</th>
            <th>Post Tags</th>
            <th>Total Post Comments</th>
            <th>Post Status</th>
            <th>Post Users</th>
            <th>Post View Count</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($posts as $post): ?>
        <tr>
            <td><?php  echo $post->post_id;  ?></td>
            <td><?php  echo $post->post_category_id;  ?></td>
            <td><?php  echo $post->post_title;  ?></td>
            <td><?php  echo $post->post_author;  ?></td>
            <td><?php  echo $post->post_date;  ?></td>
            <td><img src="../img/<?php  echo $post->post_image;  ?>" alt="Default Image"></td>
            <td><?php  echo $post->post_content;  ?></td>
            <td><?php  echo $post->post_tags;  ?></td>
            <td><?php  echo $post->post_comment_count;  ?></td>
            <td><?php  echo $post->post_status;  ?></td>
            <td><?php  echo $post->post_user;  ?></td>
            <td><?php  echo $post->post_views_count;  ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>