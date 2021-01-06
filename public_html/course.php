
<!-- 섭취한 음식의 칼로리를 계산해주는 페이지 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();
?>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
<head>
<title>Main</title>
</head>

<!-- 음식 종류를 나타내는 사진 표시 위한 함수  -->
<script>
  function over() {
    document.roll.src = "food.jpg";
  }
</script>

<body>

  <?

      include './dbcon.php';

      $e_id = $_SESSION['e_idx'];


      // 이 query는 추천 음식 및 추천 운동을 위한 것
      $query3 = "SELECT f_name from food order by f_kcal desc limit 3";
      $result3 = mysqli_query($connect, $query3) or die(mysqli_error($connect));
      $row3 = mysqli_fetch_array($result3);

      // 음식 카테고리가 중복되어 저장되어 있기 때문에 중복 없는 값들만 가져옴
      $query="SELECT DISTINCT f_category from food;";
      $result = mysqli_query($connect, $query);
      $row = mysqli_fetch_array($result);
      $num = mysqli_num_rows($result);
      $i = 1;
      $count=0;

      // 로그인한 사용자만 사용가능한 페이지
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

<!-- 현재 체중을 나타냄 -->
  <h3> 회원님의 현재체중 </h3>
  <table width= "800" border="1" cellspacing="0" cellpadding="5">
  <tr align="center">
    <td bgcolor="#ddffdd"><?=$_SESSION['user_weight']?> kg 입니다</td>
  </tr></table>


<!-- 표준 체중을 나타냄 -->
  <h3> 회원님 키의 표준체중 </h3>
  <table width= "800" border="1" cellspacing="0" cellpadding="5">
  <tr align="center">
    <td bgcolor="#ddffdd"><?=$_SESSION['std_w']?> kg 입니다</td>
  </tr>


  <!-- 표준체중과 현재 체중의 차이값을 나타냄 -->
  <?
  $d = abs($_SESSION['user_weight']-$_SESSION['std_w']);  // 절댓값으로 계산 하여 차이값을 알려준다
  ?>
<?
if($_SESSION['std_w']>$_SESSION['user_weight']){?>
  <tr align="center"><td bgcolor="#ddffdd">회원님은 표준 체중보다 <?=$d?> kg 적게 나갑니다</td>
</tr>
<!-- 표준체중보다 적게 나갈 경우 칼로리가 높은 음식들 추천 -->
<tr align="center"><td bgcolor="#ffffff">추천 음식:
  <?=$row3['f_name']?>
  <?$row3 = mysqli_fetch_array($result3);?>
  <?=$row3['f_name'] ?>
  <?$row3 = mysqli_fetch_array($result3);?>
  <?=$row3['f_name'] ?>
</td>
</tr>
<?
}
if($_SESSION['std_w']<$_SESSION['user_weight']){?>
  <tr align="center"><td bgcolor="#ddffdd">회원님은 표준 체중보다 <?=$d?> kg 많이 나갑니다</td>
</tr>
<!-- 표준 체중보다 많이 나갈 경우 칼로리가 낮은 음식들 추천 -->
    <tr align="center"><td bgcolor="#ffffff">추천 음식:
      <?$query3 = "SELECT f_name from food order by f_kcal asc limit 3";?>
      <?$result3 = mysqli_query($connect, $query3) or die(mysqli_error($connect));?>
      <?$row3 = mysqli_fetch_array($result3);?>
      <?=$row3['f_name'] ?>
      <?$row3 = mysqli_fetch_array($result3);?>
      <?=$row3['f_name'] ?>
      <?$row3 = mysqli_fetch_array($result3);?>
      <?=$row3['f_name'] ?>
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


<!-- 권장 섭취량 나타냄 -->
  <h3> 회원님의 하루 권장 섭취량 </h3>
  <table width= "800" border="1" cellspacing="0" cellpadding="5">
  <tr align="center">
    <td bgcolor="#ddffdd"><?=$_SESSION['rec_amount']?> kcal 입니다</td>
  </tr></table>

<!-- 음식 종류를 나타내는 사진  -->
  <img name = "roll" src = "food.jpg" width="500" onMouseOver="over()" onMouseOut="">


<!-- 섭취한 음식들을 입력받아서 칼로리를 계산해준다 -계산은 calculate_food.php 에서 수행 / 계산 값들은 누적됩니다 -->
  <h3> 하루 섭취한 음식 칼로리 계산 </h3>
  <CENTER>(입력 후 계산 버튼을 누르면 칼로리가 누적되어 표시됩니다)</CENTER>

<form action='calculate_food.php' name='calculate' method='post'>
  <table align="center" width= "800" border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <td bgcolor="#ddffdd">음식 종류</td>
      <td bgcolor="#ddffdd">음식 이름</td>
      <td bgcolor="#ddffdd"></td></form>
    </tr>
    <td align="center">
      <input type = "text" name = "category">
    </td>
    <td align="center">
      <input type = "text" name = "name">
    </td>

  <td align="center"><button type="submit">계산</button></td>
</tr>
<tr>
  <td align="center" colspan="3" bgcolor="#ddffdd">총 칼로리</td></tr>
  <tr>
    <td align="center" colspan="3" bgcolor="#ffffff"><?=$_SESSION['user_kcal']?> kal 입니다</td>
  </tr>
  </table>
</form>
<form action='reset_food.php' name='reset' method='post'>
  <input type="submit" value="계산 초기화"/><br/>
</form>


<!-- 섭취량과 권장 섭취량을 비교해서 차이가 많이 날 경우에 대한 권고사항 나타냄 -->
<table align="center" width= "800" border="1" cellspacing="0" cellpadding="5">
<?
$a = abs($_SESSION['rec_amount']-$_SESSION['user_kcal']);
?>
<?if($_SESSION['user_kcal']!=0){?>
<?if($_SESSION['rec_amount']+200<$_SESSION['user_kcal']){?>
  <tr align="center"><td bgcolor="#ddffdd">권장 섭취량보다 <?=$a?> kcal 더 많이 섭취했습니다</td>
  </tr>
  <tr align="center"><td bgcolor="#ffdddd">섭취량을 줄이고 운동을 해주세요</td>
  </tr>
  <?}?>
  <?if($_SESSION['rec_amount']+200>=$_SESSION['user_kcal'] && $_SESSION['rec_amount']-200<=$_SESSION['user_kcal']){?>
    <tr align="center"><td bgcolor="#ffdddd">평균입니다</td>
    </tr>
    <?}?>
  <?if($_SESSION['rec_amount']-200>$_SESSION['user_kcal']){?>
    <tr align="center"><td bgcolor="#ddffdd">권장 섭취량보다 <?=$a?> kcal 더 적게 섭취했습니다</td>
    </tr>
    <tr align="center"><td bgcolor="#ffdddd">권장 섭취량은 채우시는게 좋습니다</td>
    </tr>
    <?}?>
    <?}?>
</table>





</body>

</html>
