$(document).ready(function () {
    var a = "";
    var name = [];
    var addr = [];
    function hospital_list(bool) {
        if(bool){
            $.ajax({
                type: "get",
                url: "http://openapi.seoul.go.kr:8088/7144646767676f6437357845477541/json/vtrHospitalInfo/1/500/",
                dataType: "json",
                success: function (response) {
                    $result = response.vtrHospitalInfo.row;
                    a = $result;
                    for (var i = 0; i < a.length; i++) {
                        if (a[i].ADDR !== "") {
                            name.push(a[i].NM);
                            addr.push(a[i].ADDR);
                        } else {
                            name.push(a[i].NM);
                            addr.push(a[i].ADDR_OLD);
    
                        }
                    }
                    $.ajax({
                        type: "post",
                        url: "../../db/hospital_list/hospital_list.php",
                        data: {
                            "name": name,
                            "addr": addr
                        },
                        success: function (response) {
                            alert("동물병원 정보를 가져왔습니다");
                        }
                    });
                }
            });
        }
        
    }
    $.ajax({
        type: "get",
        url: "../../db/hospital_list/hospital_list.php",
        data: "data",
        success: function (echo) {
            var flag=echo;
            hospital_list(flag);
        }
    });
});