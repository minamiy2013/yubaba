<?php
	//共通関数呼び出し
	require_once(dirname(__FILE__) . "/./common/common.php");
	require_once(dirname(__FILE__) . "/./common/PDO_DB.php");

	
	//htmlプロパティ代入
	
	$title = "新着情報削除";
	$action = "";
	
	//変数仮代入チェックファイルできたら消去する
	$regist_error = "";
	
	$row = $_POST['row'];
	//削除ボタンがクリックされたら
	for($i=1;$i<=$row;$i++){
		if (isset($_POST["delete_$i"])){
			//チェック処理 チェックファイル完成までコメントアウト
			//require_once(dirname(__FILE__) ."/./common/check_error.php" );
			
			if(empty($regist_error)){
				$id = $_POST["update_id_$i"];
				$date = $_POST["update_date_$i"];
				$caption = $_POST["update_title_$i"];
				$comment = $_POST["update_comment_$i"];
				$url = $_POST["update_url_$i"];
				$up_date = get_time();//common.phpのユーザー関数
				
				$sql = "delete from tbl_news ";
				$sql .= "where news_id = ?";
				$paramList = array($id);
				
				sql_execute($sql,$paramList);
			}
		}
	}

?>