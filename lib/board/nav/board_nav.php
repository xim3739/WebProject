<div class="board_nav">
<?php
  include "../../db/db_connector.php";
  $sql = "select * from board order by num desc";
  $result = mysqli_query($connect, $sql);
  if ($result) {
  mysqli_query($connect, $sql);
  $page_num = mysqli_num_rows($result);
}
 ?>
 <div id="board_nav_box">
      <a href="./board_writing.php" class="top_box" style="margin-left : 180px;"><span>Writing</span></a>
      <a href="./board_myboard_form.php"class="top_box"><span>My Board</span></a>
      <a href="./board_form.php"class="top_box"><span>All View</span></a>
  </div>
  <div class="div_span_box_nav">
    <span id="span_box"><?=$page_num?> 개의 게시물이 있습니다 !</span>
  </div>
</div>
