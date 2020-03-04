<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../../css/main/small-business.css" rel="stylesheet">
    <?php include "../../lib/common_page/main_style.php" ?>
    <script src="../../js/main/pop_up_menu.js"></script>
    <!-- list css&js -->
    <script src="../../js/free/free_write.js" charset="utf-8"></script>
    <link rel="stylesheet" href="../../css/free/free.css">
    <link rel="stylesheet" href="../../css/free/free_write.css">
  </head>
    <body>
      <?php include "../../lib/common_page/header.php";?>
      <section>
        <div id="write_total">
          <?php
          include_once "../../db/db_connector.php";
          $userid=(isset($_SESSION["userid"]))?$_SESSION["userid"]:"";
          $sql = "select * from member where id = '$userid'";
          $result = mysqli_query($connect,$sql);
          $row = mysqli_fetch_array($result);
          $id = $row["id"];
          $name = $row["name"];
           ?>
          <table>
            <tbody>
              <tr class="table_border">
                <td>
                </td>
              </tr><!-- 보더용 tr -->
              <tr>
              <tr>
                <td>
                  <form name="write_form" action="free_content_insert.php?id=<?=$id?>&name=<?=$name?>" enctype="multipart/form-data" method="post">
                  <table>
                    <tbody>
                      <tr>
                        <td>
                          <div class="back_tr" style="width: 710px;">
                            <div style="display: inline;width: 80px;">
                              <select class="" name="category">
                                <option value="잡담">잡담</option>
                                <option value="질문">질문</option>
                              </select>
                            </div>
                            <div style="display: inline;">
                              <span>제목 : </span>
                              <span><input type="text" name="subject" id="subject" value="" style=" width: 400px;"> </span>
                            </div>
                            <div style="display: inline; float: right;">
                              <span hidden><?=$id?></span>
                              <span><?=$name?></span>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div style="width: 674px; margin: 10px 0px 0px 17px;">
                            <textarea name = "content" id="content" class="ckeditor" rows="8" cols="80"></textarea>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <input type="file" name = "upfile" id="input_files" value="">
                        </td>
                      </tr>
                      <tr class="back_tr">
                        <td><input type="button" id="submit_content" value="작성 완료" onclick="submit_board();"></td>
                      </tr>
                      <tr class="table_border">
                        <td></td>
                      </tr>
                    </tbody>
                  </table><!-- 폼 안 테이블 -->
                  </form>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
  </body>
</html>
