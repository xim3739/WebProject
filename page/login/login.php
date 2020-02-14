<html lang="ko">
<head>
<script type="text/javascript" src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js" charset="utf-8"></script>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

<link rel="stylesheet" href="../../css/login/login.css">
</head>

<body>
	<form class="signUp" id="signupForm">
	   <h1 class="signUpTitle">Sign up in second</h1>
	   <input type="text" class="signUpInput" placeholder="Type your username" autofocus required>
	   <input type="password" class="signUpInput" placeholder="Choose a password" required>
	   <input type="submit" value="Sign me up!" class="signUpButton">

		 <div id="naverIdLogin"></div>
     <a id="kakao-login-btn"></a>
          <a href="http://developers.kakao.com/logout"></a>
          <script type='text/javascript'>
            //<![CDATA[
              // 사용할 앱의 JavaScript 키를 설정해 주세요.
              Kakao.init('d4c9f81c1dd87d7457ae9ba104e93a3d');
              // 카카오 로그인 버튼을 생성합니다.
              Kakao.Auth.createLoginButton({
                container: '#kakao-login-btn',
                // 담겨져 나오는 카카오톡 정보값 확인s
                success: function(authObj) {
                  Kakao.API.request({
                    url:'/v2/user/me',
                    success: function(res){
                      alert(JSON.stringify(res));
                      alert(JSON.stringify(authObj));
                      console.log(res.id);
                      console.log(res.kaccount_email);
                    }

                  })
                },
                fail: function(err) {
                   alert(JSON.stringify(err));
                }
              });

          </script>
    	</form>

<!-- 네이버아디디로로그인 초기화 Script -->
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

</script>

</body>
</html>
