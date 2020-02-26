$(document).ready(function () {
    
    let isEnd = false;
    var page=0;
    $(function(){
        $(window).scroll(function(){
            let $window = $(this);
            let scrollTop = $window.scrollTop();
            let windowHeight = $window.height();
            let documentHeight = $(document).height();
            
            console.log("documentHeight:" + documentHeight + " | scrollTop:" + scrollTop + " | windowHeight: " + windowHeight );
            
            // scrollbar의 thumb가 바닥 전 30px까지 도달 하면 리스트를 가져온다.
            if( scrollTop + windowHeight + 10 > documentHeight ){
                fetchList();
            }
        })
        fetchList();
    })
    
    let fetchList = function(){
        if(isEnd == true){
            return;
        }
        
        // 방명록 리스트를 가져올 때 시작 번호
        // renderList 함수에서 html 코드를 보면 <li> 태그에 data-no 속성이 있는 것을 알 수 있다.
        // ajax에서는 data- 속성의 값을 가져오기 위해 data() 함수를 제공.
        let startNo = $("#list-guestbook li").last().data("no") || 0;
        $.ajax({
            url:"../../db/main/main_item.php",
            type: "GET",
            data:{'page':page},
             
            success: function(result){
                console.log(result);
                // 컨트롤러에서 가져온 방명록 리스트는 result.data에 담겨오도록 했다.
                // 남은 데이터가 5개 이하일 경우 무한 스크롤 종료
                if(!result.includes('empty')){
                    var response=JSON.parse(result);
                    for(var i=0 ; i<response.length ; i++){
                        var name=response[i].name;
                        var subject=response[i].subject;
                        var content=response[i].content;
                        var hit=response[i].hit;
                        var file_path=response[i].file_path;
                        var num=response[i].num;
                        var html=`<div class="container">
                        <div class="row align-items-center my-5">
                          <div class="col-lg-7 no-flex" style="width: 420px; height: 186.66px; overflow : hidden;">
                            <img class="img-fluid rounded mb-4 mb-lg-0" src='`+file_path+`'>
                          </div>
                          <div class="col-lg-5 no-flex">
                            <h1 class="font-weight-light">`+subject+`</h1>
                            <p>`+content +`</p>
                            <a class="btn btn-primary" href="../../page/board/board_widen.php?num=`+num+`">Call to Action!</a>
                            <span class="reply"><img src="" alt="">조회수 : `+hit+`회</span>
                          </div>
                        </div>
                      </div>`;
                        $('section').append(html);
                    }
                    page+=5;
                }else{
                    isEnd = true
                }
            },error:function(){
                alert("error");
            }
            
        });
    }
});
