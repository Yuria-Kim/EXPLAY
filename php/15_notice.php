<?php
  include "select_DB.php";

  $data = select_Notice();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Explay_Notice</title>
    <link rel="stylesheet" type="text/css" href="board.css" />
    <link rel="stylesheet" type="text/css" href="register.css" />
  </head>
  <body>
    <form name="notice" action="#" method="post">
      <div id="wrap">
        <!-- header -->
        <div id="header">
          <div class="logo">logo</div>
          <div id="h_main">
            <div class="main1">
              <div class="title">explay(title)</div>
              <button class="login">login</button>
              <!-- 로그인한 이후에는 로그아웃으로 표시 바뀌에 출력!! -->
            </div>

            <div class="main2">
              <ul class="menu">
                <li><a href="4_post_main.php">POST</a></li>
                <li><a href="7_challenge_main.php">CHALLENGE</a></li>
                <li><a href="13_mypage.php">MY PAGE</a></li>
                <!-- 로그인 이전, 이후 페이지 이동 다름 -->
                <li><a href="15_notice.php">NOTICE</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- body -->
        <div class="board_wrap">
          <div class="board_title">
            <strong>공지사항</strong>
            <p>EXPLAY의 공지사항을 빠르고 정확하게 안내해드립니다.</p>
          </div>
          <div class="board_list_wrap">
            <div class="board_list">
              <div class="top">
                <div class="num">번호</div>
                <div class="title">제목</div>
                <div class="writer">작성자</div>
                <div class="date">작성일</div>
                <div class="count">조회수</div>
              </div>
              <?php
                foreach($data as $notice){
                  echo "<div>
                          <div class='num'>{$notice['code']}</div>
                          <div class='title'>
                            <a href='15_1_notice_view.php?id={$notice['code']}'>{$notice['title']}</a>
                          </div>
                          <div class='writer'>관리자</div>
                          <div class='date'>{$notice['created']}</div>
                          <div class='count'>{$notice['views']}</div>
                        </div>";
                }
              ?>
                <!-- <div class="num">1</div>
                <div class="title">
                  <a href="15_1_notice_view.html">공지글 제목입니다.</a>
                </div>
                <div class="writer">관리자</div>
                <div class="date">2023.10.20</div>
                <div class="count">23</div>
                </div> -->
            <!-- </div> -->
            <div class="board_page">
              <a href="#" class="bt first"><<</a>
              <a href="#" class="bt prev"><</a>
              <a href="#" class="num on">1</a>
              <a href="#" class="num">2</a>
              <a href="#" class="num">3</a>
              <a href="#" class="num">4</a>
              <a href="#" class="num">5</a>
              <a href="#" class="bt next">></a>
              <a href="#" class="bt last">>></a>
            </div>
            <div class="bt_wrap">
              <a href="15_3_notice_write.php" class="on">작성</a>
              <!-- <a href="#">수정</a> -->
            </div>
          </div>
        </div>
        <!-- footer -->
        <div id="footer">
          <div class="footer1">
            <div class="notice">
              <p style="font-weight: 800; font-size: large">고객센터</p>
              <p>오전 10시 - 오후 4시30분 (주말, 공휴일 제외)</p>
              <p>문의전화 1577-1577</p>
              <button class="question">
                <a href="16_qna.php">문의하기</a>
              </button>
              <p style="font-size: small">
                <br />Copyright © 2023 Explay.co.,Ltd. All rights reserved.
              </p>
              <p style="font-size: small">Contact us. 070-1234-5678</p>
            </div>
          </div>
          <div class="footer2">
            <!-- 최종 이미지로 교체 잊지말기/ 배경 따로 줄거니까 투명처리 필수 -->
            <img src="img_files/map_투명2.png" width="720px" height="200px" />
          </div>
        </div>
        <!-- footer -->
      </div>
    </form>
  </body>
</html>
