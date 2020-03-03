<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="../../css/board/board.css">
  <link rel="stylesheet" type="text/css" href="../../css/comment/comment.css">
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="../../js/board/board.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../../css/main/small-business.css" rel="stylesheet">
  <style>
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
    img {vertical-align: unset;}
  </style>
  <?php include "../../lib/common_page/main_style.php";?>
  <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=2bc44b6ace455f7c953f89057af1aeae&libraries=services"></script>
  <!-- <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <script src="../../js/main/pop_up_menu.js"></script>

</head>
<body>
  <!-- header -->
  <?php include "../../lib/common_page/header.php" ?>
<section>
  <!-- nav -->
  <?php include "../../lib/board/nav/board_nav.php" ?>

  <?php
  // session_start();
  $num  = $_GET["num"];
  $sql = "select * from board where num = $num";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_array($result);

  $id      = $row["id"];
  $name      = $row["name"];
  $regist_day = $row["regist_day"];
  $subject    = $row["subject"];
  $content    = $row["content"];
  $file_name    = $row["file_name"];
  $file_type    = $row["file_type"];
  $file_copied  = $row["file_copied"];
  $locationX = $row["locationY"];
  $locationY = $row["locationX"];
  $hit = $row["hit"];

  $content = str_replace(" ", "&nbsp;", $content);
  $content = str_replace("\n", "<br>", $content);

  $new_hit = $hit + 1;
  $sql = "update board set hit=$new_hit where num=$num";
  mysqli_query($connect,$sql);
?>
  <!-- center -->
  <div class="board_widen">
   <form name="board_write" action="board_modify.php?num=<?=$num?>" method="post" enctype="multipart/form-data" style="display:inline-block;">
    <div id="board_widen_box">
      <div id="board_widen_photo">
        <?php
              if ($file_name) {
                  $real_name = $file_copied;
                  $file_path = "../../data/".$real_name;
                  $file_size = filesize($file_path);
              }else{
                $file_path = "./default.jpg";
              }
          ?>
          <img id="blah"  name="upfile"  src='<?=$file_path?>' onerror="imagedefault(this)">
      </div>
      <div id="board_widen_top">
          <span class="board_widen_top_p_span">TITLE :</span> <span id="widen_title_span"><?=$subject?></span><br>
          <span class="board_widen_top_p_span">MEMBER_ID :</span> <span id="widen_memberId_span"><?=$name?></span><br>
          <span id="board_widen_top_p_span_date"></span> <span id="widen_date_span"><?=$regist_day?></span><br>
      </div>
      <div id="board_widen_center" style="overflow: auto">
        <p><span id="widen_content_span"><?=$content?></span></p>
      </div>
      <!-- 지도 div -->
      <div id="board_location_box">
        <div id="board_location_box" style="position: relative;">
          <div class="map_wrap">
            <div id="map" style="width:100%;height:100%;position:relative;overflow:hidden;"></div>
              <ul id="category">
                <li id="PM9" data-order="2"><span class="category_bg pharmacy"></span>동물병원  </li>
              </ul>
          </div>
        </div>
      </div><br><br>
    </div>
  </form>
</div>
</section>
  <!-- 댓글기능 -->
  <?php include "../../lib/comment/comment_form.php" ?>
  <!-- <script src="../../js/board/board_map_view.js"></script> -->
  </section>
  <?php include "../../js/board/board_map_view.php"?>
  <!-- <script src="../../js/board/board_map_view.js"></script> -->


</body>

</html>
