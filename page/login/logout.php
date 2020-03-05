<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <title></title>

    <!-- ========================================네이버 로그아웃================================= -->


  </head>
  <body>

<iframe src="https://nid.naver.com/nidlogin.logout" width="" height="" style="display:hidden;"></iframe>

<?php
// header('Access-Control-Allow-Origin: *');
  session_start();
  session_destroy();


  echo("
           <script>
             window.alert('로그아웃 되었습니다')
        location.href='../index/index.php';
           </script>
        ");
        ?>
<!-- ===================================카카오 로그아웃========================================= -->

      </body>
    </html>
