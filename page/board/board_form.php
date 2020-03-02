<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../../css/board/board.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../../css/main/small-business.css" rel="stylesheet">
  <?php include "../../lib/common_page/main_style.php" ?>
  <script src="../../js/main/pop_up_menu.js"></script>
  <script src="../../js/board/board.js"></script>

</head>

<body >
  <!-- header -->
  <?php include "../../lib/common_page/header.php" ?>
  <section>
  <!-- nav -->
  <?php
    // $result = mysqli_query($connect, $sql);
    // if ($result) {
    //   mysqli_query($connect, $sql);
    //   for ($i = 0; $i <$userpost_num; $i++) {
    //     mysqli_data_seek($result, $i);
    //     $row = mysqli_fetch_array($result);
    //     $num = $row["num"];
    //     $id      = $row["id"];
    //     $name      = $row["name"];
    //     $regist_day = $row["regist_day"];
    //     $subject    = $row["subject"];
    //     $content    = $row["content"];
    //     $file_name    = $row["file_name"];
    //     $file_type    = $row["file_type"];
    //     $file_copied  = $row["file_copied"];
    //     $hit          = $row["hit"];
    //     $content = str_replace(" ", "&nbsp;", $content);
    //     $content = str_replace("\n", "<br>", $content);
?>
  <?php include "../../lib/board/nav/board_nav.php" ?>
  <?php
        if($page_num==0){
        ?>
          <div class="board_center">

            <div class="container" style='margin-left : 300px;'>
              <!-- Heading Row -->
              <div class="row align-items-center my-5">
                <div class="col-lg-7 no-flex" style="width: 420px; height: 186.66px; overflow : hidden;">

        <img class="img-fluid rounded mb-4 mb-lg-0" src="../../img/board/default.jpg">
      </div>
      <div class="col-lg-5 no-flex">
        <h1 class="font-weight-light"></h1>
        <p>게시글이 없습니다.</p>
      </div>
    </div>

      <?php
        //   }
        // } else {
        //     echo "게시글이 없습니다.";
        // }
      ?>

  </div>
</div>
        <?php } ?>
  </section>
  <footer>
    <?php include "../../lib/common_page/footer.php" ?>
  </footer>
    <?php include "../../js/main/scroll.php"; ?>
</body>

</html>
