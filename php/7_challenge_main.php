<?php
  include "select_DB.php";
  include "print_DB.php";
              
  $ch_main = selectByLatest('challenge');
  $usercode ='1';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Explay_challenge_Main</title>
  <link rel="stylesheet" type="text/css" href="register.css" />
  <link rel="stylesheet" type="text/css" href="modal.css" />

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
</head>

<body>
  <form action="0_search.php" method="post">
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
              <li><a href="4_post_main.html">POST</a></li>
              <li><a href="7_challenge_main.html">CHALLENGE</a></li>
              <li><a href="13_mypage.html">MY PAGE</a></li>
              <!-- 로그인 이전, 이후 페이지 이동 다름 -->
              <li><a href="15_notice.html">NOTICE</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- body -->
      <div id="body">
        <!-- hidden 추가 -->
      <input type="hidden" name="search" value="search_challenge">
        <div class="post">
          <p><br />Challenges</p>
          <br />
          <!-- 소주제 태그 -->
          <div class="tag">
            <!-- 이미 토글로 선택된 조건 reset되고 전체선택으로 바뀌게 -->
            <select name="mbti">
              <option value="null">MBTI</option>
              <option value="ISTJ">ISTJ</option>
              <option value="ISFJ">ISFJ</option>
              <option value="INFJ">INFJ</option>
              <option value="INTJ">INTJ</option>
              <option value="ISTP">ISTP</option>
              <option value="ISFP">ISFP</option>
              <option value="INFP">INFP</option>
              <option value="INTP">INTP</option>
              <option value="ESTP">ESTP</option>
              <option value="ESFP">ESFP</option>
              <option value="ENFP">ENFP</option>
              <option value="ENTP">ENTP</option>
              <option value="ESTJ">ESTJ</option>
              <option value="ESFJ">ESFJ</option>
              <option value="ENFJ">ENFJ</option>
              <option value="ENTJ">ENTJ</option>
            </select>

            <select name="bloodtype">
              <option value="null">혈액형</option>
              <option value="O">O</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="AB">AB</option>
            </select>

            <select name="time">
              <option value="null">시간대</option>
              <option value="daybreak">새벽</option>
              <option value="morning">오전</option>
              <option value="afternoon">오후</option>
              <option value="evening">저녁</option>
              <option value="night">밤</option>
            </select>

            <select name="sex">
              <option value="null">성별</option>
              <option value="man">남</option>
              <option value="woman">여</option>
            </select>

            <select name="emotion">
              <option value="null">감정</option>
              <option value="cozy">편안한</option>
              <option value="refreshed">후련한</option>
              <option value="addictive">중독적인</option>
              <option value="surprising">놀라운</option>
              <option value="interesting">흥미로운</option>
              <option value="exciting">활기찬</option>
              <option value="gloomy">울적한</option>
              <option value="anger">열받는</option>
              <option value="boring">따분한</option>
              <option value="nervous">초조한</option>
            </select>

            <select name="age">
              <option value="null">연령대</option>
              <option value="teenage">10대</option>
              <option value="twenty">20대</option>
              <option value="thirty">30대</option>
              <option value="forty">40대</option>
              <option value="fifty">50대</option>
              <option value="sixty">60대</option>
            </select>

            <input type="text" name = "search_txt" class="words" placeholder="검색어입력" />
            <button type="submit" class="searching"><a href="12_search_result_post.php">검색</a></button>
          </div>
          <br /><br /><br />

          <button id="post_writer" onclick="location.href='9_ch_write.php'; return false;">
            새글쓰기
          </button>
          <hr />

          <!-- 고객이 글을 쓸때마다 box가 무한증식 해야하는데 -->
          <!-- 새로운 포스팅이 올라오때마다 박스가 자동으로 하나씩 추가되고
              flex-wrap: wrap-reverse, 
              align-content: space-evenly(세로로 두줄 이상될때 사이간격 조정) 써서 
              새로운 글이 맨 앞으로 오게 -->

          <main id="p_main">
            <!-- 정렬 셀렉터 -->
            <div class="sort">
              <select name="sort" id="sort">
                <option value="null">정렬</option>
                <option value="new">최신순</option>
                <option value="comment">댓글순</option>
                <option value="view">조회순</option>
              </select>
            </div>
            <?php
              foreach($ch_main as $ch_code){
                $data = printImg('challenge', $ch_code);
                $img = $data['img'];
                $code = $data['code'];

                echo "<box class='imgbox'>
                        <a href='10_ch_now_read.php?id={$code}' class='btn_open' onClick='javascript:popOpen();'>
                        <img src='$img' alt='포스트이미지' width='250px' height='250px'>
                        </a>
                      </box>";
              }
            ?>
            <!-- 정렬 셀렉터 -->
            <!-- <box class="imgbox"> -->
              <!--팝업 오픈 버튼-->
              <!-- <div class="btn_box">
                <a href="#" class="btn_open" onClick="javascript:popOpen();">
                  <p>challenge img 1</p>
                </a>
              </div> -->
              <!--// 팝업 오픈 버튼-->
            <!-- </box>
            <box class="imgbox">challenge img 2</box>
            <box class="imgbox">challenge img 3</box> -->
          </main>
          <br />
          <hr />

          <p style="color: red; font-weight: 600">
            ※새로운 글이 DB에 업로드 되면 자동으로 맨 왼쪽에 추가 무한스크롤
            구현필요, 30개 이상 (10row) 구현시 상단으로 바로가는 아이콘 추가
          </p>
          <p style="color: red; font-weight: 600">
            #body height값 bouble check!!!
          </p>
        </div>
      </div>

      <!-- 모달팝업 -->
      <div class="modal_bg" onClick="javascript:popClose();"></div>
      <div class="modal_wrap">
        <object data="10_ch_now_read.html" type="" width="100%" height="100%"></object>

        <button class="modal_close" onClick="javascript:popClose();">
          닫기
        </button>
      </div>
      <!-- // 모달팝업 -->
      <!-- footer -->
      <br /><br />
      <div id="footer">
        <div class="footer1">
          <div class="notice">
            <p style="font-weight: 800; font-size: large">고객센터</p>
            <p>오전 10시 - 오후 4시30분 (주말, 공휴일 제외)</p>
            <button class="question">문의하기</button>
            <!-- a 태그 링크로 해도 괜찮을거에용 수현 said -->

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
    </div>
  </form>
  <script>
    function popOpen() {
      var modalPop = $(".modal_wrap");
      var modalBg = $(".modal_bg");

      $(modalPop).show();
      $(modalBg).show();
    }

    function popClose() {
      var modalPop = $(".modal_wrap");
      var modalBg = $(".modal_bg");

      $(modalPop).hide();
      $(modalBg).hide();
    }
  </script>
</body>
</html>