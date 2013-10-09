<?php

	$title ="新着情報管理画面";
	$tips = "";
	$search ="";
	
	//各submitボタンが押されたか判定
	if(isset($_POST['insert'])){
		require_once(dirname(__FILE__) . "/insert_test.php");
	}

	if(isset($_POST['select'])){
		require_once(dirname(__FILE__) . "/select_test.php");
	}

	for($i=1;$i<10;$i++){
		if(isset($_POST["update_$i"])){
			require_once(dirname(__FILE__) . "/update_test.php");
		}
	}
	for($i=1;$i<10;$i++){
		if(isset($_POST["delete_$i"])){
			require_once(dirname(__FILE__) . "/delete_test.php");
		}
	}

?>

<!DOCUMENT HTML PUBLIC "-//w3c// DTD HTML 4.01//EN" "http://www.org/TR/html4/strict.dtd">

<html lang=ja>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?php echo$title;?></title>
		<link rel="stylesheet" type="text/css" href="./test.css">
		<link rel="stylesheet" href="./css/validationEngine.jquery.css" type="text/css"/>
		<script src="./js/jquery-1.8.2.min.js" type="text/javascript"></script>
		<script src="./js/languages/jquery.validationEngine-ja.js" type="text/javascript" charset="utf-8"></script>
		<script src="./js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		jQuery(document).ready(function(){
		   jQuery("#insert_news").validationEngine();
		});
		</script>
		<script type="text/javascript">
			function confirm(){
				alert("削除します。よろしいですか？");
			}
		</script>
	</head>
	<body>
		<!---ラッパー-->
		<div id="wrap">
			<div>
				<h1>新着情報の管理</h1>
			</div>
			<p><?php echo$tips;?></p>
			<p><?php echo@$tip;?></p>
				<!--ここから登録フォーム-->
				<div class="contents">
					<table>
						<thead>
							<tr><th colspan="4">更新情報追加</th></tr>
							<tr>
								<th>表示日</th>
								<th>更新タイトル</th>
								<th>更新情報</th>
								<th>URL</th>
							</tr>
						</thead>
						<form id="insert_news" method="POST" action="" class="validate">
							<tr>
								<td><input type="text" name="insert_date" class="validate[required] date"></td>
								<td><input type="text" name="insert_title" class="validate[required] caption"></td>
								<td><textarea name="insert_comment" class="validate[required] comment" ></textarea></td>
								<td><input type="text" name="insert_url" class="validate[required] url"></td>
							</tr>
							<tr>
								<td colspan="4"><input type="submit" name="insert" value="追加"></td>
							</tr>
						</form>
					</table>
				</div>
				<!--ここから検索フォーム-->
				<div class="contents">
					<table>
						<thead>
							<tr><th colspan="6">更新情報検索</th></tr>
							<tr>
								<th>表示日</th>
								<th>オプション</th>
								<th>更新タイトル</th>
								<th>更新情報</th>
								<th>URL</th>
								<th>行数</th>
							</tr>
						</thead>
						<form id="select_news" method="POST" action="">
							<tr>
								<td><input type="text" name="select_date" value="" class="date"></td>
								<td><select name="option">
								<option value="after">より後</option>
								<option value="just" selected>を含む</option>
								<option value="before">より以前</option>
								</select></td>
								<td><input type="text" name="select_title" value="" class="caption"></td>
								<td><textarea name="select_comment" value="" class="comment"></textarea></td>
								<td><input type="text" name="select_url" value="" class="url"></td>
								<td><input type="text" name="row" value="5" class="row"></td>
							</tr>
							<tr>
								<td colspan="6"><input type="submit" name="select" value="検索"></td>
							</tr>
						</form>
					</table>
				</div>
				<div class="contents">
					<?php echo$search?>
				</div>
		</div>
		<p><a href="./Admin_Screen.php">戻る</a></p>
	</body>
</html>