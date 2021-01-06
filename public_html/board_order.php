
<!-- 게시판 조회순/최신순 정렬을 위한 order idx를 저장하는 공간 -->

<?php

    // idx = 0: 조회순 / idx = 1: 최신순
    // board.php에서 값을 받아옵니다

    $_SESSION['order'] = $_POST['order'];

    echo"<script>location.href='./board.php';</script>";

 ?>
