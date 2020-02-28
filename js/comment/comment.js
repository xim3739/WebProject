//엔터를 누르면 add버튼이 자동으로 눌리게 하는 기능
$('#submit').click(function(){
    // 검색 버튼을 눌렀을때의 기능 구현
});

$('#input_comment_area').keypress(function(event){
     if ( event.which == 13 ) {
         $('#submit').click();
         return false;
     }
});
//쉬프트 엔터를 누르면 자동으로 줄바꿈이 되게 하는 함수
$(function() {
              $('textarea').on('keydown', function(event) {
                  if (event.keyCode == 13)
                      if (!event.shiftKey){
                         event.preventDefault();
                         var button=document.getElementById('query_send');
                         button.click();
                         $('textarea').empty()
                      }
              });
            });
//둘다 같이 쓰고 싶을때
//  $(function() {
//   $('textarea').on('keydown', function(event) {
//       if (event.keyCode == 13 && event.shiftKey){
//              // event.preventDefault();
//              // var button=document.getElementById('query_send');
//              // button.click();
//              console.log("쉬프트 엔터를 눌렀다");
//              // $('textarea').empty()
//            }else if(event.keyCode == 13 && !event.shiftKey){
//              console.log("엔터를 눌렀다");
//            }
//   });
// });
