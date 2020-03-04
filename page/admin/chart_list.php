<?php
    $category=$_POST['category'];
    include "../../db/db_connector.php";
    if($category=='seek_keep'){
        $sql="SELECT * FROM `board`";
        $result=mysqli_query($connect,$sql);
        for($i=0;$i<mysqli_num_rows($result);$i++){
            mysqli_data_seek($result,$i);
            $row=mysqli_fetch_array($result);
            $response[$i]=array("regist" => $row["regist_day"],'category'=>$row["category"]);
        }

    }else if($category=='temp'){
        $sql="SELECT * FROM `temporary_board`";
        $result=mysqli_query($connect,$sql);
        for($i=0;$i<mysqli_num_rows($result);$i++){
            mysqli_data_seek($result,$i);
            $row=mysqli_fetch_array($result);
            $response[$i]=array("regist"=>$row["regist_day"],'id'=>$row['id']);
        }
    }else if($category=='free'){
        $sql="SELECT * FROM `free`";
        $result=mysqli_query($connect,$sql);
        for($i=0;$i<mysqli_num_rows($result);$i++){
            mysqli_data_seek($result,$i);
            $row=mysqli_fetch_array($result);
            $response[$i]=array("regist"=>$row["regist_day"],'id'=>$row['id']);
        }
    }else{
        $sql="SELECT * FROM `counter`";
        $result=mysqli_query($connect,$sql);
        for($i=0;$i<mysqli_num_rows($result);$i++){
            mysqli_data_seek($result,$i);
            $row=mysqli_fetch_array($result);
            $response[$i]=array("regist"=>$row["date"],'count'=>$row['count']);
        }


    }
    $list=json_encode($response);

    echo $list;
?>