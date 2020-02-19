<!doctype html>
<html lang="ko">
<head>
<script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
<script type="text/javascript">
  var naver_id_login = new naver_id_login("txJsAHBUQ68ptqMzm_5I", "http://localhost/team_project/page/login/callback.php");
  // 접근 토큰 값 출력
  alert(naver_id_login.oauthParams.access_token);
  // 네이버 사용자 프로필 조회
  naver_id_login.get_naver_userprofile("naverSignInCallback()");
  // 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
  function naverSignInCallback() {
    alert(naver_id_login.getProfileData('email'));
		alert(naver_id_login.getProfileData('name'));

		$.ajax({
			type: "POST",
			url: "http://localhost/team_project/page/login/create_session.php",
			data: "name="+naver_id_login.getProfileData('name'),
			success:function(data) {
				if(data === "name_error") {
					alert('NAME_ERROR');
				} else {
					alert(data+' 님 환영합니다.');
					opener.parent.location.reload();
					window.close();
				}
			}
		});

  }
</script>
</body>
</html>
