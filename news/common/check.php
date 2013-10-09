<?php
/*
 * System name : 汎用
 * File name   : check.php
 * Description : 共通チェック関数郡
 * Author      : N.Taga
 * License     : MIT License
 * Since       : 2013-08-21
 * Modified    : 2013-08-21
 *             : 2013-09-19 K.Kishi 関数追加（chk_time）
 *             : 2013-09-28 K.Kishi 関数追加（chk_date）
 */


/* オプション定義 */
define('REG_OPTION', 'u');

/* 文字コード指定 */
mb_regex_encoding("UTF-8"); 

/**
 * 必須チェック
 * 
 * @param  string $val  値
 * @return string $blnResult（True:エラー／False:チェックOK）
 */
function chk_empty($val) {
	return empty($val);
}


/**
 * 文字数チェック
 * 
 * @param  string $val    値
 * @param  string $length 文字数
 * @return string $blnResult（True:エラー／False:チェックOK）
 */
function chk_length($val, $length) {
	return (mb_strlen($val) > $length);
}


/**
 * メールアドレス形式チェック
 * 
 * @param  string $val       メールアドレス
 * @return string $blnResult（True:エラー／False:チェックOK）
 */
function chk_email($val) {	
	return !preg_match("/[0-9a-z!#\$%\&'\*\+\/\=\?\^\|\-\{\}\.]+@[0-9a-z!#\$%\&'\*\+\/\=\?\^\|\-\{\}\.]+/" , $val);
}


/**
 * パスワード形式チェック
 * 
 * @param  string $val パスワード
 * @return string（True:エラー／False:チェックOK）
 */
function chk_password($val) {
	return !preg_match( "/[\@-\~]/" , $val);
}


/**
 * 半角文字チェック
 * 
 * @param  string $val 値(メールアドレス)
 * @return string（True:エラー／False:チェックOK）
 */
function chk_hankaku($val) {
	return !preg_match('/^[!-~]*$/', $val);
}


/**
 * 半角英数字チェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_hankakuEisu($val) {
	return !preg_match('/^[a-zA-Z0-9]*$/', $val);
}


/**
 * 半角英字チェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_hankakuEiji($val) {
	return !preg_match('/^[a-zA-Z]*$/', $val);
}


/**
 * 数字チェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_num($val) {
	return !preg_match("/^[0-9]+$/", $val);
}


/**
 * 数字とハイフンチェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_numHyphen($val) {
	return !preg_match('/^[0-9-]*$/', $val);
}


/**
 * ひらがなチェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_hiragana($val) {
	return !preg_match('/^[ぁ-ゞ]*$/' . REG_OPTION, $val);
}


/**
 * 全角カタカナチェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_zenkakuKatakana($val) {
	return !preg_match('/^[ァ-ヶー]*$/' . REG_OPTION, $val);
}


/**
 * 半角カタカナチェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_HankakuKatakana($val) {
	return !preg_match('/^[ｱ-ﾝﾞﾟ]*$/' . REG_OPTION, $val);
}


/**
 * 全角文字を含むかチェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_zenkaku($val) {
	return !preg_match('/[^ -~｡-ﾟ]/' . REG_OPTION, $val);
}


/**
 * 全て全角文字チェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_zenkakuAll($val) {
	return !preg_match('/^[^ -~｡-ﾟ]*$/' . REG_OPTION, $val);
}


/**
 * URLの書式チェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_url($val) {
	return !preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)\.([a-zA-Z]+)$/', $val);
}


/**
 * 開始時間<=最終受付時間<=終了時間となっているかチェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_time($val) {
	for ($i=0; $i<7; $i++) {
		$result = ($val[$i][0] < $val[$i][2]) && ($val[$i][2] < $val[$i][1]);
		if (!$result) {return true;}
	}
	return false;
}


/**
 * 日付の書式チェック
 * 
 * @param  string $val 値
 * @return string（True:エラー／False:チェックOK）
 */
function chk_date($val) {
	return !preg_match('/^(\d{4})年(0[1-9]|1[0-2])月(0[1-9]|[12][0-9]|3[01])日$/', $val);
}

?>