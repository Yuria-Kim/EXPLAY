<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Explay_Challenge_Write</title>
    <link rel="stylesheet" type="text/css" href="register.css" />
  </head>
  <body>
    <form name="ch_write" action="0_write.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="action" value="create_challenge">
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
        <body id="body">
          <div id="ch_wrap">
            <!-- 챌린지 제목 -->
            <input
              name="ch_title"
              type="text"
              class="ch_title"
              size="50"
              placeholder="write challenge`s title."
            />
            <br /><br />

            <!-- 챌린지 본문(사진, 텍스트) -->
            <section class="ch_contents">
              <article class="ch_img">
                <!-- 이미지 삽입 미리보기 박스, 파일선택 버튼 -->
                <div id="p_main">
                  <box class="imgbox">img 1</box>
                  <box class="imgbox">img 2</box>
                  <box class="imgbox">img 3</box>
                </div>
                <br />
                <input type="file" class="ch_in_image" multiple name="images[]" />
                <div class="ch_writing_main">
                  <main id="ch_main">
                    <div class="ch_img_container"></div>
                  </main>
                </div>
              </article>
              <br /><br /><br />
              <article class="ch_text">
                <!-- 챌린지 내용이 들어갈 textarea  -->
                <textarea
                  name="ch_text"
                  id="ch_text"
                  cols="30"
                  rows="10"
                ></textarea>
              </article>
            </section>
            <br /><br /><br />

            <!-- 챌린지 날자정보(모집기간, 활동기간) -->
            <section>
              <p>모집 기간</p>
              <p>Start date to End date</p>
              <br />
              <div class="date_range">
                <div></div>
                <input
                  name="start_date"
                  type="date"
                  class="ch_before_date_start"
                />
                <span> - </span>
                <input name="end_date" type="date" class="ch_before_date_end" />
                <div></div>
              </div>
              <br /><br />

              <p>챌린지 활동 기간</p>
              <p>Start date to End date</p>
              <br />
              <div class="date_range">
                <div></div>
                <input
                  name="ing_start_date"
                  type="date"
                  class="ch_after_date_start"
                />
                <span> - </span>
                <input
                  name="ing_end_date"
                  type="date"
                  class="ch_after_date_end"
                />
                <div></div>
              </div>
            </section>
            <br /><br /><br />

            <!-- 챌린지 인원 -->
            <section>
              <p>챌린지 모집 인원</p>
              <div>
                <input
                  type="number"
                  name="recruitment"
                  id="recruitment"
                  min="1"
                  max="100"
                  step="1"
                  value="1"
                />
                <!-- <h4>N명(현재 신청인원) / 20명(마감인원)</h4> -->
              </div>
            </section>
            <br /><br /><br />

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

              <!-- <button class="tag_submit">등록</button> -->
            </div>

            <br /><br /><br />

            <!-- 챌린지 등록/취소 인풋 타입으로 처리-->
            <footer class="sub_footer">
              <!-- <input type="submit" value="챌린지 등록" /> -->
              <!-- <input type="reset" value="등록 취소" /> -->
              <button class="post_footer_btn" type="submit">포스트 등록</button>
              <button class="post_footer_btn" type="reset">
                <a href="7_challenge_main.php">등록 취소</a>
              </button>
            </footer>
            <br /><br /><br />
          </div>
        </body>

        <!-- footer -->
        <div id="footer">
          <div class="footer1">
            <div class="notice">
              <p style="font-weight: 800; font-size: large">고객센터</p>
              <p>오전 10시 - 오후 4시30분 (주말, 공휴일 제외)</p>
              <button class="question">문의하기</button>

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
  </body>
</html>
