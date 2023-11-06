<?php
    
    include ('db.php');
    include ('login_s.php');

    if ($email==$row['Email'] && $passwd==$row['Password']) {
        session_start();
        $_SESSION['email'] = $row['Email'];
        $_SESSION['user_code'] = $row['User_code'];
        echo "<script>alert('로그인 되었습니다.');
        location.replace('index.php');</script>";
        exit;
     }
    
     //결과가 존재하지 않으면 로그인 실패
     else{
       echo "<script>alert('아이디 또는 패스워드를 틀렸습니다.');history.back();</script>";
        exit;
     }
    // if(isset($_POST['email']) && isset($_POST['password'])){
    //     // login.php에서 입력한 내용이 존재한다면
        
    //     // 오류 검사
    //     if(empty($email)){
    //         header("location: login.php?error=이메일이 비어있습니다.");
    //         exit();
    //     }

    //     else if(empty($passwd)){
    //         header("location: login.php?error=비밀번호가 비어있습니다.");
    //         exit();
    //     }

    //     else{
    //         $sql = "select * from user where email = '$email' and password = '$passwd'";
    //         $result = mysqli_query($db, $sql);

    //         if(mysqli_num_rows($result) === 1){ //아이디가 일치하는 경우
    //             $row = mysqli_fetch_assoc($result);
    //             // print_r($row); // 출력함수, 배열 출력 => echo는 배열 출력 X
    //             // var_dump($row); // 출력함수, 배열 출력, print_r()에서 배열 내 값의 자료형도 출력

    //             $hash = $row['Password'];

    //             if(password_verify($passwd, $hash)){
    //                 // header("location: login.php?success=로그인에 성공했습니다.");
    //                 echo "<script>location.href='index.php';</script>";
    //                 }
    //             else{
    //                 header("location: login.php?error=로그인에 실패했습니다.");
    //                 exit();
    //             }
    //         }
    //         else{
    //             header("location: login.php?error=로그인에 실패했습니다.");
    //             exit();
    //         }
    //     }
    // }
    // else{
    //     header("location: login.php?error=알 수 없는 오류가 발생했습니다.");
    //             exit();
    // }
?>