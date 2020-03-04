<meta charset="utf-8">
<?php
include "../../db/db_connector.php";
session_start();
$group_num  = $_GET["num"];
$group_num = (int)$group_num;
if(isset($_GET['comment_num'])) {
  $comment_num = $_GET['comment_num'];
} else {
  $comment_num = 0;
}
$deleteNum = $_GET['delete_num'];
function test_input($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$num = test_input($_GET["num"]);
$q_num = mysqli_real_escape_string($connect, $num);

$sql ="DELETE FROM `comment` WHERE `num`=$deleteNum";
$result = mysqli_query($connect,$sql);
mysqli_close($connect);
echo "<script>
  location.href='../../page/board/board_widen.php?num=$group_num';
    </script>";

 ?>
