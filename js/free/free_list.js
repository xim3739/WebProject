function change_category(){
  var category=$("#category_select option:selected").val();
  if (category) {
    window.location.href="free_list.php?category="+category+"";
  }else{
    window.location.href="free_list.php";
  }
}
function goList(){
  window.location.href="free_list.php?new_cate=1";
}
function connect_message(send_id,rv_iv,user_id){
  show_message();
  connect_memeber(send_id,rv_iv,user_id);
}
