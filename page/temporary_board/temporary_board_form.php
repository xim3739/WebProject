<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../../css/temporary_board/board.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../../css/main/small-business.css" rel="stylesheet">
  <?php include "../../lib/common_page/main_style.php" ?>
  <script src="../../js/main/pop_up_menu.js"></script>

  </head>
  <script>
    function check_input() {
        if (!document.board_form.subject.value)
        {
            alert("제목을 입력하세요!");
            document.board_form.subject.focus();
            return;
        }
        if (!document.board_form.content.value)
        {
            alert("내용을 입력하세요!");
            document.board_form.content.focus();
            return;
        }
        document.board_form.submit();
    }
  </script>

  <body>
    <?php include "../../lib/common_page/header.php" ?>

    <section >
      <div id="board_box" style="padding-top:100px;">
        <h3 id="board_title">
            임시보호 > 글쓰기
        </h3>
        <form  name="board_form" method="post" action="./temporary_board_insert.php" enctype="multipart/form-data">
            <ul id="board_form" style="list-style:none;">
              <li>
                  <span class="col1">이름 : </span>
                  <span class="col2"><?=$username?></span>
              </li>
              <li>
                  <span class="col1">제목 : </span>
                  <span class="col2"><input name="subject" type="text"></span>
              </li>
              <li id="text_area">
                  <span class="col1">내용 : </span>
                  <span class="col2">
                      <textarea name="content" style="height:130px;"></textarea>
                  </span>
              </li>
              <li>
                <span class="col1"> 첨부 파일</span>
                <span class="col2"><input type="file" name="upfile" style="height:30px;"></span>
              </li>
            </ul>
            <ul class="buttons">
              <li><button type="button" onclick="check_input()">완료</button></li>
              <li><button type="button" onclick="location.href='./temporary_board_list.php'">목록</button></li>
            </ul>
        </form>

      </div> <!-- board_box -->
    </section>
        <!-- 생략 -->
  </body>
</html>
