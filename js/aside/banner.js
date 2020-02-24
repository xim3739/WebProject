function ask_pay(now_id,name,phone,email){
  if (!now_id) {
    alert("회원이 아닙니다.");
  }else {
    pay=(confirm("광고 시청을 중단하시겠습니까?"))?call_pay(now_id,name,phone,email):alert("취소되었습니다.");
  }
}
function call_pay(now_id,name,phone,email){
  var IMP = window.IMP;
  IMP.init('imp38038723');
  IMP.request_pay({
      pg : 'html5_inicis',
      pay_method : 'card',
      merchant_uid : 'merchant_' + new Date().getTime(),
      name : 'Ad_Blocking',
      amount : 1000,
      buyer_email : email,
      buyer_name : name,
      buyer_tel : phone,
  }, function(rsp) {
    if ( rsp.success ) {

      var msg = '결제가 완료되었습니다.';
      var premium ="yes";
      var now_ids=now_id;
        // msg += '고유ID : ' + rsp.imp_uid+'<br>\n';
        // msg += '상점 거래ID : ' + rsp.merchant_uid+'<br>\n';
        // msg += '결제 금액 : ' + rsp.paid_amount+'<br>\n';
        // msg += '카드 승인번호 : ' + rsp.apply_num;
        $.ajax({
          url:'../aside/premium_upgrade.php',
          data : {"premium" : premium,"now_id" : now_ids },
          type : 'get',
        });
        location.href="main.php";
    } else {
        var msg = '결제에 실패하였습니다.\n';
        msg += rsp.error_msg;
    }
    alert(msg);
  });
}
