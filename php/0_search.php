<?php
    include_once "function_DB_conn.php";
    include_once "getdata.php";

    // DB 연결
    $conn = DB_conn();
    
    if(isset($_POST['search'])){
        $search = $_POST['search'];

        if($search == "search_post"){
        
            // 각 input 저장
            $txt = getData('search_txt');
            //$tag_1 = getTagData();
            //$tag_2 = changeTagData($tag_1);

            if($txt != NULL){
                $sql = "SELECT P_code FROM posting WHERE P_title like ? AND P_on_off = 1 ORDER BY P_created DESC";
                $stmt = $conn->prepare($sql);
                $searchTxt = "%".$txt."%";
                $stmt->bind_param("s", $searchTxt);
                $stmt->execute();
                $stmt->bind_result($pCode);
        
                $result = array();

                while( $stmt->fetch()){
                    $result[] = $pCode;
                }
                
                session_start();
                unset($_SESSION['search_ch_result']);
                $_SESSION['search_po_result'] = $result;
                header("Location: 12_search_result_post.php");
                
            }
            else {
                echo "검색어가 없습니다";
            }
        
        }
        else if($search == 'search_challenge'){
            $txt = getData('search_txt');
            //$tag_1 = getTagData();
            //$tag_2 = changeTagData($tag_1);

            if($txt != NULL){
                $sql = "SELECT CH_code FROM challenge WHERE CH_title like ? AND CH_on_off = 1 ORDER BY CH_created DESC";
                $stmt = $conn->prepare($sql);
                $searchTxt = "%".$txt."%";
                $stmt->bind_param("s", $searchTxt);
                $stmt->execute();
                $stmt->bind_result($chCode);
                
                $result = array();

                while( $stmt->fetch()){
                    $result[] = $chCode;
                }
                session_start();
                unset($_SESSION['search_po_result']);
                $_SESSION['search_ch_result'] = $result;
                header("Location: 12_search_result_post.php");
            }
            else {
                echo "검색어가 없습니다";
            }
        }
    }
?> 