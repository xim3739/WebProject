<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="../../js/free/free_read.js" charset="utf-8"></script>
    <link rel="stylesheet" href="../../css/free/free.css">
    <link rel="stylesheet" href="../../css/free/free_read.css">
  </head>
  <body>
    <?php
      $userid="cwpark2197";
      $username="본인";
      // $username="박재훈";
      $nums = $_GET["num"];
      $page = $_GET["page"];
      // $userid="cwpark2190";
      // $userid=(isset($_SESSION["userid"]))?$_SESSION["userid"]:"";
      // $username=(isset($_SESSION["username"]))?$_SESSION["username"]:"";
      // include_once "../../db/db_connector_main.php";
      $connect = mysqli_connect("localhost","root","123456","test");
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

      // $pattern = "|<[^>]+>(.*)</[^>]+>|U";
      $pattern = "/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i";
      preg_match_all($pattern, $content, $matches);
      echo '<pre>';print_r($matches[0]);echo '</pre>';
      // preg_match("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $content, $matches);
      // var_dump($matches);
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
    <div class="">
      <table style="width: 710px;">
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
                <li><a href="./free_list.php">목록</a></li>
                <li><a href="javascript:void(0);" onclick="move_comment();">댓글</a></li>
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
                     <a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
                  }
                  // if($matches[1]){
                  //   $thumb = '<span><img src="'.$matches[1].'" width="70" height="70" class="thumb_img" alt=""></span>';
                  // }else{
                  //   $thumb = '';
                  // }
                   ?>
                  <?=$content?>
                </div>
              </div>
              </td>
          </tr>
          <tr>
            <td>
              <div id="comment_div" class="main_container">
                <?php
                  $sql = "select * from free_comment order by group_num desc, ord asc;";
                  $result = mysqli_query($connect,$sql);
                  // var_dump($result);
                  $total_record = mysqli_num_rows($result);
                  // var_dump($total_record);

                  for ($i=0; $i < $total_record; $i++) {
                    mysqli_data_seek($result,$i);
                    $row = mysqli_fetch_array($result);
                    $num = $row["num"];
                    // var_dump($num);
                    $group_num = $row["group_num"];
                    // var_dump($num);
                    $ord = $row["ord"];
                    $name = $row["name"];
                    $content = $row["content"];
                    $content=str_replace("\n", "<br>",$content);
                    $content=str_replace(" ", "&nbsp;",$content);
                    $regist_day = $row["regist_day"];
                    $depth=(int)$row['depth'];
                    $space="";
                    for($j=0;$j<$depth;$j++){
                      $space="↳&nbsp;".$space;
                    }
                  }
                  mysqli_close($connect);
                ?>
                <div id="comment_head">
                  <h4 style="display: inline;">코멘트</h4>
                  <ul class="total_ul">
                    <li>등록순</li>
                    <li>최신순</li>
                  </ul>
                  <div class="button_refresh" style="display: inline; float : right" onclick="refresh_comment();">
                    새로고침
                  </div>
                </div><!-- 코멘트 헤드 -->
                <div id="comment_main">
                  <ul class="total_ul">
                    <?php  ?>
                    <li>
                      <div id="comment_uptime">
                        <!-- <strong><span></span><span></span>작성자<span></span></strong><br>
                        <div class="">
                          <span>내용</span>
                        </div>
                        <div class="">
                          <a href="#">답글</a>
                        </div> -->
                      </div>
                    </li>
                  </ul>
                </div><!-- 코멘트 내용 -->
                <div class="" style="text-align: right;">
                  <button type="button" name="button" onclick="refresh_comment(<?=$num?>);">새로고침</button>
                </div>
                <div id="comment_write">
                  <form id="comment_form" class="" action="#" method="post">
                    <input type="hidden" id="hidden_num" value="<?=$num?>">
                    <input type="hidden" id="hidden_group_num" value="<?=$group_num?>">
                    <input type="hidden" id="hidden_depth" value="<?=$depth?>">
                    <input type="hidden" id="hidden_ord" value="<?=$ord?>">
                    <input type="hidden" id="hidden_name" value="<?=$name?>">
                    <input type="hidden" id="hidden_regist_day" value="<?=$regist_day?>">
                    <input type="hidden" id="hidden_mode" value="">
                    <table>
                      <tbody>
                        <tr>
                          <td><textarea id="input_comment" rows="8" cols="80"></textarea></td>
                          <td><input type="button" name="" value="등록" onclick="upload_comment();"></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div><!-- 코멘트 작성 -->
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="">
                <ul class="total_ul">
                  <li><a href="./free_list.php">목록</a></li>
                  <?php
                    if ($pre_num) {
                      echo "<li><a href='./free_read_form.php?num=$pre_num&page=$page'>다음글&nbsp;</a></li>";
                    }else {
                      echo "<li><a href='#'>다음글&nbsp;</a></li>";
                    }
                    if ($odd_num) {
                      echo "<li><a href='./free_read_form.php?num=$odd_num&page=$page'>&nbsp;이전글</a></li>";
                    }else {
                      echo "<li><a href='#'>&nbsp;이전글</a></li>";
                    }
                   ?>
                </ul>
                <ul class="total_ul" style="float : right">
                  <li><a href="#" onclick="history.back();">이전페이지</a></li>
                  <li><a href="#" onclick="goTop();">맨 위로</a></li>
                  <li><a href="./free_write_form.php">글쓰기</a></li>
                </ul>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
