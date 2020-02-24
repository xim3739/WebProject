// <!-- 댓글 commet창에서 글자를 치면 자동 줄바꿈 자바스크립트 -->
function resize(obj) {
  obj.style.height = "1px";
  obj.style.height = (1 + obj.scrollHeight) + "px";
}
// 댓글안에 답글글자를 누르면 답글을 달수가 있고 다시 누르면 숨겨지는 기능
var flag = true;

function hide() {
  if (flag === false) {
    document.getElementById("board_widen_comment_input_retext_box").style.display = "none";
    flag = true;
  } else {
    document.getElementById("board_widen_comment_input_retext_box").style.display = "inline-block";
    flag = false;
  }

}
// 이미지 미리보기 기능
$("#Preview_img").on('change', function() {
  readURL(this);
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
// //이미지가 잇을때 FILE_PATH로 이미지를 넣고 없을땐 DEFAULT이미지로 변경
function imagedefault(id){
    id.src = "../../img/board/default.jpg";
}
