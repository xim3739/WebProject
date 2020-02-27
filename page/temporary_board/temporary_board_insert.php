<meta charset="utf-8">
<?php
    session_start();
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

    if (!$userid) {
        echo("
                    <script>
                    alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
                    history.go(-1)
                    </script>
        ");
        exit;
    }

    include "../../db/db_connector.php";


    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);
    // htmlspecialchars 는 HTML의 코드로 인식될 수 있는 문자열의 일부내용을
    //특수문자(HTML entities)형태로 변환하여 출력해주는 역활을 하는 함수입니다.
    // HTML 코드로 인식할 수 없게 처리하여 오류를 방지할 필요성이 있거나
    //HTML 소스를 그대로 보여주어야 하는 경우 유용하게 사용할 수 있습니다.
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    $upload_dir = './data/';

    //파일 업로드시 진짜 파일은 임시저장장소에 서버가 부여한 임시파일명으로 저장이 된다.

    $upfile_name	 = $_FILES["upfile"]["name"]; //진짜 파일명
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"]; //임시 파일명
    $upfile_type     = $_FILES["upfile"]["type"];
    $upfile_size     = $_FILES["upfile"]["size"];
    $upfile_error    = $_FILES["upfile"]["error"];

    if ($upfile_name && !$upfile_error) {
        $file = explode(".", $upfile_name); //.을 기준으로 파일명을 나눈다.
        $file_name = $file[0];
        $file_ext  = $file[1];

        $new_file_name = date("Y_m_d_H_i_s");
        // $new_file_name = $new_file_name;
        $copied_file_name = $new_file_name.".".$file_ext; //.은 문자열을 연결한다.
        $uploaded_file = $upload_dir.$copied_file_name;

        if ($upfile_size  > 1000000) {
            echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				");
            exit;
        }

        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
            echo("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
            exit;
        }
    } else {
        $upfile_name      = "";
        $upfile_type      = "";
        $copied_file_name = "";
    }



    $sql = "INSERT INTO `temporary_board` (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
    $sql .= "VALUES('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
    $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')"; //sql에는 진짜 파일명이 저장된다.

    mysqli_query($connect, $sql);  // $sql 에 저장된 명령 실행


    mysqli_close($connect);                // DB 연결 끊기
//업무 처리 페이지, 답변 주는 페이지가 있기 때무에 페이지 요청도 2가지 종류가 있다.
    echo "
	   <script>
	    location.href = './temporary_board_list.php';
	   </script>
	";
?>
