<div class="board_nav">

<?php
  include "../../db/db_connector.php";
  if(isset($_GET['form'])){
    $sql = "SELECT * FROM `board` WHERE `id` = '$userid' ORDER BY `num` DESC";
  }else{
    $sql = "SELECT * FROM `board` ORDER BY `num` DESC";
  }

  $result = mysqli_query($connect, $sql);
  if ($result) {
      mysqli_query($connect, $sql);
      $page_num = mysqli_num_rows($result);
  }

 ?>

 <div id="board_nav_box">

<?php
  if (!$userid) {
      echo("
    <script>
    alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
    history.go(-1)
    </script>
    ");
      exit;
}
 ?>

      <a href="./board_writing.php" class="top_box" style="margin-left : 180px;"><span>Writing</span></a>
      <a href="./board_myboard_form.php?form=my&board=ok"class="top_box"><span>My Board</span></a>
      <a href="./board_form.php?board=ok"class="top_box"><span>All View</span></a>
  </div>
    <div class="div_span_box_nav">
        <span id="span_box"><?=$page_num?>개의 게시물이 있어요 </span>
      </div>
  </div>
