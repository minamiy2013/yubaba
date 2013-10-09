
<?php
	//共通関数呼び出し
	require_once(dirname(__FILE__) . "/./common/common.php");
	require_once(dirname(__FILE__) . "/./common/PDO_DB.php");

	
	//htmlプロパティ代入
	
	$title = "新着情報更新";
	$action = "";
	
	//変数仮代入チェックファイルできたら消去する
	$regist_error = "";
	
	$row = $_POST['row'];
	//更新ボタンがクリックされたら
	for($i=1;$i<=$row;$i++){
		if (isset($_POST["update_$i"])){
			$id = $_POST["update_id_$i"];
			$date = $_POST["update_date_$i"];
			$caption = $_POST["update_title_$i"];
			$comment = $_POST["update_comment_$i"];
			$url = $_POST["update_url_$i"];
			$up_date = get_time();//common.phpのユーザー関数

			//チェック処理 チェックファイル完成までコメントアウト
			require_once(dirname(__FILE__) ."/./common/check_error.php" );
			
			//必須チェック
			$regist_error .= chk_err_empty($date, "表示日");
			$regist_error .= chk_err_empty($caption, "タイトル");
			$regist_error .= chk_err_empty($comment, "コメント");
			$regist_error .= chk_err_empty($url, "URL");
			
			//文字数チェック
			$regist_error .= chk_err_length($date, "32", "表示日");
			$regist_error .= chk_err_length($caption, "16", "タイトル");
			$regist_error .= chk_err_length($comment, "80", "コメント");
			$regist_error .= chk_err_length($url, "20", "URL");
			
			//入力型チェック
			$date = mb_ereg_replace('[^0-9]', '', $date);
			$date = date("Y年m月d日",strtotime($date));
			$regist_error .= chk_err_date($date, "表示日");
			$date = mb_ereg_replace('[^0-9]', '', $date);

			$regist_error .= chk_err_url($url, "URL");

			
			$regist_error = nl2br($regist_error);

			if(empty($regist_error)){
				
				$sql = "update tbl_news set regist_date = ?, title = ?, comment = ?, url_data = ?, update_date = ? ";
				$sql .= "where news_id = ?";
				$paramList = array($date, $caption, $comment, $url, $up_date, $id);
				
				sql_execute($sql,$paramList);
				
				$tips = "更新完了しました。";
			}
			$tips = $regist_error;
		}
	}

?>