
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
  .map_wrap, .map_wrap * {margin:0; padding:0;font-family:'Malgun Gothic',dotum,'돋움',sans-serif;font-size:12px;}
.map_wrap {position:relative;width:100%;height:200px;}
#category {position:absolute;top:10px;left:10px;border-radius: 5px; border:1px solid #909090;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.4);background: #fff;overflow: hidden;z-index: 2;}
#category li {float:left;list-style: none;width:50px;border-right:1px solid #acacac;padding:6px 0;text-align: center; cursor: pointer;}
#category li.on {background: #eee;}
#category li:hover {background: #ffe6e6;border-left:1px solid #acacac;margin-left: -1px;}
#category li:last-child{margin-right:0;border-right:0;}
#category li span {display: block;margin:0 auto 3px;width:27px;height: 28px;}
#category li .category_bg {background:url(http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/places_category.png) no-repeat;}

#category li .pharmacy {background-position: -10px -72px;}

#category li.on .category_bg {background-position-x:-46px;}
</style>

<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=2bc44b6ace455f7c953f89057af1aeae&libraries=services"></script>
<script src="../../js/main/pop_up_menu.js"></script>

</head>

<body>
  <?php include "../../lib/common_page/header.php" ?>
  <!-- header -->
  <div class="board_header">
    <div id="board_header_div">
      <p><a href="board_form.php?num=''&page=''">BOARD</a></p>
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
  <div class="board_myboard_widen">
    <form name="board_write" action="board_modify.php" method="post" enctype="multipart/form-data" style="display:inline-block;">
      <div id="board_myboard_widen_box">
        <div id="board_myboard_widen_photo">
          <?php
                if ($file_name) {
                    $real_name = $file_copied;
                    $file_path = "../../data/".$real_name;
                    $file_size = filesize($file_path);
                    }
            ?>
          <img id="Preview_img" src=<?=$file_path?>>
        </div>
        <div id="board_myboard_widen_top">
          <span id="board_myboard_widen_top_p_span">TITLE :</span> <span id="myboard_widen_title_span"><?=$subject?></span><br>
           <span id="board_myboard_widen_top_p_span">MEMBER_ID :</span> <span id="myboard_widen_memberId_span"><?=$name?></span><br>
           <span id="board_myboard_widen_top_p_span">DATE :</span> <span id="myboard_widen_date_span"><?=$regist_day?></span><br>
        </div>
        <div id="board_myboard_widen_center">
          <p><span id="myboard_widen_content_span"><?=$content?></span></p>
        </div>

      <!-- 지도 div -->
        <div id="board_location_box" style="position: relative;">
        <div class="map_wrap">
    <div id="map" style="width:100%;height:100%;position:relative;overflow:hidden;"></div>
    <ul id="category">

        <li id="PM9" data-order="2">
            <span class="category_bg pharmacy"></span>
            동물병원
        </li>

    </ul>
</div>
        </div>
      </div>
      <div id="board_myboard_widen_button_box">
        <button type="button"><a href="board_myboard_rewrite.php?num=1&page=1">Edit</a></button>
      </div>
    </form>

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
          <span>날짜</span>&nbsp;&nbsp;<span style="cursor:pointer"  onclick="hide();">▼ 답글</span>
        </div>
      </div>
<!--대댓글-->
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
  <script src="../../js/board/board_map_view.js"></script>

</body>

</html>
