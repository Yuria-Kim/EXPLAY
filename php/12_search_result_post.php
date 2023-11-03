<?php
    include_once "function_DB_conn.php";
    include "0_search.php";


    session_start();
    if(isset($_SESSION['search_po_result'])){
        $result = $_SESSION['search_po_result'];
        $conn = DB_conn();
        
        if(!empty($result)){
            $post_result = array();

            // 프로필 이미지 유저 닉네임 게시글 제목 작성일자 게시글 내용
            foreach($result as $code) {
                $sql = "SELECT P_code, P_title, P_contents, P_created, User_code FROM posting WHERE P_code = ? AND P_on_off = 1";
                $stmt = $conn->prepare($sql);

                $stmt->bind_param("i", $code);
                $stmt->execute();
                $stmt->bind_result($pcode,$title,$contents, $created, $usercode);
                $stmt->fetch();
                $user_id = $usercode;
                $stmt->close();

                // 닉네임과 이미지 한번에 가져오는 쿼리
                // $sql = "SELECT user.Nickname, image_table.I_profile FROM user JOIN 
                //         image_table ON user.user_code = image_table.User_code WHERE User_code = ?";
                // $stmt = $conn->prepare($sql);
                // $stmt->bind_param("i", $user_id);
                // $stmt->execute();
                // if (!$stmt->execute()) {
                //     die("Error executing SQL statement: " . $stmt->error);
                // }
                // $stmt->bind_result($nickname, $profile);
                // $stmt->fetch();
                // $stmt->close();

                // 닉네임만 가져오는 쿼리
                $sql = "SELECT Nickname FROM user WHERE User_code = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i",$user_id);
                $stmt->execute();
                $stmt->bind_result($nickname);
                $stmt->fetch();
                $stmt->close();

                $post_result[] = array(
                    'pcode'=> $pcode,
                    'title'=> $title,
                    'contents'=> $contents,
                    'created'=> $created,
                    'usercode'=> $usercode,
                    'nickname'=> $nickname
                    //'profile'=> $profile
                );
            }
        }
    }else if(isset($_SESSION['search_ch_result'])){
            $result = $_SESSION['search_ch_result'];
            $conn = DB_conn();
            
            if(!empty($result)){
                $challenge_result = array();
    
                // 프로필 이미지 유저 닉네임 게시글 제목 작성일자 게시글 내용
                foreach($result as $code) {
                    $sql = "SELECT CH_code, CH_title, CH_contents, CH_created, User_code FROM challenge WHERE CH_code = ? AND CH_on_off = 1";
                    $stmt = $conn->prepare($sql);
                    
                    $stmt->bind_param("i", $code);
                    $stmt->execute();
                    $stmt->bind_result($chcode,$title,$contents,$created,$usercode);
                    $stmt->fetch();
                    $user_id = $usercode;
                    $stmt->close();
    
                    // 닉네임과 이미지 한번에 가져오는 쿼리
                    // $sql = "SELECT user.Nickname, image_table.I_profile FROM user JOIN 
                    //         image_table ON user.user_code = image_table.User_code WHERE User_code = ?";
                    // $stmt = $conn->prepare($sql);
                    // $stmt->bind_param("i", $user_id);
                    // $stmt->execute();
                    // if (!$stmt->execute()) {
                    //     die("Error executing SQL statement: " . $stmt->error);
                    // }
                    // $stmt->bind_result($nickname, $profile);
                    // $stmt->fetch();
                    // $stmt->close();
    
                    // 닉네임만 가져오는 쿼리
                    $sql = "SELECT Nickname FROM user WHERE User_code = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i",$user_id);
                    $stmt->execute();
                    $stmt->bind_result($nickname);
                    $stmt->fetch();
                    $stmt->close();
    
                    $challenge_result[] = array(
                        'chcode'=> $chcode,
                        'title'=> $title,
                        'contents'=> $contents,
                        'created'=> $created,
                        'usercode'=> $usercode,
                        'nickname'=> $nickname
                        //'profile'=> $profile
                    );
                    foreach($challenge_result as $data){
                        if(!empty($data['chcode'])){echo $data['chcode'].$data['title'];}
                        else {echo "뭔가 잘못됨";}
                        
                    }
                }
            }
    }else {
        echo "session result null";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search_result</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="searching.css">
</head>

<body>
    <form action="#" method="post">
        <div id="wrap">
            <!-- header -->
            <div id="header">
                <div class="logo">logo</div>
                <div id="h_main">
                    <div class="main1">
                        <div class="title"><a href="index.html">explay(title)</a></div>
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
            <!-- header -->
            <!-- body -->
            <div id="search_wrap">
                <h2>검색결과</h2>
                <hr>
                <?php
                if(empty($post_result) && empty($challenge_result)){
                    echo "<div class='search_each_wrap'>
                                검색 결과가 없습니다.
                                </div>";
                }
                else {
                    if(!empty($post_result)){
                        foreach($post_result as $data) {
                            //<img src="'.$data['profile'].'" alt="" class="s_img">
                            echo '<div class="search_each_wrap">
                                <div class="s_user">
                                    <div class="s_name">'.$data['nickname'].'</div>
                                </div>
                                <div class="s_title">
                                    <h3><a href="5_po_now_read1029.php?id='.$data['pcode'].'">'.$data['title'].'</a></h3>
                                </div>
                                <div class="s_contents">
                                    <span class="s_date">'.$data['created'].'</span>
                                    <p>&nbsp;ㅡ&nbsp;</p>
                                    <p class="#">'.$data['contents'].'</p>
                                </div>
                                </div>';
                        }
                    }
                    if(!empty($challenge_result)){
                        foreach($challenge_result as $data) {
                            //<img src="'.$data['profile'].'" alt="" class="s_img">
                            echo '<div class="search_each_wrap">
                                <div class="s_user">
                                    <div class="s_name">'.$data['nickname'].'</div>
                                </div>
                                <div class="s_title">
                                    <h3><a href="10_ch_now_read.php?id='.$data['chcode'].'">'.$data['title'].'</a></h3>
                                </div>
                                <div class="s_contents">
                                    <span class="s_date">'.$data['created'].'</span>
                                    <p>&nbsp;ㅡ&nbsp;</p>
                                    <p class="#">'.$data['contents'].'</p>
                                </div>
                                </div>';
                        }
                    }
                }
                ?>
                <!-- <div class="search_each_wrap">
                    <div class="s_user">
                        <img src="img_files/profilesample.jpg" alt="" class="s_img">
                        <div class="s_name">이민수</div>
                    </div>
                    <div class="s_title">
                        <h3><a href="#">하루에 5000보 이상 걷기</a></h3>
                    </div>
                    <div class="s_contents">
                        <span class="s_date">2023.10.28</span>
                        <p>&nbsp;ㅡ&nbsp;</p>
                        <p class="#">매일 꾸준히 걷는 습관은 면역력을 높이는데 좋다네요. 뭐라뭐라. 블라블라</p>
                    </div>
                </div> -->
                <hr>
            </div>
            <!-- body -->
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