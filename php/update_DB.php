<?php
	include_once "function_DB_conn.php";
	include_once "select_DB.php";
	
	// 작성된 문의사항 답변을 QnA 테이블에 입력하는 함수
	function updateAnswerData($code, $admincode) {
		$answer = getData('');
		$conn = DB_conn();
		
		$sql = "UPDATE QnA SET Q_answer = ?, Q_check = 1 Admin_id = ?";
		$sql = " WHERE Q_code = ?";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sii", $answer, $admincode, $code);
		
		if(!$stmt->excute()) {
			echo " 데이터 삽입 실패";
		} else {
			echo " 데이터 삽입 성공";
		}
		
		$stmt->close();
		$conn->close();
		
	}
	
	// 글 조회시 조회수 증가 함수
	function updateViews($type, $code) {
		$conn = DB_conn();
		$code = $code;

		if($type == "post") {
			$table = "posting";
			$codename = "P_code";
			$views = "P_views";
		} else if($type == "challenge") {
			$table = "challenge";
			$codename = "CH_code";
			$views = "CH_views";
		} else if($type =="notice") {
			$table = "notice";
			$codename = "N_code";
			$views = "N_views";
		} else if($type == "qna") {
			$table = "qna";
			$codename = "Q_code";
			$views = "Q_views";
		}
		else {
			echo "$type error";
		}
		$sql = "SELECT $views FROM $table WHERE $codename = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $code);
		$stmt->execute();
		$stmt->bind_result($lastview);
		$stmt->fetch();
		$stmt->close();
		
		$nowview = $lastview + 1;
		
		$sql = "UPDATE $table SET $views = ? WHERE $codename = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ii", $nowview, $code);
		$stmt->execute();		
		$stmt->close();
		$conn->close();
	}
	
	// 챌린지 취소 시 Challenge_ing에서 해당 참여 삭제 함수
	function updateCancel($code, $usercode){
		$conn = DB_conn();
		
		$sql = "DELETE FROM Challenge_ing WHERE User_code = ? AND CH_code = ?";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ii", $usercode, $code);
		
		if(!$stmt->excute()) {
			echo "데이터 삭제 실패";
		} else {
			echo "데이터 삭제 성공";
		}
		
		$stmt->close();
		$conn->close();
	}
	
	// 챌린지 참여인원 변동 함수
	function updatePeople($code) {
		$conn = DB_conn();
		$people = selectPeople($code);
		
		$sql = "UPDATE Challenge SET CH_people = ? WHERE CH_code = ?";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ii", $people, $code);
		
		if(!$stmt->excute()) {
			echo "데이터 삽입 실패";
		} else {
			echo "데이터 삽입 성공";
		}

		$stmt->close();
		$conn->close();
	}
	
	// 모집기간 이후 챌린지 노출여부 결정 함수
	function updateCH_On_Off() {
		$conn = DB_conn();
		$now = now();

		$sql = "SELECT CH_code FROM Challenge WHERE CH_before_end = $now";

		$result = mysqli_query($conn, $sql);

		foreach($result as $code){
			$people = selectPeople($code);
			$gaol = selectGoal($code);

			if($people < $goal*0.2) {
				$sql = "UPDATE Challenge SET CH_on_off = 0 WHERE CH_code = $code";

				if(mysqli_query($conn, $sql)) {
					echo "모집인원 미달 처리 성공";
				} else {
					echo "모집인원 미달 처리 실패";
				}
			} 
		}

		$conn->close();
	}

	
?>