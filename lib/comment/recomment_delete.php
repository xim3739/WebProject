<meta charset="utf-8">
<?php
include "../../db/db_connector.php";
session_start();
$group_num  = $_GET["num"];
$group_num = (int)$group_num;
$depth = $_GET["depth"];
$ord = $_GET["ord"];
if(isset($_GET['comment_num'])) {
  $comment_num = $_GET['comment_num'];
} else {
  $comment_num = 0;
}
var_dump($comment_num);
function test_input($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$num = test_input($_GET["num"]);
$q_num = mysqli_real_escape_string($connect, $num);


var_dump($depth);

$sql ="DELETE FROM `comment` WHERE `num`=$q_num AND `ord`=$ord";
$result = mysqli_query($connect,$sql);

mysqli_close($connect);
echo "<script>
  location.href='../../page/board/board_widen.php?num=$group_num';
    </script>";

 ?>
