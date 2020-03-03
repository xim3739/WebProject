<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js" charset="utf-8"></script>
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <script src="../../js/login/signup.js"></script>

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
            <form name="member_form"action="./member_insert.php" method="post">
              <div class="row">
                <div class="input-field col s12 center">
                  <h4>찾아ZOO</h4>
                  <p class="center">회원가입</p>
                </div>
              </div>

              <div class="row margin">
                <div class="input-field col s12">
                  <!-- <i class="mdi-social-person-outline prefix"></i> -->
                  <i class="material-icons prefix">account_circle</i>
                  <input type="text" name="inputId" id="inputId" style="margin-bottom:0px;"> <br>
                  <label for="username">ID</label>
                  <p name = "idSubMsg" id="idSubMsg" class="SubMsg" style="margin-left:40px; font-size:13px;">영문자와 숫자를 포함한 4~12자를 입력해주세요.</p>


                </div>
              </div>

              <div class="row margin">
                <div class="input-field col s12">
                  <!-- <i class="mdi-action-lock-outline prefix"></i> -->
                  <i class="material-icons prefix">vpn_key</i>
                  <input type="password" name="inputPassword" id="inputPassword" style="margin-bottom:0px;"> <br>
                  <label for="password">Password</label>
                  <p id="passwordSubMsg" class="subMsg" style="margin-left:40px;font-size:13px;">영문 소문자, 대문자와 숫자를 포함한 4~12자를<br>입력해주세요.</p>
                </div>
              </div>

              <div class="row margin">
                <div class="input-field col s12">
                  <!-- <i class="mdi-action-lock-outline prefix"></i> -->
                  <i class="material-icons prefix">check_circle</i>
                  <input type="password" name="inputPasswordCheck" id="inputPasswordCheck" style="margin-bottom:0px;"> <br>
                  <label for="password_a">Password again</label>
                  <p id="passwordCheckSubMsg" class="subMsg" style="margin-left:40px;font-size:13px;"></p>
                </div>
              </div>

              <div class="row margin">
                <div class="input-field col s12">
                  <!-- <i class="mdi-action-lock-outline prefix"></i> -->
                  <i class="material-icons prefix">recent_actors</i>
                  <input type="text" name="inputName" id="inputName" style="margin-bottom:0px;"> <br>
                  <label for="password_a">Name</label>
                  <p id="nameSubMsg" class="subMsg" style="margin-left:40px;font-size:13px;"></p>
                </div>
              </div>

              <div class="row margin">
                <div class="input-field col s12">
                  <!-- <i class="mdi-social-person-outline prefix"></i> -->
                  <i class="material-icons prefix">phone</i>
                  <input id="phone_one" name="phone_one" type="text" style="width:40px;margin-right:10px; margin-bottom: 0px;"/> -
                  <input id="phone_two" name="phone_two" type="text" style="width:60px; margin-left:10px;margin-right:10px; margin-bottom: 0px;"/> -
                  <input id="phone_three" name="phone_three" type="text" style="width:60px; margin-left:10px; margin-bottom: 0px;"/>
                  <button type="button" id="phone_check" class="btn waves-effect waves-light col s12" style="width:70px; float: right; margin-left: 20px; margin-top: 5px;">인증</button>
                  <label for="email">Phone</label>
                </div>
              </div>

              <div class="row margin">
                <div class="input-field col s12">
                  <!-- <i class="mdi-action-lock-outline prefix"></i> -->
                  <i class="material-icons prefix">check_circle</i>
                  <input id="input_phone_certification" name="input_phone_certification" type="text" style="width:160px;margin-bottom: 0px;"/>
                  <button type="button" id="phone_certification_check" class="btn waves-effect waves-light col s12" style="width:130px;  float:right;margin-left: 10px; margin-top: 5px">인증번호 확인</button>
                  <p id="input_phone_confirm" name="input_phone_confirm" class="subMsg" style="margin-left:40px;font-size:13px;"></p>
                  <label for="email">Certification</label>

                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <button type="button" onclick="done()" class="btn waves-effect waves-light col s12">REGISTER NOW</button>

                </div>
                <div class="input-field col s12">
                  <p class="margin center medium-small sign-up">Already have an account?
                    <a href="#" onclick="login_popup();">Login</a>
                    <script type="text/javascript">
                      function login_popup(){
                      location.href="./login.php";
                      }
                    </script>
                  </p>
                </div>
              </div>


            </form>
          </div>
        </div>
      </body>
    </html>
