
<!-- exercise.php 페이지의 칼로리 계산을 해주는 페이지 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();
?>

<?php
//    error_reporting(E_ALL);  ini_set("display_errors", 1);

    include './dbcon.php';

    $name=$_POST['name'];
    $time=$_POST['time'];
    $idx = $_SESSION['e_idx'];
    $id = $_SESSION['user_id'];
    $exercise_kcal = $_SESSION['e_kcal'];
    $food_kcal = $_SESSION['user_kcal'];

    // exercise 테이블 안의 운동 이름과 계산하고자 하는 운동 이름이 일치하는 경우를 찾아서 칼로리 정보를 가져다가 계산
    // e_idx: 같은 운동이라도 몸무게에 따라 다른 칼로리가 소모되기 때문에 사용자의 몸무게가 어떤 범위에 속하는지 알려주는 인덱스
    $query="SELECT * from exercise where e_name='$name' and e_idx='$idx'";
    $result = mysqli_query($connect, $query);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    // 테이블 안의 운동 이름과 계산하고자 하는 운동 이름이 일치하지 않는 경우 -> 입력 정보가 틀렸거나 빈칸임
    if(!$num || !$time){
      echo "<script>alert('일치하는 정보가 없거나 빈칸입니다');location.href='./exercise.php';</script>";
    }
    else{ // exercise.php에서 입력된 name과 time을 바탕으로 소모된 칼로리량 계산
    $_SESSION['e_kcal'] += ($row['e_kcal'] / 10) * $time;
    $kcal = $_SESSION['e_kcal'];

    // 밑의 세션 변수는 사용자가 했던 운동의 이름들을 mem_info_e 테이블에 저장하기 위해 사용되는 변수이다.
    $_SESSION['user_exercise'] = $name;

    $query2="INSERT into mem_info_e(m_id, e_name, e_time) values('$id', '$name', '$time')";
    mysqli_query($connect, $query2);
    $query3="UPDATE std_body SET food_kcal='$food_kcal', exercise_kcal = '$exercise_kcal' where m_id = '$id'";
    $result3 = mysqli_query($connect, $query3);

    echo "<script>alert('계산 완료');location.href='./main.php';</script>";
  }
 ?>
