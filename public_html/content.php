
<!-- board.php에 있는 게시글의 내용을 확인 하는 페이지 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();
?>

<?

    include './dbcon.php';

    $bid = $_GET['id'];

    // 조회수 update
    $query2 = "UPDATE board set count = count + 1 where id = '$bid'";
    mysqli_query($connect, $query2);

    $query="SELECT * FROM board where id = '$bid'";

    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);

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

<!-- 게시글 띄우기 - 수정이 불가능한 상태로 띄워줘야 하므로 각 값들만 그대로 출력 -->
    <center><h2> 게시글 내용 보기 </h2></center>
    <form name="frm_content" method="post" action="board_update_form.php?uid=<? echo $bid; ?>">
      <table align="center" width= "800" border="1" cellspacing="0" cellpadding="5">
      <tr align="center">
        <td bgcolor="#cccccc">글넘버</td>
        <td><? echo $row['id']; ?></td>
      </tr>
      <tr align="center">
        <td bgcolor="#cccccc">제목</td>
        <td><? echo $row['title']; ?></td>
      </tr>
      <tr align="center">
        <td bgcolor="#cccccc">글내용</td>
        <td><? echo $row['content']; ?></td>
      </tr>
      <tr align="center">
        <td bgcolor="#cccccc">글쓴이</td>
        <td><? echo $row['writer']; ?></td>
      </tr>
      <tr align="center">
        <td colspan="2" bgcolor="#cccccc">

<!-- 수정 버튼 누를 시 board_update_form.php 에서 게시글 수정 수행 (사용자가 작성자와 일치하는지도 저 php에서 판단) -->
            <button><a href="board_update_form.php?id=<?=$row['id']?>">수정</a></button>
            <input type="hidden" name="b_count" value="<? echo$row['count']?>">
        </td>
      </tr>
    </form>
