<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>찾아ZOO</title>
    <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/main/small-business.css" rel="stylesheet">
    <?php include "../../lib/common_page/main_style.php" ?>
    <link rel="stylesheet" href="../../css/free/free.css">
    <link rel="stylesheet" href="../../css/free/free_read.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="../../js/main/pop_up_menu.js"></script>
    <script src="../../js/free/free_read.js" charset="utf-8"></script>
  </head>
  <?php include "../../lib/common_page/header.php" ?>
  <body>
    <section>
      <div id="read_total">
        <?php
          $nums = $_GET["num"];
          $page = $_GET["page"];
          $userid=(isset($_SESSION["userid"]))?$_SESSION["userid"]:"";
          $username=(isset($_SESSION["username"]))?$_SESSION["username"]:"";
          include_once "../../db/db_connector.php";
          $sql = "select * from free";
          $result = mysqli_query($connect,$sql);
          $row = mysqli_fetch_array($result);
          $names = $row["name"];

          $q_num = mysqli_real_escape_string($connect, $nums);
          $sql = "select * from free where num = $q_num";
          $result = mysqli_query($connect,$sql);
          $row = mysqli_fetch_array($result);
          $num = $row["num"];
          $name = $row["name"];
          $category = $row["category"];
          $subject = $row["subject"];
          $r_category = "[".$category."]";
          $content = $row["content"];
          $file_name = $row["file_name"];
          $file_type = $row["file_type"];
          $file_copied = $row["file_copied"];
          $regist_day = $row["regist_day"];
          $hit = $row["hit"];
          $new_hit=$hit+1;
          $sql="update free set hit=$new_hit where num=$q_num;";
          $result = mysqli_query($connect,$sql);

          $sql = "select num from free where num > $num order by num limit 1";
          $result = mysqli_query($connect,$sql);
          $row = mysqli_fetch_array($result);
          $pre_num = $row["num"];
          $sql = "select num from free where num < $num order by num desc limit 1";
          $result = mysqli_query($connect,$sql);
          $row = mysqli_fetch_array($result);
          $odd_num = $row["num"];
         ?>
        <table>
          <tbody>
            <tr class="back_tr">
              <td>
                <ul class="total_ul">
                  <li class="col1"><?=$name?></li>
                  <li class="col2"><strong><?=$regist_day?></strong></li>
                  <li class="col3"><strong>조회 : </strong><?=$new_hit?></li>
                </ul>
              </td>
            </tr>
            <tr>
              <td>
                <span><?=$r_category?></span>
                <ul class="total_ul" style="float : right">
                  <?php
                  if ($username === $name) {
                    echo "<li><a href='./free_modify_form.php?num=$num&page=$page'>수정</a></li>&nbsp;";
                    echo "<li><a href='#' onclick='delete_confirm($num,$page);'>삭제</a></li>";
                  }
                   ?>
                  <li><a href="./free_list.php"><button type="button" class="go_list_button">목록</button></a></li>
                </ul>
              </td>
            </tr>
            <tr>
              <td>
                <div class="main_container">
                  <div class="subject">
                    <h1><?=$subject?></h1>
                  </div>
                </div>
            </td>
            </tr>
            <tr>
              <td>
                <div class="main_container">
                  <div class="content">
                    <?php
                    if ($file_name) {
                     $real_name = $file_copied;
                     $file_path = "../../data/".$real_name;
                     $file_size = filesize($file_path);

                     echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
                       <a href='free_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
                    }
                     ?>
                    <?=$content?>
                  </div>
                </div>
                </td>
            </tr>
            <tr>
              <td>
                <div class="">
                  <div id="bottom_left">
                    <ul class="total_ul">
                      <li><a href="./free_list.php">목록</a></li>
                      <?php
                      if ($pre_num) {
                        echo "<li><a href='./free_read_form.php?num=$pre_num&page=$page'>다음글&nbsp;</a></li>";
                      }else {
                        echo "<li><a href='#'>다음글&nbsp;</a></li>";
                      }
                      if ($odd_num) {
                        echo "<li><a href='./free_read_form.php?num=$odd_num&page=$page'>이전글</a></li>";
                      }else {
                        echo "<li><a href='#'>&nbsp;이전글</a></li>";
                      }
                      ?>
                    </ul>
                  </div>
                  <div id="bottom_right">
                    <ul class="total_ul">
                      <li><a href="#" onclick="history.back();">이전페이지</a></li>
                      <li><a href="#" onclick="goTop();">맨 위로</a></li>
                      <li><a href="./free_write_form.php">글쓰기</a></li>
                  </div>
                  </ul>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </body>
</html>
