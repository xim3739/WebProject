<script>
$(document).ready(function () {
    console.log('<?=$_SESSION['userid']?>');
    let isEnd = false;
    var page=0;
    var flag=true;
    $(function(){
        $(window).scroll(function(){
            let $window = $(this);
            let scrollTop = $window.scrollTop();
            let windowHeight = $window.height();
            let documentHeight = $(document).height();
            
            
           // console.log("documentHeight:" + documentHeight + " | scrollTop:" + scrollTop + " | windowHeight: " + windowHeight );
            
            // scrollbar의 thumb가 바닥 전 30px까지 도달 하면 리스트를 가져온다.
            if(flag){
              if( scrollTop + windowHeight + 30 > documentHeight ){
                  fetchList();
              }

            }
        })
        fetchList();
    })
    
    let fetchList = function(){
        flag=false;
        if(isEnd == true){
            return;
        }
        console.log("부르냐");
        <?php 
        if(isset($_GET['category'])){
            $cate=$_GET['category'];
        }else{
            $cate=null;
        }
        if(isset($_GET['form'])){
            $form=$_GET['form'];
        }else{
            $form=null;
        }
        if(isset($_GET['board'])){
            $board="ok";
        }else{
            $board=null;
        }
        ?>
        // 방명록 리스트를 가져올 때 시작 번호
        // renderList 함수에서 html 코드를 보면 <li> 태그에 data-no 속성이 있는 것을 알 수 있다.
        // ajax에서는 data- 속성의 값을 가져오기 위해 data() 함수를 제공.
        let startNo = $("#list-guestbook li").last().data("no") || 0;
        let check_duplicate=[];
        $.ajax({
            url:"../../db/main/main_item.php",
            type: "GET",
            data:{'page':page,'category':"<?=$cate?>","form":"<?=$form?>"},
             
            success: function(result){
                setTimeout(function(){flag=true;},500);
                // 컨트롤러에서 가져온 방명록 리스트는 result.data에 담겨오도록 했다.
                // 남은 데이터가 5개 이하일 경우 무한 스크롤 종료
                if(!result.includes('empty')){
                    
                    var response=JSON.parse(result);
                    console.log(response);

                    for(var i=0 ; i<response.length ; i++){
                        var name=response[i].name;
                        var subject=response[i].subject;
                        var content=response[i].content;
                        var hit=response[i].hit;
                        var file_path=response[i].file;
                        var num=response[i].num;
                        var id=response[i].id;
                        
                        if('<?=$board?>'&&'<?=$form?>'){
                            var html=`
                            <div class="board_center">
                            <div class="container" style="padding-left:146px;">
                        <div class="row align-items-center my-5">
                          <div class="col-lg-7 content_img no-flex" style="width: 420px; height: 186.66px; overflow : hidden;">
                            <img class="img-fluid rounded mb-4 mb-lg-0" src='`+file_path+`'>
                          </div>
                          <div class="col-lg-5 no-flex" style="max-width : 45.666667%">
                            <h1 class="font-weight-light">`+subject+`</h1>
                            <p style="word-wrap : break-word;">`+content +`</p>
                            <a class="btn btn-primary" href="../../page/board/board_myboard_widen.php?num=`+num+`">Call to Action!</a>
                            <span class="reply"><img src="" alt="">조회수 : `+hit+`회</span>
                          </div>
                        </div>
                      </div>
                      </div>`;
           
                        }else{
                            var html=`
                            <div class="board_center">
                            <div class="container" style="padding-left:146px;">
                        <div class="row align-items-center my-5">
                          <div class="col-lg-7 content_img no-flex" style="width: 420px; height: 186.66px; overflow : hidden;">
                            <img class="img-fluid rounded mb-4 mb-lg-0" src='`+file_path+`'>
                          </div>
                          <div class="col-lg-5 no-flex" style="max-width : 45.666667%">
                            <h1 class="font-weight-light">`+subject+`</h1>
                            <p style="word-wrap : break-word;">`+content +`</p>
                            <a class="btn btn-primary" href="../../page/board/board_widen.php?num=`+num+`">Call to Action!</a>
                            <span class="reply"><img src="" alt="">조회수 : `+hit+`회</span>
                          </div>
                        </div>
                      </div>
                      </div>`;
                      if(<?=isset($_SESSION['userid'])?>){
                            if(id==='<?=$_SESSION['userid']?>'){
                                var html=`
                            <div class="board_center">
                            <div class="container" style="padding-left:146px;">
                        <div class="row align-items-center my-5">
                          <div class="col-lg-7 content_img no-flex" style="width: 420px; height: 186.66px; overflow : hidden;">
                            <img class="img-fluid rounded mb-4 mb-lg-0" src='`+file_path+`'>
                          </div>
                          <div class="col-lg-5 no-flex" style="max-width : 45.666667%">
                            <h1 class="font-weight-light">`+subject+`</h1>
                            <p style="word-wrap : break-word;">`+content +`</p>
                            <a class="btn btn-primary" href="../../page/board/board_myboard_widen.php?num=`+num+`">Call to Action!</a>
                            <span class="reply"><img src="" alt="">조회수 : `+hit+`회</span>
                          </div>
                        </div>
                      </div>
                      </div>`;

                            }else{

                            }
                        }

                        }

                        
                        $('section').append(html);
                    }
                    page+=5;
                    console.log(page);
                    
                }else{

                    isEnd = true
                }
                
            },error:function(){
                alert("error");
            }
            
        });
    }
});
</script>