function goTop(){
  $('html').scrollTop(0);
}
function move_comment(){
  var scrollPosition = document.getElementById("comment_div");
   scrollPosition.scrollIntoView();
}
function upload_comment(){
  var comment = $("#input_comment").val();
  $.ajax({
    url : "../free_board/free_comment_insert.php",
    type : "post",
    traditional : true,
    data : {"comment" : comment},
    dataType: "json",
    success : function(data) {
      alert("보내기 성공!");
      console.log(data);
    },
    error:function(request,status,error){
      alert("메시지 불러오기 ajax 실패");
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }
  });
}
