<?php
// INPUTされたユーザー名とパスワードを変数に代入
	$UserName = @$_POST["user"];
	$PassWd = @$_POST["password"];

	define("USER","user");
	define("PASSWORD","password");

// FILEの呼び出し
	require_once(dirname(__FILE__) . "/common/common.php");
	require_once(dirname(__FILE__) . "/common/PDO_DB.php");

// INPUTされたユーザー名とパスワードと同じものをデータベースから抽出
	$sql = "SELECT user_id, user_password FROM mst_login_account WHERE user_id = ? and user_password = ?";
	$paramList = array($UserName, $PassWd);
	
// 検索処理
	$resultList = sql_select($sql, $paramList);

	session_start();

// ユーザー認証
	if(isset($UserName) and isset($PassWd)){
		if($UserName == @$resultList[0][0] and $PassWd == @$resultList[0][1]){
			$_SESSION["TEST"] = md5(PASSWORD);
				if(isset($_SESSION["TEST"]) && $_SESSION["TEST"] != null && md5(PASSWORD) === $_SESSION["TEST"]){
					print "Login success";
					header ("location: ./Admin_Screen.php");
				}else{
					echo "ユーザ認証に失敗しました。もう一度入力しなおしてください。";}
					session_destroy();
		}else{
			echo "ユーザ認証に失敗しました。もう一度入力しなおしてください。";
			session_destroy();}
	}
?>

<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta http-equiv="Content-Script-Type" content="text/javascript">
		<title>ログイン画面</title>
</head>

<body>
	<h1>ログイン画面</h1>
	<form method="POST">
		<p>ユーザー名：  <input type="text" id="input_user" name="user" value=""></p>
		<p>パスワード：  <input type="password" id="input_password" name="password" value=""></p>
		<p><input type="submit" value="実行"></p>
	</form>
</body>

</html>
