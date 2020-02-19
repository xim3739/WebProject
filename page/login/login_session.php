<!-- <meta charset="utf-8"> -->
<?php
$id= $_POST["id"];
$password = $_POST["password"];

$con = mysqli_connect("localhost", "root", "123456789", "test");
  $sql = "select * from member where id='$id'";
  $result = mysqli_query($con, $sql);

  $num_match = mysqli_num_rows($result);

  if(!$num_match)
  {
    echo("
          <script>
            window.alert('등록되지 않은 아이디입니다!')
            history.go(-1)

          </script>
        ");
   }else{
     $row = mysqli_fetch_array($result);
      $db_pass = $row["password"];

      mysqli_close($con);

              if($password != $db_pass)
              {

                 echo("
                    <script>
                      window.alert('비밀번호가 틀립니다!')
                      history.go(-1)

                    </script>
                 ");
                 exit;
              }
              else
              {
                  session_start();
                  $_SESSION["userid"] = $row["id"];
                  $_SESSION["username"] = $row["name"];
                  $name=$_SESSION["username"];
                  echo("
                           <script>
                           window.alert('$name');
                           opener.parent.location.reload();
       window.close();
                           </script>
                        ");
              }
           }
      ?>
