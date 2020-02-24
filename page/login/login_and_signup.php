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

    <script src="../../js/login/signup.js"></script>
    <script src="../../js/login/login.js"></script>


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
          <form name="member_form" action="./member_insert.php" method="post">
            <input type="text" name="inputId" id="inputId" placeholder=" 아이디 입력 "> <br>
            <p name = "idSubMsg" id="idSubMsg" class="SubMsg">&nbsp;</p>


            <input type="password" name="inputPassword" id="inputPassword" placeholder=" 비밀번호 입력 "> <br>
            <p id="passwordSubMsg" class="subMsg"></p>

            <input type="password" name="inputPasswordCheck" id="inputPasswordCheck" placeholder=" 비밀번호 재입력 "> <br>
            <p id="passwordCheckSubMsg" class="subMsg"></p>

            <input type="text" name="inputName" id="inputName" placeholder=" 이름 "> <br>
            <p id="nameSubMsg" class="subMsg"></p>

            <div id="phone">
              <div id="phone_input">
                <select name="phone_one" id="phone_one">
                  <option value="010" selected>010</option>
                  <option value="011">011</option>
                </select> -
                <input type="number" id="phone_two" name="phone_two" placeholder=" 0000 " > -
                <input type="number" id="phone_three" name="phone_three" placeholder=" 0000 " >
              </div>
              <div id="phone_certification">
                <button type="button" id="phone_check">인증 요청</button>
              </div>
            </div>

            <script type="text/javascript">

            $("#phone_check").click(function() {
      var phone_one_value =  $("#phone_one").val();
      var phone_two_value = $("#phone_two").val();
      var phone_three_value = $("#phone_three").val();
      if(phone_one_value !== "" && phone_two_value !== "" && phone_two_value !== "") {
        $.ajax({
            url: "./moonja.php",
            type: 'POST',
            data: {
              "mode": "send",
              "phone_one": phone_one_value,
              "phone_two": phone_two_value,
              "phone_three": phone_three_value
            },
            success: function(data) {
              phone_code=data;
               if (data === "발송 실패") {
                alert("문자 전송 실패되었습니다.");
                phone_code_pass = false;
                isAllPass();
                } else {
                alert("문자가 전송 되었습니다.");
              }
            }
          })
      } else {
        alert("휴대폰 번호가 제대로 입력되지 않았습니다!");
      }
    });
            </script>
            <div id="phone">
              <div id="phone_certification_check">
                <input type="text" name="input_phone_certification" id="input_phone_certification" placeholder=" 인증 번호 입력 ">
                <div id="phone_certification_check_button">
                  <a href="#" onclick="">
                    <p>확 인</p>
                  </a>
                </div>
                <p id="input_phone_confirm" name="input_phone_confirm"></p>
              </div>
            </div>
<script type="text/javascript">
$("#phone_certification_check").click(function () {
if($("#input_phone_certification").val() === "") {
  $("#input_phone_confirm").html("<span style='color:red'>인증번호를 입력해주세요.</span>");
  phone_code_pass = false;
} else if($("#input_phone_certification").val() === phone_code) {
  $("#input_phone_confirm").html("<span style='color:green'>인증에 성공하였습니다.</span>");
  phone_code_pass = true;
} else if ($("#input_phone_certification").val() !== phone_code){
    $("#input_phone_confirm").html("<span style='color:red'>인증에 실패하였습니다.</span>");
    phone_code_pass = false;
} else {
  alert("문자 인증 오류입니다!")
}
});
</script>

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
