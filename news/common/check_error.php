<?php
/*
 * System name : 汎用
 * File name   : check_error.php
 * Description : 共通エラーチェック関数郡
 * Author      : N.Taga
 * License     : MIT License
 * Since       : 2013-08-21
 * Modified    : 2013-08-21
 *             : 2013-09-19 K.Kishi 関数追加（chk_err_time）
 *             : 2013-09-28 K.Kishi 関数追加（chk_err_date）
 */


// 外部ファイルを読込み
require_once(dirname(__FILE__) . "/define.php");
require_once(dirname(__FILE__) . "/check.php");


/**
 * エラーメッセージを作成
 * 
 * @param  string $errMsg エラーメッセージ
 * @param  string $val    バインド配列
 * @return string $errMsg エラーメッセージ
 */
function get_err_message($errMsg, $array) {
    
	// 初期化
	$index = 0;
    $errMsg = "* ". $errMsg. "\n";
	
    // エラーメッセージ内にバインド文字列が無い場合
    if (strpos($errMsg, "{". $index. "}") === false) {
        return $errMsg;
    }
    
    // バインド文字列を置換
	foreach ($array as $val) {
		$errMsg = str_replace("{". $index. "}", $val, $errMsg);
		$index++;
	}
    
    return $errMsg;
}


/**
 * 必須チェック
 * 
 * @param  string $val    値
 * @param  string $name   項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_empty($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	if (chk_empty(trim($val))) {
		$errMsg = get_err_message(ERROR_REQUIRED, array($name));
	}
	
	return $errMsg;
}


/**
 * 文字数チェック（文字列の値が、指定文字数を超えていないかを判定する）
 * @param  string $val    値
 * @param  string $length 文字数
 * @param  string $name   項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_length($val, $length, $name) {
	
	// 初期化
	$errMsg = "";
	
	if (chk_length($val, $length)) {
		$errMsg = get_err_message(ERROR_LEN, array($name, $length));
	}
	
	return $errMsg;
}


/**
 * メールアドレス形式チェック
 * 
 * @param  string $val    値(メールアドレス)
 * @param  string $name   項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_email($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_email($val)) {
		$errMsg = get_err_message(ERROR_FORMAT, array($name));
	}
	
	return $errMsg;
}


/**
 * パスワードチェック
 * 
 * @param  string $val    値(パスワード)
 * @param  string $val2   値(パスワード：確認用)
 * @param  string $name   項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_password_match($val, $val2, $name) {
	
	// 初期化
	$errMsg = "";

	// 必須チェック
	$errMsg .= chkErrEmpty($val);
	$errMsg .= chkErrEmpty($val2);
	
	/* 半角英数記号のみかをチェック */
	if (chk_hankakuEisu($val)) {
		$errMsg .= get_err_message(ERROR_HANKAKU_EISU, array($name));
	}
	
	/* 入力されたパスワードおよび確認用パスワードが一致しているかをチェック */
	if ($val !== $val2) {
		$errMsg .= get_err_message(ERROR_MATCH, array($name));
	}
	
	return $errMsg;
}


/**
 * パスワード形式チェック
 * 
 * @param  string $val  パスワード
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_password($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	if (chk_password($val)) {
		$errMsg = $name. ERROR_HANKAKU_EISU. PHP_EOL;
	}
	
	return $errMsg;
}


/**
 * 半角文字チェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_hankaku($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_hankaku($val)) {
		$errMsg = get_err_message(ERROR_HANKAKU, array($name));
	}
	
	return $errMsg;
}


/**
 * 半角英数字チェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_hankakuEisu($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_hankakuEisu($val)) {
		$errMsg = get_err_message(ERROR_HANKAKU_EISU, array($name));
	}
	
	return $errMsg;
}


/**
 * 半角英字チェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_hankakuEiji($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_hankakuEiji($val)) {
		$errMsg = get_err_message(ERROR_HANKAKU_EIJI, array($name));
	}
	
	return $errMsg;
}


/**
 * 数字チェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_num($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_num($val)) {
		$errMsg = get_err_message(ERROR_NUM, array($name));
	}
	
	return $errMsg;
}


/**
 * 数字とハイフンチェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_numHyphen($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_numHyphen($val)) {
		$errMsg = get_err_message(ERROR_NUM_HYPHEN, array($name));
	}
	
	return $errMsg;
}


/**
 * ひらがなチェック
 * 
 * @param  string $val 値
 * @return string $errMsg エラーメッセージ
 */
function chk_err_hiragana($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_hiragana($val)) {
		$errMsg = get_err_message(ERROR_HIRAGANA, array($name));
	}
	
	return $errMsg;
}


/**
 * 全角カタカナチェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_zenkakuKatakana($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_zenkakuKatakana($val)) {
		$errMsg = get_err_message(ERROR_ZENKAKU_KATAKANA, array($name));
	}
	
	return $errMsg;
}


/**
 * 半角カタカナチェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_HankakuKatakana($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_HankakuKatakana($val)) {
		$errMsg = get_err_message(ERROR_HANKAKU_KATAKANA, array($name));
	}
	
	return $errMsg;
}


/**
 * 全角文字を含むかチェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_zenkaku($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_zenkaku($val)) {
		$errMsg = get_err_message(ERROR_ZENKAKU, array($name));
	}
	
	return $errMsg;
}


/**
 * 全て全角文字チェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_zenkakuAll($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_zenkakuAll($val)) {
		$errMsg = get_err_message(ERROR_ZENKAKU_ALL, array($name));
	}
	
	return $errMsg;
}


/**
 * URLの書式チェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_url($val, $name) {
	
	// 初期化
	$errMsg = "";
	
	/* 未入力時、チェックしない */
	if(chk_empty($val)) {
		return;
	}
	
	if (chk_url($val)) {
		$errMsg = get_err_message(ERROR_URL, array($name));
	}
	
	return $errMsg;
}


/**
 * 開始時間<=最終受付時間<=終了時間となっているかチェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_time($val, $name){

	// 初期化
	$errMsg = "";
	
	if (chk_time($val)) {
		$errMsg = get_err_message(ERROR_BUSINESS_TIME, array($name));
	}
	
	return $errMsg;
}


/**
 * 日付の形式チェック
 * 
 * @param  string $val  値
 * @param  string $name 項目名（複数項目時、カンマ区切り）
 * @return string $errMsg エラーメッセージ
 */
function chk_err_date($val, $name){

	// 初期化
	$errMsg = "";
	
	if (chk_date($val)) {
		$errMsg = get_err_message(ERROR_DATE, array($name));
	}
	
	return $errMsg;
}
?>