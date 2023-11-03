<?php
  include "print_DB.php";
  include_once "update_DB.php";


  $post_id = $_GET['id'];
  updateViews('post', $post_id);
  $result = printNow('post',$post_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Post_now_read</title>
  <link rel="stylesheet" href="comment.css" />
  <link rel="stylesheet" href="register.css" />
</head>

<body>

  <div id="wrap">
    <div id="sub_wrap">
      <form action="javascript:void(0)" name="po_now_read" method="post">
        <h2 id="po_read_title"><?=$result['title']?></h2>

        <div id="po_read_mid">
          <div>
            <img id="po_read_trophy" src="img_files/logo_sample.png" alt="챌린지 이미지"><br></img>
          </div>
          <div>
            <p><?=$result['nickname']?></p>
          </div>
        </div>

        <!-- 10.29 이미지 추가 필요 -->
        <article class="ch_img">
          <!-- 사진 -->
          <div id="p_main">
            <?php 
            print_r($result['img']);
              foreach($result['img'] as $img){
                echo "<box class='imgbox'><img src=$img width='250px' height='250px'></box>";
              }
            ?>
            
            <!-- <box class="imgbox">img 2</box> -->
            <!-- <box class="imgbox">img 3</box> -->
          </div>
          <br>
        </article>


        <article>
          <div id="po_read_text">
            <h2><?=$result['contents']?></h2>
          </div>
        </article>

        <!-- 1029 태그 추가 필요 -->
        <div id="po_read_tag">
          <h2>#DB에서 불러온 tag 내용 ex) "#ENFJ #저녁 # 우울함"</h2>
        </div>
      </form>
      <!-- 댓글 -->
      <ul class="comment">
        <li class="comment-form">
          <form id="commentFrm" action="comment.php" method="post">
            <input type="hidden" name="comm" value="post_comm">
            <h4>댓글쓰기 <span></span></h4>
            <span class="ps_box">
              <input type="text" placeholder="댓글 내용을 입력해주세요." class="int" name="content" />
            </span>
            <input type="submit" class="btn" value="등록" />
          </form>
        </li>
        <li id="comment-list"></li>
      </ul>
      <!-- 댓글 -->
    </div>
  </div>
  <script src="comment.js" defer></script>
</body>

</html>