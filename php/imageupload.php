<?php
// MySQL 연결 정보
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "explay";

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 이미지 파일을 서버에 업로드하는 부분 (이미지 저장 경로는 상황에 맞게 수정해주세요)
$myTempFile = $_FILES['imgFile']['tmp_name']; // 임시로 저장된 경로
$fileName = $_FILES['imgFile']['name']; // 원래 파일명
$myFile = "img/{$fileName}"; // 지정한 경로에 파일 넣는 변수
$imageUpload = move_uploaded_file($myTempFile, $myFile);

if ($imageUpload) {
    // 이미지 파일이 정상적으로 업로드되었으면 MySQL에 저장
    $sql = "INSERT INTO img (fname, fpath) VALUES ('$fileName', '$myFile')";
    
    if ($conn->query($sql) === TRUE) {
        echo "파일이 MySQL에 정상적으로 저장되었습니다.<br>"; // 저장 끝 부분


        
        // 이미지 불러오기 예제
        $selectQuery = "SELECT * FROM img WHERE fname = '$fileName'";
        $result = $conn->query($selectQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imagePath = $row['fpath'];

            echo "<img src='{$imagePath}' width='200' />";
        } else {
            echo "이미지 불러오기 실패";
        }
    } else {
        echo "MySQL 저장 실패: " . $conn->error;
    }
} else {
    echo "이미지 업로드 실패";
}

// MySQL 연결 종료
$conn->close();
?>
