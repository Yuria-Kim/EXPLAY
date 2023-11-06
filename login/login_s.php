<?php
    include 'db.php';
    session_start();
    
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    
    // Prepared statement 사용
    $sql = "SELECT * FROM user WHERE email = ? and password = ?";
    $stmt = mysqli_prepare($db, $sql);

    if (!$stmt) {
        die('Prepared statement 생성 오류: ' . mysqli_error($db));
    }

    mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
    
    if (!mysqli_stmt_execute($stmt)) {
        die('Statement 실행 오류: ' . mysqli_stmt_error($stmt));
    }

    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // 세션 변수 설정
            $_SESSION['email'] = $row['Email'];
            $_SESSION['user_code'] = $row['User_code'];

            $sid = $_SESSION['email'];
            $suser_c = $_SESSION['user_code'];

            // 로그인 성공 후의 처리
            echo "<script>alert('로그인 되었습니다.'); location.replace('index.php');</script>";
            exit();
        } else {
            // 패스워드 불일치 처리
            echo "<script>alert('아이디 또는 패스워드를 틀렸습니다.'); history.back();</script>";
        }
    // Statement와 연결 해제
    mysqli_stmt_close($stmt);
?>