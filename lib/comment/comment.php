<!-- 댓글 -->
<!--
댓글은 각 게시물의 댓글만 가져온다
댓글은 수정없이 삭제 기능만 넣는다
답글은 한 댓글에 한번 이상만 달수 있고 대대댓글은 달수 없다
 -->

    <div id="board_widen_comment_box">
      <div id="board_widen_comment_input_box">
        <div id="board_widen_comment_input_span">
          <p>댓글 <span>1000</span>개</p>
        </div>
        <div id="board_widen_comment_input_text">
          <img class="imgsetting" id="board_widen_comment_input_text_image" src="../../img/board/default_proflie.png" >
          <textarea id="input_comment_area" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
          <input type="button" value="Add">
        </div>
      </div>
      <div id="board_widen_comment_show_text">
          <img class="imgsetting" src="../../img/board/default_proflie.png">
        <div id="board_widen_comment_show_text_member">
          <span>작성자명</span><br>
          <span>댓글 내용이 옵니다</span><br>
          <span>날짜</span>&nbsp;&nbsp;<span style="cursor:pointer"  onclick="hide();">▼ 답글</span>
        </div>
      </div>
<!--대댓글-->
      <div id="board_widen_comment_input_retext_box">
        <div id="board_widen_comment_input_retext">
          <img class="imgsetting" id="board_widen_comment_input_retext_image" src="../../img/board/default_proflie.png">
          <textarea id="input_comment_rearea" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
          <input type="button" value="Add">
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
  </div>
