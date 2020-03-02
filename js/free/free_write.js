function submit_board(){
  if (!$("#subject").val())
  {
      alert("내용을 입력하세요!");
      $("#subject").focus();
      return;
  }
  if (!$("#content").val())
  {
      alert("내용을 입력하세요!");
      $("#content").focus();
      return;
  }
  document.write_form.submit();
}
