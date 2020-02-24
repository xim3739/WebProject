$(document).ready(function() {

  var inputId = $("#inputId"),
    inputPassword = $("#inputPassword"),
    inputPasswordCheck = $("#inputPasswordCheck"),
    inputName = $("#inputName"),
    idSubMsg = $("#idSubMsg"),
    passwordSubMsg = $("#passwordSubMsg"),
    passwordCheckSubMsg = $("#passwordCheckSubMsg");
    nameSubMsg = $("#nameSubMsg");

    inputId.blur(function() {
      var idValue = inputId.val();
      var exp = /^(?=.*[a-z])(?=.*[0-9]).{4,12}$/;

      if (idValue === "") {
        idSubMsg.html("<span style='color:#FA5858'>아이디를 입력해 주세요.</span>");
      } else if (!exp.test(idValue)) {
        idSubMsg.html("<span style='color:#FA5858'>아이디 형식이 맞지 않습니다.</span>");
      } else {
        $.ajax({
            url: '../../page/login/member_checkId.php',
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

  inputPassword.blur(function (){
    var passValue = inputPassword.val();
    var exp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{4,12}$/;

    if(passValue ===""){
      passwordSubMsg.html("<span style='color:#FA5858'>패스워드를 입력해 주세요.</span>");
    }else if(!exp.test(passValue)){
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
    var exp = /^[가-힣]{2,4}$/;

    if(nameValue ===""){
      nameSubMsg.html("<span style='color:#FA5858'>이름을 입력해 주세요.</span>")
    }else if(!exp.test(nameValue)){
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


}); //document ready end

function reset_form() {
   document.member_form.id.value = "";
   document.member_form.password.value = "";
   document.member_form.password_check.value = "";
   document.member_form.name.value = "";
   document.member_form.phone_two.value = "";
   document.member_form.phone_three.value = "";
   document.member_form.email_one.value = "";
   document.member_form.email_two.value = "";
   document.member_form.id.focus();
   return;
}
function done(){
  document.member_form.submit();
}
function login_done(){
  document.login_form.submit();
  // document.getElementById('#signUpButton').submit();
}
