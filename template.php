<?php
	$tips = "";
	if(isset($_POST['insert'])){
		require_once(dirname(__FILE__) . "/insert_test.php");
	}

	if(isset($_POST['select'])){
		require_once(dirname(__FILE__) . "/select_test.php");
	}

	if(isset($_POST[''])){
	
	}

?>

<!DOCUMENT HTML PUBLIC "-//w3c// DTD HTML 4.01//EN" "http://www.org/TR/html4/strict.dtd">

<html lamg=ja>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>test</title>
	<link rel="stylesheet" type="text/css" href="./test.css">
	</head>
	<body>
		<!---ラッパー-->
		<div id="wrap">
			<div>
				<h1>新着情報の管理</h1>
			</div>
			<p><?php echo$tips;?></p>
				<!--ここから登録フォーム-->
				<table>
					<thead>
						<tr>
							<th>表示日</th>
							<th>更新タイトル</th>
							<th>更新情報</th>
							<th>URL</th>
						</tr>
					</thead>
					<form id="insert_news" method="POST" action="">
						<tr>
							<td><input type="text" name="insert_date"></td>
							<td><input type="text" name="insert_title"></td>
							<td><textarea name="insert_comment"></textarea></td>
							<td><input type="text" name="insert_url"></td>
							<td><input type="submit" name="insert" value="追加"></td>
						</tr>
					</form>
				</table>
				<!--ここから検索フォーム-->
				<table>
					<thead>
						<tr>
							<th>表示日</th>
							<th>更新タイトル</th>
							<th>更新情報</th>
							<th>URL</th>
						</tr>
					</thead>
					<form id="select_news" method="POST" action="">
						<tr>
							<td><input type="text" name="select_date"></td>
							<td><input type="text" name="select_title"></td>
							<td><textarea name="select_comment"></textarea></td>
							<td><input type="text" name="select_url"></td>
						<td><input type="submit" name="select" value="検索"></td>
						</tr>
					</form>
				</table>
			<div>
				<!--ここから検索結果および更新、削除フォーム-->
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>表示日</th>
							<th>更新タイトル</th>
							<th>更新情報</th>
							<th>タイムスタンプ</th>
							<th>編集</th>
						</tr>
					</thead>
					<tr>
						<form id="update_news_1">
							<td>phpによるID表示</td>
							<td><input type="text" name="update_date_"></td>
							<td><input ytpe="text" name="update_title_"></td>
							<td><textarea name="update_comment_"></textarea></td>
							<td><input type="text" name="update_time_" value="phpによる現日付表示"></td>
							<td><input type="submit" name="update_" value="編集"></td>
							<td><input type="submit" name="delete_" value="削除"></td>
						</form>
					</tr>
				</table>
			</div>
		</div>
	</body>
<html>