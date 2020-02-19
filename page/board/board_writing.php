
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
  <!-- board에서 입력하지 않은 칸이 있는지 확인 -->
  <script>
    function check_input() {
        if (!document.board_write.subject.value)
        {
            alert("제목을 입력하세요!");
            document.board_write.subject.focus();
            return;
        }
        if (!document.board_write.content.value)
        {
            alert("내용을 입력하세요!");
            document.board_write.content.focus();
            return;
        }
        document.board_write.submit();
     }
  </script>
</head>

  <body>

    <header>
      <?php include "../../lib/common_page/header.php" ?>
    </header>

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
      <div class="board_wirte">
          <form name="board_write" action="board_form.php" method="post" style="display:inline-block;">
        <div id="board_wirte_box">
          <div id="board_wirte_photo">
            <input type="file" name="upfile" value="Attach a file">
          </div>
          <div id="board_wirte_top">
            <input id="wirte_title" name="subject" type="text" placeholder="Title">
            <span id="div_write_spandiv">MemberId :<span id="memberid">사용자 아이디가 옴</span> </span>
          </div>
          <div id="board_wirte_center">
            <textarea id="wirte_content"  name="content"  placeholder="Content"></textarea>
          </div>
          <div id="board_location_box">
              <input type="button"  value="location">
          </div>
        </div>
        <div id="board_wirte_bottom">
          <button id="wirte_upload" type="button" onclick="check_input();">UpLoad</button>
        </div>
        </form>
      </div>



    <footer>
      <?php include "../../lib/common_page/footer.php" ?>
    </footer>

  </body>
</html>
