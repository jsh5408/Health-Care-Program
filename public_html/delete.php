
<!-- 게시글 삭제 페이지 -->

<?php

    include './dbcon.php';

    $bid = $_GET['id'];

    // id와 일치하는 게시글 삭제 (id: 게시글의 고유 번호-user의 id와는 무관하다)
    $query="DELETE from board where id = '$bid'";
    mysqli_query($connect, $query);

    echo"
    <script>
    location.href='./board.php';
    </script>
    ";

 ?>
