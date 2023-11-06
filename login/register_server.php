<?php
    
    include ('db.php');
    
    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_check']) && isset($_POST['nickname']) ){
    // form에서 받은 내용이 존재한다면 실행

        // 보안 코딩
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $passwd = mysqli_real_escape_string($db, $_POST['password']);
        $passwd_check = mysqli_real_escape_string($db, $_POST['password_check']);
        $nickname = mysqli_real_escape_string($db, $_POST['nickname']);
        $register_day = date("Y-m-d (H:i:s)");  // 현재의 '년-월-일-시-분-초'를 저장

        // 오류 검사
        if(empty($email)){
            header("location: register.php?error=이메일이 비어있습니다.");
            exit();
        }
        else if(empty($passwd)){
            header("location: register.php?error=비밀번호가 비어있습니다.");
            exit();
        }
        else if(empty($passwd_check)){
            header("location: register.php?error=비밀번호 재확인이 비어있습니다.");
            exit();
        }
        else if($passwd !== $passwd_check){
            header("location: register.php?error=비밀번호가 일치하지 않습니다.");
            exit();
        }
        else if(empty($nickname)){
            header("location: register.php?error=닉네임이 비어있습니다.");
            exit();
        }
        else{
            // 비밀번호 암호화
            // $passwd1 = password_hash($passwd, PASSWORD_DEFAULT);
            
            // 아이디와 닉네임 동시에 중복확인
            $sql = "SELECT * from user where email = '$email' and nickname = '$nickname'";
            $query = mysqli_query($db, $sql);

            if(mysqli_num_rows($query) > 0){
                header("location: register.php?error=아이디 또는 닉네임이 이미 존재합니다.");
                exit();
            }
            else{
                $sql_save = "insert into user(email, password, nickname, created) values('$email', '$passwd', '$nickname', '$register_day')";
                $result = mysqli_query($db, $sql_save);

                if($result){
                    echo "<script>alert('가입에 성공했습니다.');location.replace('login.php');</script>";
                    exit(); 
                }
                else{
                    header("location: register.php?error=회원가입에 실패했습니다.");
                    exit();
                }
            }
        }
    }
    else{
        header("location: register.php?error=알 수 없는 오류가 발생했습니다.");
                exit();
    }
?>