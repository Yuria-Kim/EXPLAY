<?php
	
	// POST 형식으로 보낸 데이터 받는 함수
	// 해당 인자는 '' 형식으로 작성 ex) 'post_title'
	function getData($key) {
		 if(isset($_POST[$key])){
		 	return $_POST[$key];
		 } else {
		 	return NULL;
		 }
	}
	
	// FILE 형식으로 보낸 이미지 받는 함수
	function getImgData($key) {
		if(isset($_FILES['images'])&& !empty($_FILES['images']['name'][0])){
			$images = $_FILES['images'];

			$upload
		}
	}
	
	// 유저가 선태한 태그값 받는 함수
	function getTagData() {
		return $tag = Array($_POST['mbti'], $_POST['bloodtype'], $_POST['time'], $_POST['sex'], $_POST['emotion'], $_POST['age']);
	}
	
	// 유저태그값을 시스템태그와 비교하여 2차원 배열로 가공하는 함수
	function changeTagData($usertag) {
		
	}
	

		
?>