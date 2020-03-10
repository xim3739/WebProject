<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/main/small-business.css" rel="stylesheet">
    <?php include "../../lib/common_page/main_style.php" ?>
    <link rel="stylesheet" href="../../css/free/free.css">
    <link rel="stylesheet" href="../../css/free/free_list.css">
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="../../js/main/pop_up_menu.js"></script>
    <script src="../../js/free/free_list.js" charset="utf-8"></script>
  </head>

    <body>
      <?php include "../../lib/common_page/header.php";?>
      <div id="list_total">
          <?php
            include_once "../../db/db_connector.php";
            $userid=(isset($_SESSION["userid"]))?$_SESSION["userid"]:"";
            $username=(isset($_SESSION["username"]))?$_SESSION["username"]:"";
            if (!$userid) {
              echo "<script>
                      alert('로그인 후 이용해주세요!');
                      history.go(-1);
                      </script>
                      ";
              exit;
            }
            $search_option=(isset($_GET["search_option"]))?$_GET["search_option"]:" ";
            $key_word=(isset($_GET["key_word"]))?$_GET["key_word"]:" ";
            $page=(isset($_GET["page"]))?$_GET["page"]:1;
            $scale=(isset($_GET["scale"]))?$_GET["scale"]:20;
            $page_num=10;
            $new_cate=(isset($_GET["new_cate"]))?$_GET["new_cate"]:0;
            if ($new_cate==="1") {
              unset($_GET["category"]);
            }
            $category=(isset($_GET["category"]))?$_GET["category"]:" ";
            if ($key_word===" ") {
              if ($category===" ") {
                $sql = "SELECT * FROM `free` ORDER BY `num` DESC";
              }else {
                $sql = "select * from free where category='$category' order by num desc";
              }
            }else {
              switch ($search_option) {
                case 'title':
                  if ($category===" ") {
                    $sql = "select * from free where subject LIKE '%$key_word%' order by num desc";
                  }else {
                    $sql = "select * from free where subject LIKE '%$key_word%' and category='$category' order by num desc";
                  }
                  break;

                case 'content':
                  if ($category===" ") {
                    $sql = "select * from free where content LIKE '%$key_word%' order by num desc";
                  }else {
                    $sql = "select * from free where content LIKE '%$key_word%' and category='$category' order by num desc";
                  }
                  break;

                case 'name':
                  if ($category===" ") {
                    $sql = "select * from free where name LIKE '%$key_word%' order by num desc";
                  }else {
                    $sql = "select * from free where name LIKE '%$key_word%' and category='$category' order by num desc";
                  }
                  break;
              }
            }//end of else
            $result = mysqli_query($connect,$sql);
            $total_record = mysqli_num_rows($result);
            $total_page=ceil($total_record/$scale);

            $block = ceil($page/$page_num);

            $start_page = (($block-1) * $page_num)+1;
            $end_page = $start_page + $page_num -1;
            if ($end_page>$total_page) {
              $end_page=$total_page;
            }
            $start = ($page-1) * $scale;
            $number = $total_record - $start;
           ?>
          <table>
            <tbody>
              <tr>
                <td>
                  <div>
                    <select class="" id="category_select" onchange="change_category();">
                      <option value>카테고리</option>
                      <option value="잡담" <?php if($category === "잡담") echo "SELECTED"; ?>>잡담</option>
                      <option value="질문" <?php if($category === "질문") echo "SELECTED"; ?>>질문</option>
                    </select>
                    <ul class="total_ul" style="float: right;">
                      <li><button type="button" class="go_list_button" onclick="goList();">목록</button></li>
                      <li><a href="./free_write_form.php"><img src="../../img/free/write.gif" alt="글쓰기.gif"></a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="table_border"></td>
              </tr>
              <!-- 실제 리스트 시작 -->
              <tr>
                <td>
                  <form class="" action="#" method="post">
                    <table id="input_table">
                      <thead class="">
                        <tr class="back_tr bottom_tr">
                          <td class="col1">번호</td>
                          <td class="col2">제목</td>
                          <td class="col3">글쓴이</td>
                          <td class="col4">등록일</td>
                          <td class="col5">조회</td>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        for ($i=$start; $i <$start+$scale && $i < $total_record ; $i++) {
                          mysqli_data_seek($result,$i);
                          $row = mysqli_fetch_array($result);
                          $num = $row["num"];
                          $id = $row["id"];
                          $name = $row["name"];
                          $q_category = $row["category"];
                          $subject = $row["subject"];
                          $total_subject = "[".$q_category."] ".$subject;
                          $content = $row["content"];
                          $regist_day = $row["regist_day"];
                          $time = substr($regist_day,12,5);
                          $hit = $row["hit"];
                          ?>
                        <tr class="bottom_tr list_tr">
                          <td class="col1"><?=$num?></td>
                          <td class="col2" style="text-align: left;"><a href="./free_read_form.php?num=<?=$num?>&page=<?=$page?>"><?=$total_subject?></a></td>
                          <td hidden><?=$id?></td>
                          <td class="col3"><?=$name?></td>
                          <td class="col4"><?=$time?></td>
                          <td class="col5"><?=$hit?></td>
                        </tr>
                      <?php
                        $number --;
                      }//end of for
                      ?>
                    </tbody>
                    </table>
                  </form>
                </td>
              </tr>
              <tr>
                <td style="text-align: right;" class="back_tr "><a href="./free_write_form.php"><img src="../../img/free/write.gif" alt="글쓰기.gif"></a></td>
              </tr>
              <tr>
                <td class="table_border"></td>
              </tr>
              <tr>
                <td>
                  <form class="" action="./free_list_search.php" method="post">
                    <table class="page_table">
                      <tr class="back_tr page_tr total_ul" style="width: 800px;">
                        <td>
                          <div id="page_div">
                            <ul>
                              <?php
                                if ($page<=1) {
                                  echo "<li><b></b></li>";
                                }else {
                                  if ($key_word===" ") {
                                    if ($category===" ") {
                                      echo "<li><a href='free_list.php'>처음</a></li>";
                                    }else {
                                      echo "<li><a href='free_list.php?category=$category'>처음</a></li>";
                                    }
                                  }else {
                                    if ($category===" ") {
                                      echo "<li><a href='free_list.php'>처음</a></li>";
                                    }else {
                                      echo "<li><a href='free_list.php?key_word=$key_word&category=$category'>처음</a></li>";
                                    }
                                  }
                                }
                                if ($page<=1) {
                                  echo "<li><b></b></li>";
                                }else {
                                  $new_page = $start_page;
                                  if ($key_word===" ") {
                                    if ($category===" ") {
                                      echo "<li><a href='free_list.php?page=$new_page'><b> ◀ 이전 </b></a></li>";
                                    }else {
                                      echo "<li><a href='free_list.php?category=$q_category&page=$new_page'><b> ◀ 이전 </b></a></li>";
                                    }
                                  }else {
                                    if ($category===" ") {
                                      echo "<li><a href='free_list.php?key_word=$key_word&page=$new_page&search_option=$search_option'><b> ◀ 이전 </b></a></li>";
                                    }else {
                                      echo "<li><a href='free_list.php?key_word=$key_word&category=$q_category&page=$new_page&search_option=$search_option'><b> ◀ 이전 </b></a></li>";
                                    }
                                  }
                                }
                                for ($i=$start_page; $i <=$end_page; $i++) {
                                  if ($page == $i) {
                                    echo "<li><b>&nbsp;$i&nbsp;</b></li>";
                                  }else {
                                    if ($key_word===" ") {
                                      if ($category===" ") {
                                        echo "<li><a href='free_list.php?page=$i'>&nbsp;$i&nbsp;</a></li>";
                                      }else {
                                        echo "<li><a href='free_list.php?category=$q_category&page=$i'>&nbsp;$i&nbsp;</a></li>";
                                      }
                                    }else {
                                      if ($category===" ") {
                                        echo "<li><a href='free_list.php?key_word=$key_word&search_option=$search_option&page=$i'>&nbsp;$i&nbsp;</a></li>";
                                      }else {
                                        echo "<li><a href='free_list.php?key_word=$key_word&search_option=$search_option&category=$q_category&page=$i'>&nbsp;$i&nbsp;</a></li>";
                                      }
                                    }
                                  }
                                }
                                if ($total_page>=2 && $page != $total_page) {
                                  $new_page =($end_page>10)?$end_page+1:$end_page;
                                  if ($key_word===" ") {
                                    if ($category===" ") {
                                      echo "<li><a href='free_list.php?page=$end_page'><b> 다음 ▶ </b></a></li>";
                                    }else {
                                      echo "<li><a href='free_list.php?category=$q_category&page=$end_page'><b> 다음 ▶ </b></a></li>";
                                    }
                                  }else {
                                    if ($category===" ") {
                                      echo "<li><a href='free_list.php?key_word=$key_word&search_option=$search_option&page=$end_page'><b> 다음 ▶ </b></a></li>";
                                    }else {
                                      echo "<li><a href='free_list.php?key_word=$key_word&search_option=$search_option&category=$q_category&page=$end_page'><b> 다음 ▶ </b></a></li>";
                                    }
                                  }
                                }else {
                                  echo "<li></li>";
                                }
                                if ($page>=$total_page) {
                                  echo "<li><b></b></li>";
                                }else {
                                  if ($key_word===" ") {
                                    if ($category===" ") {
                                      echo "<li><a href='free_list.php?page=$total_page'> 마지막 </a></li>";
                                    }else {
                                      echo "<li><a href='free_list.php?category=$q_category&page=$total_page'> 마지막 </a></li>";
                                    }
                                  }else {
                                    if ($category===" ") {
                                      echo "<li><a href='free_list.php?key_word=$key_word&search_option=$search_option&page=$total_page'> 마지막 </a></li>";
                                    }else {
                                      echo "<li><a href='free_list.php?key_word=$key_word&search_option=$search_option&category=$q_category&page=$total_page'> 마지막 </a></li>";
                                    }
                                  }
                                }
                             ?>
                            </ul>
                          </div>
                          <div id="search_div">
                            <ul id="search_ul">
                              <li><select class="" name="search_option">
                                <option value="title" <?php if($search_option === "title") echo "SELECTED"; ?>>제목</option>
                                <option value="content" <?php if($search_option === "content") echo "SELECTED"; ?>>내용</option>
                                <option value="name" <?php if($search_option === "name") echo "SELECTED"; ?>>글쓴이</option>
                              </select> </li>
                              <li><input type="text" name="search_word" value="<?=$key_word?>" style="width: 100px;"></li>
                              <li><input type="hidden" name="category" value="<?=$category?>"></li>
                              <li><button type="submit" name="button">검색</button></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="table_border"></td>
                      </tr>
                    </table>
                  </form>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
  </body>
</html>
