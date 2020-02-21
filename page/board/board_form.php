
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../../css/board/board.css">
  <!-- Bootstrap core CSS -->
  <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../../css/main/small-business.css" rel="stylesheet">
  <style>
    form { display: inline-block; }

    #header_box { width: 1100px; margin: 0 auto; }

    #header_box div { display: inline-block; }

    header { position: fixed; top: 0; width: 100%; background-color: antiquewhite; }

    #icon_box { margin-left: 190px; }

    #search { width: 700px; height: 50px; font-size: 20px; }

    header span { display: inline-block; width: 45px; height: 45px; }

    #login_icon { background-image: url(""); }

    #info_icon { background-image: url(""); }

    #btn_search { height: 45px; width: 45px; background-image: url("../../img/main/search1.png"); border: none; background-color: none; outline: none; }

    header a { width: 45px; height: 52px; padding: 0; margin: 0; display: inline-block; vertical-align: middle; }

    img{vertical-align:unset;}

    #btn_home { background-image: url("../../img/main/home1.png"); }

    #btn_info { background-image: url("../../img/main/info1.png"); }

    #btn_login { background-image: url("../../img/main/key1.jpg"); }

    .no-flex { flex: none; }

    .col-lg-7 { width: 450px; }

    #menu_bar { height: 48px; background-color: #443e58; font-size: 16px; }

    #menu_bar ul { width: 1200px; margin: 0 auto; padding: 14px 0 0 40px; }

    #menu_bar li { display: inline; margin-left: 10.5%; color: white; }

    #pop_up { display: none; position: absolute; top: 54px; right: 128px; background-color: antiquewhite; }
    #pop_log { display: none; position: absolute; top: 54px; right: 128px; background-color: antiquewhite; }
    #pop_box { width: 350px; height: 250px; }

    #pop_box ul { width: 50%; float: left; list-style: none; padding-left: 5px; }

    #pop_box li { text-align: center; }
    #pop_login ul{ width: 100%; list-style: none; padding-left: 5px; }
    #pop_login{ width: 150px; }
    .reply { margin-left: 213px; }
    body{ padding-top: 67px; }
  </style>

  <script src="../../js/main/pop_up_menu.js"></script>
</head>

<body>
  <header>
    <?php include "../../lib/common_page/header.php" ?>
  </header>

  <div class="board_header">
    <div id="board_header_div">
      <p><a href="./board_form.php">BOARD</a></p>
    </div>
  </div>
  <!-- nav -->

  <div class="board_nav">
    <div id="board_nav_box">
      <div id="board_box_message">
        <p><span></span> 개의 게시물이 있습니다 !</p>
      </div>

      <div id="board_box_writing">
        <p><a href="./board_writing.php" style="color : black;">+ 글쓰기</a></p>
      </div>

      <div id="board_box_mypost">
        <p><a href="./board_myboard_form.php" style="color : black;">내 게시글 보기</a></p>
      </div>

      <div id="board_box_viewall">
        <p><a href="./board_form.php" style="color : black;">전체보기</a></p>
      </div>
    </div>
  </div>
  <!-- center -->
  <?php
    $num  = $_GET["num"];
    $page  = $_GET["page"];

    $con = mysqli_connect("localhost", "root", "123456", "joo_db");
    $sql = "select * from board where num=$num";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);
    $id      = $row["id"];
    $name      = $row["name"];
    $regist_day = $row["regist_day"];
    $subject    = $row["subject"];
    $content    = $row["content"];
    $file_name    = $row["file_name"];
    $file_type    = $row["file_type"];
    $file_copied  = $row["file_copied"];
    $hit          = $row["hit"];

    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);

    $new_hit = $hit + 1;
    $sql = "update board set hit=$new_hit where num=$num";
    mysqli_query($con, $sql);
?>
  <div class="board_center">
    <div class="container" style="margin-left : 300px;">
      <!-- Heading Row -->
      <div class="row align-items-center my-5">
        <div class="col-lg-7 no-flex">
          <img class="img-fluid rounded mb-4 mb-lg-0" src="http://placehold.it/900x400" alt="">
        </div>
        <div class="col-lg-5 no-flex">
          <h1 class="font-weight-light">Business Name or Tagline</h1>
          <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
          <a class="btn btn-primary" href="../../page/board/board_widen.php?num=''&page=''">Call to Action!</a>
          <span class="reply"><img src="" alt="">댓글 "15개"</span>
        </div>
      </div>
    </div>
    <div class="container" style="margin-left : 300px;">
      <!-- Heading Row -->
      <div class="row align-items-center my-5">
        <div class="col-lg-7 no-flex">
          <img class="img-fluid rounded mb-4 mb-lg-0" src="http://placehold.it/900x400" alt="">
        </div>
        <div class="col-lg-5 no-flex">
          <h1 class="font-weight-light">Business Name or Tagline</h1>
          <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
          <a class="btn btn-primary" href="../../page/board/board_widen.php?num=''&page=''">Call to Action!</a>
          <span class="reply"><img src="" alt="">댓글 "15개"</span>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <?php include "../../lib/common_page/footer.php" ?>
  </footer>

</body>

</html>
