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
      $connect = mysqli_connect("localhost","root","123456","test");
      $sql = "select * from free";
      $result = mysqli_query($connect,$sql);
      $row = mysqli_fetch_array($result);
      $num = $row["num"];
      $name = $row["name"];
      $category = $row["category"];
      $subject = $row["subject"];
      $r_category = "[".$category."]";
      $content = $row["content"];
      $regist_day = $row["regist_day"];
      $time = substr($regist_day,12,5);
      $hit = $row["hit"];
      $chu = $row["chu"];
     ?>
    <div class="">
      <table style="width: 710px;">
        <tbody>
          <tr class="back_tr">
            <td>
              <ul class="total_ul">
                <li class="col1"><?=$name?></li>
                <li class="col2"><strong><?=$regist_day?></strong></li>
                <li class="col3"><strong>조회 : </strong><?=$hit?>&nbsp;&nbsp;&nbsp;&nbsp;<strong>추천 : </strong><?=$chu?></li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>
              <span><?=$r_category?></span>
              <ul class="total_ul" style="float : right">
                <li><a href="./free_list.php">목록</a></li>
                <li>댓글</li>
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
                  <?=$content?>
                </div>
              </div>
              </td>
          </tr>
          <tr>
            <td>
              <div class="main_container">
                <div id="content_bottom">
                  <ul class="total_ul"  style="float : left">
                    <li><a href="./free_list.php">목록</a></li>
                    <li>댓글</li>
                  </ul>
                  <button type="button" name="button">추천</button>
                  <button type="button" name="button">신고하기</button>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="">
                <div class="main_container">
                  <h4 style="display: inline;">코멘트</h4>
                  <ul class="total_ul">
                    <li>등록순</li>
                    <li>최신순</li>
                  </ul>
                  <div class="" style="display: inline; float : right">
                    새로고침
                  </div>
                </div>
              </div>
              <div class="main_container">
                <div class="">
                  댓글 보기
                </div>
              </div>
              <div class="" style="text-align: right;">
                새로고침
              </div>
              <div class="main_container">
                <div class="">
                  <form class="" action="index.html" method="post">
                    <table>
                      <tbody>
                        <tr>
                          <td><span>이름</span> </td>
                          <td><textarea name="name" rows="8" cols="80"></textarea> </td>
                          <td><input type="button" name="" value="등록"></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="">
                <ul class="total_ul">
                  <li><a href="./free_list.php">목록</a></li>
                  <li>다음글</li>
                  <li>이전글</li>
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
