<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../../css/free/free.css">
    <link rel="stylesheet" href="../../css/free/free_write.css">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="../../js/free/free_write.js" charset="utf-8"></script>
  </head>
  <body>
    <?php
    // include_once "../../db/db_connector_main.php";
    // $userid=(isset($_SESSION["userid"]))?$_SESSION["userid"]:"";
    $userid = "cwpark2190";
    $connect = mysqli_connect("localhost","root","123456","test");
    $sql = "select * from member where id = '$userid'";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($result);
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
            <form name="write_form" action="free_content_insert.php?name=<?=$name?>" enctype="multipart/form-data" method="post">
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
                        <span><?=$name?></span>
                      </div>
                    </div>
                  </td>
                </tr>
                <!-- <tr>
                  <td>
                    <ul class="total_ul">
                      <li><input type="radio" name="" value="">text</li>
                      <li><input type="radio" name="" value="">html</li>
                      <li><input type="radio" name="" value="">웹에디터</li>
                    </ul>
                    <span>닉네임</span>
                  </td>
                </tr> -->
                <tr>
                  <td>
                    <div style="width: 674px; margin: 10px 0px 0px 17px;">
                      <textarea name = "content" id="content" class="ckeditor" rows="8" cols="80"></textarea>
                    </div>
                  </td>
                </tr>
                <!-- <tr>
                  <td>
                    <ul class="total_ul">
                      <li>이미지 첨부</li>
                      <li>파일 첨부</li>
                    </ul>
                  </td>
                </tr> -->
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
  </body>
</html>
