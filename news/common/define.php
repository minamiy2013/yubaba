<?php
/*
 * System name : 汎用
 * File name : define.php
 * Description : 定数郡
 * Author : Taga Naoki
 * License : MIT License
 * Since : 2013-08-21
 * Modified : 2013-08-21
 *          : 2013-09-19 K.Kishi 定数追加（ERROR_BUSINESS_TIME）
 *          : 2013-09-28 K.Kishi 定数追加（ERROR_DATE）
 */


//-----------------------------------------------------------------
// 画面ファイル名
//-----------------------------------------------------------------
define('SCREEN_INPUT', 'input.html');		// 入力画面
define('SCREEN_CONFIRM', 'confirm.html');	// 確認画面
define('SCREEN_FINISH', 'finish.html');		// 完了画面
define('SCREEN_ERROR', 'error.html');		// エラー画面

//-----------------------------------------------------------------
// エラーメッセージ
//-----------------------------------------------------------------

define('ERROR_REQUIRED', '{0}は必須です');
define('ERROR_FORMAT', '正しい{0}を入力してください');
define('ERROR_HANKAKU', '{0}は半角文字で入力してください');
define('ERROR_HANKAKU_EISU', '{0}は半角英数字で入力してください');
define('ERROR_HANKAKU_EIJI', '{0}は半角英字で入力してください');
define('ERROR_NUM', '{0}は半角数字で入力してください');
define('ERROR_NUM_HYPHEN', '{0}は数字とハイフンで入力してください');
define('ERROR_HIRAGANA', '{0}はひらがなで入力してください');
define('ERROR_ZENKAKU_KATAKANA', '{0}は全角カタカナで入力してください');
define('ERROR_HANKAKU_KATAKANA', '{0}は半角カタカナで入力してください');
define('ERROR_ZENKAKU', '{0}は全角文字を含めて入力してください');
define('ERROR_ZENKAKU_ALL', '{0}は全て全角文字で入力してください');
define('ERROR_EMAIL', '{0}はメールアドレスの書式で入力してください');
define('ERROR_MATCH', '{0}が一致しません');
define('ERROR_LEN', '{0}は{1}文字以内で入力してください');
define('ERROR_URL', '{0}はURLの書式で入力してください');
define('ERROR_DENY', 'お使いのホストからのアクセスは管理者によって拒否されています');

define('ERROR_FAILURE_SEND_MAIL', 'メールの送信に失敗しました');
define('ERROR_FAILURE_SEND_AUTO_REPLY', '自動返信メールの送信に失敗しました');

define('ERROR_BUSINESS_TIME', '営業時間を正しく入力してください');
define('ERROR_DATE', '日付を-年-月-日の形式（例：2010年08月08日）で入力してください。');

?>