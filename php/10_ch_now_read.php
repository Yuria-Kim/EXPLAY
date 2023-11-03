<?php
    include_once "print_DB.php";
    include_once "update_DB.php";

    $ch_id = $_GET['id'];
    updateViews('challenge', $ch_id);
    $result = printNow('challenge', $ch_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ch_now_read</title>
    <link rel="stylesheet" href="comment.css">
    <link rel="stylesheet" type="text/css" href="register.css">
</head>

<body>
    <div id="wrap">

        <!-- body -->

        <body id="body">
            <div id="sub_wrap">
                <form action="comment.php" name="ch_now_read" method="post">
                    <h2 id="po_read_title"><?=$result['title']?></h2>
                    <div id="po_read_mid">
                        <div>
                            <img id="po_read_trophy" src="img_files/logo_sample.png"><br>#챌린지 이미지</img>
                        </div>
                        <div>
                            <p><?=$result['nickname']?></p>
                        </div>
                    </div>
                    <article class="ch_img">
                        <!-- 사진 -->
                        <div id="p_main">
                        <?php 
                            foreach($result['img'] as $img){
                                echo "<box class='imgbox'><img src=$img width='250px' height='250px'></box>";
                            }
                        ?>
                            <!-- <box class="imgbox">img 1</box>
                            <box class="imgbox">img 2</box>
                            <box class="imgbox">img 3</box> -->
                        </div>
                        <br>
                    </article>
                    <article>
                        <div id="po_read_text">
                            <h2><?=$result['contents']?></h2>
                        </div>
                    </article>
                    <div id="po_read_tag">
                        <h2>#DB에서 불러온 tag 내용 ex) "#ENFJ #저녁 # 우울함"</h2>
                    </div>
                </form>


                <!-- 댓글 -->
                <ul class="comment">
                    <li class="comment-form">
                        <form id="commentFrm" action="comment.php" method="post">
                            <input type="hidden" name="comm" value="challenge_comm">
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

        </body>
    </div>

    <script src="comment.js"></script>
</body>

</html>