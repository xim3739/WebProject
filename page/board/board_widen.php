<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../../css/board/board.css">

  <script>
    function resize(obj) {
      obj.style.height = "1px";
      obj.style.height = (1 + obj.scrollHeight) + "px";
    }
  </script>
</head>

<body>
  <header>
    <?php include "../../lib/common_page/header.php" ?>
  </header>

  <div class="board_header">
    <div id="board_header_div">
      <p><a href="board_form.html">BOARD</a></p>
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
        <p><a href="#">내 게시글 보기</a></p>
      </div>

      <div id="board_box_viewall">
        <p><a href="#">전체보기</a></p>
      </div>
    </div>
  </div>
  <!-- center -->
  <div class="board_widen">
    <div id="board_widen_box">
      <div id="board_widen_photo">
        <img src="/WebProject/img/board/default.jpg">
      </div>
      <div id="board_widen_top">
        <p> <span>TITLE :</span> <span id="widen_title_span">제목이 옵니다</span></p>
        <p> <span>MEMBER_ID :</span> <span id="widen_memberId_span">작성자 명이 옵니다</span></p>
        <p> <span>DATE :</span> <span id="widen_date_span">날짜가 옵니다</span></p>
      </div>
      <div id="board_widen_center">
        <p><span id="widen_content_span">내용이 옵니다</span></p>
      </div>
    </div>
    <div id="board_widen_comment_box">
      <div id="board_widen_comment_input_box">
        <div id="board_widen_comment_input_span">
          <p>댓글 <span>1000</span>개</p>
        </div>
        <div id="board_widen_comment_input_text">
          <img src="/WebProject/img/board/default_proflie.png">
          <!-- <textarea id="input_comment_area"  wrap="hard" rows="1" placeholder="Comment Field"></textarea> -->
          <textarea id="input_comment_area" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
          <input type="button" value="Add">
        </div>
      </div>
      <div id="board_widen_comment_show_text">
        <div id="board_widen_comment_show_text_img">
          <img src="/WebProject/img/board/default_proflie.png">
        </div>
        <div id="board_widen_comment_show_text_member">
          <span>작성자명</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>날짜</span><br>
          <span>댓글 내용이 옵니다</span><br>
          <input type="button" value="답글 달기">
        </div>

      </div>
    </div>
  </div>

  <footer>
    <?php "../../lib/common_page/footer.php" ?>
  </footer>

</body>

</html>
