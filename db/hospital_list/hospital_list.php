<?php

include "../db_connector.php";
$sql = "SELECT * FROM `hospital_list`";
if (isset($_POST["addr"])) {
    $name = $_POST["name"];
    $addr = $_POST["addr"];
    $result = mysqli_query($connect, $sql);
    if (!(mysqli_num_rows($result) > 0)) {
        for ($i = 0; $i < count($name); $i++) {
            $sql = "INSERT INTO `hospital_list` VALUES (NULL, '$name[$i]', '$addr[$i]')";
            mysqli_query($connect, $sql);
        }
    }
}elseif(isset($_GET['data'])){
    $a=$_GET["data"];
    echo true;
}else{
    if(isset($_POST['mode'])){
        
        $result=mysqli_query($connect,$sql);
    
        for($i=0;$i<mysqli_num_rows($result);$i++){
            mysqli_data_seek($result,$i);
            $row=mysqli_fetch_array($result);
    
            //리스트에 연관 배열{"name":aa,"address":bb}이런식으로 가져옴
            $list[$i]=array("name" => $row["name"],'addr'=>$row["address"]);
        }  
        //받은 정보를 제이슨으로 ajax success함수에 반환
        $gg=json_encode($list);
        echo $gg;
    }
}



?>