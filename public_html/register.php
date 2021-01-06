
<!-- 회원가입한 정보를 DB에 넣어주는 역할 -->

<?php
//    error_reporting(E_ALL);  ini_set("display_errors", 1);

    include './dbcon.php';

    $id=$_POST['id'];
    $pwd=$_POST['pwd'];
    $name=$_POST['name'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $height=$_POST['height'];
    $weight=$_POST['weight'];
    $act=$_POST['act'];

    // session 변수 이용 이유: 로그인 후 페이지 이동에도 값들 유지 위해서
    $_SESSION['user_gender'] = $gender;
    $_SESSION['user_height'] = $height;
    $_SESSION['user_weight'] = $weight;
    $_SESSION['user_act'] = $act;

    $query="SELECT m_id, m_pwd from member where m_id='$id'";
    $result = mysqli_query($connect, $query);
    $num = mysqli_num_rows($result);
    //$row = mysqli_fetch_array($result);

    // 아이디가 존재하는지 판단
    if ($num) {
      echo "<script>alert('해당 아이디가 존재함');history.go(-1)</script>";
    } else {  // 없으면 가입

      // 몸무게별로 다른 칼로리 소모량(운동)->어느 몸무게 범위에 속하는지 계산
      if($_SESSION['user_weight']<=55){
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

      // 성별에 따라 다른 표준 체중 계산
      if($_SESSION['user_gender'] == 'female')
      {
        $w = $_SESSION['user_height'] * $_SESSION['user_height'] * 0.0001 * 21;
        $_SESSION['std_w'] = $w;
      }
      else {
        $w = $_SESSION['user_height'] * $_SESSION['user_height'] * 0.0001 * 22;
        $_SESSION['std_w'] = $w;
      }
      $std_weight=$_SESSION['std_w'];

       // 활동량에 따라 다른 권장 섭취량 계산
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
      $std_kcal = $_SESSION['rec_amount'];

      // 누적된 값 0으로 초기화
      $_SESSION['e_kcal'] = 0;
      $_SESSION['user_kcal'] = 0;

      // 모든 값들을 해당 테이블에 저장

      $query="INSERT into member(m_id, m_pwd, m_name, m_age, m_gender, m_height, m_weight, m_act) values('$id', '$pwd', '$name', '$age', '$gender', '$height', '$weight', '$act')";
      mysqli_query($connect, $query);

      $query="INSERT into std_body(m_id, std_kcal, std_weight, food_kcal, exercise_kcal) values('$id', '$std_kcal', '$std_weight', '$food_kcal', '$exercise_kcal')";
      mysqli_query($connect, $query);

      echo "<script>alert('회원가입이 완료되었습니다'); location.href='./login_form.html';</script>";
    }


 ?>
