
<!-- calculate했던 운동에 따른 누적 칼로리 소모량을 초기화 시켜주는 페이지 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();
?>
<?php
    include './dbcon.php';

    $id=$_SESSION['user_id'];

    // session에도 0으로 초기화 시켜준다
    $_SESSION['e_kcal'] = 0;
    $exercise_kcal = $_SESSION['e_kcal'];

    // 초기화 시, 지금까지 누적된 계산량 0으로 초기화
    $query3="UPDATE std_body SET exercise_kcal = '$exercise_kcal' where m_id = '$id'";
    $result3 = mysqli_query($connect, $query3);

    // 초기화 시, 했던 운동들의 정보들도 초기화
    $query="DELETE from mem_info_e where m_id = '$id'";
    mysqli_query($connect, $query);

    echo "<script>location.href='./main.php';</script>";
 ?>
