<div class="board_nav">
<?php
  include "../../db/db_connector.php";
  if(isset($_GET['mode'])){
    switch ($_GET['mode']) {
      case 'my':
      $sql = "select * from board where id = '$userid'";
        break;

      case 'all':
      $sql = "select * from board order by num desc";
        break;

      default : break;
    }
  }
  $result = mysqli_query($connect, $sql);
  $userpost_num = mysqli_num_rows($result);
 ?>

 <div id="board_nav_box">
      <a href="./board_writing.php" class="top_box" style="margin-left : 180px;"><span>Writing</span></a>
      <a href="./board_myboard_form.php?mode=my" class="top_box" ><span>My Board</span></a>
      <a href="./board_form.php?mode=all" class="top_box" ><span>All View</span></a>
  </div>
  <?php
  if(!isset($_GET['mode'])){
    ?>
  <div class="div_span_box_nav"></div>
<?php }else{ ?>
  <div class="div_span_box_nav">
    <span id="span_box"><?=$userpost_num?>개의 게시물이 있어요 </span>
  </div>
<?php } ?>
</div>
<!-- <script>
    function settingspan(mode){
      if (mode === 1){
        document.getElementById('span_box').innerText="<?=$userpost_num?> 개의 게시물이 있습니다 !";
      }else if(mode === 2){
        document.getElementById('span_box').innerText="<?=$page_num?>개의 게시물이 있습니다 !";
      } else {
        document.getElementById('span_box').innerText='error';
      }
    }
</script> -->
