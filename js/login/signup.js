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
