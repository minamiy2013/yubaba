<?php
	//共通関数呼び出し
	require_once(dirname(__FILE__) . "/./common/common.php");
	require_once(dirname(__FILE__) . "/./common/PDO_DB.php");

	
	//htmlプロパティ代入
	
	$title = "新着情報追加";
	$action = "";
	
	//変数仮代入チェックファイルできたら消去する
	$regist_error = "";
	
	//登録ボタンがクリックされたら
	if (isset($_POST['insert'])){
		//チェック処理 チェックファイル完成までコメントアウト
		//require_once(dirname(__FILE__) ."/./common/check_error.php" );
		
		if(empty($regist_error)){
			$date = $_POST['insert_date'];
			$caption = $_POST['insert_title'];
			$comment = $_POST['insert_comment'];
			$url = $_POST['insert_url'];
			$up_date = get_time();//common.phpのユーザー関数
			echo$date ."<br>".$comment ."<br>".$url."<br>".$up_date."<br>".$caption;
			//SQL文発行
			$sql = "insert into 'news'";
			$sql .= "('registration_date',";
			$sql .= "'title','comment','update_date','url_data')";
			$sql .= "values(?,?,?,?,?)";
			
			$paramList = array("$date","$caption","$comment","$up_date","$url");
			
			sql_execute($sql,$paramList);
			
			$tips = "登録完了！<a href='topページのURL'>こちら</a>で確認できます";
			
			
		}else {
			//エラー表示
		}
	}
?>