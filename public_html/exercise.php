
<!-- 운동으로 인한 칼로리 소모량을 계산해주는 페이지 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();


    include './dbcon.php';

    $e_id = $_SESSION['e_idx'];

    $query3 = "SELECT e_name from exercise where e_idx = '$e_id' order by e_kcal desc limit 3";

    $result3 = mysqli_query($connect, $query3) or die(mysqli_error($connect));
    $row3 = mysqli_fetch_array($result3);


    $i = 1;
    $count=0;

    // 로그인 해야만 게시판 접근 가능
  if(!isset($_SESSION['user_id'])) {
      echo "<script>alert('로그인된 정보가 없습니다');location.href='./login_form.html';</script>";
      //exit;
   }
   else{
 }
?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
<title>Main</title>
</head>

<!-- 운동 종류를 나타내는 사진 표시 위한 함수  -->
<script>
  function over() {
    document.roll.src = "exercise.jpg";
  }
</script>

<body>
<?/* 사이트 이름과 메뉴 바, 로그인,회원가입... 등 페이지 상단의 기본 형태*/?>
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


  <!-- course와 유사한 부분 -->

  <!-- 현재 체중을 나타냄 -->
  <h3> 회원님의 현재체중 </h3>
  <table width= "800" border="1" cellspacing="0" cellpadding="5">
  <tr align="center">
    <td bgcolor="#ddffdd"><?=$_SESSION['user_weight']?> kg 입니다</td>
  </tr></table>

<!-- 표준체중을 나타냄 -->
  <h3> 회원님 키의 표준체중 </h3>
  <table width= "800" border="1" cellspacing="0" cellpadding="5">
  <tr align="center">
    <td bgcolor="#ddffdd"><?=$_SESSION['std_w']?> kg 입니다</td>
  </tr>

  <!-- 표준체중과 현재 체중의 차이를 계산하여 표시해줌 -->
  <?
  $d = abs($_SESSION['user_weight']-$_SESSION['std_w']);
  ?>
  <?
  if($_SESSION['std_w']>$_SESSION['user_weight']){?>
  <tr align="center"><td bgcolor="#ddffdd">회원님은 표준 체중보다 <?=$d?> kg 적게 나갑니다</td>
  </tr>
  <!-- 표준 체중보다 많이 나갈 경우 칼로리 소모량이 많은 운동 추천 -->
      <tr align="center"><td bgcolor="#ffffff">추천 운동:
        <?=$row3['e_name'] ?>
        <?$row3 = mysqli_fetch_array($result3);?>
        <?=$row3['e_name'] ?>
        <?$row3 = mysqli_fetch_array($result3);?>
        <?=$row3['e_name'] ?>
      </td>
      </tr>
  <?
  }
  if($_SESSION['std_w']<$_SESSION['user_weight']){?>
    <tr align="center"><td bgcolor="#ddffdd">회원님은 표준 체중보다 <?=$d?> kg 많이 나갑니다</td>
  </tr>
  <!-- 표준 체중보다 적게 나갈 경우 칼로리 소모량이 적은 운동 추천 - 대체로 유산소 -->
  <tr align="center"><td bgcolor="#ffffff">추천 운동:
    <?$query3 = "SELECT e_name from exercise where e_idx = '$e_id' order by e_kcal asc limit 3";?>
    <?$result3 = mysqli_query($connect, $query3) or die(mysqli_error($connect));?>
    <?$row3 = mysqli_fetch_array($result3);?>
    <?=$row3['e_name'] ?>
    <?$row3 = mysqli_fetch_array($result3);?>
    <?=$row3['e_name'] ?>
    <?$row3 = mysqli_fetch_array($result3);?>
    <?=$row3['e_name'] ?>
  </td>
  </tr>
  <?
  }
  ?>
  <?
  if($_SESSION['std_w']==$_SESSION['user_weight']){?>
    <tr align="center"><td bgcolor="#ddffdd">회원님은 표준 체중입니다 이대로 유지해주세요</td>
  </tr>
  <?
  }
  ?>
</table>



<!-- 운동 종류를 나타내는 사진  -->
<img name = "roll" src = "exercise.jpg" width="500" onMouseOver="over()" onMouseOut="">


<!-- 운동으로 인한 칼로리 소모량 계산 -->
  <h3> 운동으로 인한 칼로리 소모량 계산 </h3>
  <CENTER>(입력 후 계산 버튼을 누르면 칼로리가 누적되어 표시됩니다)</CENTER>

<form action='calculate_exercise.php' name='calculate' method='post'>
  <table align="center" width= "800" border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <td bgcolor="#ddffdd">운동 이름</td>
      <td bgcolor="#ddffdd">운동 시간(분단위로 숫자만 입력)</td>
      <td bgcolor="#ddffdd"></td></form>
    </tr>
    <td align="center">
      <input type = "text" name = "name">
    </td>
    <td align="center">
      <input type = "text" name = "time">
    </td>

  <td align="center"><button type="submit">계산</button></td>
</tr>
<tr>
  <td align="center" colspan="3" bgcolor="#ddffdd">총 소모 칼로리</td>
</tr>
  <tr>
    <td align="center" colspan="3" bgcolor="#ffffff"><?=$_SESSION['e_kcal']?> kal 입니다</td>
  </tr>
  </table></form>
  <form action='reset_exercise.php' name='reset' method='post'>
    <input type="submit" value="계산 초기화"/><br/>
  </form>

  <table align="center" width= "800" border="1" cellspacing="0" cellpadding="5">
  <?
  $a = ($_SESSION['user_kcal']-$_SESSION['e_kcal']);
  ?>

<!-- 운동으로 인한 소모량에 따라 변한 섭취량과 권장 섭취량을 비교해서 차이가 많이 날 경우에 대한 권고사항 나타냄 -->
<?if($_SESSION['user_kcal']!=0){?>
  <?
  if($a>=$_SESSION['rec_amount']-200 && $a<=$_SESSION['rec_amount']+200){ // 권장섭취량과 차이가 별로 없을 경우
  ?>
  <tr align="center"><td bgcolor="#ddffdd">평균입니다</td>
    </tr>
  <?
  }?>
    <?
    if($a<$_SESSION['rec_amount']-200){ // 운동으로 인한 소비량이 훨씬 많거나 음식 섭취량이 매우 적은 경우
    ?>
    <tr align="center"><td bgcolor="#ffdddd">음식 섭취량이 너무 적습니다! 이 때, 과한 운동은 좋지 않습니다</td>
    </tr>
    <?
  }?>
  <?
  if($a>$_SESSION['rec_amount']+200){ // 섭취량이 훨씬 많은 경우
  ?>
  <tr align="center"><td bgcolor="#ffdddd">음식 섭취량이 너무 많습니다! 식이조절 및 운동 요망</td>
  </tr>
  <?
}?>
<?}?>
  </table>

</body>
