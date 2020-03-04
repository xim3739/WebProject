<style media="screen">
      /* ------------------------------------------ */
      /* comment.php */
      .board_widen_comment_box {
      width: 920px;
      margin: 0 auto;
      }

      #board_widen_comment_box {
      width: 920px;
      margin: 20px auto;
      border-top: 0;
      }

      #board_widen_comment_input_box {
      width: 920px;
      border-bottom: 1px solid gray;
      }

      #board_widen_comment_input_span p {
      margin: 10px;
      }

      #board_widen_comment_input_text img {
      width: 30px;
      height: 30px;
      margin-left: 16px;
      margin-top: 10px;
      }

      #board_widen_comment_input_text textarea {
      width: 750px;
      margin-left: 10px;
      resize: none;
      border: 0;
      border-bottom: 1px solid gray;
      outline: none;
      overflow: auto;
      }

      #input_comment_area {
      font-size: 16px;
      }

      #board_widen_comment_input_text button {
      margin-left: 10px;
      width: 80px;
      height: 35px;
      font-size: 14px;
      transform: translateY(-15px);
      background-color: inherit;
      border: 1px solid gray;
      }
      #board_widen_comment_input_retext img {
      width: 30px;
      height: 30px;
      margin-top: 10px;
      }

      #board_widen_comment_input_retext textarea {
      margin-left: 5px;
      width: 708px;
      resize: none;
      border: 0;
      border-bottom: 1px solid gray;
      outline: none;
      overflow: auto;
      }

      #input_comment_rearea {
      font-size: 16px;
      }

      #board_widen_comment_input_retext button {
      margin-left: 10px;
      width: 80px;
      height: 35px;
      font-size: 14px;
      transform: translateY(-15px);
      background-color: inherit;
      border: 1px solid gray;
      }

      #board_widen_comment_show_text {
      width: 921.600px;
      margin-top: 20px;
      display: inline-block;
      }

      .board_widen_comment_show_text_member {
      display: inline-block;
      }

      .board_widen_comment_show_text_member span {
      font-size: 13px;
      margin-left: 10px;
      }

      #board_widen_comment_show_text img {
      width: 40px;
      height: 40px;
      margin-left: 16px;
      transform: translateY(-15px);
      }

      #board_widen_comment_show_text textarea {
      width: 750px;
      margin-left: 10px;
      resize: none;
      border: 0;
      outline: none;
      overflow: auto;
      transform: translateY(-10px);
      }

      #board_widen_comment_viewmore_click {
      margin-top: 10px;
      margin-bottom: 10px;
      transform: translateX(60px);
      }

      #board_widen_comment_viewmore_click span {
      font-size: 13px;
      margin-left: 10px;
      }

      #board_widen_comment_viewmore_click img {
      width: 40px;
      height: 40px;
      margin-left: 16px;
      transform: translateY(-15px);
      }

      #board_widen_comment_viewmore_click textarea {
      width: 750px;
      margin-left: 10px;
      resize: none;
      border: 0;
      outline: none;
      overflow: auto;
      transform: translateY(-10px);
      }

      /* ------------------------------------------ */
</style>


<!-- 댓글 -->
<!--
삭제 할땐 내가 단 댓글만 지울수 있고 다른 사람의 댓글은 지울수 없다
내가 쓴 댓글은 삭제버튼이 생겨져 있다
내가 쓴 댓글의 이미지는 기본 이미지와 다르다 색상을 주어 눈에 띄게 보임
삭제 -  댓글에 삭제를 하면 대댓긇도 없어진다
전 글을 삭제하면 다음글이 이전글위치에 있어야 한다
 -->

  <?php
  $num = $_GET["num"];
  $page = $_GET["page"];
  ?>
  <script>
        function open_delete(x,y,z){
          alert(x+" "+y+" "+z);
          location.href="./comment_delete.php?comment_num="+x+"&depth="+y+"&num="+z+"&page=<?=$page?>";
        }
  </script>
  <script>
        function open_redelete(x,y,z){
          alert(x+" "+y+" "+z);
          location.href="./recomment_delete.php?comment_num="+x+"&num="+y+"&ord="+z+"&page=<?=$page?>";
        }
  </script>
  <?php

      $passFlag=false;

      $sql = "SELECT * FROM (SELECT * FROM `temporary_comment` ORDER BY `group_num` DESC, `comment_num`) `temporary_comment` WHERE `group_num` = $num GROUP BY `depth`,`comment_num` ORDER BY `comment_num`, `depth`";
    // 코멘트 테이블(그룹넘버로 내림차순, 코멘트 넘버로 오름차순)을 한 테이블에서 그룹넘버가 10인
    // 데이터만 가져오는데 뎁스로 그룹바이를 해서 정렬해서 가져오고 코멘트 넘버로도 구룹 바이로 해서 가져온후
    // 코멘트 넘버로 오름차순으로 가져옴

      $result = mysqli_query($connect, $sql);
      $commentpost_num = mysqli_num_rows($result);


      if ($commentpost_num) {
          for ($i = 0; $i < $commentpost_num; $i++) {
              $row = mysqli_fetch_array($result);
              $id = $row["id"];
              $regist_day = $row["regist_day"];
              $content = $row["content"];
              $ord = $row["ord"];

              ?>
        <script>
        // 댓글 숨기기 기능
          var flag = false;
            function hide(text) {
              if(!flag) {
                document.getElementById(text).style.display = 'none';
                flag = true;
              } else {
                document.getElementById(text).style.display = 'inline-block';
                flag = false;
              }
            }
        </script>
        <!-- basic comment input -->
        <div class="board_widen_comment_box">
          <form name="comment_form" action="./comment_insert.php?num=<?=$num?>"  method="post">
            <div id="board_widen_comment_input_box">
              <div id="board_widen_comment_input_span">
                <p>댓글 <span><?=$commentpost_num?></span>개</p>
              </div>
              <div id="board_widen_comment_input_text">
                <img class="imgsetting" id="board_widen_comment_input_text_image" src="../../img/board/default_proflie.png" >
                <textarea name="content" id="input_comment_area" rows="1"  placeholder="Comment"></textarea>
                <button type="submit" id="submit" name="button">Add</button>
              </div>
            </div>
        </form>
            <!-- 댓글의 폼이 닫히는 부분 -->
            <?php
            // 해당 게시판 group_num 의 뎃글의 갯수를 가져와 보여준다
               for ($i=0; $i<$commentpost_num; $i++) {
                   mysqli_data_seek($result, $i);
                   $row = mysqli_fetch_array($result);
                   $id      = $row["id"];
                   $regist_day = $row["regist_day"];
                   $content    = $row["content"];
                   $depth = $row["depth"];
                   $comment_num = $row['comment_num'];
                   $ord = $row["ord"];


                    ?>

                  <?php
                  if($depth & $passFlag === false){
                    $sql1 = "SELECT * FROM `temporary_comment` WHERE `group_num` = $num AND `comment_num` = $comment_num AND `depth` = $depth";
                    $result1 = mysqli_query($connect, $sql1);
                    $recomment_num = mysqli_num_rows($result1);
                    for($j = 0; $j < $recomment_num; $j++) {
                        mysqli_data_seek($result1, $j);
                        $row = mysqli_fetch_array($result1);
                        $recomment_id      = $row["id"];
                        $recomment_regist_day = $row["regist_day"];
                        $recomment_content    = $row["content"];
                        $ord = $row["ord"];

                  ?>
                  <!--대댓글-->
                  <!-- 대댓글의 폼이 시작 되는 부분 -->
                  <div id="board_widen_comment_viewmore_click">
                    <img src="../../img/board/default_proflie.png">
                    <div id="board_widen_comment_show_text_member<?=$j?>" class="board_widen_comment_show_text_member">
                      <span><?=$recomment_id?></span><br>
                      <input type="hidden" name="id" value="<?=$id?>">
                      <span><?=$recomment_content?></span><br>
                      <input type="hidden" name="re_content" value="<?=$content?>">
                      <span><?=$recomment_regist_day?></span>
                      <input type="hidden" name="date" value="<?=$regist_day?>">
                      <?php
                          if (isset($_SESSION['userid'])) {
                            if ($_SESSION['userid']==$recomment_id) {
                              echo("<span style='cursor:pointer;' onclick='open_redelete($comment_num,$num,$ord);'>삭제</span>");
                            }
                          }
                       ?>

                    </div>
                  </div>
                  <?php
                    }
                    $passFlag = true;
                  }else{
                    $passFlag = false;
                      ?>
                      <!-- comment show & recomment input -->
                     <div id="board_widen_comment_show_text">
                       <img class="imgsetting" src="../../img/board/default_proflie.png">
                       <div id="board_widen_comment_show_text_member<?=$i?>" class="board_widen_comment_show_text_member">
                         <span id ="id"><?=$id?></span><br>
                         <input type="hidden" name="id" value="<?=$id?>">
                         <span id ="re_content"><?=$content?></span><br>
                         <input type="hidden" name="re_content" value="<?=$content?>">
                         <span id ="date"><?=$regist_day?></span>&nbsp;&nbsp;
                         <span id = "reple_comment" style="cursor:pointer"  onclick="hide('board_widen_comment_input_retext_box<?=$i?>');">▼ 답글</span>
                         <?php
                             if (isset($_SESSION['userid'])) {
                               if ($_SESSION['userid']==$id) {
                                 echo("<span style='cursor:pointer;' onclick='open_delete($comment_num,$depth,$num);'>삭제</span>");
                               }
                             }
                          ?>

                         <input type="hidden" name="date" value="<?=$regist_day?>">
                       </div>
                     </div>
                     <!-- 대댓글폼 -->
                     <form name = "recomment_form" action="./comment_insert.php?num=<?=$num?>&mode=re_reply&comment_num=<?=$comment_num?>&page=<?=$page?>" method="post">
                       <div id="board_widen_comment_input_retext_box<?=$i?>" style="margin-left : 60px; display : none;">
                         <div id="board_widen_comment_input_retext">
                           <img class="imgsetting" id="board_widen_comment_input_retext_image" src="../../img/board/default_proflie.png">
                           <textarea name="content" id="input_comment_area" rows="1"  placeholder="Comment"></textarea>
                           <button type="submit" id="submit" name="button" >Add</button>
                         </div>
                       </div>
                     </form>
                      <?php
                  }

                   ?>
                   <!-- 대댓글의 폼이 닫히는 부분 -->

                   <?php
               } ?>
           </div>

        <?php
          }
      } else {
          ?>
        <div class="board_widen_comment_box">
          <!-- 댓글 -->
          <form name="comment_form" action="./comment_insert.php?num=<?=$num?>&mode=reply&page=<?=$page?>"  method="post">
            <div id="board_widen_comment_input_box">
              <div id="board_widen_comment_input_span">
                <p>댓글 <span><?=$commentpost_num?></span>개</p>
              </div>
              <div id="board_widen_comment_input_text">
                <img class="imgsetting" id="board_widen_comment_input_text_image" src="../../img/board/default_proflie.png"/>
                <textarea name="content" id="input_comment_area" rows="1" placeholder="Comment"></textarea>
                <button type="submit" name="button">Add</button>
              </div>
            </div>
          </form></div><br><br><br><br>

        <?php
      }


      mysqli_close($connect);
   ?>
