<?php
/*
 * System name : 汎用
 * File name   : PDO_DB.php
 * Description : DB共通処理
 * Author      : N.Taga
 * License     : MIT License
 * Since       : 2013-08-27
 * Modified    : 2013-09-12  N.Taga
 */


/* DB接続情報を読込 */
require_once(dirname(__FILE__) . "/DBConfig.php");


/**
 * SQL実行処理 (SELECT）
 * 
 * @param  string $sql SQL
 * @return string $paramList  パラメータ(配列）※省略可
 */
function sql_select($sql, $paramList = array()) {
	
	/* DB接続文字列を取得 */
	$dsn = get_dsn(DB_SERVER, DB_NAME);
	$i = 0;
	
	try {
		
		/* データベースを接続 */
	    $dbh = new PDO($dsn, DB_USER, DB_PASSWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
		$resultList = Array(Array());
		
		/* SQLを実行 */
		$stmt = $dbh->prepare($sql);
		$stmt->execute($paramList);
		
		
		while($result = $stmt->fetch(PDO::FETCH_BOTH)) {
			for($j=0; isset($result[$j]); $j++) {
		        $resultList[$i][$j] = $result[$j];
			}
			$i++;
	    }

		/* データベースを切断 */
		$dbh = null;
		
	} catch (PDOException $e) {
	    var_dump($e->getMessage());
	} catch (Exception $e) {
		echo "データベース接続エラー: {$e->getMessage()}\n";
	}
	
	// 検索結果を返却
	return $resultList;

}


/**
 * SQL実行処理 (INSERT/UPDATE/DELETE/CREATE）
 * 
 * @param  string $sql  SQL
 * @param  string $paramList  パラメータ(配列）※省略可
 * @return なし
 */
function sql_execute($sql, $paramList = array()) {
	
	/* DB接続文字列を取得 */
	$dsn = get_dsn(DB_SERVER, DB_NAME);
	
	try {
		
		/* データベースを接続 */
	    $dbh = new PDO($dsn, DB_USER, DB_PASSWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
		
		/* SQLを実行 */
		$stmt = $dbh->prepare($sql);
		$stmt->execute($paramList);
		
		/* データベースを切断 */
		$dbh = null;

	} catch (PDOException $e) {
	    var_dump($e->getMessage());
	} catch (Exception $e) {
		echo "データベース接続エラー: {$e->getMessage()}\n";
	}
}



/**
 * DSN取得処理
 * 
 * @param  string $host ホスト名
 * @return string $db   データベース名
 */
function get_dsn($host, $db) {
	return "mysql:host={$host};dbname={$db}";
}


?>