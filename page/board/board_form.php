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
      <p><a href="board_form.html"></a>BOARD</p>
    </div>
  </div>
  <!-- nav -->
  <div class="board_nav">
    <div id="board_nav_box">
      <div id="board_box_message">
        <p><span>"__"</span> 개의 게시물이 있습니다 !</p>
      </div>

      <div id="board_box_writing">
        <p><a href="board_writing.html" style="color : black;">+ 글쓰기</a></p>
      </div>

      <div id="board_box_mypost">
        <p><a href="board_form.html" style="color : black;">내 게시글 보기</a></p>
      </div>

      <div id="board_box_viewall">
        <p><a href="board_form.html" style="color : black;">전체보기</a></p>
      </div>
    </div>
  </div>
  <!-- center -->
  <div class="board_center">
    <div id="board_center_box">
      <a href="board_widen.html">아직 게시물이 없습니다!</a>
    </div>
  </div>

  <footer>
    <?php "../../lib/common_page/footer.php" ?>
  </footer>
  
</body>

</html>
