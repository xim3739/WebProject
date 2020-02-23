$(document).ready(function () {


    var list = [];
    $(document).ready(function () {

        $.ajax({
            type: "post",
            data: {
                "mode": "select"
            },
            url: "../../db/hospital_list/hospital_list.php",
            success: function (response) {
                //제이슨 해당정보를 해독을 함
                var a = JSON.parse(response);
                for (var i = 0; i < a.length; i++) {
                    list.push(a[i]);
                }


            },
            error: function (request, status, error) {
                alert("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            }
        });
    });

    
        var a = document.getElementById("locationY");
        var b = document.getElementById("locationX");
        var mapContainer = document.getElementById('map_write'), // 지도를 표시할 div 
            mapOption = {
                center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
                level: 1 // 지도의 확대 레벨
            };
           
        var flag = false;
        // 지도를 생성합니다    
        var map = new kakao.maps.Map(mapContainer, mapOption);
        var markers = [];
        // 주소-좌표 변환 객체를 생성합니다
        var geocoder = new kakao.maps.services.Geocoder();
        var windows = [];
        var marker = new kakao.maps.Marker(), // 클릭한 위치를 표시할 마커입니다
            infowindow = new kakao.maps.InfoWindow({
                zindex: 1
            }); // 클릭한 위치에 대한 주소를 표시할 인포윈도우입니다

        var imageSrc = 'http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/places_category.png', // 마커 이미지 url, 스프라이트 이미지를 씁니다
            imageSize = new kakao.maps.Size(27, 28), // 마커 이미지의 크기
            imgOptions = {
                spriteSize: new kakao.maps.Size(72, 208), // 스프라이트 이미지의 크기
                spriteOrigin: new kakao.maps.Point(46, 72), // 스프라이트 이미지 중 사용할 영역의 좌상단 좌표
                offset: new kakao.maps.Point(11, 28) // 마커 좌표에 일치시킬 이미지 내에서의 좌표
            },
            markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imgOptions)

        // 현재 지도 중심좌표로 주소를 검색해서 지도 좌측 상단에 표시합니다
        searchAddrFromCoords(map.getCenter(), displayCenterInfo);

        // 지도를 클릭했을 때 클릭 위치 좌표에 대한 주소정보를 표시하도록 이벤트를 등록합니다
        kakao.maps.event.addListener(map, 'click', function (mouseEvent) {
            searchDetailAddrFromCoords(mouseEvent.latLng, function (result, status) {
                console.log(mouseEvent);
                var detailAddr = "";
                var check_goo = "";
                if (status === kakao.maps.services.Status.OK) {
                    detailAddr = !!result[0].road_address ? result[0].road_address.address_name :
                        result[0].address.address_name;
                    check_goo = !!result[0].road_address ? result[0].road_address.region_2depth_name :
                        result[0].address.region_2depth_name;

                    // // 마커를 클릭한 위치에 표시합니다 
                    marker.setPosition(mouseEvent.latLng);
                    marker.setMap(map);

                    // 인포윈도우에 클릭한 위치에 대한 법정동 상세 주소정보를 표시합니다
                    infowindow.setContent(detailAddr);
                    infowindow.open(map, marker);
                    a.value=mouseEvent.latLng.getLat();
                    b.value=mouseEvent.latLng.getLng();
                    var coords = new kakao.maps.LatLng(mouseEvent.latLng.getLat(), mouseEvent.latLng
                        .getLng());
                    map.setCenter(coords);
                }
                for (var i = 0; i < list.length; i++) {
                    if (list[i].addr.includes(check_goo)) {
                        var hospitalName = list[i].name;
                        geocoder.addressSearch(list[i].addr, function (result, status) {
                            console.log(result);
                            // 정상적으로 검색이 완료됐으면 
                            if (status === kakao.maps.services.Status.OK) {
                                console.log(markers);

                                console.log(markers);
                                var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                                // 결과값으로 받은 위치를 마커로 표시합니다
                                var marker = new kakao.maps.Marker({
                                    map: map,
                                    title: hospitalName,
                                    position: coords,
                                    image: markerImage
                                });
                                markers.push(marker);

                                // 인포윈도우로 장소에 대한 설명을 표시합니다
                                // var infowindow = new kakao.maps.InfoWindow({
                                //     content: '<div style="width:150px;text-align:center;padding:6px 0;">' +
                                //         hospitalName + '</div>'
                                // });
                                // infowindow.open(map, marker);
                                //windows.push(infowindow);

                            }
                        });
                    }
                }
                if (!markers.length == 0) {
                    for (var j = 0; j < markers.length; j++) {
                        markers[j].setMap(null);
                        windows[j].close();
                    }
                    markers = [];
                    windows = [];
                }
            });
        });

        // 중심 좌표나 확대 수준이 변경됐을 때 지도 중심 좌표에 대한 주소 정보를 표시하도록 이벤트를 등록합니다
        kakao.maps.event.addListener(map, 'idle', function () {
            searchAddrFromCoords(map.getCenter(), displayCenterInfo);
        });

        function searchAddrFromCoords(coords, callback) {
            // 좌표로 행정동 주소 정보를 요청합니다
            geocoder.coord2RegionCode(coords.getLng(), coords.getLat(), callback);
        }

        function searchDetailAddrFromCoords(coords, callback) {
            // 좌표로 법정동 상세 주소 정보를 요청합니다
            geocoder.coord2Address(coords.getLng(), coords.getLat(), callback);
        }

        // 지도 좌측상단에 지도 중심좌표에 대한 주소정보를 표출하는 함수입니다
        function displayCenterInfo(result, status) {
            if (status === kakao.maps.services.Status.OK) {
                var infoDiv = document.getElementById('centerAddr');

                for (var i = 0; i < result.length; i++) {
                    // 행정동의 region_type 값은 'H' 이므로
                    if (result[i].region_type === 'H') {
                        infoDiv.innerHTML = result[i].address_name;
                        break;
                    }
                }
            }
        }
    
});