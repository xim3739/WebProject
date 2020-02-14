<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Small Business - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/small-business.css" rel="stylesheet">
  <style>
    form{
      display: inline-block;
    }
    #header_box{
      width: 1100px;
      margin: 0 auto;
    }
    #header_box div{
      display: inline-block;
    }
    header{
      position: fixed;
      top: 0;
      width: 100%;
      background-color: antiquewhite;

    }
    #icon_box{
      margin-left: 190px;
    }
    #search{
      width: 700px;
      height: 50px;
      font-size: 20px;
      }
      header span{
        display: inline-block;
        width: 45px;
        height: 45px;
      }
      #login_icon{
        background-image: url("");
      }
      #info_icon{
        background-image: url("");
      }
      #btn_search{
        height: 45px;
    width: 45px;
    background-image: url("../../img/main/search1.png");
    border: none;
    background-color: none;
    outline: none;
      }
    
    header a{
      width: 45px;
      height: 52px;
      padding: 0;
      margin: 0;
      display: inline-block;
      vertical-align: middle;
    }
    #btn_home{
      background-image: url("../../img/main/home1.png");
    }
    #btn_info{
      background-image: url("../../img/main/info1.png");
    }
    #btn_login{
      background-image: url("../../img/main/info1.png");
    }
    .no-flex{
      flex: none;
    }
    .col-lg-7{
      width: 450px;
    }
    
  </style>
</head>

<body>

  <!-- Navigation -->
  <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
     
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto no-margin">
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> -->

  <?php include "../../lib/common_page/header.php"; ?>
  <!-- Page Content -->
  <div class="container">

    <!-- Heading Row -->
    <div class="row align-items-center my-5">
      <div class="col-lg-7 no-flex">
        <img class="img-fluid rounded mb-4 mb-lg-0" src="http://placehold.it/900x400" alt="">
      </div>
      <!-- /.col-lg-8 -->
      <div class="col-lg-5 no-flex">
        <h1 class="font-weight-light">Business Name or Tagline</h1>
        <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
        <a class="btn btn-primary" href="#">Call to Action!</a>
      </div>
      <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

  
    </div>
    <!-- /.row -->
    



  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php include "../../lib/common_page/footer.php"; ?>

  <!-- Bootstrap core JavaScript -->
  <!-- <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

</body>

</html>
