<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>찾아ZOO</title>
    
    <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/notice/notice.css">
    <link href="../../css/index/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/index/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../css/index/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="../../css/index/landing-page.min.css" rel="stylesheet">
    
    
    
   
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="../../js/index/hospital_list.js"></script>
    <!-- KaKao API-->
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

    <?php include "../../lib/common_page/main_style.php";?>
    <script>
        $(document).ready(function() {
            $('section').show(3000);
        });        
    </script>
</head>

<body style="padding-top: 0px">
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
    <nav class="navbar navbar-light bg-light static-top">
        <div class="container" style="vertical-align: text-top;">
            <a class="navbar-brand" href="../index/index.php">찾아Joo</a>
                <div id="icon_box" style=" vertical-align: text-top;">
    <?php
        if(!$userid) {
    ?>
    
                <input type="button" class="btn btn-primary" value="Sign In" onclick="window.open('../login/signup.php','','width=500,height=1000,left=500,top=40');">
    <?php

        } else {
    ?>

    <?php
        include "../../count.php";
        $logged = $username."(".$userid.")님"; ?>

        <span><?=$logged?></span>
        <span>&nbsp;&nbsp; | &nbsp;&nbsp;</span>
        <span><a href="#" onclick="window.open('../../page/login/member_modify_form.php','정보 수정','width=500,height=700,left=500');" style="text-align: center;">마이페이지</a></span>
        <span>&nbsp;&nbsp; | &nbsp;&nbsp;</span>
        <span><a href="../login/logout.php" style=" width: 100px;text-align: center;">로그아웃</a></span>
        
    <?php
        }
    ?>
    
        </div>
    </nav>
    <div id="section_div">
    <section id="section" style="display: none;">
    <div id="div_top_notice">
        <br>
        <br>
        <h1 style="margin-top: 30px;">안녕하세요 찾아JOO 입니다</h1>
        <br/>
        <ul>
            <h4>ABOUT 찾아JOO</h4>
            <li>
                저희 <em>찾아JOO</em>는 <em>강아지</em>와 <em>고양이</em>를 사랑하는 사이트 입니다.
            </li>
            <li>
                <em>찾아JOO</em>에서는 잃어버린 <em>반려견</em>, <em>반려묘</em>들을 찾을 수 있는 사이트 입니다.
            </li>
            <hr>
        </ul>
    </div>
    <br>
    <div id="div_middle_notice">
        <ol>
            <h4>반려견을 잃어버리지 않는 방법!</h4>
            <li>
                이름표를 달아줍니다. <br> 
                반려견에게 이름표를 달아줍니다. 이름표에는 주인과 반려견의 이름, 전화번호 등을 간단히 써줍니다.
            </li>
            <hr>
            <li>
                외출 시에는 반드시 목줄을 맨다. <br> 
                외출 시의 목줄은 분실방지뿐만 아니라 교통사고 등 불의의 사고를 예방해 주고 아무거나 주워 먹는 것을 막을 수도 있습니다.
            </li>
            <hr>
            <li>
                귀환 명령을 확실하게 가르칩니다. <br>
                반려견에 있어서 '이리와', '기다려' 는 꼭 가르쳐야 할 명령어 입니다. 외부 활동에서 자칫 산만해지거나 혹은 흥미로운 일에 이끌려 보호자의 존재와 거리를 잊고 돌아다니다 보면 잃어버리는 일이 발생합니다. 보호자가 반려견의 행동을 제지하는 명령에 대해서는 반드시 숙지 시켜야합니다.
            </li>
            <hr>
            <li>
                반려견을 잃어버렸을 때의 행동요령을 미리 숙지 합니다. <br>
                반려견을 일어버렸을 때 어떻게 할지 몰라서 중요한 시간을 허비하는 경우가 많이 있습니다. 미리 주변의 반려동물 보호센터, 동물 보호소 등의 연락처를 숙지해 두면 위급 상황에 즉시 대처가 가능하며 반려견의 최근 사진을 항상 가지고 있으면 찾는데 많은 도움이 됩니다.
            </li>
            <hr>
        </ol>
        <br>
        <ol>
            <h4></h4>
        </ol>
    </div>
    <div id="div_bottom_notice">
        <ol>
            <h4>반려견을 잃어버렸을 때!</h4>
            <li>
                같이 찾아 봅니다. <br>
                혼자서 찾기보다는 지인 등 여러 사람들을 동원해서 넓은 반경을 빠르게 찾는게 좋습니다.
            </li>
            <hr>
            <li>
                실종 신고를 빠르게 하자. <br>
                잃어 버린 곳 주변의 애견숍, 동물병원, 보호소 등 공공 기관에 알리세요. 보호소의 경우 구조 후 10 ~ 20일이 지나면 다른 곳으로 보낼 수도 있기 때문에 반드시 연락을 해두는 것이 좋습니다.
            </li>
            <hr>
            <li>
                전단지를 부착하자. <br>
                불특정 다수를 상대로 알리는 방법이라서 정말 효과적입니다. 전단지를 만들 때에는 흑백보다 컬러, 물에 잘 젖지 않는 재질, 강아지의 특징과 최근 사진, 잃어버린 장소, 시간, 구조 시 받을 연락처는 두 개 이상, 최소 100장 이상 필요합니다.
            </li>
            <hr>
            <li>
                유기동물 사이트에 실종 등록을 합니다. <br>
                많은 사람들이 이용하는 사이트에 실종 등록을 하면 실종 된 강아지를 찾을 확률이 높아 집니다. <br>
                동물 보호 관리 시스템 <a href="http://animal.go.kr/">http://animal.go.kr/</a><br>
                유기견 보호센터 <a href="http://anumal.or.kr/lost01.htm">http://anumal.or.kr/lost01.htm</a><br>
                동물 보호 센터 <a href="http://www.angel.or.kr/">http://www.angel.or.kr/</a><br>
            </li>
        </ol>
    </div>
    </section>
    </div>

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
</body>

</html>