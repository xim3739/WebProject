<div class="board_nav">
  <div id="board_nav_box">
<?php
include "../../db/db_connector.php";
$sql = "select * from board order by num desc";
$result = mysqli_query($connect, $sql);
if ($result) {
mysqli_query($connect, $sql);
$page_num = mysqli_num_rows($result);
}
 ?>
    <div id="board_box_message">
      <span> <span><?=$page_num?></span> 개의 게시물이 있습니다 !</span>
    </div>

    <div id="board_box_writing">
      <a href="./board_writing.php"><span>+ 글쓰기</span></a>
    </div>

    <div id="board_box_mypost">
      <a href="./board_myboard_form.php"><span>내 게시글 보기</span></a>
    </div>

    <div id="board_box_viewall">
      <a href="./board_form.php"><span>전체보기</span></a>
    </div>

  </div>
</div>
