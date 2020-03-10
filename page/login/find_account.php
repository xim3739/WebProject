<?php
  include "../../db/db_connector.php";
  if(isset($_SESSION['userid'])){
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
  }else{ ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8" />
<title>회원계정 찾기</title>
<style>
* {margin: 0 auto;}
a {color:#333; text-decoration: none;}
.find {text-align:left; width:500px; margin-top:30px; }
</style>
</head>
<body style="background-color:#7ca2c3">
  <div class="big" style="background-color:white; margin-left:30px;margin-right:30px; height:450px;">


  <div class="find">
    <form method="post" action="./member_find_id.php">
      <h1 style="text-align:center; margin-bottom:25px; color:#7ca2c3; padding-top:20px;">회원계정 찾기</h1>

        <fieldset>
          <legend  style="padding:10px;">아이디 찾기</legend>
            <table>
              <tr>
                <td>이름</td>
                <td><input type="text" size="35" name="name" placeholder="이름" style="width:200px"></td>
              </tr>
              <tr>
                <td>전화번호</td>
                <td>
                    <select name="phone_one" id="phone_one">
                      <option value="010" selected>010</option>
                      <option value="011">011</option>
                    </select> -
                    <input type="number" id="phone_two" name="phone_two" placeholder=" 0000 " style="width:57px;"> -
                    <input type="number" id="phone_three" name="phone_three" placeholder=" 0000 " style="width:57px;">
                </td>
              </tr>
            </table>
          <input type="submit" value="아이디 찾기" style="margin-left: 170px; margin-top:10px; margin-bottom:5px; width:150px;" />
      </fieldset>
    </form>
  </div>
  <div class="find">
      <form method="post" action="member_find_pw.php">
        <fieldset>
          <legend style="padding:10px;">비밀번호 찾기</legend>
            <table>
              <tr>
                <td>아이디</td>
                <td><input type="text" size="35" name="userid" placeholder="아이디" style="width:200px"></td>
              </tr>
              <tr>
                <td>전화번호</td>
                <td>
                    <select name="phone_one" id="phone_one">
                      <option value="010" selected>010</option>
                      <option value="011">011</option>
                    </select> -
                    <input type="number" id="phone_two" name="phone_two" placeholder=" 0000 "  style="width:57px;"> -
                    <input type="number" id="phone_three" name="phone_three" placeholder=" 0000 " style="width:57px">
                </td>
              </tr>

            </table>
          <input type="submit" value="비밀번호 찾기" style="margin-left: 170px; margin-top:10px; margin-bottom:5px; width:150px;"/>
      </fieldset>
    </form>
  </div>
  </div>
</body>
</html>
<?php } ?>
