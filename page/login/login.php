<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>찾아zoo</title>
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js" charset="utf-8"></script>
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script src="../../js/login/signup.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style media="screen">

      body{
        display: table-cell;
        vertical-align: middle;
        background-color: #e0f2f1 !important;
      }

      html {
        display: table;
        margin: auto;
      }

      html, body {
        height: 100%;
      }

      .medium-small {
        font-size: 0.9rem;
        margin: 0;
        padding: 0;
      }

      .login-form {
        width: 280px;
      }

      .login-form-text {
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.8rem;
      }

      .login-text {
        margin-top: -6px;
        margin-left: -6px !important;
      }

      .margin {
        margin: 0 !important;
      }

      .pointer-events {
        pointer-events: auto !important;
      }

      .input-field >.material-icons  {
        padding-top:10px;
      }

      .input-field div.error{
        position: relative;
        top: -1rem;
        left: 3rem;
        font-size: 0.8rem;
        color:#FF4081;
        -webkit-transform: translateY(0%);
        -ms-transform: translateY(0%);
        -o-transform: translateY(0%);
        transform: translateY(0%);
      }
    </style>

  </head>
  <body>

<div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">

        <div class="row">
          <div class="input-field col s12 center">
            <p class="center login-form-text">LOGIN</p>
          </div>
        </div>
      <form method="POST" class="signUp" id="login_form" name="login_form" action="./login_session.php">
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input id="username" name="id"  type="text" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGP6zwAAAgcBApocMXEAAAAASUVORK5CYII=&quot;); cursor: auto;"/>
            <label for="username" data-error="wrong" class="center-align" data-success="right">ID</label>

          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix">vpn_key</i>
            <input id="password" name="password" type="password" onkeyup="enterkey();" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGP6zwAAAgcBApocMXEAAAAASUVORK5CYII=&quot;);"/>
            <script>
//엔터키의 코드가 13이고, 제이쿼리를 통해서 함수 구현
//어떤 키를 누르든 작동 되는 keypress를 이용하고 그 중 13 코드가 눌리면 사인업버튼이 눌리는 것과 같은 효과를 줄수 있게 설정.
  $('#password').keypress(function(event){
       if ( event.which == 13 ) {
           $('#signUpButton').click();
           return false;
       }
  });
  </script>



            <label for="password">Password</label>
          </div>
        </div>



        <div class="row">
          <div class="input-field col s12">
            <button type="button" onclick="login_done()" onkeyup="onEnterLogin();;"id="signUpButton" class="btn waves-effect waves-light col s12" style="margin-bottom:7px; height: 50px;">Login</button>
            <div id="naverIdLogin" >NAVER Login</div>
            <!-- 위의 네이버로그인js 자체에서 naverIdLogin이 눌리면 콜백 페이지를 통해 정보가 주고받아지게 설정을 해줌 -->
            <a href="#" onclick="kout()"><img src="../../img/login/kakao_btn.png" style="width:277px;"></a>


        </div>
      </form>
        <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="#" onclick="login_popup();">Register Now!</a></p>
            <script type="text/javascript">
              function login_popup(){
              location.href="./signup.php";
              // 새 창을 띄우지 않고 한 팝업창 내에서 이어지게끔 하기 위해 href를 이용
              }
            </script>
          </div>
          <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"> <a href="./find_account.php" onClick="window.open(this.href, '', 'width=600, height=500'); return false;">Forgot password ?</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- ===================================카카오 로그인========================================= -->

      <script type="text/javascript">
      Kakao.init('d4c9f81c1dd87d7457ae9ba104e93a3d');

      function kout(){
        Kakao.Auth.logout();
                   Kakao.Auth.loginForm({
                     success: function(authObj) {

// ① : 사용자에 의한 요청 이벤트가 발생합니다.
// ② : 요청 이벤트가 발생하면 이벤트 핸들러에 의해 자바스크립트가 호출됩니다.
// ③ : 자바스크립트는 XMLHttpRequest 객체를 사용하여 서버로 요청을 보냅니다.
//     이때 웹 브라우저는 요청을 보내고 나서, 서버의 응답을 기다릴 필요 없이 다른 작업을 처리할 수 있습니다.
// ④ : 서버는 전달받은 XMLHttpRequest 객체를 가지고 Ajax 요청을 처리합니다.
// ⑤와 ⑥ : 서버는 처리한 결과를 HTML, XML 또는 JSON 형태의 데이터로 웹 브라우저에 전달합니다.
//     이때 전달되는 응답은 새로운 페이지를 전부 보내는 것이 아니라 필요한 데이터만을 전달합니다.
// ⑦ : 서버로부터 전달받은 데이터를 가지고 웹 페이지의 일부분만을 갱신하는 자바스크립트를 호출합니다.
// ⑧ : 결과적으로 웹 페이지의 일부분만이 다시 로딩되어 표시됩니다.

                       							Kakao.API.request({
                                     	url:'/v2/user/me',
                       								success: function(res){
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
  </body>
</html>
