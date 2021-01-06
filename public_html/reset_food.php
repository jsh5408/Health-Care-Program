
<!-- calculate했던 누적 음식 섭취량을 초기화 시켜주는 페이지 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();
?>
<?php
//    error_reporting(E_ALL);  ini_set("display_errors", 1);

    include './dbcon.php';

    $id=$_SESSION['user_id'];

    // session에도 0으로 초기화 시켜준다
    $_SESSION['user_kcal'] = 0;
    $food_kcal = $_SESSION['user_kcal'];

    // 초기화 시, 지금까지 누적된 계산량 0으로 초기화
    $query3="UPDATE std_body SET food_kcal='$food_kcal' where m_id = '$id'";
    $result3 = mysqli_query($connect, $query3);

    // 초기화 시, 섭취한 음식들의 정보들도 초기화
    $query="DELETE from mem_info_f where m_id = '$id'";
    mysqli_query($connect, $query);

    echo "<script>location.href='./course.php';</script>";
 ?>
