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
        session_start();
        if(!(isset($_SESSION['email']))){
        echo '<div class="login"><a href="login.php">LOGIN</a></div>';
        }
        else{
          echo '<div class="login"><a href="logout.php">LOGOUT</a></div>';
          echo $_SESSION['email'].'<br>';
          echo $_SESSION['user_code'];
        }
        ?>
        <nav class="menu">
          <div class="go_page_post">
            <a href="4_post_main.html">POST</a>
          </div>
          <div class="go_page_challenge">
            <a href="7_challenge_main.html">CHALLENGE</a>
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