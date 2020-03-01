<!-- 댓글 -->
<!--
댓글은 각 게시물의 댓글만 가져온다
댓글은 수정없이 삭제 기능만 넣는다
삭제 할땐 내가 단 댓글만 지울수 있고 다른 사람의 댓글은 지울수 없다
답글은 한 댓글에 한번 이상만 달수 있고 대대댓글은 달수 없다
내가 쓴 댓글은 삭제버튼이 생겨져 있다
내가 쓴 댓글의 이미지는 기본 이미지와 다르다(색상을 주어 눈에 띄게 보임)
댓글에 보여지는 것은 1.작성자아이디와 2.댓글의 내용 3.날짜 만 가지고 있어야 함
삭제 -  댓글에 삭제를 하면 대댓긇도 없어진다
전 글을 삭제하면 다음글이 이전글위치에 있어야 한다
대댓글이 없으면 대댓글을 보여주지 않는다
 -->

  <?php
      $num  = $_GET["num"];
      $sql = "SELECT * FROM `comment` WHERE `group_num`=$num";
      $result = mysqli_query($connect, $sql);
      $commentpost_num = mysqli_num_rows($result);
      if($commentpost_num){
        for($i = 0; $i < $commentpost_num; $i++){
          $row = mysqli_fetch_array($result);
          $id      = $row["id"];
          $regist_day = $row["regist_day"];
          $content    = $row["content"];
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
        <div class="board_widen_comment_box">
          <form name="comment_form" action="../../lib/comment/comment_insert.php?num=<?=$num?>"  method="post">
            <div id="board_widen_comment_input_box">
              <div id="board_widen_comment_input_span">
                <p>댓글 <span><?=$commentpost_num?></span>개</p>
              </div>
              <div id="board_widen_comment_input_text">
                <img class="imgsetting" id="board_widen_comment_input_text_image" src="../../img/board/default_proflie.png" >
                <textarea name="content" id="input_comment_area" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
                <button type="submit" name="button">Add</button>
              </div>
            </div>
            <?php
            // 해당 게시판 group_num 의 뎃글의 갯수를 가져와 보여준다
               for ($i=0; $i<$commentpost_num; $i++) {
                   mysqli_data_seek($result, $i);
                   $row = mysqli_fetch_array($result);
                   $id      = $row["id"];
                   $regist_day = $row["regist_day"];
                   $content    = $row["content"];
                 ?>
                   <div id="board_widen_comment_show_text">
                     <img class="imgsetting" src="../../img/board/default_proflie.png">
                     <div id="board_widen_comment_show_text_member">
                       <span id ="id"><?=$id?></span><br>
                       <input type="hidden" name="id" value="<?=$id?>">
                       <span id ="re_content"><?=$content?></span><br>
                       <input type="hidden" name="re_content" value="<?=$content?>">
                       <span id ="date"><?=$regist_day?></span>&nbsp;&nbsp;
                       <span id = "reple_comment" style="cursor:pointer"  onclick="hide('board_widen_comment_input_retext_box<?=$i?>');">▼ 답글</span><span>삭제</span>
                       <input type="hidden" name="date" value="<?=$regist_day?>">
                     </div>
                   </div>
                   <!--대댓글-->
                   <div id="board_widen_comment_input_retext_box<?=$i?>" style="margin-left : 60px; display : none;">
                     <div id="board_widen_comment_input_retext">
                       <img class="imgsetting" id="board_widen_comment_input_retext_image" src="../../img/board/default_proflie.png">
                       <textarea id="input_comment_rearea" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
                       <button type="button" name="button" >Add</button>
                     </div>
                   </div>
                   <div id="board_widen_comment_viewmore_click">
                     <img src="../../img/board/default_proflie.png">
                     <div id="board_widen_comment_show_text_member">
                       <span>작성자명</span><br>
                       <input type="hidden" name="id" value="<?=$id?>">
                       <span>댓글 내용이 옵니다</span><br>
                       <input type="hidden" name="re_content" value="<?=$content?>">
                       <span>날짜</span>
                       <input type="hidden" name="date" value="<?=$regist_day?>">
                       <span>삭제</span>
                     </div>
                   </div>
                   <?php
               }
            ?>
           </div>
          </form>
        <?php
        }
      }else{
        ?>
        <div class="board_widen_comment_box">
          <form name="comment_form" action="../../lib/comment/comment_insert.php?num=<?=$num?>"  method="post">
            <div id="board_widen_comment_input_box">
              <div id="board_widen_comment_input_span">
                <p>댓글 <span><?=$commentpost_num?></span>개</p>
              </div>
              <div id="board_widen_comment_input_text">
                <img class="imgsetting" id="board_widen_comment_input_text_image" src="../../img/board/default_proflie.png" >
                <textarea name="content" id="input_comment_area" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
                <button type="submit" name="button">Add</button>
              </div>
            </div><br><br><br><br>
        <?php
      }
      mysqli_close($connect);
   ?>
