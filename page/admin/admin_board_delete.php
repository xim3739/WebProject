<?php
  if (isset($_POST["item"])) {
    $num_item = count($_POST["item"]);
  }else {
    echo "
          <script>
          alert('삭제할 게시글을 선택해주세요!');
          history.go(-1)
          </script>
         ";
  }
  include_once "../../db/db_connector.php";
  for ($i=0; $i <$num_item ; $i++) {
    $num = $_POST["item"][$i];
    $q_num = mysqli_real_escape_string($connect, $num);
    $sql = "select * from board where num=$q_num";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($result);
    $category = $row["category"];
    $file_copied = $row["file_copied"];
    if ($file_copied){
      $file_path = "../../data/".$file_copied;
      unlink($file_path);
    }
    $sql = "delete from board where num = $q_num";
    mysqli_query($connect,$sql);
  }
  $category="%27".$category."%27";
  mysqli_close($connect);
  echo "
	     <script>
	         location.href = 'admin_board.php?category=$category';
	     </script>
	   ";
?>
