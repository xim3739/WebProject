<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="../../css/admin/admin_board.css">
  </head>
  <body>
    <aside id="admin_aside_left">
        <ul>
          <li><a href="./admin_member.php" class="admin_list">회원 목록 관리</a></li>
          <li><a href="./admin_board.php?category='찾아요'" class="admin_list">게시판 관리</a>
            <ul id="admin_list_category">
              <?php
              include_once "../../db/db_connector.php";
              $category=(isset($_GET["category"]))?$_GET["category"]:"";
              $str1="'"."찾아요"."'";
              $str2="'"."데리고있어요"."'";
              $str3="'"."임시보호"."'";
              $str4="'"."자유게시판"."'";
              $str5="%27"."찾아요"."%27";
              $str6="%27"."데리고있어요"."%27";
              $str7="%27"."임시보호"."%27";
              $str8="%27"."자유게시판"."%27";
              switch ($category) {
                case $str1:
                  echo "<li><a href='./admin_board.php?category=$str5' style='font-weight : bold'>찾아요</a></li>";
                  echo "<li><a href='./admin_board.php?category=$str6' >데리고 있어요</a></li>";
                  echo "<li><a href='./admin_board.php?category=$str7' >임시 보호</a></li>";
                  echo "<li><a href='./admin_board.php?category=$str8' >자유게시판</a></li>";
                  break;

                case $str2:
                echo "<li><a href='./admin_board.php?category=$str5' >찾아요</a></li>";
                echo "<li><a href='./admin_board.php?category=$str6' style='font-weight : bold'>데리고 있어요</a></li>";
                echo "<li><a href='./admin_board.php?category=$str7' >임시 보호</a></li>";
                echo "<li><a href='./admin_board.php?category=$str8' >자유게시판</a></li>";
                  break;

                case $str3:
                echo "<li><a href='./admin_board.php?category=$str5' >찾아요</a></li>";
                echo "<li><a href='./admin_board.php?category=$str6' >데리고 있어요</a></li>";
                echo "<li><a href='./admin_board.php?category=$str7' style='font-weight : bold'>임시 보호</a></li>";
                echo "<li><a href='./admin_board.php?category=$str8' >자유게시판</a></li>";
                  break;

                case $str4:
                echo "<li><a href='./admin_board.php?category=$str5' >찾아요</a></li>";
                echo "<li><a href='./admin_board.php?category=$str6' >데리고 있어요</a></li>";
                echo "<li><a href='./admin_board.php?category=$str7' >임시 보호</a></li>";
                echo "<li><a href='./admin_board.php?category=$str8' style='font-weight : bold'>자유게시판</a></li>";
                  break;

                default:
                  echo "<script>alert('해당하는 페이지가 없습니다.')</script>";
                  break;
              }
               ?>
            </ul>
          </li>
          <li><a href="./admin_statistic.php" class="admin_list">통계</a>
        </ul>
      </aside>
    <section>
      <div id="admin_box">
        <h3 id="board_title">관리자 모드 > 게시판 관리 ><?=$category?></h3>
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
            if($category===$str3){
              $sql = "select * from temporary_board";
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
                $subject = $row["subject"];
                $regist_day = $row["regist_day"];
                $hit = $row["hit"];
                $file_name = $row["file_name"];
                if (!$file_name) {
                  $file_name="자료 없음";
                }
                ?>
                <li>
                  <form action="admin_board_delete.php" method="post">
                    <span class="col1"><?=$i+1?></span>
                    <span class="col2"><?=$id?></span>
                    <span class="col3"><?=$name?></span>
                    <span class="col4">임시보호</span>
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
              
            }else{
              if($category===$str4){
              $sql = "select * from free";
            }else{
              $sql = "select * from board where category = $category";
            }
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
              if (!$file_name) {
                $file_name="자료 없음";
              }
              ?>
              <li>
                <form action="admin_board_delete.php" method="post">
                  <span class="col1"><?=$i+1?></span>
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
            }
            ?>
        </ul>
        <ul id="page_num">
          <?php
          $category="%27".$category."%27";
            if ($total_page>=2 && $page >=2) {
              $new_page = $page -1;
              echo "<li><a href='admin_board.php?category=$category&page=$new_page'>◀ 이전</a></li>";
            }else {
              echo "<li>&nbsp;</li>";
            }
            for ($i=1; $i <=$total_page ; $i++) {
              if ($page == $i) {
                echo "<li><b> $i </b></li>";
              }else {
                echo "<li><a href='admin_board.php?category=$category&page=$i'> $i </a></li>";
              }
            }
            if ($total_page>=2 && $page != $total_page) {
              $new_page = $page+1;
              echo "<li><a href='admin_board.php?category=$category&page=$new_page'>다음 ▶</a></li>";
            }else {
              echo "<li>&nbsp;</li>";
            }
         ?>
        </ul>
        <button type="submit">선택된 글 삭제</button>
      </form>
      </div>
    </section>
  </body>
</html>
