
<!-- 회원탈퇴 기능 수행 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();
?>
<?php

    include './dbcon.php';

    if(!isset($_SESSION['user_id'])) {
      echo "<script>alert('로그인된 정보가 없습니다');location.href='./login_form.html';</script>";
       //exit;
     }
     else{
       // 회원 정보와 관련된 테이블의 내용들 전부 삭제
    $user_id = $_SESSION['user_id'];
     $query = "DELETE from member where m_id = '$user_id'";
     $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
     $query = "DELETE from std_body where m_id = '$user_id'";
     $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
     $query = "DELETE from mem_info_e where m_id = '$user_id'";
     $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
     $query = "DELETE from mem_info_f where m_id = '$user_id'";
     $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
     session_destroy();
     echo "<script>alert('회원탈퇴 완료');location.href='./main.php';</script>";
   }
?>
