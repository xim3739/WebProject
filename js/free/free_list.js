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
function connect_message(id){
  show_message();
  recall_message();
}
