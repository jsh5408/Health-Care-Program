
<!-- 메인 HOME 페이지 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();
?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
<title>Main</title>
</head>

<!-- 사진 표시 위한 함수  -->
<script>
  function over() {
    document.roll.src = "main.jpg";
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
  </table></CENTER>
  <br/>

  <!-- main 사진  -->
    <CENTER>
      <h3> 표준 체중 표 </h3>
      <img name = "roll" src = "main.jpg" width="500" onMouseOver="over()" onMouseOut=""></CENTER>


</body>

</html>
