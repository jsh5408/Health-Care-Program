
<!-- 자유 게시판 페이지 -->

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

<body>
  <?
    // 로그인 해야만 게시판 접근 가능
    if(!isset($_SESSION['user_id'])) {
      echo "<script>alert('로그인된 정보가 없습니다');location.href='./login_form.html';</script>";
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

<? //자유 게시판 ?>
<div id="board_area" align="center">
  <h1>자유 게시판</h1>
  <h4>자유롭게 글을 쓸 수 있는 게시판입니다.<br>
  운동이나 음식에 대한 정보를 공유해보세요!</h4>

<? //정렬 버튼-조회순/최신순 선택 후 정렬 버튼을 누르면 board_order에서 처리됨?>
  <form name = "select_order" action='./board_order.php' method='post'>
    <input type="radio" name="order" value="0">조회순
    <input type="radio" name="order" value="1">최신순
    <input type="submit" value="정렬"></br>
  </form>

<? //게시글 목록 표시 ?>
    <table class="list-table">
      <thead>
          <tr align="center">
              <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>

        <?php
        // board테이블에있는 id를 기준으로 내림차순해서 10개까지 표시(최신순)
        $query = "SELECT * from board order by id desc limit 10";
        $query2 = "SELECT * from board order by count desc limit 10";
         // board테이블에있는 count를 기준으로 내림차순해서 10개까지 표시(조회순)


         // 1이면 최신순
         if($_SESSION['order'] == 1){
           $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
         }
         // 0이면 조회순
         else if($_SESSION['order'] == 0){
           $result = mysqli_query($connect, $query2) or die(mysqli_error($connect));
         }

         // 앞에서 정해진 순서대로 목록 나열
         // id부분을 누르면 게시글 내용 확인 가능
         while ($row = mysqli_fetch_array($result)) {
       ?>
             <td align="center"><a href="content.php?id=<?=$row['id']?>"><?=$row['id']?></a></td>
             <td align="center"><?=$row['title']?></td>
             <td align="center"><?=$row['writer']?></td>
             <td align="center"><?=$row['date']?></td>
             <td align="center"><?=$row['count']?></td>
           </tr>
       <?  }
       ?>
    </table>
    <br>
    <!-- 글쓰기 버튼 -> write.php로 넘어가서 글 작성 -->
    <div id="write_btn" align="center">
      <a href="write.php?id=<?=$row['id']?>"><button>글쓰기</button></a>
    </div>
  </div>
</body>
</html>
