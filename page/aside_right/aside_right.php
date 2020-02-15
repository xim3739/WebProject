<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../../css/aside_right.css">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
      function check_input() {
        if (!document.message_form.content.value)
        {
            alert("내용을 입력하세요!");
            document.message_form.content.focus();
            return;
        }
        document.message_form.submit();
      }
      // function hide_message() {
      //   $("#aside_rightside").hide();
      // }
      function show_message() {
        $("#aside_rightside").toggle();
      }
    </script>
  </head>
  <body>
    <button type="button" id="message_show" onclick="show_message()">쪽지함 보이기/숨기기</button>
    <aside id="aside_rightside">
      <!-- <button type="button" name="button" id="message_exit" onclick="hide_message()">X</button> -->
        <div id="member_list">
          <ul >
            <?php
            // session_start();
            $check_id=(isset($_GET["check_id"]))?$_GET["check_id"]:"";
            $now_id="";
            $i=0;
            $now_id = "cwpark2190";

            // $id=(isset($_SESSION["id"]))?$_SESSION["id"]:"";
            // $profile=(isset($_SESSION["profile"]))?$_SESSION["profile"]:"";
            // $intro=(isset($_SESSION["intr"]))?$_SESSION["intro"]:"";
            $con = mysqli_connect("localhost","root","123456","test");
            $sql = "select * from member";
            $result = mysqli_query($con,$sql);
            $total_record = mysqli_num_rows($result);
            for ($i=0; $i <$total_record ; $i++) {
              $row = mysqli_fetch_array($result);
              $member_id[]= $row["id"];
              $name = $row["name"];
             ?>
            <li>
              <span ><a href="test.php?check_id=<?=$member_id[$i]?>" id="profile_link"><?=$member_id[$i]?> <?=$name?></a></span>
            </li>
            <?php
              }//end of for
             ?>
          </ul>
        </div>
        <form name="message_form" id="message_form"action="message_insert.php?send_id=<?=$now_id?>&rv_id=<?=$check_id?>" method="post">
          <h5 style="background-color : lightblue;">&nbsp; <?=$name?></h5>
          <div id="message_view">
            <ul>
              <?php
                $sql = "select * from message where send_id in ('$check_id','$now_id') and rv_id in ('$now_id','$check_id') order by num asc ";
                $result = mysqli_query($con,$sql) or die("error".mysqli_error($con));

                $total_record = mysqli_num_rows($result);
                for ($i=0; $i <$total_record ; $i++) {
                  $row = mysqli_fetch_array($result);
                  $send_id = $row["send_id"];
                  $rv_id = $row["rv_id"];
                  $name = $row["name"];
                  $content = $row["content"];
                  $regist_day = $row["regist_day"];
                  $time = substr($regist_day,12,5);
                  $time_hour = substr($time,0,2);
                  $time_minute = substr($time,2,3);
                  if ((int)$time_hour<12&&(int)$time_hour>0) {
                    $time=$time_hour.$time_minute;
                    $set_time="오전 ".$time;
                  }else {
                    $time=(string)((int)$time_hour-12).$time_minute;
                    $set_time="오후 ".$time;
                  }
                  if ($send_id !== $now_id) {
                    ?>
                    <li style="width: 200px;" class="<?=$i?>">
                      <span class="time"><?=$set_time?></span><br>
                      <span class="names"><?=$name?></span>
                      <span class="contents" ><?=$content?></span>
                    </li>
                    <style media="screen">
                      .contents{background-color: lightgray;}
                      .names{display: inline;}
                    </style>
                    <?php
                  }
                  else {
                    ?>
                    <li class="<?=$i?>" style="width: 200px; text-align: right; position: relative; left: 20%;">
                      <span class="time"><?=$set_time?></span><br>
                      <span class="names" style="display: none;"><?=$name?></span>
                      <span class="contents" style="background-color: lightblue;"><?=$content?></span>
                    </li>
                    <?php
                  }
                }//end of for
                mysqli_close($con);
                 ?>
            </ul>
          </div>
          <input type="text" name="content" placeholder="메세지를 입력하세요.">
          <button type="button" id="message_send" onclick="check_input()">보내기</button>
          <button type="button" id="message_refresh" onclick="location.href = 'test.php?check_id=<?=$check_id?>'">새로고침</button>
        </form>
        </aside>

  </body>
</html>
