<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="../../css/message/message.css">
    <script src="../../js/message/message.js" charset="utf-8"></script>
  </head>
  <body>
    <button type="button" id="message_show" onclick="show_message()">쪽지함</button>
    <aside id="aside_rightside">
      <button type="button" name="button" id="message_exit" onclick="hide_message()"><img id="exit_img" src="../../img/message/hide.png" alt="X"> </button>
      <div id="member_list">
        <ul >
          <?php
          // session_start();
          $check_id=(isset($_GET["check_id"]))?$_GET["check_id"]:"";
          $names=(isset($_GET["names"]))?$_GET["names"]:"";
          $i=0;
          // $now_id = "man1";
          $now_id = "cwpark2190";
          if (!$now_id) {
            echo "<script type='text/javascript'>
            $('#aside_rightside').hide();
            $('#message_show').hide();
            </script>";
          }
          // include "../../db/db_connector_main.php";
          // $id=(isset($_SESSION["id"]))?$_SESSION["id"]:"";
          // $profile=(isset($_SESSION["profile"]))?$_SESSION["profile"]:"";
          // $intro=(isset($_SESSION["intr"]))?$_SESSION["intro"]:"";
          $connect = mysqli_connect("localhost","root","123456","test");
          $sql = "select * from member";
          $result = mysqli_query($connect,$sql);
          $total_record = mysqli_num_rows($result);
          for ($i=0; $i <$total_record ; $i++) {
            $row = mysqli_fetch_array($result);
            $member_id= $row["id"];
            $name = $row["name"];
           ?>
          <li>
            <span><button type="button" class="profile_link" onclick="connect_memeber('<?=$member_id?>','<?=$now_id?>');"><?=$name?></button> </span>
          </li>
          <?php
            }//end of for
           ?>
        </ul>
      </div>
      <form name="message_form" id="message_form" action="#" method="post">
        <h6 id="name_head">&nbsp;</h6>
        <input id="hidden_send_id"hidden></input>
        <input id="hidden_rv_id"hidden></input>
        <div id="message_view">
          <ul id="message_ul">
          </ul>
        </div>
        <input type="text" id="message_content" name="content" placeholder="메세지를 입력하세요.">
        <button type="button" class="button_icon" id="message_send" onclick="check_input();"><img src="../../img/message/send.png" alt="보내기.png"></button>
        <button type="button" class="button_icon" id="message_delete" onclick="delete_message();"><img src="../../img/message/delete.png" alt="삭제.png"></button>
        <button type="button" class="button_icon" id="message_refresh" onclick="recall_message();">
          <img src="../../img/message/refresh.png" alt="새로고침.png"></button>
      </form>
    </aside>
  </body>
</html>
