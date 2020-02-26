<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Small Business - Start Bootstrap Template</title>

  <!-- message core CSS&JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
  <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
  <link rel="stylesheet" href="../../css/aside/message.css">
  <script src="../../js/aside/message.js" charset="utf-8"></script>
  <!-- banner core CSS&JS -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
  <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
  <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
  <link rel="stylesheet" href="../../css/aside/banner.css">
  <script src="../../js/aside/banner.js" charset="utf-8"></script>
  <!-- Bootstrap core CSS -->
  <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../css/main/small-business.css" rel="stylesheet">

  <script src="../../js/main/pop_up_menu.js"></script>

  <!-- internal style -->
  <?php include "../../lib/common_page/main_style.php";?>
  <?php include "../../db/db_connector.php"; ?>

</head>

<body>

  <!-- Navigation -->
  <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto no-margin">
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> -->

  <?php include "../../lib/common_page/header.php"; ?>
  <!-- Page Content -->
  <section style="margin-top : 90px">
  <?php 
    if(isset($_GET['category'])) {
  
        $getCategory = $_GET['category'];
        
        $sql = "SELECT * FROM `board` WHERE `category` = '$getCategory'";
        
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
              <h1 class="font-weight-light">게시글이 없습니다.</h1>
              <p></p>
              <span class="reply"><img src="" alt=""></span>
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
  <?php
    } else {
      include "../../lib/common_page/content.php";
    }
    
  ?>

  </section>
  
  <!-- Footer -->
  <?php include "../../lib/common_page/footer.php"; ?>

  <!-- Bootstrap core JavaScript -->
  <!-- <script src="../../js/main/jquery/jquery.min.js"></script>
  <script src="../../js/main/bootstrap/js/bootstrap.bundle.min.js"></script> -->

</body>

</html>
