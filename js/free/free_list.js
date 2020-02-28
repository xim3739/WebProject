function change_category(categorys){
  var category=$("#category_select option:selected").val();
  if (category) {
    // if ($("#category_select option").val()==categorys) {
    //   $("#category_select option").attr("selected","selected");
    // }
    window.location.href="free_list.php?category="+category+"";
  }else{
    window.location.href="free_list.php";
  }
}
function goList(){
  window.location.href="free_list.php?new_cate=1";
}
