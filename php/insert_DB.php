<?php
	include_once 'function_DB_conn.php';
	include 'getData.php';
	include 'update_DB.php';
	
	// 식별코드를 인자로 받아 해당 이미지 Image 테이블에 입력하는 함수
	function insertImgData($type, $code) {
		$conn = DB_conn();
		if($type != "profile"){
			if($type =="post") {
				$codename = "P_code";
				$file = "post";
			}else if($type == "challenge"){
				$codename = "CH_code";
				$file = "challenge";
			}else if($type == "comment"){
				$codename = "C_code";
				$file = "comment";
			}

			if(isset($_FILES['images'])&& !empty($_FILES['images']['name'][0])){
				$images = $_FILES['images'];

				$uploaded = [];

				foreach($images['name'] as $key => $name){
					$tmp_name = $images['tmp_name'][$key];
					$encodingname = urlencode($name);
					$path = "uploads/$file/$encodingname";

					if(move_uploaded_file($tmp_name, $path)){
						$sql = "INSERT INTO image_table(I_contents, $codename) VALUES (?,?)";

						$stmt = $conn->prepare($sql);
						$stmt->bind_param("si", $path, $code);
						
						if($stmt->execute()){
							echo "이미지 삽입 성공";
						}else{
							echo "삽입실패";
						}
					}
					else {
						echo "이미지 업로드 실패";
					}
				}
			}
		}else {
			$tmp_name = $_FILES['imgFile']['tmp_name'];
			$name = $_FILES['imgFile']['name'];
			$path = "uploads/profile/$name";

			if(move_uploaded_file($tmp_name, $path)){
				$sql = "INSERT INTO image_table (I_profile, User_code) VALUES (?, ?)";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("si", $path, $code);
				$stmt->execute();
			}
		}

	}

	// 작성된 posting 정보 Posting 테이블에 입력하는 함수
	// mysqli_real_escape_string($conn, 입력값) : String 형의 입력시 SQL인젝션 피하는 함수
	
	function insertPostData($usercode) {
		$title = getData('post_title');
		$contents = getData('post_text');
		//$usertag = getTagData();
		//$tag = changeTagData($usertag);

		$conn = DB_conn();
		
		$sql = "INSERT INTO posting (P_title, P_contents, P_created, P_on_off, User_code)";
		$sql = $sql." VALUES(?, ?, now(), 1, ?)";
		
		$stmt = $conn -> prepare($sql);
		$stmt->bind_param("ssi", $title, $contents, $usercode);
		
		if(!$stmt->execute()) {
			echo "데이터 삽입 실패";
		} else {
			$postId = $stmt->insert_id;
			
			insertImgData('post', $postId);
			//insertTageData($tag, 'post', $postId);
			
			echo "데이터 삽입 성공";
		}
		
		$stmt->close();
		$conn->close();

	}
	
	// 작성된 challenge 정보 Challenge 테이블에 입력하는 함수
	function insertChallengeData($usercode) {
		$title = getData('ch_title');
		$contents = getData('ch_text');
		$before_start = getData('start_date');
		$before_end = getData('end_date');
		$after_start = getData('ing_start_date');
		$after_end = getData('ing_end_date');
		$goal = getData('recruitment');
		
		$conn = DB_conn();
		
		$sql = "INSERT INTO challenge (CH_title, CH_contents, CH_before_start, CH_before_end, ";
		$sql = $sql."CH_start, CH_end, CH_goal_people, CH_created, User_code)";
		
		$sql = $sql." VALUES(?, ?, ?, ?, ?, ?, ?, now(), ?)";
		
		$stmt = $conn -> prepare($sql);
		$stmt->bind_param("ssssssii", $title, $contents, $before_start, $before_end, $after_start, $after_end, $goal, $usercode);
		
		if(!$stmt->execute()) {
			echo '데이터 삽입 실패';
		} else {
			$challengeId = $stmt->insert_id;
			
			insertImgData('challenge', $challengeId);
			//insertTageData($tag, 'challenge', $challengeId);
			
			echo "데이터 삽입 성공";
		}
		
		$stmt->close();
		$conn->close();
		
		// challenge 작성자를 참여인원에 포함
		insertCH_ingData($challengeId, $usercode);

	}
	
	// 작성된 comment 정보 Comment 테이블에 입력하는 함수
	function insertCommentData($usercode, $type, $code) {
		$contents = getData('content');
		$conn = DB_conn();
		
		if($type == "post") {
			$ID_code = "P_code";
		} else if($type == "challenge") {
			$ID_code = "CH_code";
		}else {
			echo "type error";
			return;
		}
		
		
		$sql = "INSERT INTO comment (C_contents, C_created, C_on_off, User_code, $ID_code)";
		$sql = $sql." VALUES (?, now(), 1, ?, ?)";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sii", $contents, $usercode, $code);
		
		if(!$stmt->execute()) {
			echo "데이터 삽입 실패";
		} else {
			$CommentId = $stmt->insert_id;
			
			insertImgData('comment', $CommentId);
			echo "데이터 삽입 성공";
		}
		
		$stmt->close();
		$conn->close();
	}
	
	// 작성된 공지사항을 Notice 테이블에 입력하는 함수
	function insertNoticeData($admincode) {
		$admin = getData('writer');
		$title = getData('title');
		$contents = getData('content');
		$conn = DB_conn();
		
		$sql = "INSERT INTO notice (N_title, N_contents, N_created, Admin_id)";
		$sql = $sql." VALUES (?, ?, now(), ?)";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ssi", $title, $contents, $admincode);
		
		if(!$stmt->execute()) {
			echo "데이터 삽입 실패";
		} else {
			echo "데이터 삽입 성공";	
		}
		
		$stmt->close();
		$conn->close();
	}
	
	// 작성된 문의사항을 QnA 테이블에 입력하는 함수
	function insertQnAData($usercode) {
		$title = getData('title');
		$contents = getData('content');
		$pw = getData('pw');
		//$img = getImgData('');
		
		$sql = "INSERT INTO qna (Q_title, Q_contents, Q_image, Q_pw, Q_created, Q_check, User_code)";
		$sql = $sql." VALUES(?, ?, ?, ?, now(), 0, ?)";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sssii", $title, $contents, $img, $pw, $usercode);
		
		if(!$stmt->execute()) {
			echo "데이터 삽입 실패";
		} else {
			echo "데이터 삽입 성공";
		}
		
		$stmt->close();
		$conn->close();
	}
	
	
	
	
	// 식별코드를 인자로 받아 해당 태그 Tag 테이블에 입력하는 함수
	function insertTag($tag, $type, $code) {
		$conn = DB_conn();
		
		if($type == "post") {
			$sql = "INSERT INTO tag(P_code) VALUES($code)";
		}else if($type == "challenge") {
			$sql = "INSERT INTO tag(CH_code) VALUES($code)";
		}
		
		mysqli_query($conn, $sql);
		
		$tagcode = mysqli_insert_id($conn);
		
	

		// $Tag = Array(
		// 		'MBTI' => Array('ESFJ','ESFP','ESTJ','ESTP','ENFJ','ENFP','ENTJ','ENTP','ISFJ','ISFP','ISTJ','ISTP','INFJ','INFP','INTJ','INTP'),
		// 		'Bloodtype' => Array('A', 'B', 'AB', 'O'),
		// 		'time' => Array('daybreak', 'moring', 'afternoon', 'evening', 'night'),
		// 		'sex' => Array('man', 'woman'),
		// 		'emotion' => Array('cozy','refreshed','addicitive','surprising','interesting','exciting','gloomy','anger'),
		// 		'age' => Array('teenage','twenty','thirty','forty','fifty','sixty')
		// );
		
		// foreach($Tag as $tableName => $columns) {
		// 	$sql = "INSERT INTO `$tableName` (";
		// 	$params = array();
			
		// 	foreach($columns as $columnName) {
		// 		$sql = $sql."`$columnName', ";
		// 		$params[] = "?";
		// 	}
		// }


	}
	
	// 식별코드와 유저코드를 인자로 받아 해당 Challenge_ing 테이블에 입력하는 함수
	function insertCH_ingData($code, $usercode) {
		$conn = DB_conn();
		
		$sql = "INSERT INTO Challenge_ing (CH_code, User_code) VALUES(?, ?)";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ii", $code, $usercode);
		
		if(!$stmt->execute()) {
			echo "데이터 삽입 실패";
		} else {
			echo "데이터 삽입 성공";
		}
		
		$stmt->close();
		$conn->close();
		
	}

	
?>