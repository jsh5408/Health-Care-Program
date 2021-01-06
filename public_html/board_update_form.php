
<!-- 게시판에 있는 게시글 수정하는 페이지 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();
?>

<?php
  include  $_SERVER['DOCUMENT_ROOT']."/dbcon.php";
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>

<!-- delete 페이지로 가게 해주는 함수 -->
<script>
  function deldata() {
    location.href='./delete.php?id=<? echo $bid ?>';
  }
</script>

<body>

  <?

  $bid = $_GET['id'];
  $query="SELECT * FROM board where id = '$bid'";

  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_array($result);

    // 로그인 해야만 접근 가능
    if(!isset($_SESSION['user_id'])) {
      echo "<script>alert('로그인된 정보가 없습니다');location.href='./login_form.html';</script>";
       //exit;
    }
    // 현재 로그인 한 사람과 게시글 작성자의 아이디가 다를 경우 수정 및 삭제 불가
    if($_SESSION['user_id']!=$row['writer']){
      echo "<script>alert('다른 작성자의 글을 수정/삭제할 수 없습니다');location.href='./board.php';</script>";
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
  <br/></CENTER>

<!-- 게시글 수정 공간 / 사용자의 아이디와 글쓴이가 동일해야만 수행되는 곳이므로 글쓴이와 글의 고유번호 id는 고정되게 출력 -->
<center><h2> 게시글 수정 </h2></center>
<form name="frm_content" method="post" action="board_update.php?uid=<? echo $bid; ?>">
  <table align="center" width= "800" border="1" cellspacing="0" cellpadding="5">
  <tr align="center">
    <td bgcolor="#cccccc">아이디</td>
    <td><? echo $row['id']; ?></td>
  </tr>
  <tr align="center">
    <td bgcolor="#cccccc">제목</td>
    <td><input type="text" name="b_title" value="<? echo $row['title']; ?>"></td>
  </tr>
  <tr align="center">
    <td bgcolor="#cccccc">글내용</td>
    <td><textarea name="b_content" rows="10" cols="80"><? echo $row['content']; ?></textarea></td>
  </tr>
  <tr align="center">
    <td bgcolor="#cccccc">글쓴이</td>
    <td><? echo $row['writer']; ?></td>
  </tr>
  <tr align="center">
    <td colspan="2" bgcolor="#cccccc">
        <input type="submit" value="완료">
        <input type="hidden" name="b_count" value="<? echo$row['count']?>">
        <input type="button" value="삭제" OnClick="deldata();">
    </td>
  </tr>
</form>
