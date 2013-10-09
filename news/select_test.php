<?php
	//共通関数呼び出し
	require_once(dirname(__FILE__) . "/./common/common.php");
	require_once(dirname(__FILE__) . "/./common/PDO_DB.php");

	$date = $_POST['select_date'];
	$caption = $_POST['select_title'];
	$comment = $_POST['select_comment'];
	$url = $_POST['select_url'];
	$up_date = get_time();//common.phpのユーザー関数
	$option = $_POST['option'];
	$row = $_POST['row'];
	
	$tip ="";
	
	//htmlプロパティ代入
	
	$title = "新着情報検索結果";
	$action = "";
	
	//変数仮代入チェックファイルできたら消去する
	$regist_error = "";
	
	//検索ボタンがクリックされたら
	if (isset($_POST['select'])){
		//チェック処理 チェックファイル完成までコメントアウト
		require_once(dirname(__FILE__) ."/./common/check_error.php" );
		
		//文字数チェック
		$regist_error .= chk_err_length($date, "36", "表示日");
		$regist_error .= chk_err_length($caption, "16", "タイトル");
		$regist_error .= chk_err_length($comment, "80", "コメント");
		$regist_error .= chk_err_length($url, "128", "URL");
		
		//入力型チェック
		if(!empty($date)){
			$date = mb_ereg_replace('[^0-9]', '', $date);

		}

		
		$regist_error = nl2br($regist_error);
	
		if(empty($regist_error)){
			//SQL文発行
			$sql = "select news_id, regist_date, title, comment, url_data, update_date from tbl_news where news_id is not null ";
			$paramList = array();
			
			if (!empty($date)) {
			
				if($option == "just"){
					$sql .= "AND ";
					$sql .= "	regist_date LIKE ? ";
					$paramList[] = "%{$date}%";
				}elseif($option == "after"){
					$year = date('Y');
					$year = $year * 10000;
					if($date < $year){
						$date = $date + $year;
					}
					$sql .="and";
					$sql .= "	regist_date >= ? ";
					$paramList[] = "$date";
				}elseif($option == "before"){
					$year = date('Y');
					$year = $year * 10000;
					if($date < $year){
						$date = $date + $year;
					}
					$sql .="and";
					$sql .= "	regist_date <= ? ";
					$paramList[] = "$date";
				}
			}

			if (!empty($caption)) {
				$sql .= "AND ";
				$sql .= "	title LIKE ? ";
				$paramList[] = "%{$caption}%";
			}

			if (!empty($comment)) {
				$sql .= "AND ";
				$sql .= "	comment LIKE ? ";
				$paramList[] = "%{$comment}%";
			}

			if (!empty($url)) {
				$sql .= "AND ";
				$sql .= "	url_data LIKE ? ";
				$paramList[] = "%{$url}%";
			}
			
			$sql .= "limit $row";
			$resultList ="";
			$resultList = sql_select($sql,$paramList);
			$c = count($resultList);
			
			
			if(!empty($resultList[0][0])){
				$i=1;
			$search = <<<EOD
				<div>
					<!--ここから検索結果および更新、削除フォーム-->
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>表示日</th>
								<th>更新タイトル</th>
								<th>更新情報</th>
								<th>URL</th>
								<th>タイムスタンプ</th>
								<th>編集</th>
							</tr>
						</thead>
EOD;
				foreach($resultList as $rows){
					$rows[1] = date("Y年m月d日",strtotime($rows[1]));
					$search .=<<<EOD
						<tr>
							<form id="update_news_{$i}" action="" method="post">
								<td><input type="text" readonly="readonly" value="{$rows[0]}" name="update_id_{$i}" class="id"></td>
								<td><input type="text" name="update_date_{$i}" value="{$rows[1]}" class="date"></td>
								<td><input ytpe="text" name="update_title_{$i}" value="{$rows[2]}" class="caption"></td>
								<td><textarea name="update_comment_{$i}" class="comment">{$rows[3]}</textarea></td>
								<td><input type="text" name="update_url_{$i}" value="$rows[4]" class="url"></td>
								<td><input type="text" name="update_time_{$i}" value="{$rows[5]}" class="update">
								<input type="hidden" value="{$row}" name="row"></td>
								<td><input type="submit" name="update_{$i}" value="編集"></td>
								<td><input type="submit" name="delete_{$i}" value="削除" class="delete" onclick=confirm()></td>
							</form>
						</tr>
					
					
					
EOD;
				$i++;
				}
			echo"</table></div>";
			$tips = "検索結果".$c."件ありました";
			$date = date("Y年m月d日",strtotime($date));
			}else{
				$tips = "該当データなし";
			}
		//error
		}
		$tips = $regist_error;
	}
?>