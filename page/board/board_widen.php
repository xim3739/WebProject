
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
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

    img{vertical-align:unset;}

    #icon_box { margin-left: 190px; }

    #search { width: 700px; height: 50px; font-size: 20px; }

    header span { display: inline-block; width: 45px; height: 45px; }

    #login_icon { background-image: url(""); }

    #info_icon { background-image: url(""); }

    #btn_search { height: 45px; width: 45px; background-image: url("../../img/main/search1.png"); border: none; background-color: none; outline: none; }

    header a { width: 45px; height: 52px; padding: 0; margin: 0; display: inline-block; vertical-align: middle; }

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
  <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=4ef132eaf679a177a01f1b53b69f7119"></script>
  <!-- <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="../../js/main/pop_up_menu.js"></script>

</head>

<body>
  <?php include "../../lib/common_page/header.php" ?>
    <!-- header -->
    <div class="board_header">
      <div id="board_header_div">
        <p><a href="board_form.php">BOARD</a></p>
      </div>
    </div>
    <!-- nav -->
    <div class="board_nav">
      <div id="board_nav_box">
        <div id="board_box_message">
          <p><span>"__"</span> 개의 게시물이 있습니다 !</p>
        </div>
        <div id="board_box_writing">
          <p><a href="board_writing.php">+ 글쓰기</a></p>
        </div>
        <div id="board_box_mypost">
          <p><a href="board_myboard_form.php">내 게시글 보기</a></p>
        </div>
        <div id="board_box_viewall">
          <p><a href="board_form.php">전체보기</a></p>
        </div>
      </div>
    </div>
    <!-- center -->
    <?php
    $num  = $_GET["num"];
    $page  = $_GET["page"];

    $con = mysqli_connect("localhost", "root", "123456", "joo_db");
    $sql = "select * from board where num=1";
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
    $locationX = $row["locationX"];
    $locationY = $row["locationY"];
    $hit = $row["hit"];

    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);

    $new_hit = $hit + 1;
    $sql = "update board set hit=$new_hit where num=$num";
    mysqli_query($con, $sql);
?>
    <div class="board_widen">
      <div id="board_widen_box">
        <div id="board_widen_photo">
          <?php
                if ($file_name) {
                    $real_name = $file_copied;
                    $file_path = "../../data/".$real_name.".png";
                    $file_size = filesize($file_path);
                    }
            ?>
          <img id="default_proflie" src=<?=$file_path?>>
        </div>
        <div id="board_widen_top">
          <span id="board_widen_top_p_span">TITLE :</span> <span id="widen_title_span"><?=$subject?></span><br>
           <span id="board_widen_top_p_span">MEMBER_ID :</span> <span id="widen_memberId_span"><?=$name?></span><br>
           <span id="board_widen_top_p_span">DATE :</span> <span id="widen_date_span"><?=$regist_day?></span><br>
        </div>
        <div id="board_widen_center">
          <p><span id="widen_content_span"><?=$content?></span></p>
        </div>
        <div id="board_location_box"></div>
      </div>

<!-- 댓글 -->
      <div id="board_widen_comment_box">
        <div id="board_widen_comment_input_box">
          <div id="board_widen_comment_input_span">
            <p>댓글 <span>1000</span>개</p>
          </div>
          <div id="board_widen_comment_input_text">
            <img id="board_widen_comment_input_text_image" src="../../img/board/default_proflie.png">
            <textarea id="input_comment_area" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
            <input type="button" value="Add">
          </div>
        </div>
        <div id="board_widen_comment_show_text">
            <img src="../../img/board/default_proflie.png">
          <div id="board_widen_comment_show_text_member">
            <span>작성자명</span><br>
            <span>댓글 내용이 옵니다</span><br>
            <span>날짜</span>&nbsp;&nbsp;<span style="cursor:pointer" onclick="hide();">▼ 답글</span><br>
          </div>
        </div>

<!-- 대댓글 -->
        <div id="board_widen_comment_input_retext_box">
          <div id="board_widen_comment_input_retext">
            <img id="board_widen_comment_input_retext_image" src="../../img/board/default_proflie.png">
            <textarea id="input_comment_rearea" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
            <input type="button" value="Add">
          </div>
        </div>


        <div id="board_widen_comment_viewmore_click">
          <img src="../../img/board/default_proflie.png">
          <div id="board_widen_comment_show_text_member">
            <span>작성자명</span><br>
            <span>댓글 내용이 옵니다</span><br>
            <span>날짜</span>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <?php include "../../lib/common_page/footer.php" ?>
    </footer>
    <script src="../../js/board/board.js"></script>

</body>

</html>
