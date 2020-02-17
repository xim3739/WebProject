<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js" charset="utf-8"></script>
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script src="../../js/login/vendor/jquery/jquery.min.js"></script>
    <script src="../../js//login/signup.js"></script>


    <link rel="stylesheet" href="../../css/login/login.css">
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
    </script>
    <link rel="stylesheet" href="../../css/login/login.css">
    <style media="screen">
    body{
margin-top: 50px;
font-family: 'Trebuchet MS', serif;
line-height: 1.6
}
.container{
width: 500px;
margin: 0 auto;
}

ul.tabs{
margin: 0px;
padding: 0px;
list-style: none;
}
ul.tabs li{
background: none;
color: #222;
display: inline-block;
padding: 10px 15px;
cursor: pointer;
}

ul.tabs li.current{

color: #222;
}

.tab-content{
display: none;

padding: 15px;
}

.tab-content.current{
display: inherit;
}

/* 회원가입 */
input {
  box-sizing: border-box;
  border: 0.5px solid lightgray;
  border-radius: 2px;
}
#member_main_content {
  width: 400px;
  margin: 0 auto;
}
#title_member {
  text-align: center;
  margin-top: 40px;
  margin-bottom: 20px;
}
#member_form input {
  width: 400px;
  height: 50px;
  margin-bottom: 10px;
  box-sizing: border-box;
}
#phone {
  width: 400px;
  height: 40px;
  margin-bottom: 10px;
  box-sizing: border-box;
}
#phone #phone_input {
  display: inline-block;
  float: left;
  box-sizing: border-box;
}
#phone select {
  width: 60px;
  height: 40px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

#phone input {
  width: 103px;
  height: 40px;
  margin-bottom: 10px;
  box-sizing: border-box;
}
#email {
  margin-bottom: 70px;
}

#email #email_one {
  width: 175px;
  height: px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

#email input {
  width: 97px;
  height: 40px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

#email select {
  width: 95px;
  height: 40px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

#email_certification {
  display: inline-block;
  float: left;
  width: 95px;
  height: 40px;
  margin-bottom: 10px;
  box-sizing: border-box;
  border: 1px solid #1C1C1C;
  border-radius: 2px;
}

#email_certification a {
  text-decoration: none;
  color: #1C1C1C;
}

#email_certification a p {
  width: 95px;
  height: 33px;
  text-align: center;
  font-size: 13px;
  margin: 0px;
  padding: 7px 0px 0px 0px;
}

#email_certification_check input {
  display: inline-block;
  float: left;
  width: 175px;
  height: 40px;
  margin-bottom: 10px;
  margin-right: 7px;
  box-sizing: border-box;
}

#email_certification_check_button {
  display: inline-block;
  float: left;
  width: 112px;
  height: 40px;
  margin-bottom: 10px;
  margin-right: 7px;
  box-sizing: border-box;
  background-color: #0B3861;
  border-radius: 2px;
}

#email_certification_check_button a {
  text-decoration: none;
  color: #1C1C1C;
}

#email_certification_check_button a p {
  width: 95px;
  height: 33px;
  text-align: center;
  font-size: 13px;
  color: white;
  margin: 0px;
  padding: 9px 0px 0px 6px;
}
#button {
  width: 400px;
  height: 40px;
  box-sizing: border-box;
  margin: 0 auto;
  margin-bottom: 40px;
}
#cancel_btn {
  display: inline-block;
  float: left;
  width: 130px;
  height: 40px;
  margin-bottom: 10px;
  margin-left: 60px;
  box-sizing: border-box;
  background-color: gray;
  border-radius: 2px;
}
#cancel_btn a {
  text-decoration: none;
}
#cancel_btn a p {
  display: inline-block;
  width: 130px;
  height: 38px;
  text-align: center;
  font-size: 13px;
  color: white;
  margin: 0px;
  padding: 9px 0px 0px 0px;
}
#signup_btn {
  display: inline-block;
  float: left;
  width: 130px;
  height: 40px;
  margin-bottom: 10px;
  margin-left: 20px;
  box-sizing: border-box;
  background-color: #F23005;
  border-radius: 2px;
}
#signup_btn a {
  text-decoration: none;
  color: #1C1C1C;
}

#signup_btn a p {
  display: inline-block;
  width: 130px;
  height: 38px;
  text-align: center;
  font-size: 13px;
  color: white;
  margin: 0px;
  padding: 9px 0px 0px 0px;
}
    </style>
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
                <select name="phone_one">
                  <option value="010" selected>010</option>
                  <option value="011">011</option>
                </select> -
                <input type="number" name="phone_two" maxlength="4" placeholder=" 0000 " oninput="numberMaxLength(this);"> -
                <input type="number" name="phone_three" maxlength="4" placeholder=" 0000 " oninput="numberMaxLength(this);">
              </div>
            </div>
            <div id="email">
              <div id="email_input">
                <input type="text" id="email_one" name="email_one" placeholder=" 이메일 입력 "> @
                <input type="text" name="email_two" id="email_two">
                <select name="email_option" id="email_option">
                  <option value="gmail.com">gmail.com</option>
                  <option value="naver.com">naver.com</option>
                  <option value="daum.net">daum.net</option>
                  <option value="">직접 입력</option>
                </select> <br>
                <script type="text/javascript">
                  $(function(){
                    var tag_mail=$('#email_two');
                    $('#email_option').change(function(){
                      var element=$(this).find('option:selected');
                      var myTag=element.attr('value');
                      tag_mail.val(myTag);
                    });
                  });
                </script>
              </div>
              <div id="email_certification_check">
                <input type="text" name="" placeholder=" 인증 번호 입력 ">
                <div id="email_certification_check_button">
                  <a href="#" onclick="">
                    <p>확 인</p>
                  </a>
                </div>
                <div id="email_certification">
                  <a href="#" onclick="">
                    <p>인증 요청</p>
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
      <form class="signUp" id="signupForm">
         <h1 class="signUpTitle">Sign up in second</h1>
         <input type="text" class="signUpInput" placeholder="Type your username" autofocus required>
         <input type="password" class="signUpInput" placeholder="Choose a password" required>
         <input type="submit" value="Sign me up!" class="signUpButton">

         <div id="naverIdLogin"><a id="naverIdLogin_loginButton" href="#" role="button"></a></div>
         <a id="kakao-login-btn"></a>
      </form>

      <!-- 카카오톡 로그인 -->
      <script type='text/javascript'>
				//<![CDATA[
					// 사용할 앱의 JavaScript 키를 설정해 주세요.
					Kakao.init('d4c9f81c1dd87d7457ae9ba104e93a3d');
					// 카카오 로그인 버튼을 생성합니다.
					Kakao.Auth.createLoginButton({
						container: '#kakao-login-btn',
						// 담겨져 나오는 카카오톡 정보값 확인
						success: function(authObj) {
							Kakao.API.request({
								url:'/v2/user/me',
								success: function(res){
									// alert(JSON.stringify(res));
									// alert(JSON.stringify(authObj)); //res에 담겨있는 json값을 모두 확인가능
									alert(res.properties.nickname+'님 환영합니다.');

								}

							});
						},
						fail: function(err) {
							 alert(JSON.stringify(err));
						}
					});
			</script>

<!-- 네이버아이디로로그인 초기화 Script -->
<script type="text/javascript">
	var naverLogin = new naver.LoginWithNaverId(
		{
			clientId: "txJsAHBUQ68ptqMzm_5I",
			callbackUrl: "http://localhost/team_project/page/login/callback.php",
			isPopup: false, /* 팝업을 통한 연동처리 여부 */
			loginButton: {color: "green", type: 3, height: 60} /* 로그인 버튼의 타입을 지정 */
		}
	);

	/* 설정정보를 초기화하고 연동을 준비 */
	naverLogin.init();

/* 현재 로그인 상태를 확인 */
  window.addEventListener('load', function () {
  naverLogin.getLoginStatus(function (status) {
  if (status) {
  /* 로그인 상태가 "true" 인 경우 로그인 버튼을 없애고 사용자 정보를 출력합니다. */
  setLoginStatus();
  }
  });
  });
</script>
  	</div>
  </div>
  </body>
</html>
