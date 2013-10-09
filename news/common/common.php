<?php
/*
 * System name : 汎用
 * File name   : common.php
 * Description : 共通関数郡
 * Author      : N.Taga
 * License     : MIT License
 * Since       : 2013-08-31
 * Modified    : 2013-09-08 N.Taga  関数追加（left, right, set_time_list）
 *             : 2013-09-15 N.Taga  関数更新（disp_error_text, disp_warning_text, disp_confirm_text, disp_warning_text）
 *             : 2013-09-17 N.Taga  関数追加（get_emp_list, get_youbi, get_youbi_jp）
 *             : 2013-09-18 N.Taga  関数追加（get_add_time）
 *             : 2013-09-19 K.Kishi 関数更新（set_time_list）
 *             : 2013-09-21 N.Taga  関数更新（validate：多次元配列に対応）
 *             : 2013-09-24 N.Taga  関数更新（validate：POSTからREQUESTに変更）
 *             : 2013-10-01 K.Kishi 関数更新（disp_error_text：領域の確保を無しに変更）、関数削除（disp_blank_text）
 */


/**
 * 文字列の左から指定された文字数を取得する
 * 
 * @param  string $val       値
 * @param  string $nomber    文字数
 * @param  string $char_code 文字コード
 * @return string 抽出文字
 */
function left($val, $nomber, $char_code = "UTF-8"){
	return mb_substr($val, 0, $nomber, $char_code);
}

/**
 * 文字列の右から指定された文字数を取得する
 * 
 * @param  string $val       値
 * @param  string $nomber    文字数
 * @param  string $char_code 文字コード
 * @return string 抽出文字
 */
function right($val, $nomber, $char_code = "UTF-8"){
	return mb_substr($val, ($nomber) * (-1), $nomber, $char_code);
}

/**
 * REQUESTの値をチェック(REQUESTの特殊文字をHTML用の値に変換)
 *  ※ REQUEST:GET/POST
 * @param  string $require 配列（チェック対象REQUESTのキー）
 * @param  string $check (true:チェック、false:チェックしない）
 *
 * @return boolean（True:チェックOK／False:エラー）
 */
function validate($require, $check = true) {
	
	/* 特殊文字を変換 */
	convert_html_chars($_REQUEST);

	$_SESSION = $_REQUEST;

	if ($check) {
		check_require($require);
	}

	return true;
}

	function convert_html_chars($ary, $flags = ENT_QUOTES, $char_code = "UTF-8"){
		if(is_array($ary)){
			foreach ($ary as $name => $value) {
				$ary[$name] = convert_html_chars($value);
			}
		} else {
			$ary = htmlspecialchars($ary, $flags, $char_code);
		}
		return $ary;
	}

	function check_require($ary){
		if(is_array($ary)){
			foreach ($ary as $name => $value) {
				if(!check_require($value)){return false;};
			}
		} else {
			if(!isset($ary)){return false;}
		}
	}
	

/**
 * 不正URL呼出し時のエラー表示
 *
 * @param  なし
 * @return string 店舗ID
 */
function disp_fraud_url_error() {
	disp_error_text("不正なURLから呼び出された可能性があります。");
	session_destroy();
}

/**
 * 店舗IDを取得
 * 
 * @param  なし
 * @return string 店舗ID
 */
function get_store_id() {
	
	// TODO: 要修正
	$store_id = "10000001";
	
	if (isset($_SESSION['STORE_ID'])) {
		$store_id = $_SESSION['STORE_ID'];
	}
	
	return $store_id;
}

/**
 * ログインIDを取得
 * 
 * @param  なし
 * @return string ログインID
 */
function get_login_id() {
	
	// TODO: 要修正
	$login_id = "willands6";
	
	if (isset($_SESSION['LOGIN_ID'])) {
		$login_id = $_SESSION['LOGIN_ID'];
	}
	
	return $login_id;
}

/**
 * 現在の日時を取得
 * 
 * @param  なし
 * @return string 日時（例：2013/09/01 07:17:56）
 */
function get_time() {
	return date("Y-m-d h:i:s");
}

/**
 * 現在の日時を取得（DB値）
 *
 * @param  なし
 * @return string 日時（例：20130901）
 */
function get_time_db() {
	return date("Ymd");
}

/**
 * 現在日付(表示用)を取得
 *
 * @param  日付（例：2013-09-18） ※ デフォルト値：現在日付
 * @return string 日時（例：2013年09月01日(月）)
 */
function get_disp_date($date = "") {
	
	// 曜日を取得
	$youbi = get_youbi_jp($date);
	
	// 日付を表示用に変換
	if (!empty($date)) {
		$returnValue = date("Y年m月d日({$youbi})", strtotime($date));
	} else {
		$returnValue = date("Y年m月d日({$youbi})");
	}
	
	return $returnValue;
}

/**
 * 曜日を取得(和名)
 *
 * $date   日付（例：2013-09-18） ※ デフォルト値：現在日付
 * @return string 曜日（例：月)
 */
function get_youbi_jp($date = "") {
	
	/* 日付が渡されていない場合、現在日付より取得 */
	if ($date == "") {
		$date = date("Y-m-d");
	}
	
	$week = array("日", "月", "火", "水", "木", "金", "土");
	$time = strtotime($date);
	$w = date("w", $time);
	
	return $week[$w];
}

/**
 * 曜日を取得(値)
 *
 * $date   日付（例：2013-09-18） ※ デフォルト値：現在日付
 * @return string 曜日（例：1[月])
 */
function get_youbi($date = "") {
	
	/* 日付が渡されていない場合、現在日付より取得 */
	if ($date == "") {
		$date = date("Y-m-d");
	}
	
	$time = strtotime($date);

	return date("w", $time);
}

/**
 * 時刻・時間の足し算関数
 * @param string $time : 時間  例：0830
 * @param string $minute : 分（足す時間）例：(30, 45, 60)
 * @return string : 合計時間
 */
function get_add_time($time, $minute) {
		
	$datetime = date_create($time);
		
	/* 時刻を加算し、返却 */
	date_add($datetime, date_interval_create_from_date_string("{$minute} minute"));
	return date_format($datetime, 'Hi');
		
}

/**
 * 従業員のドロップダウンリストを作成
 *
 * @param  string  $name 属性値（name)
 * @param  string  $store_id 店舗ID   ※ デフォルト値：セッション値「店舗ID」
 * @param  string  $emp_id   従業員ID（選択状態にする従業員のID） ※ デフォルト値：選択なし
 * @return string  HTML(ドロップダウンリスト)
 */
function get_emp_list($name, $emp_id = "") {

	$store_id = get_store_id();

	/* 従業員を取得 */
	$sql  = "";
	$sql .= "SELECT ";
	$sql .= "    EMP_ID, ";
	$sql .= "    EMP_NAME ";
	$sql .= "FROM ";
	$sql .= "    TBL_EMP ";
	$sql .= "WHERE ";
	$sql .= "    STORE_ID = ? ";
	$sql .= "AND (DEL_FLG IS NULL OR DEL_FLG = '0') ";
	$sql .= "ORDER BY ";
	$sql .= "    DISP_ORDER ";

	$paramList = array($store_id);

	/* SQLを実行 */
	$empList = sql_select($sql, $paramList);

	print("<select>");

	foreach ($empList as $employee) {
		
		// 初期化
		$selected = "";
		
		if ($emp_id === $employee[0]) {
			$selected = "selected";
		}
		
		print("<option name = '{$name}' value='{$employee[0]}' {$selected}>{$employee[1]}</option>");
	}

	print("</select>");

}

/**
 * 単位毎の時間をセットしたドロップダウンリストを作成
 *
 * @param  string  $name 属性値（name)
 * @param  integer $unit 単位（15, 30) ※ デフォルト値：30
 * @param  string  $selected_time 選択時刻（例：08:00 or 0800） ※ デフォルト値：現在時刻
 * @param  string  $disabled 入力不可に変更 ※ デフォルト値：入力可
 * @return string  HTML(ドロップダウンリスト)
 */
function set_time_list($name, $unit = 30, $selected_time = "", $disabled = "") {
	
	// 選択時刻が設定されていない場合、
	// 現在時刻に近い時刻を選択
	if (empty($selected_time)) {
		
		if (right(date("h:m"), 2) <= 30) {
			$selected_time = date("h30");
		} else {
			$selected_time = date("h00");
		}
	}
	
	$selected_time = str_replace(":", "", $selected_time);
	
	/* ドロップダウンリストを作成 */
	$html  = "<select name='{$name}' {$disabled}>";
	
	for ($hour=0; $hour < 24; $hour++) {
		
		for ($minutes=0; $minutes < 60; $minutes += $unit) {
			
			$set_time = sprintf("%02d:%02d", $hour, $minutes);	// 時刻(表示用)を取得
			$value = sprintf("%02d%02d", $hour, $minutes);		// 値を取得
			
			if ($value === $selected_time) {
				$html .= "<option selected value='{$value}'>{$set_time}</option>";
			} else {
				$html .= "<option value='{$value}'>{$set_time}</option>";
			}
		}
	}

	$html .= "</select>";

	return $html;
}


/***************************************************************
  メッセージ用関数
****************************************************************/

/**
 * エラー用テキストを表示
 *
 * @param  なし
 * @return なし
 */
function disp_error_text($message) {
	if (!empty($message)) {
		print("<p id='text_error'>{$message}</p>");
	}
}

/**
 * 警告用テキストを表示
 *
 * @param  なし
 * @return なし
 */
function disp_warning_text($message) {
	print("<p id='text_warning'>{$message}</p>");
}

/**
 * 確認用テキストを表示
 *
 * @param  なし
 * @return なし
 */
function disp_confirm_text($message = "以下の入力内容で宜しければ更新ボタンを押してください。") {
	print("<p id='text_confirm'>{$message}</p>");
}

/**
 * 完了用テキストを表示
 *
 * @param  なし
 * @return なし
 */
function disp_success_text($message = "更新処理が完了しました。") {
	print("<p id='text_success'>{$message}</p>");
}

/**
 * お知らせ用テキストを表示
 *
 * @param  なし
 * @return なし
 */
function disp_info_text($message) {
	print("<p id='text_info'>{$message}</p>");
}


/***************************************************************
	デバッグ用関数
****************************************************************/

/**
 * 配列内の値を表示
 * 
 * @param  string $arrayList 値
 * @return なし
 */
function debug_get_result_record($table_name) {
	
	/* 指定テーブルの最終更新レコードを取得 */
	$sql = "SELECT * FROM {$table_name} ORDER BY 1 DESC LIMIT 1";
	
	/* SQLを実行 */
	$resultList = sql_select($sql);
	
	/* 取得したレコードを表示 */
	debug_print($resultList);
}

/**
 * 配列内の値を表示
 * 
 * @param  string $arrayList 値
 * @return なし
 */
function debug_print($arrayList) {
	print("<pre>");
	print_r($arrayList);
	print("</pre>");
}

?>