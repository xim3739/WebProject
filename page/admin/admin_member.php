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
          <li><a href="./admin_board.php?category='찾아요'">게시판 관리</a></li>
        </ul>
      </aside>
      <section>
        <div id="admin_box">
          <h3 id="member_title">관리자 모드 > 회원 관리</h3>
          <ul id="member_list">
            <li>
              <span class="col1">번호</span>
              <span class="col2">아이디</span>
              <span class="col3">이름</span>
              <span class="col4">전화번호</span>
              <span class="col5">프리미엄 상태</span>
              <span class="col6">삭제</span>
            </li>
            <?php
              $page=(isset($_GET["page"]))?$_GET["page"]:1;
              include_once "../../db/db_connector_main.php";
              $sql = "select * from member order by num desc";
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
                $phone = $row["phone"];
                $premium = $row["premium"];
                if (!$premium) {
                  $premium = "no";
                }
                ?>
                <li>
                  <form action="#" method="post">
                    <span class="col1"><?=$num?></span>
                    <span class="col2"><?=$id?></span>
                    <span class="col3"><?=$name?></span>
                    <span class="col4"><?=$phone?></span>
                    <span class="col5"><?=$premium?></span>
                    <span class="col6"><button type="button" onclick="location.href='admin_member_delete.php?num=<?=$num?>'">삭제</button></span>
                  </form>
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
                echo "<li><a href='admin_member.php?page=$new_page'>◀ 이전</a></li>";
              }else {
                echo "<li>&nbsp;</li>";
              }
              for ($i=1; $i <=$total_page ; $i++) {
                if ($page == $i) {
                  echo "<li><b> $i </b></li>";
                }else {
                  echo "<li><a href='admin_member.php?page=$i'> $i </a></li>";
                }
              }
              if ($total_page>=2 && $page != $total_page) {
                $new_page = $page+1;
                echo "<li><a href='admin_member.php?page=$new_page'>다음 ▶</a></li>";
              }else {
                echo "<li>&nbsp;</li>";
              }
           ?>
          </ul>
        </div>
      </section>
  </body>
</html>
