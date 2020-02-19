function hide_message() {
  $("#aside_rightside").hide();
  $("#message_show").show();
}
function show_message() {
  $("#aside_rightside").show();
  $("#message_show").hide();
}
function check_input() {
  var send_id=$("#hidden_send_id").val();
  var rv_id=$("#hidden_rv_id").val();
  var mode = "insert";
  var content = document.message_form.content.value;
  if (!content)
  {
      alert("내용을 입력하세요!");
      document.message_form.content.focus();
      return;
  }
  insert_message(send_id,rv_id,mode,content);
}
function connect_memeber(check_id,now_id) {
  $.ajax({
    url : "../aside_right/message_ajax.php",
    type : "get",
    traditional : true,
    data : {"check_id" : check_id, "now_id" : now_id},
    dataType: "json",
    success : function(data) {
      var html_one=send_ids=now_ids=html_two="";
      $("#name_head").text(data[0].name);
      $("#hidden_send_id").val(data[0].rv_id);
      $("#hidden_rv_id").val(data[0].send_id);
      for(var i =0; i<data[0].result; i++){
        send_ids = data[i].send_id;
        now_ids = data[i].now_id;
        if (send_ids!==now_ids) {
          html_one += "<li style='width: 200px;' class='"+i+"'>";
          html_one += "<span class='time'>"+data[i].regist_day+"</span><br>";
          html_one += "<span class='names'>"+data[i].name+"&nbsp;</span>";
          html_one += "<span class='contents'>"+data[i].content+"</span>";
          html_one += "</li>";
          html_one += "<style media='screen'>";
          html_one += ".contents{background-color: #91DCEB; border-radius: 0px 40px 40px 40px;}";
          html_one += ".names{display: inline;}";
          html_one += "</style>";
        }else{
          html_one += "<li class='<?=$i?>' style='width: 200px; text-align: right; position: relative; left: 45px;'>";
          html_one += "<span class='time' style='font-size: 10px;'>"+data[i].regist_day+"</span><br>";
          html_one += "<span class='names' style='display: none;'>"+data[i].name+"&nbsp;</span>";
          html_one += "<span class='contents' style='background-color: lightblue; border-radius: 40px 0px 40px 40px;'>"+data[i].content+"</span>";
          html_one += "<input name='hidden_num' value='"+data[i].num+"' hidden></input>";
          html_one += "</li>";
        }
      }//end of for
      $("#message_ul").html(html_one);
      $("#message_form").show();
    },
    error:function(request,status,error){
      alert("메시지 불러오기 ajax 실패");
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }
  });
}
function insert_message(send_id,rv_id,mode,content){
  $.ajax ({
    url : "../aside_right/message_board.php",
    type : "get",
    data : {"send_id": send_id,
            "rv_id": rv_id,
            "mode" : mode,
            "content": content},
    dataType: "text",
    success : function(data) {
      // if(data==="0"){
      //   alert("전송에 실패하였습니다");
      // }else{
      //   alert("메세지를 전송했습니다");
      // }
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
    url : "../aside_right/message_board.php",
    type : "get",
    data : {"send_id": send_id,
            "rv_id": rv_id,
            "mode" : mode,
            "num": num},
    dataType: "text",
    success : function(data) {
      // if(data==="0"){
      //   alert("삭제 실패");
      // }else{
      //   alert("삭제 완료");
      // }
    },
    error : function() {
      console.log("삭제 작업 ajax 실패");
    }
  })
}
function recall_message(){
  var send_id=$("#hidden_send_id").val();
  var rv_id=$("#hidden_rv_id").val();
  $.ajax({
    url : "../aside_right/message_ajax.php",
    type : "get",
    traditional : true,
    data : {"check_id" : rv_id, "now_id" : send_id},
    dataType: "json",
    success : function(data) {
      var html_one=send_ids=now_ids=html_two="";
      $("#name_head").text(data[0].name);
      $("#hidden_send_id").val(data[0].rv_id);
      $("#hidden_rv_id").val(data[0].send_id);
      for(var i =0; i<data[0].result; i++){
        send_ids = data[i].send_id;
        now_ids = data[i].now_id;
        if (send_ids!==now_ids) {
          html_one += "<li style='width: 200px;' class='"+i+"'>";
          html_one += "<span class='time'>"+data[i].regist_day+"</span><br>";
          html_one += "<span class='names'>"+data[i].name+"&nbsp;</span>";
          html_one += "<span class='contents'>"+data[i].content+"</span>";
          html_one += "</li>";
          html_one += "<style media='screen'>";
          html_one += ".contents{background-color: #91DCEB; border-radius: 0px 40px 40px 40px;}";
          html_one += ".names{display: inline;}";
          html_one += "</style>";
        }else{
          html_one += "<li class='<?=$i?>' style='width: 200px; text-align: right; position: relative; left: 45px;'>";
          html_one += "<span class='time' style='font-size: 10px;'>"+data[i].regist_day+"</span><br>";
          html_one += "<span class='names' style='display: none;'>"+data[i].name+"&nbsp;</span>";
          html_one += "<span class='contents' style='background-color: lightblue; border-radius: 40px 0px 40px 40px;'>"+data[i].content+"</span>";
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
