<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <title></title>
  </head>
  <body>


<?php
header('Access-Control-Allow-Origin: *');
  session_start();
  // unset($_SESSION["userid"]);
  // unset($_SESSION["username"]);
  session_destroy();

  // echo("
  //          <script>
  //            window.alert('로그아웃 되었습니다')
  //       history.go(-1);
  //          </script>
  //       ");
        ?>
<!-- ===================================카카오 로그아웃========================================= -->
        <!-- <script src='https://developers.kakao.com/sdk/js/kakao.min.js'></script>
        <script>
        let date = new Date();
        date.setHours(date.getHours()-1);
        document.cookie = "kakao_login=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/localhost;";
        Kakao.init('d4c9f81c1dd87d7457ae9ba104e93a3d');//카카오에서 제공 myceo.co.kr 수정
        Kakao.Auth.logout(
        function(obj) {
        if(obj==true){}else{}
         // location.href='../index/index.php';
         }
        );
        </script> -->




<!-- ========================================네이버 로그아웃================================= -->
<script type="text/javascript">
$(document).ready(function () {

  $.ajax({
    type: "GET",
      url: "https://nid.naver.com/oauth2.0/token?grant_type=delete&client_id=txJsAHBUQ68ptqMzm_5I&client_secret=Zilysao1t_&access_token=AAAAN1AJwxDd1-BiXe39woiKEbV7DmF3wGFhZRw_HVpi3eA4XtSOA_pNMEFPFVbbVQ-01T-G56mhnXO5qZ0dQkD6UXg&service_provider=NAVER",
// data: {grant_type:'delete',client_id:'txJsAHBUQ68ptqMzm_5I', client_secret:'Zilysao1t_',access_token:'AAAAN1AJwxDd1-BiXe39woiKEbV7DmF3wGFhZRw_HVpi3eA4XtSOA_pNMEFPFVbbVQ-01T-G56mhnXO5qZ0dQkD6UXg',},
      success: function (data) {
          location.href='../index/index.php';

      },
      fail: function() {
         alert("ERROR");
      }

      });

});
</script>
      </body>
    </html>
