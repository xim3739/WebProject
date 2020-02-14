<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../../css/board/board.css">
</head>

<body>
  <header>
    <?php include "../../lib/common_page/header.php" ?>
  </header>

  <div class="board_header">
    <div id="board_header_div">
      <p><a href="board_form.html"  >BOARD</a></p>
    </div>
  </div>
  <!-- nav -->
  <div class="board_nav">
    <div id="board_nav_box">
      <div id="board_box_message">
        <p><span>"__"</span> 개의 게시물이 있습니다 !</p>
      </div>

      <div id="board_box_writing">
        <p><a href="board_writing.html">+ 글쓰기</a></p>
      </div>

      <div id="board_box_mypost">
        <p><a href="board_form.html">내 게시글 보기</a></p>
      </div>

      <div id="board_box_viewall">
        <p><a href="board_form.html">전체보기</a></p>
      </div>
    </div>
  </div>
  <!-- center -->
  <div class="board_wirte">
    <div id="board_wirte_box">
      <div id="board_wirte_photo">
        <input type="button" value="Attach a file">
      </div>
      <div id="board_wirte_top">
         <input id="wirte_title" type="text" placeholder="Title">
         <input id="wirte_memberId" type="text" placeholder="MemberId">
      </div>
      <div id="board_wirte_center">
        <textarea id="wirte_content"  placeholder="Content"></textarea>
      </div>
    </div>
    <div id="board_wirte_bottom">
      <input id="wirte_upload" type="button" value="UpLoad">
    </div>
  </div>

  <footer>
    <?php "../../lib/common_page/footer.php" ?>
  </footer>
  
</body>

</html>
