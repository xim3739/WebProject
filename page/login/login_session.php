<!-- <meta charset="utf-8"> -->
<?php

include "../../db/db_connector.php";

$id= $_POST["id"];
$password = $_POST["password"];
if(!($id=='admin1234'&&$password=='admin')){


  $sql = "SELECT * FROM `member` WHERE `id` = '$id'";
  $result = mysqli_query($connect, $sql);

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

      mysqli_close($connect);

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
                  $id=$_SESSION["userid"];

                  echo("
                           <script>
                           window.alert('$name');
                           window.close();
                           opener.location.reload();


                           </script>
                        ");

              }
           }
          }else{
            session_start();
            $_SESSION["userid"] = $id;
            $_SESSION["username"] = '관리자';
            $name=$_SESSION["username"];
            $id=$_SESSION["userid"];

            echo("
                     <script>
                     window.alert('$name');
                     window.close();
                     opener.location.reload();


                     </script>
                  ");
          }
      ?>
