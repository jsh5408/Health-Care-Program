
<!-- 수정된 게시글을 db에 update 해주는 역할 -->

<?php

    include './dbcon.php';

    $bid = $_GET['uid'];
    $title = $_POST['b_title'];
    $content = $_POST['b_content'];
    $count = $_POST['b_count'];

    // 수정된 게시글 update
    $query="UPDATE board SET title = '$title', content = '$content', count = '$count' where id = '$bid'";
    mysqli_query($connect, $query);

    echo"<script>  location.href='./board.php';</script>";

 ?>
