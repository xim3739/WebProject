<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js" charset="utf-8"></script>
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script src="./js/vendor/jquery.min.js"></script>

    <script src="../../js//login/signup.js"></script>
    <script src="../../js//login/login.js"></script>

    <script type="text/javascript">

      $(document).ready(function(){

        $('ul.tabs li').click(function(){
          var tab_id = $(this).attr('data-tab');

          $('ul.tabs li').removeClass('current');
          $('.tab-content').removeClass('current');

          $(this).addClass('current');
          $("#"+tab_id).addClass('current');
        });
    });
    function login_done(){
      document.login_form.submit();
      // document.getElementById('#signUpButton').submit();
    }

    </script>
    <link rel="stylesheet" href="../../css/login/login.css">
    <link rel="stylesheet" href="../../css/login/signup.css">
  </head>
  <body>
    <div class="container">
  	<ul class="tabs">
  		<li class="tab-link current" data-tab="signup">회원가입</li>
  		<li class="tab-link" data-tab="login">로그인</li>
  	</ul>
  	<div id="signup" class="tab-content current">
      <div id="member_main_content">
        <div id="title_member">
          <h1>회원가입</h1>
        </div>
        <div id="member_form">
          <form name="member_form" action="member_insert.php" method="post">
            <input type="text" name="id" id="input_id" placeholder=" 아이디 입력 "> <br>
            <p id="input_id_confirm"></p>
            <input type="password" name="password" id="input_password" placeholder=" 비밀번호 입력 "> <br>
            <p id="input_password_confirm"></p>
            <input type="password" name="password_check" id="input_password_check" placeholder=" 비밀번호 재입력 "> <br>
            <p id="input_password_check_confirm"></p>
            <input type="text" name="name" id="input_name" placeholder=" 이름 "> <br>
            <p id="input_name_confirm"></p>
            <div id="phone">
              <div id="phone_input">
                <select name="phone_one" id="phone_one">
                  <option value="010" selected>010</option>
                  <option value="011">011</option>
                </select> -
                <input type="number" id="phone_two" name="phone_two" placeholder=" 0000 " > -
                <input type="number" id="phone_three" name="phone_three" placeholder=" 0000 " >
              </div>
              <div id="email_certification">
                <button type="button" id="phone_check">인증 요청</button>

              </div>
            </div>

            <script type="text/javascript">

            document.getElementById('phone_check').click(function(){
              var phone_val=document.getElementById("phone_one").value;
              phone_val+=document.getElementById("phone_two").value;
              phone_val+=document.getElementById("phone_three").value;

              console.log(phone_val);
              $.ajax({
                url: 'moonja.php',
                type: 'POST',
                dataType : "text",
                data: {phone:phone_val}
              })
              .done(function(data) {
                console.log(data);
                phone_num=data;
                // alert(h_code);
                alert("문자인증 번호가 발송되었습니다.");
              })
              .fail(function() {
                alert("문자인증 번호 발송실패!");
                console.log("error");
              })
              .always(function() {
                console.log("complete");
             });

            });
            </script>
            <div id="email">
              <div id="email_certification_check">
                <input type="text" name="" placeholder=" 인증 번호 입력 ">
                <div id="email_certification_check_button">
                  <a href="#" onclick="">
                    <p>확 인</p>
                  </a>
                </div>
              </div>
            </div>
            <div id="button">
              <div id="cancel_btn">
                <a href="#" onclick="reset_form()">
                  <p>취 소</p>
                </a>
              </div>
              <div id="signup_btn">
                <a href="#" onclick="done()">
                  <p>가 입</p>
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
  	</div>
  	<div id="login" class="tab-content">
      <form method="POST" class="signUp" name="login_form" action="./login_session.php">
         <h1 class="signUpTitle">Sign up in second</h1>
         <input type="text" name="id" class="signUpInput" placeholder="Type your username" autofocus required>
         <input type="password" name="password" class="signUpInput" placeholder="Choose a password" required>
         <input type="button" value="로그인" id="signUpButton" class="signUpButton" onclick="login_done()">
         <div id="naverIdLogin"></div>
         <a href="#" onclick="kout()"><img src="../../img/login/kakao_account_login_btn_medium_narrow.png"</a>

      </form>


    <!-- ===================================카카오 로그인========================================= -->

    <script type="text/javascript">
    Kakao.init('d4c9f81c1dd87d7457ae9ba104e93a3d');

    function kout(){
      Kakao.Auth.logout();
                 Kakao.Auth.loginForm({
                   success: function(authObj) {

                     							Kakao.API.request({
                                   	url:'/v2/user/me',
                     								success: function(res){

                     									// alert(JSON.stringify(res));
                     									// alert(JSON.stringify(authObj)); //res에 담겨있는 json값을 모두 확인가능
                                      console.log(res.kakao_account.email);
                                      var allData = {"name": res.properties.nickname, "email": res.id};
                                         $.ajax({
                                           type: "POST",
                                           url: "http://localhost/team_project/page/login/create_session.php",
                                           data: allData,
                                           success:function(data) {

                                             if(data === "error") {
                                               alert('NAME_ERROR');
                                             } else {
                                               alert(data+' 님 환영합니다.');
                                               console.log(data);
                                               opener.parent.location.reload();
                                               window.close();
                                             }
                                           }//success:function(data)
                                         });//$.ajax

                                    }//success: function(res){
                                  });//Kakao.API.request
                                  },//success: function(authObj)
                     fail: function(err) {
                       alert(JSON.stringify(err));
                     }

                  }); //Kakao.Auth.loginForm
    } //kout
    </script>

<!-- ========================================네이버 로그인========================================== -->

<script type="text/javascript">
	var naverLogin = new naver.LoginWithNaverId(
		{
			clientId: "txJsAHBUQ68ptqMzm_5I",
			callbackUrl: "http://localhost/team_project/page/login/callback.php",
			isPopup: false, /* 팝업을 통한 연동처리 여부 */
			loginButton: {color: "green", type: 3, height: 60} /* 로그인 버튼의 타입을 지정 */
		}
	);
  naverLogin.init();

	/* 설정정보를 초기화하고 연동을 준비 */
;

</script>
  	</div>
  </div>
  </body>
</html>
