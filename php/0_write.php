<?php
    include_once "insert_DB.php";

    // 세션값으로 유저코드 받기
    $usercode = '2';
    $admincode = '1';

    // 포스트/챌린지/공지사항/문의사항 구분하여 삽입
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        if($action == 'create_post'){
            insertPostData($usercode);

            // 위의 삽입동작 실행 페이지 연결
            header("Location: 4_post_main.php");
        }
        else if($action == 'create_challenge'){
            insertChallengeData($usercode);

            // 위의 삽입동작 실행 페이지 연결
            header("Location: 7_challenge_main.php");
        }
        else if($action == "create_notice"){
            insertNoticeData($admincode);

            // 위의 삽입동작 실행 페이지 연결
            header("Location: 15_notice.php");
        }
        else if($action == "create_qna"){
            insertQnAData($usercode);

            // 위의 삽입동작 실행 페이지 연결
            header("Location: 16_qna_view.php");
        }
    }
    // 댓글 삽입
    else if(isset($_POST['comm'])){
        $comm = $_POST['comm'];
        
        if($comm == "post_comm"){
            insertCommentData($usercode, 'post', $code);

            header("Location: 5_po_now_read1029.php");
        }
        else if($comm == "challenge_comm"){
            insertCommentData($usercode, 'challenge', $code);
            
            header("Location: 10_ch_now_read.php");
        }
    }

?>