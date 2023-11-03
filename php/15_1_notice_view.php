<?php
  include "print_DB.php";
  include_once "update_DB.php";

  $notice_id = $_GET['id'];
  updateViews('notice', $notice_id);
  $notice = printNotice($notice_id);
?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Explay_Notice_View</title>
    <link rel="stylesheet" href="board.css" />
    <link rel="stylesheet" href="register.css" />
  </head>
  <body>
    <form name="notice_view" action="#" method="post">
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
          <div class="board_view_wrap">
            <div class="board_view">
              <div class="title"><?=$notice['title']?></div>
              <div class="info">
                <dl>
                  <dt>번호</dt>
                  <dd><?=$notice['num']?></dd>
                </dl>
                <dl>
                  <dt>작성자</dt>
                  <dd>관리자</dd>
                </dl>
                <dl>
                  <dt>작성일</dt>
                  <dd><?=$notice['created']?></dd>
                </dl>
                <dl>
                  <dt>조회</dt>
                  <dd><?=$notice['views']?></dd>
                </dl>
              </div>
              <div class="cont">
                <?=$notice['contents']?>
              </div>
            </div>
            <div class="bt_wrap">
              <a href="15_notice.php" class="on">목록</a>
              <a href="15_2_notice_edit.php">수정</a>
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
                <a href="16_qna.html">문의하기</a>
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
