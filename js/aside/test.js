function call_pay(){
  var IMP = window.IMP;
  IMP.init('imp38038723');
  IMP.request_pay({
      pg : 'payco',
      pay_method : 'card',
      merchant_uid : 'merchant_' + new Date().getTime(),
      name : '주문명:결제테스트',
      amount : 1000,
      buyer_email : 'cwpark2193@naver.com',
      buyer_name : '박재훈',
      buyer_tel : '010-2947-1257',
      buyer_addr : '서울특별시 동작구 사당동',
      buyer_postcode : '123-456'
  }, function(rsp) {
    if ( rsp.success ) {
        var msg = '결제가 완료되었습니다.';
        msg += '고유ID : ' + rsp.imp_uid;
        msg += '상점 거래ID : ' + rsp.merchant_uid;
        msg += '결제 금액 : ' + rsp.paid_amount;
        msg += '카드 승인번호 : ' + rsp.apply_num;

        // set_premium();
    } else {
        var msg = '결제에 실패하였습니다.';
        msg += '에러내용 : ' + rsp.error_msg;
    }
    alert(msg);
    window.location.href="./main.php";
  });
}
