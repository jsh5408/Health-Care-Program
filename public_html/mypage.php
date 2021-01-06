
<!-- 회원정보 페이지 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
<head>
<title>Main</title>
</head>

<body>

  <?
  include './dbcon.php';
  $e_id = $_SESSION['e_idx'];
  $id = $_SESSION['user_id'];

  //회원 정보들이 담긴 테이블의 값들을 가져옴
  $query = "SELECT * from member where m_id = '$id'";

  $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
  $row = mysqli_fetch_array($result);

  // 로그인한 사용자들만 접근 가능한 페이지
    if(!isset($_SESSION['user_id'])) {
      echo "<script>alert('로그인된 정보가 없습니다');location.href='./login_form.html';</script>";
       //exit;
     }
     else{
   }
  ?>
<!-- 사이트 이름과 메뉴 바, 로그인,회원가입... 등 페이지 상단의 기본 형태 -->
  <p align="right"><a href="./login_form.html">로그인</a>
  <a href="./logout.php">로그아웃</a>
  <a href="./register_form.html">회원가입</a>
  <a href="./withdraw.php">회원탈퇴</a></p>
  <CENTER><h2> 표준 체중을 향한 건강관리 프로그램 </h2>
    <table align="center" width= "800" border="1" cellspacing="0" cellpadding="5">
      <tr align="center">
        <td colspan="5" bgcolor="#ffffff"><?=$_SESSION['user_name']?>(<?=$_SESSION['user_id']?>)님 환영합니다.</td>
      </tr>
      <tr align="center">
        <td bgcolor="#ddffdd"><a href="./main.php">HOME</td>
        <td bgcolor="#ddffdd"><a href="./exercise.php">운동량계산</td>
        <td bgcolor="#ddffdd"><a href="./course.php">칼로리계산</td>
        <td bgcolor="#ddffdd"><a href="./board.php">자유 후기</td>
        <td bgcolor="#ddffdd"><a href="./mypage.php">Mypage</td>
      </tr>
    </table>
  <br/>

<!-- 회원 정보를 나타냄 -->
  <h3> 회원정보 </h3>
  <a href="update_form.html"><button>회원정보수정</button></a>
  <br><br>
  <table width= "800" border="1" cellspacing="0" cellpadding="5">
  <tr align="center">
    <td bgcolor="#ddffdd">아이디</td>
    <td bgcolor="#ddffdd">이름</td>
    <td bgcolor="#ddffdd">나이</td>
</tr>
<tr align="center">
  <td><?=$_SESSION['user_id']?></td>
  <td><?=$_SESSION['user_name']?></td>
  <td><?=$_SESSION['user_age']?></td>
</tr>
<tr align="center">
  <td bgcolor="#ddffdd">키</td>
  <td bgcolor="#ddffdd">몸무게</td>
  <td bgcolor="#ddffdd">성별</td>
</tr>
<tr align="center">
<td><?=$_SESSION['user_height']?></td>
<td><?=$_SESSION['user_weight']?></td>
<td><?=$_SESSION['user_gender']?></td>
</tr>

<!-- user_act 값에 따른 활동량 정도 나눔 - 활동량에 따라 권장 섭취량이 달라집니다 -->
<tr align="center">
  <?
  if($_SESSION['user_act'] == 0)
  {
    $am = '보통';
  }
  if($_SESSION['user_act'] == 1)
  {
    $am = '적음';
  }
  if($_SESSION['user_act'] == 2)
  {
    $am = '많음';
  }
  ?>
  <td colspan = "3" bgcolor="#ffffff">활동량 <?=$am?> 입니다</td>
</tr>

</table>

<!-- 표준체중을 나타냄 -->
<h3> 회원님 키의 표준체중 </h3>
<table width= "800" border="1" cellspacing="0" cellpadding="5">
<tr align="center">
  <td bgcolor="#ddffdd"><?=$_SESSION['std_w']?> kg 입니다</td></tr>

</table>

<!-- 권장 섭취량을 나타냄 -->
<h3> 회원님의 하루 권장 섭취량 </h3>
<table width= "800" border="1" cellspacing="0" cellpadding="5">
<tr align="center">
  <td bgcolor="#ddffdd"><?=$_SESSION['rec_amount']?> kcal 입니다</td>
</tr></table>

<!-- 누적된 음식들의 이름을 나열 -->
<h3> 지금까지 먹은 음식들 </h3>
<table width= "800" border="1" cellspacing="0" cellpadding="5">
<tr align="center">
  <td bgcolor="#ddffdd">
    <?
    $query4 = "SELECT f_name from mem_info_f where m_id = '$id'";
    $result4 = mysqli_query($connect, $query4) or die(mysqli_error($connect));
    $num = mysqli_num_rows($result4);
    if(!$num){
      echo '없음';
    }
      while($row4=mysqli_fetch_array($result4)){
        echo $row4['f_name'].' / ';
      }
    ?>
  </td>
</tr></table>

<!-- 누적된 운동들의 이름과 시간을 나열 -->
<h3> 지금까지 한 운동들 </h3>
<table width= "800" border="1" cellspacing="0" cellpadding="5">
<tr align="center">
  <td bgcolor="#ddffdd">
    <?
    $query4 = "SELECT e_name, e_time from mem_info_e where m_id = '$id'";
    $result4 = mysqli_query($connect, $query4) or die(mysqli_error($connect));
    $num = mysqli_num_rows($result4);
    if(!$num){
      echo '없음';
    }
      while($row4=mysqli_fetch_array($result4)){
        echo $row4['e_name'].'('.$row4['e_time'].'분)'.' / ';
      }
    ?>
  </td>
</tr></table>

</body>

</html>
