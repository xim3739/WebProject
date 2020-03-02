<?php
  $num = $_POST["num"];
  $group_num = $_POST["group_num"];
  $depth = $_POST["depth"];
  $ord = $_POST["ord"];
  $name = $_POST["name"];
  $comment = $_POST["comment"];
  $regist_day = $_POST["regist_day"];
  $mode = $_POST["mode"];
  // var_dump($num);
  // var_dump($group_num);
  // var_dump($depth);
  // var_dump($ord);
  // var_dump($name);
  // var_dump($comment);
  // var_dump($regist_day);
  // var_dump($mode);

  // include_once "../../db/db_connector_main.php";
  $connect = mysqli_connect("localhost","root","123456","test");

  switch ($mode) {
    case 'refresh':
      comment_refresh($connect);
      break;
    case 'insert':
      comment_insert($connect,$num,$group_num,$depth,$ord,$name,$comment,$regist_day);
      break;
    case 'delete':
      comment_delete($connect,$num,$group_num,$depth,$ord,$name,$comment,$regist_day);
      break;

    default:
      // code...
      break;
  }
  function comment_refresh($connect)
  {
    $sql="SELECT * FROM `free_comment`";
    // var_dump()
    // var_dump($sql);
    // $sql="insert into free_comment values (null,$group_num,$depth,$ord,'$name','$comment','$regist_day',null,null,null);";
    $result = mysqli_query($connect,$sql);
    // var_dump($result);


    $total_record = mysqli_num_rows($result);
    // var_dump($total_record);

    $list=array();
    for ($i=0; $i < $total_record; $i++) {
      mysqli_data_seek($result, $i);
      $row = mysqli_fetch_array($result);
      $num=$row["num"];
      $ord = $row["ord"];
      $name = $row["name"];
      $content = $row["content"];
      $content=str_replace("\n", "<br>",$content);
      $content=str_replace(" ", "&nbsp;",$content);
      $regist_day = $row["regist_day"];
      $depth=(int)$row['depth'];

      array_push($list,array("result"=>$total_record,"num"=>$num, "group_num"=>$group_num,"depth"=>$depth,"ord"=>$ord,
      "name"=>$name,"comment"=>$comment,"regist_day"=>$regist_day));
    }
    mysqli_close($connect);
    echo json_encode($result , JSON_UNESCAPED_UNICODE);
  }
  function comment_insert($connect,$num,$group_num,$depth,$ord,$name,$comment,$regist_day)
  {
    $sql="insert into free_comment values (null,$group_num,$depth,$ord,'$name','$comment','$regist_day',null,null,null);";
    $result = mysqli_query($connect,$sql);
    $total_record = mysqli_num_rows($result);

    mysqli_close($connect);
    echo json_encode($result , JSON_UNESCAPED_UNICODE);
  }
  function comment_delete($connect,$num,$group_num,$depth,$ord,$name,$comment,$regist_day)
  {
    $sql="delete from free_comment where num = $num";
    // $sql="insert into free_comment values (null,$group_num,$depth,$ord,'$name','$comment','$regist_day',null,null,null);";
    $result = mysqli_query($connect,$sql);

    mysqli_close($connect);
    echo json_encode($result , JSON_UNESCAPED_UNICODE);
  }
 ?>
