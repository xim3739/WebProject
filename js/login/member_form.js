var id_exp = /^(?=.*[a-z])(?=.*[0-9]).{4,12}$/;
var pw_exp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{4,12}$/;
var name_exp = /^[가-힣]{2,4}$/;

var phone_exp = /^[0-9]{3,4}$/;


var id_check = false;


function done(){
if(!(document.member_form.inputId.value.match(id_exp))){
  alert("아이디를 형식에 맞게 입력하시오.n\(대문자와 소문자, 숫자를 포함해서 4~12자)");
  document.member_form.inputId.focus();
    return;
}

if()
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
document.member_form.submit();

}

function reset_form() {
   document.member_form.id.value = "";
   document.member_form.pass.value = "";
   document.member_form.pass_confirm.value = "";
   document.member_form.name.value = "";
   document.member_form.email.value = "";

   document.member_form.phone1.value = "";
   document.member_form.phone2.value = "";
   document.member_form.phone3.value = "";
   document.member_form.id.focus();
   return;
}

  window.open("member_check_id.php?id=" + document.member_form.id.value,
      "IDcheck",
       "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
