<section style="margin-top : 90px">
<?php
include "../../db/db_connector.php";
var_dump("ddd");
  $sql = "SELECT * FROM `board`";

  $result = mysqli_query($connect, $sql);
  $page_num = mysqli_num_rows($result);
  if($page_num) {
    for($i = 0; $i < $page_num; $i++) {
      mysqli_data_seek($result, $i);

      $row = mysqli_fetch_array($result);

      $num = $row['num'];
      $id = $row['id'];
      $name = $row["name"];
      $regist_day = $row["regist_day"];
      $subject = $row["subject"];
      $content = $row["content"];
      $file_name = $row["file_name"];
      $file_type = $row["file_type"];
      $file_copied = $row["file_copied"];
      $hit = $row["hit"];
      $content = str_replace(" ", "&nbsp;", $content);
      $content = str_replace("\n", "<br>", $content);
?>  
      <!-- Aside_right Message-->
  <div class="container">
    <!-- Heading Row -->
    <div class="row align-items-center my-5">
      <div class="col-lg-7 no-flex" style="width: 420px; height: 186.66px; overflow : hidden;">
      <?php 
        if ($file_name) {
          $real_name = $file_copied;
          $file_path = "../../data/".$real_name;
          $file_size = filesize($file_path);
        }else{
          $file_path="../../img/board/default.jpg";
        }
      ?>
        <img class="img-fluid rounded mb-4 mb-lg-0" src="<?=$file_path?>">
      </div>
      <div class="col-lg-5 no-flex">
        <h1 class="font-weight-light"><?=$subject?></h1>
        <p><?=$content?></p>
        <a class="btn btn-primary" href="../../page/board/board_widen.php?num=<?=$num?>">Call to Action!</a>
        <span class="reply"><img src="" alt="">조회수 : <?=$hit?></span>
      </div>
    </div>
  </div>
  <?php
    }
  } else {
    ?>
    <div class="container">
    <!-- Heading Row -->
    <div class="row align-items-center my-5">
      <div class="col-lg-7 no-flex" style="width: 420px; height: 186.66px; overflow : hidden;">
      <?php 
        if ($file_name) {
          $real_name = $file_copied;
          $file_path = "../../data/".$real_name;
          $file_size = filesize($file_path);
        }else{
          $file_path="../../img/board/default.jpg";
        }
      ?>
        <img class="img-fluid rounded mb-4 mb-lg-0" src="<?=$file_path?>">
      </div>
      <div class="col-lg-5 no-flex">
        <h1 class="font-weight-light"></h1>
        <p>게시글이 없습니다.</p>
      </div>
    </div>
  </div>
  <?php
  }
  ?>
    <div id="buttons_box">
    <div id="pop_write">
      <ul>
        <li><a href="../../page/board/board_writing">글쓰기</a></li>
        <li><a href="">쪽지쓰기</a></li>
      </ul>
    </div>
    <button id="btn_pop_write" onclick="pop_up(this)"><img src="../../img/main/plus_button.png" alt="버튼"></button>
  </div>
  <?php include "../aside/message.php"; ?>
  <?php include "../aside/banner.php"; ?>
</section>
