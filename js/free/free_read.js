function goTop(){
  $('html').scrollTop(0);
}
function move_comment(){
  var scrollPosition = document.getElementById("comment_div");
   scrollPosition.scrollIntoView();
}
function delete_confirm(nums,page){
  console.log(nums);
  console.log(page);
  confirm("글을 삭제하시겠습니까?");
  if (true) {
    window.location.href = "../../page/free_board/free_delete.php?num="+nums+"&page="+page+"";
  }
}
function refresh_comment(){
  var num = $("#hidden_num").val();
  var group_num = $("#hidden_group_num").val();
  var depth = $("#hidden_depth").val();
  var ord = $("#hidden_ord").val();
  var name = $("#hidden_name").val();
  var comment = $("#input_comment").val();
  var regist_day = $("#hidden_regist_day").val();
  var mode = "refresh";
  $.ajax({
    url : "../free_board/free_comment_ajax.php",
    type : "post",
    traditional : true,
    data : {"num" : num,"group_num" : group_num,"depth" : depth,"ord" : ord,
  "name" : name,"comment" : comment,"regist_day" : regist_day,"mode" : mode},
    dataType: "json",
    success : function(data) {
      alert("새로고침 성공!");
      console.log(data);
    },
    error:function(request,status,error){
      alert("새로고침 실패");
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }
  });
}
function upload_comment(){
  if (!$("#input_comment").val())
  {
      alert("내용을 입력하세요!");
      $("#input_comment").focus();
      return;
  }
  var num = $("#hidden_num").val();
  var group_num = $("#hidden_group_num").val();
  var depth = $("#hidden_depth").val();
  var ord = $("#hidden_ord").val();
  var name = $("#hidden_name").val();
  var comment = $("#input_comment").val();
  var regist_day = $("#hidden_regist_day").val();
  var mode = "insert";
  $.ajax({
    url : "../free_board/free_comment_ajax.php",
    type : "post",
    traditional : true,
    data : {"num" : num,"group_num" : group_num,"depth" : depth,"ord" : ord,
  "name" : name,"comment" : comment,"regist_day" : regist_day,"mode" : mode},
    dataType: "json",
    success : function(data) {
      alert("보내기 성공!");
      console.log(data);
    },
    error:function(request,status,error){
      alert("보내기 실패");
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }
  });
}
function delete_comment(){
  var num = $("#hidden_num").val();
  var group_num = $("#hidden_group_num").val();
  var depth = $("#hidden_depth").val();
  var ord = $("#hidden_ord").val();
  var name = $("#hidden_name").val();
  var comment = $("#input_comment").val();
  var regist_day = $("#hidden_regist_day").val();
  var mode = "insert";
  $.ajax({
    url : "../free_board/free_comment_ajax.php",
    type : "post",
    traditional : true,
    data : {"num" : num,"group_num" : group_num,"depth" : depth,"ord" : ord,
  "name" : name,"comment" : comment,"regist_day" : regist_day,"mode" : mode},
    dataType: "json",
    success : function(data) {
      alert("삭제 성공!");
      console.log(data);
    },
    error:function(request,status,error){
      alert("삭제 실패");
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }
  });
}
