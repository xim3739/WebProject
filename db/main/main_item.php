<?php
 include "../../db/db_connector.php";
 if(isset($_GET['category'])){
     $category=$_GET['category'];
     $sql = "SELECT * FROM `board` WHERE `category` = '$category'";
 }else{
    $sql = "SELECT * FROM `board`";
 }
  $scale=5;
  if(isset($_GET['page'])){
    $truncte_num=$_GET['page'];
  }else{
    $truncte_num=0;
  }
  $response="";
  $count=0;
  $result = mysqli_query($connect, $sql);
  $total_record = mysqli_num_rows($result);
  if($total_record>$truncte_num){
      for($i = $truncte_num; $i < $total_record && $i<$scale+$truncte_num ; $i++) {
        mysqli_data_seek($result, $i);
        $row = mysqli_fetch_array($result);
        $num = $row['num'];
        $id = $row['id'];
        $name = $row["name"];
        $regist_day = $row["regist_day"];
        $subject = $row["subject"];
        $content = $row["content"];
        $file_name = $row["file_name"];
        $file_type = $row["file_type"];
        $file_copied = $row["file_copied"];
        $hit = $row["hit"];
        $content = str_replace(" ", "&nbsp;", $content);
        $content = str_replace("\n", "<br>", $content);
        if ($file_name) {
          $real_name = $file_copied;
          $file_path = "../../data/".$real_name;
        }else{
          $file_path="../../img/board/default.jpg";
        }
        
  
        $data[$count]=array('num'=>$num,'name'=>$name,
        'subject'=>$subject,'content'=>$content,'file'=>$file_path,'hit'=>$hit);
        $count++;
    }
    $result=json_encode($data);
    echo $result;
  }else{
      $result=array("empty"=>"empty");
      $result=json_encode($result);
    echo $result;
  }


    

?>  