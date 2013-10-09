<?php
	//共通関数呼び出し
	require_once(dirname(__FILE__) . "/./common/common.php");
	require_once(dirname(__FILE__) . "/./common/PDO_DB.php");

	
	//htmlプロパティ代入
	
	$title = "新着情報追加";
	$action = "";
	
	$date = $_POST['insert_date'];
	$caption = $_POST['insert_title'];
	$comment = $_POST['insert_comment'];
	$url = $_POST['insert_url'];
	$up_date = get_time();//common.phpのユーザー関数
	
	$date = mb_ereg_replace('[^0-9]', '', $date);

	
	//変数仮代入チェックファイルできたら消去する
	$regist_error = "";
	
	//登録ボタンがクリックされたら
	if (isset($_POST['insert'])){
		//チェック処理 チェックファイル完成までコメントアウト
		require_once(dirname(__FILE__) ."/./common/check_error.php" );

		//必須チェック
		$regist_error .= chk_err_empty($date, "表示日");
		$regist_error .= chk_err_empty($caption, "タイトル");
		$regist_error .= chk_err_empty($comment, "コメント");
		
		//文字数チェック
		$regist_error .= chk_err_length($date, "32", "表示日");
		$regist_error .= chk_err_length($caption, "16", "タイトル");
		$regist_error .= chk_err_length($comment, "80", "コメント");
		$regist_error .= chk_err_length($url, "128", "URL");
		
		//入力型チェック
		
		//年の入力がなかったら今年として入力
		$year = date('Y');
		$year = $year * 10000;
		if($date < $year){
			$date = $date + $year;
		}
		$date = mb_ereg_replace('[^0-9]', '', $date);
		$date = date("Y年m月d日",strtotime($date));
		$regist_error .= chk_err_date($date, "表示日");
		$date = mb_ereg_replace('[^0-9]', '', $date);
		$regist_error .= chk_err_url($url, "URL");

		
		$regist_error = nl2br($regist_error);

		
		if(empty($regist_error)){
			
			//SQL文発行
			$sql = "insert into tbl_news ";
			$sql .= "(regist_date, ";
			$sql .= "title, comment, update_date, url_data) ";
			$sql .= "values(?,?,?,?,?)";
			
			$paramList = array($date,$caption,$comment,$up_date,$url);
			
			sql_execute($sql,$paramList);
			
			$tips = "登録完了！<a href='topページのURL'>こちら</a>で確認できます";
			
			header("Location:./confirm.php");
			
		}else {
			//エラー表示
			$tips = $regist_error;
		}
	}
?>