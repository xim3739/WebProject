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
function test_input($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

echo($confirm ="<script>javascript:confirm('선택한 댓글을 삭제 하시겠습니까?');</script>");
if($confirm){
  echo "<script>
          alert('삭제가 완료된 페이지를 다시 불러 옵니다!');
        </script>";
        $num = test_input($_GET["num"]);
        $q_num = mysqli_real_escape_string($connect, $num);

        $sql ="DELETE FROM `comment` WHERE `group_num`=$comment_num;
        $result = mysqli_query($connect,$sql);

        mysqli_close($connect);
        echo "<script>
              location.href='../../page/board/board_widen.php?num=$group_num';
              </script>";
}else{
  echo "<script>
          alert('삭제를 취소 헸습니다');
        </script>";
}
 ?>
