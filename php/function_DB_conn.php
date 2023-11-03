<?php
	function DB_conn() {
		$server = "localhost";
		$user = "root";
		$pw = "";
		$DB = "explay";   // DB 이름 삽입

		$conn = new mysqli($server, $user, $pw, $DB);
		
		if($conn->connect_error){
			echo "데이터베이스와 연결 실패";
		}
		
		return $conn;
	}
?>