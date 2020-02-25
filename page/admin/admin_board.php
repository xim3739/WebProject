<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="../../css/admin/admin.css">
  </head>
  <body>
    <aside id="admin_aside_left">
        <ul>
          <li><a href="./admin_member.php">회원 목록 관리</a></li>
          <li><a href="./admin_board.php?category='찾아요'">게시판 관리</a>
            <ul id="admin_list_category">
              <li><a href="./admin_board.php?category='찾아요'">찾아요 게시판</a></li>
              <li><a href="./admin_board.php?category='데리고 있어요'">데리고 있어요</a></li>
              <li><a href="./admin_board.php?category='임시 보호'">임시 보호</a></li>
              <li><a href="./admin_board.php?category='자유게시판'">자유게시판</a></li>
            </ul>
          </li>
        </ul>
      </aside>
      <section>
        <div id="admin_box">
          <h3 id="member_title">관리자 모드 > 찾아요 게시판 관리</h3>
          <ul id="board_list">
            <li class="title">
              <span class="col1">번호</span>
              <span class="col2">아이디</span>
              <span class="col3">이름</span>
              <span class="col4">카테고리</span>
              <span class="col5">제목</span>
              <span class="col6">등록일</span>
              <span class="col7">조회수</span>
              <span class="col8">파일 이름</span>
              <span class="col9">선택</span>
            </li>
            <?php
              $page=(isset($_GET["page"]))?$_GET["page"]:1;
              $category=(isset($_GET["category"]))?$_GET["category"]:"";
              include_once "../../db/db_connector_main.php";
              $sql = "select * from board where category = $category";
              $result = mysqli_query($connect,$sql);
              $total_record = mysqli_num_rows($result);
              $scale = 10;
              $total_page=($total_record % $scale == 0)?floor($total_record/$scale):(floor($total_record/$scale)+1);
              $start = ($page-1) * $scale;
              $number = $total_record - $start;
              for ($i=$start; $i <$start+$scale && $i < $total_record ; $i++) {
                mysqli_data_seek($result,$i);
                $row = mysqli_fetch_array($result);
                $num = $row["num"];
                $id = $row["id"];
                $name = $row["name"];
                $category = $row["category"];
                $subject = $row["subject"];
                $regist_day = $row["regist_day"];
                $hit = $row["hit"];
                $file_name = $row["file_name"];
                ?>
                <li>
                  <form action="admin_board_delete.php" method="post">
                    <span class="col1"><?=$num?></span>
                    <span class="col2"><?=$id?></span>
                    <span class="col3"><?=$name?></span>
                    <span class="col4"><?=$category?></span>
                    <span class="col5"><?=$subject?></span>
                    <span class="col6"><?=$regist_day?></span>
                    <span class="col7"><?=$hit?></span>
                    <span class="col8"><?=$file_name?></span>
                    <span class="col9"><input type="checkbox" name="item[]" value="<?=$num?>"></span>
                </li>
              <?php
                $number --;
                }
                mysqli_close($connect);
              ?>
          </ul>
          <ul id="page_num">
            <?php
              if ($total_page>=2 && $page >=2) {
                $new_page = $page -1;
                echo "<li><a href='admin_board.php?page=$new_page'>◀ 이전</a></li>";
              }else {
                echo "<li>&nbsp;</li>";
              }
              for ($i=1; $i <=$total_page ; $i++) {
                if ($page == $i) {
                  echo "<li><b> $i </b></li>";
                }else {
                  echo "<li><a href='admin_board.php?page=$i'> $i </a></li>";
                }
              }
              if ($total_page>=2 && $page != $total_page) {
                $new_page = $page+1;
                echo "<li><a href='admin_board.php?page=$new_page'>다음 ▶</a></li>";
              }else {
                echo "<li>&nbsp;</li>";
              }
           ?>
          </ul>
          <button type="submit" >선택된 글 삭제</button>
        </form>
        </div>
      </section>
  </body>
</html>
