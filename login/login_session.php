<?php
    include 'db.php';
    session_start(); // 세션 사용시 필수로 넣어야 함
    

    $email = mysqli_real_escape_string($db, $_POST['email']);
    $passwd = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT * FROM user WHERE email = ? and password = ?;";
    $result = mysqli_query($db, $sql);

    $row = $result->fetch_array(MYSQLI_ASSOC);

    $_SESSION['email'] = $row['Email'];
    $_SESSION['user_code'] = $row['User_code'];
?>