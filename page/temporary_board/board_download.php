<?php
    $real_name = $_GET["real_name"];
    $file_name = $_GET["file_name"];
    $file_type = $_GET["file_type"];
    $file_path = "../../data/".$real_name;

    $ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) ||
    //브라우저 이름에 MSIE나 Internet Explorer가 포함되어 있는지 검사
    //$_SERVER [‘HTTP_USER_AGENT’]는 사용자 브라우저 이름.

        (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false &&
            strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);
//브라우저 이름에 문자열 Trident/7.0 또는 rv:11.0이 포함되어 있는지 검사.
//인터넷 익스플로러는 브라우저 이름에 이러한 문자열이 포함되어 있기 때문.

    //IE인경우 한글파일명이 깨지는 경우를 방지하기 위한 코드
    if ($ie) {
        $file_name = iconv('utf-8', 'euc-kr', $file_name); //한글이 깨지는 현상을 방지하기 위해
    }

    if (file_exists($file_path)) {
        $fp = fopen($file_path, "rb");//파일을 오픈하는 기능
        Header("Content-type: application/x-msdownload");
        Header("Content-Length: ".filesize($file_path));
        Header("Content-Disposition: attachment; filename=".$file_name);
        Header("Content-Transfer-Encoding: binary");
        Header("Content-Description: File Transfer");
        Header("Expires: 0");
    }

    if (!fpassthru($fp)) {
        fclose($fp);
    }
    //포인터인 $fp에 저장된 파일 데이터를 fpassthru( ) 함수로 출력 버퍼에 저장하면 파일이 다운로드 됨.
    //다운로드가 완료되면 fclose( ) 함수로 파일을 닫음.
