
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
    .reply { margin-left: 213px; }
    .map_wrap {
            position: relative;
            width: 100%;
            height: 200px;
        }

        .title {
            font-weight: bold;
            display: block;
        }

        .hAddr {
            position: absolute;
            left: 10px;
            top: 10px;
            border-radius: 2px;
            background: #fff;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1;
            padding: 5px;
        }

        #centerAddr {
            display: block;
            margin-top: 2px;
            font-weight: normal;
        }

        .bAddr {
            padding: 5px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }
  </style>
  <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=2bc44b6ace455f7c953f89057af1aeae&libraries=services"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
     <script src="../../js/main/pop_up_menu.js"></script>
     <!-- internal style -->
     <?php include "../../lib/common_page/main_style.php";?>

</head>

  <body>
    <?php include "../../lib/common_page/header.php" ?>
    <!-- nav -->
    <section>
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
        <div class="board_wirte">
            <form name="board_write" action="./board_insert.php" method="post" enctype="multipart/form-data" style="display:inline-block;">
          <div id="board_wirte_box">
            <div id="board_wirte_photo">
              <input type='file' id="Preview_img" name="upfile"/>
              <img src="../../img/board/default.jpg" id="blah"/>
            </div>
            <div id="board_wirte_top">
              <input id="wirte_title" name="subject" type="text" placeholder="Title">
            <!--  <span id="div_write_spandiv">MemberId :<span id="memberid"></span> </span>-->
            <select id="category_write" name="category">
              <option value="찾아요">찾아요</option>
              <option value="데리고있어요">데리고 있어요</option>
              <option value="자유게시판">자유게시판</option>
              <option value="흐흐흐">흐흐흐</option>
            </select>
            </div>
            <div id="board_wirte_center">
              <textarea id="wirte_content"  name="content"  placeholder="Content"></textarea>
            </div>
            <div id="board_location_box">
            <div class="map_wrap">
          <div id="map_write" style="width:100%;height:100%;position:relative;overflow:hidden;"></div>
          <div class="hAddr" style="position: absolute;left: 10px;top: 10px;border-radius: 2px;background: #fff;
              background: rgba(255, 255, 255, 0.8);z-index: 1;padding: 5px;">
              <span class="title">지도중심기준 행정동 주소정보</span>
              <span id="centerAddr"></span>
          </div>
          </div>
            </div>
          </div>
          <div id="board_wirte_bottom">
            <button id="wirte_upload" type="button" onclick="check_input();">UpLoad</button>
          </div>
          </form>
        </div>
    </section>

    <footer>
      <?php include "../../lib/common_page/footer.php" ?>
    </footer>
  <script src="../../js/board/board.js"></script>
  <script src="../../js/board/board_map_write.js"></script>
  </body>
</html>
