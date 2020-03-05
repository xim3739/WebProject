<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>찾아ZOO</title>
    <link rel="stylesheet" href="../../css/login/signup.css">
    <link rel="stylesheet" href="../../css/login/login.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

    <script src="../../js/login/member_modify.js"></script>
  </head>
  <body>



<?php
@session_start();
if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
} else {
    $userid = "";
}
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    $username = "";
}
?>
    <?php
            if (!$userid) {
                echo("<script>
						alert('로그인 후 이용해주세요!');
						history.go(-1);
						</script>
					");
                exit;
            }
        ?>
<?php
include "../../db/db_connector.php";
    $sql    = "SELECT * FROM `member` WHERE `id`='$userid'";
    $result = mysqli_query($connect, $sql);
    $row    = mysqli_fetch_array($result);

    $id = $row["id"];
    $pass = $row["password"];
    $name = $row["name"];
    $phone = $row["phone"];

    $phone = explode("-", $row["phone"]);
    $phone1 = $phone[0];
    $phone2 = $phone[1];
    $phone3 = $phone[2];

    mysqli_close($connect);
?>
<div id="signup" class="tab-content current">
  <div id="member_main_content">
    <div id="title_member">
      <h1>정보 수정</h1>
    </div>
    <div id="member_form">
      <form name="member_form" action="./member_modify.php?id=<?=$userid?>" method="post">
        <input type="text" name="inputId" id="inputId" value="<?=$userid?>" readonly> <br>
        <p name = "idSubMsg" id="idSubMsg" class="SubMsg"></p>

        <input type="password" name="inputPassword" id="inputPassword" value="<?=$pass?>"> <br>
        <p id="passwordSubMsg" class="subMsg"></p>

        <input type="password" name="inputPasswordCheck" id="inputPasswordCheck" placeholder=" 비밀번호 재입력 "> <br>
        <p id="passwordCheckSubMsg" class="subMsg"></p>

        <input type="text" name="inputName" id="inputName" value="<?=$name?>"> <br>
        <p id="nameSubMsg" class="subMsg"></p>

        <div id="phone">
          <div id="phone_input">
            <select name="phone_one" id="phone_one" style="width:70px" value="<?=$phone1?>">
              <option value="010">010</option>
              <option value="011">011</option>
            </select>&nbsp; - &nbsp;
            <input type="number" id="phone_two" name="phone_two" value="<?=$phone2?>" style="width:83px">&nbsp; - &nbsp;
            <input type="number" id="phone_three" name="phone_three" value="<?=$phone3?>" style="margin-right:20px; width:83px;">
          </div>

            <input type="button" class="btn btn-primary" value="인증 요쳥" id="phone_check">


        <div id="phone">
          <div id="phone_certification_check">
            <input type="text" name="input_phone_certification" id="input_phone_certification" placeholder=" 인증 번호 입력 " style="width: 270px;">
            <div id="phone_certification_check_button" style="width:110px; margin-left:6px;">
              <a href="#" onclick="">
                <p>확 인</p>
              </a>
            </div>
            <p id="input_phone_confirm" name="input_phone_confirm"></p>
          </div>
        </div>
        <div id="button">
          <div id="cancel_btn">
            <a href="#" onclick="reset_form()">
              <p>취 소</p>
            </a>
          </div>
          <div id="signup_btn">
            <a href="#" onclick="modify_done()">
              <p>저  장</p>
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
