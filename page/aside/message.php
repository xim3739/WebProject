<aside id="aside_rightside">
  <button type="button" id="message_show" onclick="show_message()">쪽지함</button>
  <div id="message_total" class="off">
    <button type="button" name="button" id="message_exit" onclick="hide_message()"><img id="exit_img" src="../../img/aside/hide.png" alt="X"> </button>
    <div id="member_list">
      <ul >
        <?php
        $i=0;
        $userid=(isset($_SESSION["userid"]))?$_SESSION["userid"]:"";
        $username=(isset($_SESSION["username"]))?$_SESSION["username"]:"";
        if (!$userid) {
          echo "<script type='text/javascript'>
          $('#aside_rightside').hide();
          $('#message_show').hide();
          </script>";
        }
        include_once "../../db/db_connector.php";
        $sql = "select distinct send_id,rv_id,send_name,rv_name from message";
        $result = mysqli_query($connect,$sql);
        $total_record = mysqli_num_rows($result);
        for ($i=0; $i <$total_record ; $i++) {
          $row = mysqli_fetch_array($result);
          $send_id= $row["send_id"];
          $rv_id= $row["rv_id"];
          $send_name = $row["send_name"];
          $rv_name = $row["rv_name"];
          if ($rv_id===$userid) {
            ?>
            <li>
              <span><button type="button" class="profile_link" onclick="connect_memeber('<?=$rv_id?>','<?=$send_id?>','<?=$userid?>');"><?=$send_name?></button> </span>
            </li>
            <?php
          }
          }//end of for
         ?>
      </ul>
    </div>
    <form name="message_form" id="message_form" action="#" method="post">
      <h6 id="name_head">&nbsp;</h6>
      <input id="hidden_send_id"  value="<?=$send_id?>"></input>
      <input id="hidden_rv_id"  value="<?=$rv_id?>"></input>
      <input id="hidden_user_id"  value="<?=$userid?>"></input>
      <div id="message_view">
        <ul id="message_ul">
        </ul>
      </div>
      <input type="text" id="message_content" name="content" placeholder="메세지를 입력하세요.">
      <button type="button" class="button_icon" id="message_send" onclick="check_input();"><img src="../../img/aside/send.png" alt="보내기.png"></button>
      <button type="button" class="button_icon" id="message_delete" onclick="delete_message();"><img src="../../img/aside/delete.png" alt="삭제.png"></button>
      <button type="button" class="button_icon" id="message_refresh" onclick="recall_message();">
        <img src="../../img/aside/refresh.png" alt="새로고침.png"></button>
    </form>
  </div>
</aside>
