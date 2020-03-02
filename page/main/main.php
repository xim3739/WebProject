<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Small Business - Start Bootstrap Template</title>
  <!-- jquery -->
  <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>

  <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
  <!-- popup js -->
  <script src="../../js/main/pop_up_menu.js"></script>
  <!-- aside js -->
  <script src="../../js/aside/message.js" charset="utf-8"></script>
  <script src="../../js/aside/banner.js" charset="utf-8"></script>

  <!-- aside css -->
  <link rel="stylesheet" href="../../css/aside/message.css">
  <link rel="stylesheet" href="../../css/aside/banner.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
  
  <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/main/small-business.css" rel="stylesheet">

  <!-- main header css -->
  <?php include "../../lib/common_page/main_style.php";?>

  <?php include "../../db/db_connector.php"; ?>

</head>

<body>

  <?php include "../../lib/common_page/header.php"; ?>
  <!-- Page Content -->
  <section style="margin-top : 90px">

        <?php
        if(isset($_GET['category'])){
          $category=$_GET['category'];
          $sql="SELECT * FROM `board` WHERE `category` = '$category'";
        }else{

          $sql="SELECT * FROM `board`";

        }
        $result=mysqli_query($connect,$sql);
        $page_num=mysqli_num_rows($result);
        if($page_num==0){
          
        ?>
  <div class="container" style="padding-left:146px;">
    <!-- Heading Row -->
    <div class="row align-items-center my-5">
      <div class="col-lg-7 no-flex" style="width: 420px; height: 186.66px; overflow : hidden;">
        <img class="img-fluid rounded mb-4 mb-lg-0" src="../../img/board/default.jpg">
      </div>
      <div class="col-lg-5 no-flex" style="max-width : 45.666667%">
        <h1 class="font-weight-light"></h1>
        <p>게시글이 없습니다.</p>
      </div>
    </div>
  </div>


        <?php } ?>
        <div id="buttons_box">
            <div id="pop_write">
              <ul>
                <li><a href="../../page/board/board_writing.php">글쓰기</a></li>
                <li><a href="">쪽지쓰기</a></li>
              </ul>
            </div>
            <button id="btn_pop_write" onclick="pop_up(this)"><img src="../../img/main/plus_button.png" alt="버튼"></button>
          </div>
          <?php include "../aside/message.php"; ?>
          <?php include "../aside/banner.php"; include "../../js/main/scroll.php";?>


  </section>

  <!-- Bootstrap core JavaScript -->
  <script src="../../js/main/jquery/jquery.min.js"></script>
  <script src="../../js/main/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
