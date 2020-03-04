function hide_message() {
  $("#message_total").css("-webkit-animation","slide-down 1s ease-in");
  $("#message_total").addClass("off");
  $("#message_total").removeClass("on");
  $("#message_show").show();
}
function show_message() {
  $("#message_total").addClass("on");
  $("#message_total").removeClass("off");
  $("#message_total").css("-webkit-animation","slide-up 1s ease-out");
  $("#message_show").hide();
}
function check_input() {
  var send_id=$("#hidden_send_id").val();
  var rv_id=$("#hidden_rv_id").val();
  var user_id=$("#hidden_user_id").val();
  var mode = "insert";
  var content = $("#message_content").val();
  if (!content || content===" ")
  {
      alert("내용을 입력하세요!");
      document.message_form.content.focus();
      return;
  }
  insert_message(send_id,rv_id,user_id,mode,content);
}
function member_list(){
  var send_id=$("#hidden_send_id").val();
  var rv_id=$("#hidden_rv_id").val();
  var user_id=$("#hidden_user_id").val();
  $.ajax({
    url : "../aside/message_member_ajax.php",
    type : "get",
    traditional : true,
    data : {"send_id" : send_id, "rv_id" : rv_id, "user_id" : user_id},
    dataType: "json",
    success : function(data) {
      var html_one=send_ids=rv_ids="";
      for(var i =0; i<data[0].result; i++){
        send_ids = data[i].send_id;
        rv_ids = data[i].rv_id;
        user_ids = data[i].user_id;
        if (send_ids!==user_ids) {
          html_one += "<li>";
          html_one += "<span><button type='button' class='profile_link' onclick='connect_memeber("+send_ids+","+rv_ids+","+user_ids+");''>"+data[i].name+"</button></span>";
          html_one += "<li>";
        }else if (rv_ids!==user_ids) {
          html_one += "<li>";
          html_one += "<span><button type='button' class='profile_link' onclick='connect_memeber("+send_ids+","+rv_ids+","+user_ids+");''>"+data[i].name+"</button></span>";
          html_one += "<li>";
        }
      }//end of for
      $("#member_list_ul").html(html_one);
      // $("#message_view").ScrollTop($("#message_view").scrollHeight);
    },
    error:function(request,status,error){
      alert("메시지 불러오기 ajax 실패");
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }
  });
}
function connect_memeber(send_id,rv_id,user_id) {
  $.ajax({
    url : "../aside/message_ajax.php",
    type : "get",
    traditional : true,
    data : {"send_id" : send_id, "rv_id" : rv_id, "user_id" : user_id},
    dataType: "json",
    success : function(data) {
      var html_one=send_ids=rv_ids="";
      $("#hidden_send_id").val(data[0].send_id);
      $("#hidden_rv_id").val(data[0].rv_id);
      for(var i =0; i<data[0].result; i++){
        send_ids = data[i].send_id;
        rv_ids = data[i].rv_id;
        user_ids = data[i].user_id;
        if (send_ids!==user_ids) {
          $("#name_head").text(data[i].send_name);
          html_one += "<li style='width: 180px;' class='"+i+"'>";
          html_one += "<span class='time'>"+data[i].regist_day+"</span><br>";
          html_one += "<span class='names'>"+data[i].send_name+"&nbsp;</span>";
          html_one += "<span class='contents'>"+data[i].content+"</span>";
          html_one += "</li>";
        }else{
          $("#name_head").text(data[i].rv_name);
          html_one += "<li class='<?=$i?>' style='width: 180px; text-align: right; '>";
          html_one += "<span class='time' style='font-size: 10px;'>"+data[i].regist_day+"</span><br>";
          html_one += "<span class='names' style='display: none;'>"+data[i].rv_name+"&nbsp;</span>";
          html_one += "<span class='contents' style='display: inline-block; max-width : 120px; background-color: #15E7EB; border-radius: 40px 0px 40px 40px;'>"+data[i].content+"</span>";
          html_one += "<input name='hidden_num' value='"+data[i].num+"' hidden></input>";
          html_one += "</li>";
        }
      }//end of for
      $("#message_ul").html(html_one);
      $("#message_form").show();
      // $("#message_view").ScrollTop($("#message_view").scrollHeight);
    },
    error:function(request,status,error){
      alert("메시지 불러오기 ajax 실패");
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }
  });
}
function insert_message(send_id,rv_id,user_id,mode,content){
  $.ajax ({
    url : "../aside/message_board.php",
    type : "get",
    data : {"send_id": send_id,
            "rv_id": rv_id,
            "user_id": user_id,
            "mode" : mode,
            "content": content},
    dataType: "text",
    success : function(data) {
      if(data==="0"){
        alert("전송에 실패하였습니다");
      }else{
        alert("메세지를 전송했습니다");
        recall_message();
      }
    },
    error : function() {
      console.log("메세지 전송 ajax 실패");
    }
  })
  $("#message_content").val(" ");
}
function delete_message(){
  var send_id=$("#hidden_send_id").val();
  var rv_id=$("#hidden_rv_id").val();
  var mode = "delete";
  var numValue=$("input[name='hidden_num']").length;
  var numData = new Array(numValue);
  for(var i=0;i<numValue;i++){
    numData[i] = $("input[name='hidden_num']")[i].value;
  };
  var num = numData[numData.length-1];
  $.ajax ({
    url : "../aside/message_board.php",
    type : "get",
    data : {"send_id": send_id,
            "rv_id": rv_id,
            "mode" : mode,
            "num": num},
    dataType: "text",
    success : function(data) {
      if(data==="0"){
        alert("삭제 실패");
      }else{
        alert("삭제 완료");
        recall_message();
      }
    },
    error : function() {
      console.log("삭제 작업 ajax 실패");
    }
  });
}
function recall_message(){
  var send_id=$("#hidden_send_id").val();
  var rv_id=$("#hidden_rv_id").val();
  var user_id=$("#hidden_user_id").val();
  $.ajax({
    url : "../aside/message_ajax.php",
    type : "get",
    traditional : true,
    data : {"send_id" : send_id, "rv_id" : rv_id, "user_id" : user_id},
    dataType: "json",
    success : function(data) {
      var html_one=send_ids=now_ids=html_two="";
      $("#hidden_send_id").val(data[0].send_id);
      $("#hidden_rv_id").val(data[0].rv_id);
      for(var i =0; i<data[0].result; i++){
        send_ids = data[i].send_id;
        rv_ids = data[i].rv_id;
        user_ids = data[i].user_id;
        if (send_ids!==user_ids) {
          $("#name_head").text(data[i].send_name);
          html_one += "<li style='width: 180px;' class='"+i+"'>";
          html_one += "<span class='time'>"+data[i].regist_day+"</span><br>";
          html_one += "<span class='names' >"+data[i].send_name+"&nbsp;</span>";
          html_one += "<span class='contents' >"+data[i].content+"</span>";
          html_one += "</li>";
        }else{
          $("#name_head").text(data[i].rv_name);
          html_one += "<li class='<?=$i?>' style='width: 180px; text-align: right; '>";
          html_one += "<span class='time'>"+data[i].regist_day+"</span><br>";
          html_one += "<span class='names' style='display: none;'>"+data[i].rv_name+"&nbsp;</span>";
          html_one += "<span class='contents' style='display: inline-block; max-width : 120px; background-color: #15E7EB; border-radius: 40px 0px 40px 40px;'>"+data[i].content+"</span>";
          html_one += "<input name='hidden_num' value='"+data[i].num+"' hidden></input>";
          html_one += "</li>";
        }
      }//end of for

      $("#message_ul").html(html_one);
      document.getElementById("message_content").placeholder = "메시지를 입력하세요.";
      // $("#message_content").placeholder("메시지를 입력하세요.");
    },
    error:function(request,status,error){
      alert("메시지 불러오기 ajax 실패");
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }
  });
}
