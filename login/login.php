<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Explay_register</title>
    <link rel="stylesheet" type="text/css" href="register.css" />
  </head>
  <body>
    <form action="login_server.php" method="post" name="login">
      <div id="wrap">
        <!-- body -->
        <body>
          <div class="container">
            <button class="bustom-btn btn-4">
              <a href="index.php">HOME</a>
            </button>
            <!-- wrapper -->
            <div id="wrapper">
              <!-- content-->
              <div id="content">
                <!-- EMAIL -->
                <div>
                  <h3 class="join_title">
                    <label for="email">이메일</label>
                  </h3>
                  <span class="box int_email">
                    <input
                      type="text"
                      name="email"
                      id="email"
                      class="int"
                      maxlength="100"
                      placeholder="ex) abc@gmail.com"
                    />
                  </span>
                  <span class="error_next_box"
                    >이메일 주소를 다시 확인해주세요.</span
                  >
                </div>

                <!-- PW1 -->
                <div>
                  <h3 class="join_title">
                    <label for="pswd1">비밀번호</label>
                  </h3>
                  <span class="box int_pass">
                    <input
                      type="password"
                      name="password"
                      id="pswd1"
                      class="int"
                      maxlength="20"
                    />
                    <span id="alertTxt">사용불가</span>
                    <img
                      src="m_icon_pass.png"
                      id="pswd1_img1"
                      class="pswdImg"
                    />
                  </span>
                  <span class="error_next_box"></span>
                </div>

                <!-- JOIN BTN-->
                <div class="btn_area">
                  <button type="button" id="btnJoin">
                    <span><a href="index.php">로그인</a></span>
                  </button>
                  <br />
                  <br />
                </div>
                <!-- <button type="button" id="btn_re">비밀번호 재설정</button>
                              <button type="button" id="btn_re">회원가입</button>
                              <br>
                              <br> -->
                <button class="custom-btn btn-5">
                  <span><a href="findpw.php">비밀번호 찾기</a></span>
                </button>
                <button class="custom-btn btn-5">
                  <span><a href="register.php">회원가입</a></span>
                </button>
                <br />
                <br />
                <br />
                <br />

                <div class="another_join">
                  <img
                    src="img_files/btn_sns/btn_naver_register.gif"
                    width="260px"
                    alt="naver_login"
                    class="joinnaver"
                  />
                  <img
                    src="img_files/btn_sns/btn_kakao_register.gif"
                    width="260px"
                    alt="kakao_login"
                    class="joinkakao"
                  />
                </div>
              </div>
              <!-- content-->
            </div>

            <!-- wrapper -->
          </div>
        </body>

        <!-- footer -->
      </div>
    </form>
    <script>
      $(function () {
        $("#confirm").click(function () {
          modalClose(); //모달 닫기 함수 호출

          //컨펌 이벤트 처리
        });
        $("#modal-open").click(function () {
          $("#popup").css("display", "flex").hide().fadeIn();
          //팝업을 flex속성으로 바꿔준 후 hide()로 숨기고 다시 fadeIn()으로 효과
        });
        $("#close").click(function () {
          modalClose(); //모달 닫기 함수 호출
        });
        function modalClose() {
          $("#popup").fadeOut(); //페이드아웃 효과
        }
      });
    </script>
  </body>
</html>
