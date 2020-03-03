var pw_exp = /^(?=.*[a-zA-Z])(?=.*[A-Z])(?=.*[0-9]).{4,12}$/;
var name_exp = /^[가-힣]{2,4}$/;
var phone_exp = /^[0-9]{3,4}$/;
var phone_code_pass = false;
var id_check = false;

$(document).ready(function() {



  var inputPassword = $("#inputPassword"),
    inputPasswordCheck = $("#inputPasswordCheck"),
    inputName = $("#inputName"),
    passwordSubMsg = $("#passwordSubMsg"),
    passwordCheckSubMsg = $("#passwordCheckSubMsg");
    nameSubMsg = $("#nameSubMsg");


  inputPassword.blur(function (){
    var passValue = inputPassword.val();

    if(passValue ===""){
      passwordSubMsg.html("<span style='color:#FA5858'>패스워드를 입력해 주세요.</span>");
    }else if(!pw_exp.test(passValue)){
        passwordSubMsg.html("<span style='color:#FA5858'>패스워드 형식이 맞지 않습니다.</span>");
    }else{
      passwordSubMsg.html("<span style='color:#FA5858'></span>");
    }
  });

  inputPasswordCheck.blur(function() {
    var passValue= inputPassword.val();
    var passConfirmValue=inputPasswordCheck.val();

    if(document.member_form.inputPassword.value ===
          document.member_form.inputPasswordCheck.value){
      passwordCheckSubMsg.html("<span style='color:#FA5858'>비밀번호가 일치합니다.</span>");
    }else{
      passwordCheckSubMsg.html("<span style='color:#FA5858'>비밀번호가 틀립니다. 다시 확인해 주세요.</span>");
    }
  });

  inputName.blur(function(){
    var nameValue = inputName.val();

    if(nameValue ===""){
      nameSubMsg.html("<span style='color:#FA5858'>이름을 입력해 주세요.</span>")
    }else if(!name_exp.test(nameValue)){
      nameSubMsg.html("<span style='color:#FA5858'>이름을 형식에 맞게 입력해 주세요.</span>");
    }else{
      nameSubMsg.html("<span style='color:#FA5858'></span>");
    }
  });


  $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
  });

  $("#phone_check").click(function() {
          var phone_one_value =  $("#phone_one").val();
          var phone_two_value = $("#phone_two").val();
          var phone_three_value = $("#phone_three").val();
          if(phone_one_value !== "" && phone_two_value !== "" && phone_two_value !== "") {
          $.ajax({
          url: "../../page/login/moonja.php",
          type: 'POST',
          data: {
            "mode": "send",
            "phone_one": phone_one_value,
            "phone_two": phone_two_value,
            "phone_three": phone_three_value
          },
          success: function(data) {
            phone_code=data;
             if (data === "발송 실패") {
                alert("문자 전송 실패되었습니다.");
                phone_code_pass = false;
                isAllPass();
              } else {
                alert("문자가 전송 되었습니다.");
            }
          }
          })
          } else {
            alert("휴대폰 번호가 제대로 입력되지 않았습니다!");
            phone_code_pass = false;
          }
  });

  $("#phone_certification_check").click(function () {
        if($("#input_phone_certification").val() === "") {
          $("#input_phone_confirm").html("<span style='color:red'>인증번호 필요</span>");
          phone_code_pass = false;
        } else if($("#input_phone_certification").val() === phone_code) {
          $("#input_phone_confirm").html("<span style='color:green'>인증 되었습니다.</span>");
          phone_code_pass = true;
        } else if ($("#input_phone_certification").val() !== phone_code){
            $("#input_phone_confirm").html("<span style='color:red'>일치하지 않습니다.</span>");
            phone_code_pass = false;
        } else {
          alert("문자 인증 오류입니다!");
          phone_code_pass = false;
        }
  });
}); //document ready end

function modify_done(){

      if (!(document.member_form.inputPassword.value.match(pw_exp))) {
          alert("비밀번호를 형식에 맞게 입력하세요!");
          document.member_form.inputPassword.focus();
          return;
      }
      if (document.member_form.inputPassword.value !==
            document.member_form.inputPasswordCheck.value) {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
          document.member_form.inputPassword.focus();
          document.member_form.inputPassword.select();
          return;
      }
      if (!(document.member_form.inputName.value.match(name_exp))) {
        alert("이름을 올바르게 입력해주세요.");
          document.member_form.inputName.focus();
          return;
      }
      if (!(document.member_form.phone_two.value.match(phone_exp))) {
        alert("휴대폰 번호를 올바르게 입력해주세요.");
          document.member_form.phone_two.focus();
          return;
      }
      if (!(document.member_form.phone_three.value.match(phone_exp))) {
        alert("휴대폰 번호를 올바르게 입력해주세요.");
          document.member_form.phone_three.focus();
          return;
      }
      if(!phone_code_pass){
        alert("전화번호 인증을 진행 해주세요");
        return;
      }
      document.member_form.submit();
}

function reset_form(){
window.close();
   return;
}

function login_done(){
  document.login_form.submit();
  // document.getElementById('#signUpButton').submit();
}
