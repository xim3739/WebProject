  /*******************게시물 보기 했을때 나오는 지도*******************/
  // 카카오 지도 api
 // 마커를 클릭했을 때 해당 장소의 상세정보를 보여줄 커스텀오버레이입니다
 var placeOverlay = new kakao.maps.CustomOverlay({zIndex:1}), 
 contentNode = document.createElement('div'), // 커스텀 오버레이의 컨텐츠 엘리먼트 입니다 
 markers = [], // 마커를 담을 배열입니다
 currCategory = ''; // 현재 선택된 카테고리를 가지고 있을 변수입니다
 var near_hotpital=[];
 var near_category=""; 
 var near_hospital_target=[];
 var geocoder = new kakao.maps.services.Geocoder();
 var list = [{
 
         name: "치킨병원",
         addr: "서울 영등포구 영등포동 647-8"
     }, {
         name: "감자치킨",
         addr: "서울 구로구 신도림동 296-103"
     }];
 var callback = function(result, status) {
 if (status === kakao.maps.services.Status.OK) {
     near_category=!!result[0].address?result[0].address.region_2depth_name :result[0].road_address.region_2depth_name;
     for(var i=0;i<list.length;i++){
         if(list[i].addr.includes(near_category)){
             near_hotpital.push(list[i]);
             geocoder.addressSearch(list[i].addr, callback1);
             console.log(near_hotpital);
         }
     }
 }
 };
 
 var callback1 = function(result, status) {
 if (status === kakao.maps.services.Status.OK) {
     near_hospital_target.push(result);
     console.log(result);
 }
 };
 
 
 
 var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
 mapOption = {
     center: new kakao.maps.LatLng(37.50467450611051, 126.89874173588733), // 지도의 중심좌표
     level: 5 // 지도의 확대 레벨
 },
 my_marker=new kakao.maps.Marker({
         title:"잃어버린 위치",
         position:  new kakao.maps.LatLng(37.50467450611051, 126.89874173588733)}); // 마커의 위치;  
 
 // 지도를 생성합니다    
 var map = new kakao.maps.Map(mapContainer, mapOption); 
 my_marker.setMap(map);
 kakao.maps.event.addListener(my_marker, 'click', function() {
             window.open("https://map.kakao.com/link/to/분실장소,"+37.50467450611051+","+126.89874173588733,"path_finder","width=1200px,height=1200px");
         });
 
 // 버튼에 클릭 이벤트를 등록합니다
 addCategoryClickEvent();
 geocoder.coord2Address(126.89874173588733, 37.50467450611051, callback);
 
 
 // 지도에 마커를 표출하는 함수입니다
function displayPlaces(places) {

    // 몇번째 카테고리가 선택되어 있는지 얻어옵니다
    // 이 순서는 스프라이트 이미지에서의 위치를 계산하는데 사용됩니다
    var order = document.getElementById(currCategory).getAttribute('data-order');

    // console.log(places);
    // console.log(places[0][0].x);

    for ( var i=0; i<places.length; i++ ) {

            // 마커를 생성하고 지도에 표시합니다
            var marker = addMarker(new kakao.maps.LatLng(parseFloat(places[i][0].y), parseFloat(places[i][0].x), order));
            var x=places[i][0].x;
            var y=places[i][0].y;
            var name=near_hotpital[i].name;
            console.log("네임 :"+name);
            kakao.maps.event.addListener(marker, 'click', makeClickListener(name,x,y));
    }
}
function makeClickListener(name,x,y){
    return function(){
        window.open("https://map.kakao.com/link/to/"+name+","+y+","+x,"path_finder","width=1200px,height=1200px");
    }
}
 // 마커를 생성하고 지도 위에 마커를 표시하는 함수입니다
 function addMarker(position, order) {
 var imageSrc = 'http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/places_category.png', // 마커 이미지 url, 스프라이트 이미지를 씁니다
     imageSize = new kakao.maps.Size(27, 28),  // 마커 이미지의 크기
     imgOptions =  {
         spriteSize : new kakao.maps.Size(72, 208), // 스프라이트 이미지의 크기
         spriteOrigin : new kakao.maps.Point(46, 72), // 스프라이트 이미지 중 사용할 영역의 좌상단 좌표
         offset: new kakao.maps.Point(11, 28) // 마커 좌표에 일치시킬 이미지 내에서의 좌표
     },
     markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imgOptions),
         marker = new kakao.maps.Marker({
         position: position, // 마커의 위치
         image: markerImage 
     });
 
 marker.setMap(map); // 지도 위에 마커를 표출합니다
 markers.push(marker);  // 배열에 생성된 마커를 추가합니다
 
 return marker;
 }
 
 // 지도 위에 표시되고 있는 마커를 모두 제거합니다
 function removeMarker() {
 for ( var i = 0; i < markers.length; i++ ) {
     markers[i].setMap(null);
 }   
 markers = [];
 }
 
 
 
 // 각 카테고리에 클릭 이벤트를 등록합니다
 function addCategoryClickEvent() {
 var category = document.getElementById('category'),
     children = category.children;
     children[0].onclick = onClickCategory;
 
 }
 
 // 카테고리를 클릭했을 때 호출되는 함수입니다
 function onClickCategory() {
 var id = this.id,
     className = this.className;
 
 placeOverlay.setMap(null);
 
 if (className === 'on') {
     currCategory = '';
     changeCategoryClass();
     removeMarker();
 } else {
     currCategory = id; 
     changeCategoryClass(this);
     displayPlaces(near_hospital_target);
 
 }
 }
 
 // 클릭된 카테고리에만 클릭된 스타일을 적용하는 함수입니다
 function changeCategoryClass(el) {
 var category = document.getElementById('category'),
     children = category.children,
     i;
 
 
     children[0].className = '';
 
 
 if (el) {
     el.className = 'on';
 } 
 } 
 
 