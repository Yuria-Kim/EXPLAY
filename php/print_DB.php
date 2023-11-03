<?php
	include_once "function_DB_conn.php";
	include_once "select_DB.php";
	
	// main 페이지 이미지 출력
	function printImg($type, $id) {
		$conn = DB_conn();
		$prints = array();

		if($type == "post"){
			$codename = "P_code";
		}else if($type == "challenge"){
			$codename = "CH_code";
		}else {
			echo "type error";
			return null;
		}
		
		$sql = "SELECT I_contents FROM image_table WHERE $codename = $id LIMIT 1";
		$result = mysqli_query($conn, $sql);

		$row = mysqli_fetch_assoc($result);
		$img = $row['I_contents'];
		
		$print = array(
			'img'=> $img,
			'code'=> $id
		);

		$conn->close();

		return $print;
	}

	// 현재 페이지에 해당하는 값 출력
	function printNow($type, $code) {
		$conn = DB_conn();
		$print = array();
		
		if($type == "post") {
			$table = "posting";
			$title = "P_title";
			$contents = "P_contents";
			$codename = "P_code";
		}
		else if($type == "challenge") {
			$table = "challenge";
			$title = "CH_title";
			$contents = "CH_contents";
			$codename = "CH_code";
		} else {
			echo "type error";
			return;
		}
		
		// 게시글 제목, 내용 담기
		$sql = "SELECT * FROM $table WHERE $codename = $code";
		$result = mysqli_query($conn, $sql);
		
		if($result){
			$row = mysqli_fetch_assoc($result);
			$usercode = $row['User_code'];
			$print['title'] = $row[$title];
			$print['contents'] = $row[$contents];
		}else {
			echo "쿼리 실행 에러";
		}
		
				
		// 유저 닉네임 담기
		$sql = "SELECT Nickname FROM user WHERE User_code = $usercode";
		$result = mysqli_query($conn, $sql);
		
		if($result){
			$row = mysqli_fetch_assoc($result);
			$print['nickname'] = $row['Nickname'];
		}
		
		// 게시글 해당 댓글 담기
		$sql = "SELECT $contents FROM Comment WHERE $codename = $code";
		$reslut = mysqli_query($conn, $sql);
		
		if($result){
			$row = mysqli_fetch_assoc($result);
			if(isset($row[$contents])){
				$print['comm'] = $row[$contents];
			}
		}
		// 해당 태그 담기
				
		// 게시글 이미지 담기
		$sql = "SELECT I_contents FROM image_table WHERE $codename = $code AND I_ON_OFF = 1";
		$result = mysqli_query($conn, $sql);

		if($result){
			while($row = mysqli_fetch_assoc($result)) {
				if(isset($row['I_contents'])){
					$print['img'][] = $row['I_contents'];
				}
			}
		}
		
		return $print;
	}

	

	// 문의사항 view 페이지 출력
	function printQnA($id) {
		$conn = DB_conn();

		$sql = "SELECT Q_code, Q_title, Q_contents, Q_created, Q_views, User_code FROM qna WHERE Q_code = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->bind_result($code, $title, $contents, $created, $views, $usercode);
		$stmt->fetch();
		$stmt->close();
		$conn->close();

		$conn = DB_conn();
		$sql2 = "SELECT Nickname FROM user WHERE User_code = ?";
		$stmt2 = $conn->prepare($sql2);
		$stmt2->bind_param("i", $usercode);
		$stmt2->execute();
		$stmt2->bind_result($nickname);
		$stmt2->fetch();
		$stmt2->close();
		$conn->close();

		$print = array(
			'num'=> $code,
			'title'=>$title,
			'contents'=>$contents,
			'created'=>$created,
			'views'=>$views,
			'nickname'=>$usercode
		);

		return $print;
	}

	// 공지사항 view 페이지 출력
	function printNotice($id){
		$conn = DB_conn();

		$sql = "SELECT N_code, N_title, N_contents, N_created, N_views FROM notice WHERE N_code = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->bind_result($ncode, $title, $contents, $created, $views);
		$stmt->fetch();
		$stmt->close();
		$conn->close();

		$print = array(
			'num' => $ncode,
			'title'=> $title,
			'contents'=>$contents,
			'created'=>$created,
			'views'=>$views
		);

		return $print;
	}
	
	// 해당하는 태그 값 담기
	function printTap($type, $code) {
		$conn = DB_conn();
		$Tag = Array(
					'MBTI' => Array('ESFJ','ESFP','ESTJ','ESTP','ENFJ','ENFP','ENTJ','ENTP','ISFJ','ISFP','ISTJ','ISTP','INFJ','INFP','INTJ','INTP'),
					'Bloodtype' => Array('A', 'B', 'AB', 'O'),
					'time' => Array('daybreak', 'moring', 'afternoon', 'evening', 'night'),
					'sex' => Array('man', 'woman'),
					'emotion' => Array('cozy','refreshed','addicitive','surprising','interesting','exciting','gloomy','anger'),
					'age' => Array('teenage','twenty','thirty','forty','fifty','sixty')
		);

		foreach($Tag as $tableName => $columns) {
			$sql = "SELECT * FROM `$tableName` WHERE";
			
		
		
		}	
	}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
?>