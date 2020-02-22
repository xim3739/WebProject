<!-- //board테이블에 저장
//파일 복사 날짜 파일명 복사 -->
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

    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $category = $_POST["category"];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);
    $regist_day = date("Y-m-d (H:i)");
    $upload_dir = '../../data/';

    $upfile_name	 = $_FILES["upfile"]["name"];
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    $upfile_type     = $_FILES["upfile"]["type"];
    $upfile_size     = $_FILES["upfile"]["size"];
    $upfile_error    = $_FILES["upfile"]["error"];

    if ($upfile_name && !$upfile_error) {
        $file = explode(".", $upfile_name);
        $file_name = $file[0];
        $file_ext  = $file[1];

        $new_file_name = date("Y_m_d_H_i_s");
        $copied_file_name = $new_file_name.".".$file_ext;
        $uploaded_file = $upload_dir.$copied_file_name;

        echo ($upfile_tmp_name);


        if ($upfile_size  > 10000000) {
            echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				");
            exit;
        }
        //move_uploaded_file($upfile_tmp_name, $uploaded_file);
        if (move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
          echo "김치";
        }else{
          echo("
          <script>
          alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
          history.go(-1)
          </script>
          ");
          exit;

        }
    }else{
    $upfile_name      = "";
    $upfile_type      = "";
    $copied_file_name = "";
}

    $con = mysqli_connect("localhost", "root", "123456", "joo_db");
    $sql = "insert into board values ";
    $sql .= "(null, '$userid', '$username', '$category' ,'$subject', '$content', '$regist_day', 0, ";
    $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name','123456','789123')";

    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	   <script>
	    location.href = './board_form.php';
	   </script>
	";
?>
