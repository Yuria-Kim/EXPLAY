<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Main_Page</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"
    ></script>
    <script src="main.js"></script>
  </head>
  <body>
    <div id="fullpage">
      <div class="wrap">
        <div class="logo">EXPLAY</div>
        <?php
          //include "login_session.php";

          // 로그인 여부 판별하여 로그인 로그아웃 출력
          if(!isset($_SESSION['usercode'])){
            echo '<div class="login"><a href="login.php">LOGIN</a></div>';
            echo "null";
          }
          // 로그인 상태일 시 logout으로 출력, 클릭시 logout
          else{
            echo "<div class='login'><a href='logout.php'>LOGOUT</a></div>";
            // echo "usercode".$_SESSION['usercode'];
          }
        ?>
        <nav class="menu">
          <div class="go_page_post">
            <a href="4_post_main.php">POST</a>
          </div>
          <div class="go_page_challenge">
            <a href="7_challenge_main.php">CHALLENGE</a>
          </div>
        </nav>
      </div>

      <div class="quick"><ul></ul></div>
      <img
        src="imgs/2.jpg"
        alt="main_img"
        class="fullsection full1"
        pageNum="1"
      />
      <img
        src="imgs/1.jpg"
        alt="main_img"
        class="fullsection full2"
        pageNum="2"
      />
      <img
        src="imgs/3.jpg"
        alt="main_img"
        class="fullsection full3"
        pageNum="3"
      />
      <img
        src="imgs/4.jpg"
        alt="main_img"
        class="fullsection full4"
        pageNum="4"
      />
    </div>

    <script></script>
  </body>
</html>