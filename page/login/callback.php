<!doctype html>
<html lang="ko">
<head>
<script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js" charset="utf-8"></script>
</head>
<body>
<script type="text/javascript">

  var naverLogin = new naver.LoginWithNaverId(
			{
				clientId: "txJsAHBUQ68ptqMzm_5I",
				callbackUrl: "http://localhost/team_project/page/login/callback.php",
				isPopup: false,
				callbackHandle: true
				/* callback 페이지가 분리되었을 경우에 callback 페이지에서는 callback처리를 해줄수 있도록 설정합니다. */
			}
		);

    naverLogin.init();

    window.addEventListener('load', function () {
    			naverLogin.getLoginStatus(function (status) {
    				if (status) {
    					/* (5) 필수적으로 받아야하는 프로필 정보가 있다면 callback처리 시점에 체크 */
    					var email = naverLogin.user.getEmail();
              var name = naverLogin.user.getName();
    					if( email == undefined || email == null) {
    						alert("이메일은 필수정보입니다. 정보제공을 동의해주세요.");
    						/* (5-1) 사용자 정보 재동의를 위하여 다시 네아로 동의페이지로 이동함 */
    						naverLogin.reprompt();
    						return;
    					}

                var allData = {"name": name, "email": email};

                $.ajax({
                  type: "POST",
                  url: "http://localhost/team_project/page/login/create_session.php",
                  data: allData,
                  success:function(data) {
                    if(data === "name_error") {
                      alert('NAME_ERROR');
                    } else {
                      alert(data+' 님 환영합니다.');
                      opener.parent.location.reload();
                      window.close();
                    }
                  }
                })
              }else{
    					console.log("callback 처리에 실패하였습니다.");
    				}//if (status)
    			}); // naverLogin.getLoginStatus
    		}); //  window.addEventListener













</script>
</body>
</html>
