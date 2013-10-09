<?php

	if(isset($_POST['logout'])){

// セッション変数を全て解除する
	$_SESSION = array();

// セッションを切断するにはセッションクッキーも削除する。
// Note: セッション情報だけでなくセッションを破壊する。
	if (ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000,
	$params["path"], $params["domain"],
	$params["secure"], $params["httponly"]);}

//セッションを破壊してリダイレクト
	session_destroy();
	header("Location:Login_Screen.php");}

?>

<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta http-equiv="Content-Script-Type" content="text/javascript">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" type="text/javascript"></script>	
		<title>管理者画面</title>
</head>

<body>
	<h1>管理者ページ</h1>

	<form method="POST" id="admin_form">
		<p><input type="button" onclick="location.href='./template.php'" value="新着情報管理">
			<input type="button" onclick="location.href='*'" value="予約情報管理"></p>
	</form>

	<form id="logout_form">
		<p><input type="button" onclick="location.href='./Login_Screen.php'" value="ログアウト"></p>
	</form>
</body>

</html>
