
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
        echo ("<script>console.log(document.cookie)</script>");
?>

<header class="z_index1">
  <div id="header_box">
    <div id="header_center">
      <div id="header_content" style="margin-bottom: 10px;margin-top: 10px;">
        <!-- <a href="../../page/index/index.php" id="btn_home"></a> -->
        <button type="button" id="btn_home"></button>
        <form action="">
          <input type="text" name="" id="search">
          <input type="submit" value="  " id="btn_search">
        </form>
      </div>


      <div id="icon_box">
      <?php
      if (!$username) {
       ?>
       <input type="button" class="btn btn-primary sign_btn" value="Sign In" onclick="window.open('../login/login_and_signup.php','','width=500,height=700,left=500,top=40')">
      <?php
      }else{
        $logged = $username."(".$userid.")님"; ?>
      <span><?=$logged?></span>
      <span>&nbsp;&nbsp;| </span>
      <!-- <span><a href="../../page/login/member_modify_form.php" target="_blank" class="private">마이페이지</a></span> -->
      <span><a href="#" onclick="window.open('../../page/login/member_modify_form.php','','width=500,height=700,left=500,top=40')" class="private">마이페이지</a></span>

      <span> |</span>
      <span><a href="../login/logout.php" class="private">로그아웃</a></span>

        <?php
      }
       ?>

      </div>
    </div>
  </div>

</header>
<!-- tab -->
<div id="menu_bar" class="z_index1">
  <ul>
    <li class="t_co11"><a href="">찾아요</a></li>
    <li class="t_co12"><a href="">데리고있어요</a></li>
    <li class="t_co13"><a href="">임시보호</a></li>
    <li class="t_co14"><a href="../../page/board/board_form.php">자유게시판</a></li>
    <li class="t_co15"><a href="">후원하기</a></li>
  </ul>
</div>
<<<<<<< HEAD
<!-- <div id="pop_up" class="z_index2">
  <div id="pop_box" onmouseleave="pop_down()">
    <ul class="z_index2">
      <li><a href="">찾아요</a></li>
      <li><a href="">데리고있어요</a></li>
      <li><a href="">임시보호</a></li>
    </ul>
    <ul>
      <li><a href="../../page/board/board_form.php">자유게시판</a></li>
      <li><a href="">후후후</a></li>
    </ul>
  </div>
</div>
<div id="pop_log" class="z_index2" onmouseleave="pop_down()">
  <div id="pop_login">
    <ul>
      <li><a href="">로그인</a></li>
      <li><a href="">회원가입</a></li>
    </ul>
  </div>
</div> -->

<!-- </div> -->
=======
>>>>>>> 28a2c70a33a312b317ee393ac3e54eb467f15472
