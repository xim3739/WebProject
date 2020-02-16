<?php
  include "../../db/db_connector_main.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>test</title>
  <!-- Bootstrap core CSS -->
  <link href="../../css/index/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="../../css/index/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../../css/index/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="../../css/index/landing-page.min.css" rel="stylesheet">

</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">s
      <a class="navbar-brand" href="">test</a>

      <input type="button" class="btn btn-primary" value="Sign In" onclick="window.open('../login/login.php','','width=500,height=700,left=300')">
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead text-white text-center" id="big_head">
    <div class="overlay"></div>
    <div class="container">
      <div id="slide_div" class="row">
      <div id="cp_widget_cc364539-773c-4be5-955e-b1aa94fd7ea5">...</div>
        <script type="text/javascript">
          var cpo = []; cpo["_object"] ="cp_widget_cc364539-773c-4be5-955e-b1aa94fd7ea5"; cpo["_fid"] = "AsPAfqeZUIfu";
          var _cpmp = _cpmp || []; _cpmp.push(cpo);
          (function() { var cp = document.createElement("script"); cp.type = "text/javascript";
          cp.async = true; cp.src = "//www.cincopa.com/media-platform/runtime/libasync.js";
          var c = document.getElementsByTagName("script")[0];
          c.parentNode.insertBefore(cp, c); })();
        </script>
      </div>
    </div>
  </header>
  <div class="col-xl-9 mx-auto">
    <h1 id="seek_h1" class="mb-5">찾을 내용을 입력해 주세요!</h1>
  </div>
  <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
    <form>
      <div class="form-row">
        <div class="col-12 col-md-9 mb-2 mb-md-0">
          <input type="email" class="form-control form-control-lg" placeholder="키워드나 내용을 입력해주세요">
        </div>
        <div class="col-12 col-md-3">
          <button type="submit" class="btn btn-block btn-lg btn-primary">시작하기</button>
        </div>
      </div>
      <div>
          <button><a href="../main/main.php">go</a></button>
      </div>
    </form>
  </div>

  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <ul class="list-inline mb-2">
            <li class="list-inline-item">
              <a href="#">About</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Contact</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
          </ul>
          <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2019. All Rights Reserved.</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-twitter-square fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-instagram fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="../../js/index/vendor/jquery/jquery.min.js"></script>
  <script src="../../js/index/vendor/bootstrap/bootstrap.bundle.min.js"></script>

</body>

</html>
