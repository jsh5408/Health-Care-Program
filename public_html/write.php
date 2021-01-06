
<!-- 게시판에 글을 작성하는 페이지 -> 작성된 글은 post.php에서 DB로 저장된다 -->

<?
error_reporting(~E_NOTICE);  ini_set("display_errors", 1);  session_start();
?>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>

<body>

  <?
  // 로그인한 사용자만 접근 가능
    if(!isset($_SESSION['user_id'])) {
      echo "<script>alert('로그인된 정보가 없습니다');location.href='./login_form.html';</script>";
       //exit;
     }
     else{

   }
  ?>

  <?
  include './dbcon.php';

  $bid = $_GET['id'];
  $query="SELECT * FROM member where m_id = '$bid'";

  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_array($result);
  ?>
<?/* 사이트 이름과 메뉴 바, 로그인,회원가입... 등 페이지 상단의 기본 형태*/?>
  <p align="right"><a href="./login_form.html">로그인</a>
  <a href="./logout.php">로그아웃</a>
  <a href="./register_form.html">회원가입</a></p>
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

<!-- 게시글 작성 폼 / 글쓴이는 로그인 한 사용자이므로 고정 -->
    <div id="board_write"><CENTER>
        <h1><a href="./board.php">자유 게시판</a></h1>
        <h4>글을 작성하는 공간입니다.</h4>
            <div id="write_area">
                <form action='post.php' name='post_table' method='post'>
                  <div id="b_writer">
                    <tr align="center">
                      <td bgcolor="#cccccc">글쓴이: </td>
                      <td><? echo $_SESSION['user_id']; ?></td>
                    </tr>
                  </div>
                    <div id="b_title">
                        <textarea name="b_title" id="title" rows="2" cols="55" placeholder="제목" maxlength="100" required></textarea>
                    </div>
                    <div class="b_line"></div>

                    <div class="b_line"></div>
                    <div id="b_content">
                        <textarea name="b_content" id="ucontent" rows="10" cols="55" placeholder="내용" required></textarea>
                    </div>
                    <div class="bt_se">
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
