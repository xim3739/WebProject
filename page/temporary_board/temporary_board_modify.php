<?php
include "../../db/db_connector.php";

    $num = $_GET["num"];
    $page = $_GET["page"];
    $exist = $_GET["exist"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $originFile = $_POST["originFile"];


    if($exist==="exist"){

      $file_path = "../../data/".$originFile;
      unlink($file_path);

      $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

      $upload_dir = '../../data/';

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
      $sql = "update temporary_board set subject='$subject', content='$content', file_name='$upfile_name', file_type='$upfile_type', file_copied='$copied_file_name'";
      $sql .= " where num=$num";
      mysqli_query($connect, $sql);
      mysqli_close($connect);

    }else{
    $sql = "update temporary_board set subject='$subject', content='$content' ";
    $sql .= " where num=$num";
    mysqli_query($connect, $sql);

    mysqli_close($connect);
}
    echo "
	      <script>
	          location.href = 'temporary_board_list.php?page=$page';
	      </script>
	  ";
?>
