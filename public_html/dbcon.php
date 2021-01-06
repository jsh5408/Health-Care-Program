
<!-- DB 연결 -->

<?
$db_host = "localhost";
$db_user = "root";
$db_passwd = "autoset";
$db_name = "test";

// DB 연결
$connect = mysqli_connect($db_host, $db_user, $db_passwd, $db_name);

if (mysqli_connect_errno($connect)) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
  //echo "성공";
}


?>
