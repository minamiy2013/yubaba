<?php
	require_once(dirname(__FILE__) . "/common/PDO_DB.php");
	require_once(dirname(__FILE__) . "/common/common.php");
	//日付取得
	$now = date('Ymd');
	
	
	$sql = "select regist_date, title, comment, url_data from tbl_news where regist_date <= ".$now." order by regist_date desc limit 5";
	$resultList = sql_select($sql);
	
	//一件目
	$date_1 = $resultList[0][0];
	$caption_1 = $resultList[0][1];
	$comment_1 = $resultList[0][2];
	$url_1 = $resultList[0][3];
	//日付の書式を変更
	$date_1 = date("Y年m月d日",strtotime($date_1));
	
?>