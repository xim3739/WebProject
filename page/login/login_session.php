<?php

include "../../db/db_connector.php";

//form의 submit을 통해서 받아온 아이디와 패스워드 값을 post 방식을 통해 전달받고 각각의 변수에 저장한다
$id= $_POST["id"];
$password = $_POST["password"];
if(!($id=='admin1234'&&$password=='admin')){
//관리자가 아닐 경우

  $sql = "SELECT * FROM `member` WHERE `id` = '$id'";
  $result = mysqli_query($connect, $sql);

  $num_match = mysqli_num_rows($result);
   // mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환합니다.

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
     //리절트 셋(result set)에서 레코드를 1개씩 리턴해주는 함수입니다.
     // mysqli_fetch_array 함수는 순번을 키로 하는 일반 배열과 컬럼명을 키로 하는 연관배열 둘 모두 값으로 갖는 배열을 리턴합니다.

     // mysqli_fetch_row= 함수는 순번을 키로 하는 일반 배열
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
