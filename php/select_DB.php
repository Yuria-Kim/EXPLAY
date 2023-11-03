<?php
	include_once "function_DB_conn.php";
	
	// 조회순 정렬
	function selectByView($type) {
		$conn = DB_conn();
		$codes = array();
		
		if($type == "post") {
			$table = "posting";
			$on_off = "P_on_off";
			$views = "P_views";
			$code = "P_code";
			
		}else if($type == "challenge") {
			$table = "challenge";
			$on_off = "CH_on_off";
			$views = "CH_views";
			$code = "CH_code";
			
		}else {
			echo "$type error";
		}
		
		$sql = "SELECT $code FROM $table WHERE $on_off = 1 ORDER BY $views DESC";
		
		$result = mysqli_query($conn, $sql);
		
		if(!$result) {
			echo "select error";
		}else {
			while($row = mysqli_fetch_assoc($result)){
				$codes[] = $row[$code];
			}
		}

		$conn->close();

		return $codes;
	}
	
	// 댓글순 정렬
	function selectByComm($type) {
		$conn = DB_conn();
		
		if($type == "post") {
			 $table = "Posting";
			 $code = "P_code";
			 
		}else if($type == "challenge") {
			$table = "Challenge";
			$code = "CH_code";
		}else {
			echo "$type error";
		}
		
		$sql = "SELECT $table.$code, IFNULL(c.count,0) as c_count FROM $table";
		$sql = $sql." LEFT JOIN ( SELECT $code, COUNT(C_code) as count FROM Comment GROUP BY $code)";
		$sql = $sql." c ON $table.$code = c.$code ORDER BY c_count DESC";
		
		$result = mysqli_query($conn, $sql);
		
		if(!$result) {
			echo "select error";
		}else {
			while($row = mysqli_fetch_assoc($result)){
				$codes[] = $row[$code];
			}
		}

		$conn->close();

		return $codes;
	}
	
	// 최신순 정렬
	function selectByLatest($type) {
		$conn = DB_conn();
		
		if($type == "post") {
			$table = "posting";
			$on_off = "P_on_off";
			$created = "P_created";
			$code = "P_code";
			
		} else if($type == "challenge") {
			$table = "challenge";
			$on_off = "CH_on_off";
			$created = "CH_created";
			$code = "CH_code";
			
		} else {
			echo "$type error";
		}
		
		$sql = "SELECT $code FROM $table WHERE $on_off = 1 ORDER BY $created DESC";
		$result = mysqli_query($conn, $sql);
		
		$result = mysqli_query($conn, $sql);
		
		if(!$result) {
			echo "select error";
		}else {
			while($row = mysqli_fetch_assoc($result)){
				$codes[] = $row[$code];
			}
		}

		$conn->close();

		return $codes;
	}
	
	// 챌린지 참여 인원 카운트 함수
	function selectPeople($code) {
		$conn = DB_conn();
		
		$sql = "SELECT COUNT(*) FROM Challenge_ing WHERE CH_code = ?";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $code);
		
		if(!$stmt->excute()) {
			echo "데이터 출력 실패";
		} else {
			$people = $stmt->get_result();
		}
		
		$stmt->close();
		$conn->close();
		
		return $people;
	}

	// 챌린지 목표 인원 출력 함수
	function selectGoal($code) {
		$conn = DB_conn();

		$sql = "SELECT CH_goal_people FROM Challenge WHERE CH_code = ?";

		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $code);

		if(!$stmt->excute()) {
			echo "select error";
		} else {
			$goal = $stmt->get_result();
		}

		$stmt->close();
		$conn->close();

		return $goal;
	}

	
	// 유저별 작성 포스트 검색 함수
	function selectUser_Post($usercode) {
		$conn = DB_conn();
		
		$sql = "SELECT P_code FROM Posting WHERE User_code = ?";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $usercode);
		
		if(!$stmt->execute()) {
			echo "select error";
		} else {
			$result = $stmt->get_result();
		}
		
		$stmt->close();
		$conn->close();
		
		return $reasult;
		
	}
	
	// 유저별 참여 챌린지 검색 함수
	function selelctUser_Challenge($usercode) {
		$conn = DB_conn();

		$sql = "SELECT CH_code FROM Challenge_ing WHERE User_code = ?";

		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $usercode);

		if(!$stmt->execute()) {
			echo "select error";
		} else {
			$data = $stmt->get_result();
			while($row = $data->fetch_assoc()){
				$result[] = $row;
			}
		}

		$stmt->close();
		$conn->close();

		return $result;
	}
	
	// 문의사항 전체 검색 함수
	function select_QnA() {
		$conn = DB_conn();

		$sql = "SELECT * FROM qna ORDER BY Q_created DESC";
		$result = $conn->query($sql);
		$data = array();
		
		while($row = $result->fetch_assoc()) {
			$user_id = $row['User_code'];

			$user_sql = "SELECT Nickname FROM user WHERE User_code = $user_id";
			$user_result = $conn->query($user_sql);
			$user_row = $user_result->fetch_assoc();
			$nickname = $user_row['Nickname'];
			
			$tempdata = array(
				'q_code'=>$row['Q_code'],
				'title'=>$row['Q_title'],
				'contetns'=>$row['Q_contents'],
				'created'=>$row['Q_created'],
				'state'=>$row['Q_check'],
				'views'=>$row['Q_views'],
				'usercode'=>$row['User_code'],
				'nickname'=>$nickname
			);
			$data[] = $tempdata;
		}


		return $data;
	}

	// 공지사항 전체 검색 함수
	function select_Notice() {
		$conn = DB_conn();

		$sql = "SELECT * FROM notice ORDER BY N_created DESC";
		$result = $conn->query($sql);
		$data = array();
		
		while($row = $result->fetch_assoc()) {
			$tempdata = array(
				'code'=>$row['N_code'],
				'title'=>$row['N_title'],
				'contetns'=>$row['N_contents'],
				'created'=>$row['N_created'],
				'views'=>$row['N_views']
			);
			$data[] = $tempdata;
		}
		return $data;
	}

	function select_mypage($usercode) {
		$conn = DB_conn();
		$user = array();

		// 닉네임
		$sql = "SELECT Nickname FROM user WHERE User_code = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i",$usercode);
		$stmt->execute();
		$stmt->bind_result($nickname);
		if($stmt->fetch()){
			$user['nickname'] = $nickname;
		}
		$stmt->close();
		

		// 프로필 이미지
		// $sql = "SELECT I_profile FROM image_table WHERE User_code = ? AND I_on_off = 1";
		// $stmt = $conn->prepare($sql);
		// $stmt->bind_param("i", $usercode);
		// $stmt->execute();
		// $stmt->bind_result($profile);
		// if($stmt->fetch()){
		// 	// $user['profile'] = $profile;
		// }
		// $stmt->close();

		// 작성한 포스트
		$sql = "SELECT count(P_code) FROM posting WHERE User_code = ? AND P_on_off = 1";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $usercode);
		$stmt->execute();
		$stmt->bind_result($post_count);
		if($stmt->fetch()){
			$user['post_count'] = $post_count;
		}
		$stmt->close();
		
		// 참여한 챌린지
		$sql = "SELECT count(CH_code) FROM challenge_ing WHERE User_code = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $usercode);
		$stmt->execute();
		$stmt->bind_result($ch_count);
		if($stmt->fetch()){
			$user['ch_count'] = $ch_count;
		}
		
		$stmt->close();

		// 작성한 댓글
		$sql = "SELECT count(C_code) FROM comment WHERE User_code = ? AND C_on_off = 1";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $usercode);
		$stmt->execute();
		$stmt->bind_result($comment_count);
		if($stmt->fetch()){
			$user['comment_count'] = $comment_count;
		}
		
		$stmt->close();
		$conn->close();
		
		
		return $user;

	}
?>