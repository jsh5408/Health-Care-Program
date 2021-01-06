
<!-- 회원정보수정 후 DB에 update 및 정보에 따라 값이 달라지는 변수들을 다시 계산 해주는 페이지 -->

<?php

    include './dbcon.php';

    $id=$_SESSION['user_id'];
    $pwd=$_POST['pwd'];
    $name=$_POST['name'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $height=$_POST['height'];
    $weight=$_POST['weight'];
    $act=$_POST['act'];


    // 회원 정보 수정 페이지에서 입력한 값들을 기준으로 update
    $query="UPDATE member SET m_pwd = '$pwd', m_name = '$name', m_age = '$age', m_act='$act' where m_id = '$id'";
    $result = mysqli_query($connect, $query);
    $query2="UPDATE member SET m_gender='$gender', m_height='$height', m_weight='$weight' where m_id='$id'";
    $result2 = mysqli_query($connect, $query2);


    // 변경된 값들 기준으로 표준체중 및 권장 섭취량 다시 계산
    if($_SESSION['user_weight']<=55){ // 몸무게별로 다른 칼로리 소모량(운동)->어느 몸무게 범위에 속하는지 계산
      $_SESSION['e_idx'] = 0;
    }
    else if($_SESSION['user_weight']<65 && $_SESSION['user_weight']>=55){
      $_SESSION['e_idx'] = 1;
    }
    else if($_SESSION['user_weight']<75 && $_SESSION['user_weight']>=65){
      $_SESSION['e_idx'] = 2;
    }
    else if($_SESSION['user_weight']<85 && $_SESSION['user_weight']>=75){
      $_SESSION['e_idx'] = 3;
    }
    else if($_SESSION['user_weight']>=85){
      $_SESSION['e_idx'] = 4;
    }

    if($_SESSION['user_gender'] == 'female')
    {
      $w = $_SESSION['user_height'] * $_SESSION['user_height'] * 0.0001 * 21;
      $_SESSION['std_w'] = $w;
    }
    else {
      $w = $_SESSION['user_height'] * $_SESSION['user_height'] * 0.0001 * 22;
      $_SESSION['std_w'] = $w;
    }
    $std_weight=$_SESSION['std_w']; // 표준 체중

    if($_SESSION['user_act'] == 0)
    {
      $amount = $w * 35;
    }
    if($_SESSION['user_act'] == 1)
    {
      $amount = $w * 30;
    }
    if($_SESSION['user_act'] == 2)
    {
      $amount = $w * 40;
    }
    $_SESSION['rec_amount'] = $amount;
    $std_kcal = $_SESSION['rec_amount'];  // 권장 섭취량

    $food_kcal = $_SESSION['user_kcal'];
    $exercise_kcal = $_SESSION['e_kcal'];


    // std_body의 정보들도 update해줍니다 (체중과 키가 변할 시 표준체중..들도 바뀌어야 하므로)
    $query3="UPDATE std_body SET food_kcal='$food_kcal', exercise_kcal = '$exercise_kcal' where m_id = '$id'";
    $result3 = mysqli_query($connect, $query3);

    $query4="UPDATE std_body SET std_kcal='$std_kcal', std_weight = '$std_weight' where m_id = '$id'";
    $result4 = mysqli_query($connect, $query4);

    // update가 모두 잘되면 if문 수행
    if($result == 1 && $result2 == 1 && $result3 == 1 && $result4 == 1)
    {
      $_SESSION['user_id'] = $id;
      $_SESSION['user_name'] = $name;
      $_SESSION['user_age'] = $age;
      $_SESSION['user_pwd'] = $pwd;
      $_SESSION['user_gender'] = $gender;
      $_SESSION['user_height'] = $height;
      $_SESSION['user_weight'] = $weight;
      $_SESSION['std_w'] = $std_weight;
      $_SESSION['user_act'] = $act;
      $_SESSION['e_kcal'] = $exercise_kcal;
      $_SESSION['user_kcal'] = $food_kcal;
    }

    echo"
    <script>
    location.href=history.go(-2);
    </script>
    ";

 ?>
