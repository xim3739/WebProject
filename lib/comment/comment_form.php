<!-- 댓글 -->
<!--
댓글은 각 게시물의 댓글만 가져온다
댓글은 수정없이 삭제 기능만 넣는다
삭제 할땐 내가 단 댓글만 지울수 있고 다른 사람의 댓글은 지울수 없다
답글은 한 댓글에 한번 이상만 달수 있고 대대댓글은 달수 없다
내가 쓴 댓글은 삭제버튼이 생겨져 있다
내가 쓴 댓글의 이미지는 기본 이미지와 다르다(색상을 주어 눈에 띄게 보임)
댓글에 보여지는 것은 1.작성자아이디와 2.댓글의 내용 3.날짜 만 가지고 있어야 함
 -->
<!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <?php
     $num  = $_GET["num"];
     $sql = "select * from comment where num=$num";
     $result = mysqli_query($connect, $sql);
     $row = mysqli_fetch_array($result);
     $id      = $row["id"];
     $regist_day = $row["regist_day"];
     $content    = $row["content"];
     $commentpost_num = mysqli_num_rows($result);
     mysqli_query($connect,$sql);
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
         </div>
         <div id="board_widen_comment_show_text">
           <img class="imgsetting" src="../../img/board/default_proflie.png">
           <div id="board_widen_comment_show_text_member">
             <span id ="id"><?=$id?></span><br>
             <input type="hidden" name="id" value="<?=$id?>">
             <span id ="content"><?=$content?></span><br>
             <input type="hidden" name="re_content" value="<?=$content?>">
             <span id ="date"><?=$regist_day?></span>&nbsp;&nbsp;<span style="cursor:pointer"  onclick="hide();">▼ 답글</span>
             <input type="hidden" name="date" value="<?=$regist_day?>">
           </div>
         </div>
       </form>
       <!--대댓글-->
       <div id="board_widen_comment_input_retext_box">
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
           <span>댓글 내용이 옵니다</span><br>
           <span>날짜</span>
         </div>
       </div>
     </div>
   </body>
 </html>
