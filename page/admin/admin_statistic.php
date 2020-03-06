<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <style>
        #statis_nav ul {
            display: inline-block;
            margin: 0;
            margin-left: 345px;
            padding: 0;
        }

        .cols {
            padding: 10px auto;
            border: 0;
            margin: 0;
            list-style: none;
            display: inline-block;
            cursor: pointer;
            height: 50px;
            font-size: 17px;
        }

        #statis_nav {
            padding: 10px 0;
        }

        #select_year {
            font-size: 27px;
            color: #7ca2c3;
            border: none;
            outline: none;
        }

        #div_center {
            width: 1100px;
            margin: 0 auto;
        }

        #wing_tab {
            display: inline-block;
        }
        #admin_aside_left ul li a{
            text-decoration: none;
    color: black;
    font-weight: bold;
        }
    </style>
     <link rel="stylesheet" href="../../css/admin/admin_board.css">
    <title>통계</title>
</head>

<body>
<aside id="admin_aside_left">
  <button type="button" id="exit_admin" name="button" onclick="location.href='../index/index.php'">나가기</button>
        <ul>
          <li><a href="./admin_member.php">회원 목록 관리</a></li>
          <li><a href="./admin_board.php?category='찾아요'">게시판 관리</a></li>
          <li><a href="./admin_statistic.php">통계</a></li>
        </ul>
      </aside>
      <section>
        <div id="admin_box" style="text-align: unset">
          <h3 id="member_title">관리자 모드 > 통계</h3>
          <div id="statis_nav">
            <select name="" id="select_year"></select>
                <ul>
                    <li class="cols" id="visitor" onclick="setData(this)">방문자수</li> |
                    <li class="cols" id="seek_keep" onclick="setData(this)">찾아요/데리고있어요</li> |
                    <li class="cols" id="temp" onclick="setData(this)">임시보호</li> |
                    <li class="cols" id="free" onclick="setData(this)">자유게시판</li>
                </ul>


        </div>
        <hr>
        <canvas id="myChart" width="1100" height="400"></canvas>
        </div>
      </section>
    <script>
        var myChart = null;
        var name_list = [];
        var data = [];
        var now = new Date();
        var year = now.getUTCFullYear();
        var start_year = 2019;
        var select_year = document.querySelector('#select_year');
        var label_names = [];


        for (var i = 1; i <= 12; i++) {
            label_names.push(i + "월");
        }
        var dataSet = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var myChartData = {
            labels: label_names,
            label: "",
            backgroundColor: 'rgba(255,0,0,0.5)',
            borderColor: 'red',
            borderWidth: 1,
            data: dataSet
        };



        //데이터셋 설정
        function setData(id) {
            var line_set=document.querySelectorAll('.cols');
            for(var i=0;i<line_set.length;i++){
                line_set[i].style.textDecorationLine='none';
            }
            switch (id.id) {
                case 'seek_keep':
                    while (myChartData.datasets.length) {
                        myChartData.datasets.pop();
                    }
                    callItem('seek_keep');
                    id.style.textDecorationLine='underLine';
                    break;
                case 'temp':
                    while (myChartData.datasets.length) {
                        myChartData.datasets.pop();
                    }
                    callItem('temp');
                    id.style.textDecorationLine='underLine';
                    break;
                case 'free':

                    while (myChartData.datasets.length) {
                        myChartData.datasets.pop();
                    }
                    callItem('free');
                    id.style.textDecorationLine='underLine';
                    break;
                case 'visitor':

                    while (myChartData.datasets.length) {
                        myChartData.datasets.pop();
                    }
                    callItem('visitor');
                    id.style.textDecorationLine='underLine';
                    break;

            }
        }


        $(document).ready(function () {
            //년도 세팅
            var year_option = document.createElement('option');
            for (var i = year; i >= start_year; i--) {
                var year_option = document.createElement('option');
                year_option.value = i.toString();
                year_option.innerHTML = i.toString() + "년";
                select_year.appendChild(year_option);
            }

            var ctx = document.getElementById('myChart');

            myChart = new Chart(ctx, {
                type: 'bar',
                data: myChartData,
                options: {
                    reponsive: false
                }


            });
        });



        function callItem(category) {

            $.ajax({
                type: "post",
                url: "chart_list.php",
                data: {
                    'category': category
                },
                success: function (response) {
                    if (!response.includes('Undefined')) {
                        var result = JSON.parse(response);
                    } else {
                        var result = null;
                    }
                    if (category === 'seek_keep') {
                        var seek = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        var keep = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        if (result) {

                            for (var i = 0; i < result.length; i++) {
                                if (result[i].regist.includes(select_year.value)) {
                                    if (result[i].category.includes('찾아요')) {
                                        seek[(parseInt(result[i].regist.substr(5, 2))) - 1]++;
                                    } else {
                                        keep[(parseInt(result[i].regist.substr(5, 2))) - 1]++;
                                    }
                                }
                            }
                        }

                        var newData1 = {
                            labels: label_names,
                            label: "데리고있어요",
                            backgroundColor: 'rgba(255,0,0,0.5)',
                            borderColor: 'red',
                            borderWidth: 1,
                            data: keep
                        }
                        var newData2 = {
                            labels: label_names,
                            label: "찾아요",
                            backgroundColor: 'rgba(54, 162, 235,0.5)',
                            borderColor: 'blue',
                            borderWidth: 1,
                            data: seek
                        }



                        myChartData.datasets.push(newData1);
                        myChartData.datasets.push(newData2);
                        myChart.update();

                    } else if (category === 'visitor') {
                        var visitor = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        if (result) {

                            for (var i = 0; i < result.length; i++) {

                                if (result[i].regist.includes(select_year.value)) {
                                    
                                   visitor[(parseInt(result[i].regist.substr(5, 2))) - 1] += parseInt(
                                    result[i].count);

                                }
                            }
                        }

                        var newData1 = {
                            labels: label_names,
                            label: "방문자수",
                            backgroundColor: 'rgba(255, 159, 64,0.5)',
                            borderColor: 'orange',
                            borderWidth: 1,
                            data: visitor
                        }



                        myChartData.datasets.push(newData1);
                        myChart.update();
                    } else if (category === 'temp') {
                        var etc = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        if (result) {
                            for (var i = 0; i < result.length; i++) {
                                if (result[i].regist.includes(select_year.value)) {
                                    etc[(parseInt(result[i].regist.substr(5, 2))) - 1]++;

                                }
                            }

                            var newData1 = {
                                labels: label_names,
                                label: "임시보호",
                                backgroundColor: 'rgba(75, 192, 192,0.5)',
                                borderColor: 'green',
                                borderWidth: 1,
                                data: etc
                            }

                        }





                        myChartData.datasets.push(newData1);
                        myChart.update();

                    } else {
                        var etc = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        if (result) {
                            for (var i = 0; i < result.length; i++) {
                                if (result[i].regist.includes(select_year.value)) {
                                    etc[(parseInt(result[i].regist.substr(5, 2))) - 1]++;
                                }
                            }
                        }



                        var newData1 = {
                            labels: label_names,
                            label: "자유게시판",
                            backgroundColor: 'rgba(153, 102, 255,0.5)',
                            borderColor: 'purple',
                            borderWidth: 1,
                            data: etc
                        }



                        myChartData.datasets.push(newData1);
                        myChart.update();

                    }






                }
            });
        }
    </script>

</body>

</html>
