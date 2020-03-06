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
            <a href="#" onclick="kout()"><img src="../../img/login/kakao_btn.png" style="width:277px;"></a>


        </div>
      </form>
        <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="#" onclick="login_popup();">Register Now!</a></p>
            <script type="text/javascript">
              function login_popup(){
              location.href="./signup.php";
              }
            </script>
          </div>
          <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"> <a href="./find_account.php" onClick="window.open(this.href, '', 'width=600, height=450'); return false;">Forgot password ?</a></p>
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
