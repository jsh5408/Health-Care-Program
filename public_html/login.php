
<!-- 로그인을 수행하는 역할 / 필요한 변수들 값을 (로그인 유지를 위해) session 변수에 다 넣어준다 - 초기화 -->

<?php
    session_start();

    include './dbcon.php';


    $id=$_POST['id'];
    $pwd=$_POST['pwd'];

    // 회원 정보들을 다 가져와서 세션변수들 초기화
    // session 변수 사용 이유: 로그인 유지 및 페이지 이동에도 값들을 유지하기 위해서
    $query="SELECT * from member where m_id='$id'";
    $query2="SELECT * from std_body where m_id='$id'";
    $query3="SELECT * from mem_info_f where m_id='$id'";
    $query4="SELECT * from mem_info_e where m_id='$id'";
    // echo $query;

    $result = mysqli_query($connect, $query);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    $name = $row['m_name'];
    $age = $row['m_age'];
    $gender = $row['m_gender'];
    $height = $row['m_height'];
    $weight = $row['m_weight'];
    $act = $row['m_act'];

    $result2 = mysqli_query($connect, $query2);
    $num2 = mysqli_num_rows($result2);
    $row2 = mysqli_fetch_array($result2);
    $std_kcal = $row2['std_kcal'];
    $std_weight = $row2['std_weight'];
    $food_kcal = $row2['food_kcal'];
    $exercise_kcal = $row2['exercise_kcal'];

    $result3 = mysqli_query($connect, $query3);
    $num3 = mysqli_num_rows($result3);
    $row3 = mysqli_fetch_array($result3);
    $user_food = $row3['f_name'];

    $result4 = mysqli_query($connect, $query4);
    $num4 = mysqli_num_rows($result4);
    $row4 = mysqli_fetch_array($result4);
    $user_exercise = $row4['e_name'];

    if ($num) {
      if ($row['m_pwd'] == $pwd) {
        $_SESSION['is_logged'] = 'YES';
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_age'] = $age;
        $_SESSION['user_pwd'] = $pwd;
        $_SESSION['user_gender'] = $gender;
        $_SESSION['user_height'] = $height;
        $_SESSION['user_weight'] = $weight;
        $_SESSION['std_w'] = $std_weight;
        $_SESSION['user_act'] = $act;
        $_SESSION['order'] = 1;
        $_SESSION['e_kcal'] = $exercise_kcal;
        $_SESSION['user_kcal'] = $food_kcal;
        $_SESSION['rec_amount'] = $std_kcal;

        $_SESSION['user_food'] = $user_food;
        $_SESSION['user_exercise'] = $user_exercise;

        // 초기화가 다 끝나면 로그인 하여 main페이지로 간다
        echo "<form name='logged' action='./main.php' method='post'><input type='hidden' name='login_success' value='1'>";
        echo "<input type='hidden' name='login_id' value='$id'></form>";
        echo "<script>alert('로그인 성공'); document.logged.submit();location.href='./main.php';</script>";
        exit();
      } else {
        $_SESSION['is_logged'] = 'NO';
        $_SESSION['user_id'] = '';
        $_SESSION['user_name'] = '';
        $_SESSION['user_age'] = '';
        $_SESSION['user_pwd'] = '';
        $_SESSION['user_gender'] = '';
        $_SESSION['user_height'] = '';
        $_SESSION['user_weight'] = '';
        $_SESSION['user_act'] = '';
        $_SESSION['order'] = 1;
        $_SESSION['e_kcal'] = 0;
        $_SESSION['user_kcal'] = 0;
        $_SESSION['e_idx'] = 0;
        $_SESSION['rec_amount'] = 0;

        $_SESSION['user_food'] = '';
        $_SESSION['user_exercise'] = '';
        echo "<script>alert('비번 오류'); history.go(-1);</script>";
        exit();
      }
    } else {
      echo "<script>alert('해당 아이디가 존재하지 않음. 회원가입 먼저 하길 바람');location.href='./register_form.html';</script>";
    }

 ?>
