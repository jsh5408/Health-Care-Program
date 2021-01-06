
<!-- course.php 페이지의 칼로리 계산을 해주는 페이지 - course.php는 음식 칼로리 계산 페이지 입니다 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();
?>

<?php
//    error_reporting(E_ALL);  ini_set("display_errors", 1);

    include './dbcon.php';

    $category=$_POST['category'];
    $name=$_POST['name'];
    $id = $_SESSION['user_id'];
    $exercise_kcal = $_SESSION['e_kcal'];
    $food_kcal = $_SESSION['user_kcal'];

    // food 테이블 안의 음식 이름과 계산하고자 하는 음식 이름이 일치하는 경우를 찾아서 칼로리 정보를 가져다가 계산
    $query="SELECT * from food where f_category='$category' and f_name='$name'";
    $result = mysqli_query($connect, $query);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    // 테이블 안의 음식 이름과 계산하고자 하는 음식 이름이 일치하지 않는 경우 -> 입력 정보가 틀렸거나 빈칸임
    if(!$num){
      echo "<script>alert('일치하는 정보가 없거나 빈칸입니다');location.href='./course.php';</script>";
    }
    else{ // course.php에서 입력된 name을 바탕으로 섭취한 칼로리량 계산

    $_SESSION['user_kcal'] += $row['f_kcal'];
    $food_kcal = $_SESSION['user_kcal'];

    // 밑의 세션 변수는 사용자가 했던 음식의 이름들을 mem_info_f 테이블에 저장하기 위해 사용되는 변수이다.
    $_SESSION['user_food'] = $name;

    $query2="INSERT into mem_info_f(m_id, f_name) values('$id', '$name')";
    mysqli_query($connect, $query2);
    $query3="UPDATE std_body SET food_kcal='$food_kcal', exercise_kcal = '$exercise_kcal' where m_id = '$id'";
    $result3 = mysqli_query($connect, $query3);



    echo "<script>alert('계산 완료');location.href='./course.php';</script>";
  }
 ?>
