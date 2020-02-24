<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
    <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="../../css/aside/banner.css">
    <script src="../../js/aside/banner.js" charset="utf-8"></script>
  </head>
    <?php
      // $userid="cwpark2190";
      // $connect = mysqli_connect("localhost","root","123456","test");
      $userid=(isset($_SESSION["userid"]))?$_SESSION["userid"]:"";
      include "../../db/db_connector_main.php";
      mysqli_connect_error($connect);
      $sql = "select * from member where id='$userid'";
      $result = mysqli_query($connect,$sql);
      $row = mysqli_fetch_array($result);
      $name= $row["name"];
      $phone= $row["phone"];
      $email= $row["email"];
      $premium= $row["premium"];
    ?>
  <body>
    <aside id="aside_leftside">
      <a  href="https://e.kakao.com/t/you-are-so-cute-zzangjeolmi" target="_blank">
        <img src="../../img/aside/emoticon.jpg" alt="짱절미 이모티콘.jpg"> </a><br>
      <a  href="http://www.yes24.com/campaign/01_book/yesPresent/yesPresent.aspx?EventNo=132102&CategoryNumber=001" target="_blank">
        <img src="../../img/aside/re_book.gif" alt="추천도서.gif"> </a><br>
      <button type="button" id="banner_block" onclick="ask_pay('<?=$userid?>',
        '<?=$name?>','<?=$phone?>','<?=$email?>');"><img src="../../img/aside/hide.png" alt="광고 삭제.jpg"></button>
    </aside>
    <?php
    if ($premium ==="yes") {
      echo "<script>$('#aside_leftside').hide();</script>";
    }else {
      echo "<script>$('#aside_leftside').show();</script>";
    }
    mysqli_close($connect);
    ?>
  </body>
</html>
