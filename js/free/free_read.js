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
  var html = "";
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
      // for(var i =0; i<data[0].result; i++){
      //   name = data[i].name;
      //   now_ids = data[i].now_id;
      //   if (send_ids!==now_ids) {
      //     html_one += "<li style='width: 180px;' class='"+i+"'>";
      //     html_one += "<span class='time'>"+data[i].regist_day+"</span><br>";
      //     html_one += "<span class='names'>"+data[i].name+"&nbsp;</span>";
      //     html_one += "<span class='contents'>"+data[i].content+"</span>";
      //     html_one += "</li>";
      //   }else{
      //     html_one += "<li class='<?=$i?>' style='width: 180px; text-align: right; '>";
      //     html_one += "<span class='time' style='font-size: 10px;'>"+data[i].regist_day+"</span><br>";
      //     html_one += "<span class='names' style='display: none;'>"+data[i].name+"&nbsp;</span>";
      //     html_one += "<span class='contents' style='display: inline-block; max-width : 120px; background-color: #15E7EB; border-radius: 40px 0px 40px 40px;'>"+data[i].content+"</span>";
      //     html_one += "<input name='hidden_num' value='"+data[i].num+"' hidden></input>";
      //     html_one += "</li>";
      //   }
      // }//end of for
      // $("#message_ul").html(html_one);

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
