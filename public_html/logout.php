
<!-- 로그아웃 수행 -->

<?php
    session_start();
    include './dbcon.php';

    $id=$_SESSION['user_id'];
    $pwd=$_SESSION['user_pwd'];

    $exercise_kcal = $_SESSION['e_kcal'];
    $food_kcal = $_SESSION['user_kcal'];

    if(!isset($_SESSION['user_id'])) {
      echo "<script>alert('로그인된 정보가 없습니다');location.href='./login_form.html';</script>";
       //exit;
     }
     else{
       // 로그아웃 시점까지의 누적 계산 칼로리들 update
       $query3="UPDATE std_body SET food_kcal='$food_kcal', exercise_kcal = '$exercise_kcal' where m_id = '$id'";
       $result3 = mysqli_query($connect, $query3);
       $res = session_destroy();
    }
    if($res){
      echo "<script>alert('로그아웃 완료');location.href='./main.php';</script>";
    }
 ?>
