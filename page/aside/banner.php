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
      // include "../../db/db_connector_main.php";
      $premiums=(isset($_GET["premium"]))?$_GET["premium"]:"";
      $now_id="cwpark2190";
      echo "<script>console.log('$now_id');</script>";
      $connect = mysqli_connect("localhost","root","123456","test");
      mysqli_connect_error($connect);
      $sql = "select * from member where id='$now_id'";
      $result = mysqli_query($connect,$sql);
      $row = mysqli_fetch_array($result);
      $premium= $row["premium"];
    ?>
  <body>
    <aside id="aside_leftside">
      <a  href="#">광고 테스트</a><br>
      <button type="button" id="banner_block" onclick="ask_pay();">광고 안보기</button>
    </aside>
    <?php
    if ($premiums ==="yes") {
      $sql = "update member set premium='$premiums' where id='$now_id'";
      echo "<script>$('#aside_leftside').hide();</script>";
    }else {
      // echo "<script>$('#aside_leftside').hide();</script>";
      echo "<script>$('#aside_leftside').show();</script>";
    }
    mysqli_close($connect);
    ?>
  </body>
</html>
