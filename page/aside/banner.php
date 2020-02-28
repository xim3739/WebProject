<?php
  // $userid="cwpark2190";
  // $connect = mysqli_connect("localhost","root","123456","test");
  $userid=(isset($_SESSION["userid"]))?$_SESSION["userid"]:"";
  // include_once "../../db/db_connector_main.php";
  mysqli_connect_error($connect);
  $sql = "select * from member where id='$userid'";
  $result = mysqli_query($connect,$sql);
  $row = mysqli_fetch_array($result);
  $name= $row["name"];
  $phone= $row["phone"];
  $premium= $row["premium"];
?>
<aside id="aside_leftside">
  <a  href="https://e.kakao.com/t/you-are-so-cute-zzangjeolmi" target="_blank">
    <img src="../../img/aside/emoticon.jpg" alt="짱절미 이모티콘.jpg"> </a><br>
  <a  href="http://www.yes24.com/campaign/01_book/yesPresent/yesPresent.aspx?EventNo=132102&CategoryNumber=001" target="_blank">
    <img src="../../img/aside/re_book.gif" alt="추천도서.gif"> </a><br>
  <button type="button" id="banner_block" onclick="ask_pay('<?=$userid?>',
    '<?=$name?>','<?=$phone?>');"><img src="../../img/aside/hide.png" alt="광고 삭제.jpg"></button>
</aside>
<?php
if ($premium ==="yes") {
  echo "<script>$('#aside_leftside').hide();</script>";
}else {
  echo "<script>$('#aside_leftside').show();</script>";
}
mysqli_close($connect);
?>
