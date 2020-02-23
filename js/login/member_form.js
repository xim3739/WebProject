$(document).ready(function() {
  var inputId = $("#inputId"),
    idSubMsg = $("#idSubMsg"),
    passMsg = $("#pass_msg"),
    pass = $("#pass"),
    pass_confirm = $("#pass_confirm");

  pass_confirm.blur(function() {
    var passValue= pass.val();
    var passConfirmValue=pass_confirm.val();

    if(document.member_form.pass.value ===
          document.member_form.pass_confirm.value){
      passMsg.html("<span style='color:#FA5858'>비밀번호가 일치합니다.</span>");
    }else{
      passMsg.html("<span style='color:#FA5858'>비밀번호가 틀립니다. 다시 확인해 주세요.</span>");
    }
  });

  inputId.blur(function() {
    var idValue = inputId.val();
    var exp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{4,12}$/;

    if (idValue === "") {
      idSubMsg.html("<span style='color:#FA5858'>아이디를 입력해 주세요.</span>");
    } else if (!exp.test(idValue)) {
      idSubMsg.html("<span style='color:#FA5858'>아이디 형식이 맞지 않습니다.</span>");
    } else {
      $.ajax({
          url: './member_checkId.php',
          type: 'POST',
          data: {
            "inputId": idValue
          },
          success: function(data) {
            console.log(data);
            if (data === "1") {
              idSubMsg.html("<span style='color:#FA5858'>이미 사용 중인 아이디입니다.</span>");
            } else if (data === "0") {
              idSubMsg.html("<span style='color:#FA5858'>사용 가능한 아이디입니다.</span>");
            } else {
              idSubMsg.html("<span style='color:#FA5858'>ERROR</span>");
            }
          }
        })
        .done(function() {
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
    }
  }); //inputId.blur end

}); //document ready end
