<?php
  date_default_timezone_set('Asia/Seoul');
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  $num = $_GET["num"];
  include_once "../../db/db_connector.php";
  $sql = "select * from free where num = $num";
  $result = mysqli_query($connect,$sql);
  $row = mysqli_fetch_array($result);
  $file_name = $row["file_name"];
  $file_type = $row["file_type"];
  $file_copied = $row["file_copied"];
  if ($file_copied) {
    $file_path = "../../data/".$file_copied;
    unlink($file_path);
  }
  $category = $_POST["category"];
  $subject = $_POST["subject"];
  $content = $_POST["content"];
  $subject = htmlspecialchars($subject, ENT_QUOTES);
  $content = htmlspecialchars($content, ENT_QUOTES);
  $regist_day = date("Y-m-d H:i");

  $upload_dir = '../../data/';
  $upfile_name = $_FILES["upfile"]["name"];
  $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
  $upfile_type = $_FILES["upfile"]["type"];
  $upfile_size = $_FILES["upfile"]["size"];
  $upfile_error = $_FILES["upfile"]["error"];


  if ($upfile_name && !$upfile_error) {
    $file = explode(".",$upfile_name);
    $file_name = $file[0];
    $file_ext = $file[1];

    $new_file_name = date("Y_m_d_H_i_s");
    $new_file_name = $new_file_name."_".$file_name;
    $copied_file_name = $new_file_name.".".$file_ext;
    $uploaded_file = $upload_dir.$copied_file_name;

    if ($upfile_size > 1000000) {
      echo "<script>
            alert('업로드 파일 크기가 지정된 용량(1mb)을 초과합니다!<br>파일 크기를 체크해주세요!');
            histoy.go(-1)
            </script>";
            exit;

    }
    if (!move_uploaded_file($upfile_tmp_name,$uploaded_file)) {
      echo "<script>
            alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
            histoy.go(-1)
            </script>";
            exit;
    }
  }else {
    $upfile_name = "";
    $upfile_type = "";
    $copied_file_name = "";
  }

  $sql = "update free set category = '$category',subject = '$subject', content = '$content'";
  $sql .= ", file_name='$upfile_name', file_type='$upfile_type',file_copied='$copied_file_name'";
  $sql .= "where num = $num";
  mysqli_query($connect,$sql);
  mysqli_close($connect);
  echo "<script>
          alert('작성 완료');
          </script>
          ";
  echo "<script>location.href = 'free_list.php'</script>";
 ?>
