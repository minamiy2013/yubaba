<?php

//1ページあたりの表示件数を定数に入れる
define('comments_per_page', 5);

//ページ情報リセット
$page = "";

//正しいパラメータが渡されなかったら1ページ目へ
if(preg_match('/^[1-9][0-9]*$/',@$_GET['page'])){
	$page = (int)$_GET['page'];
}else{
	$page = 1;
}

//日付取得
$now = date('Ymd');

//エラーレポート(不要？)
error_reporting(E_ALL & ~E_NOTICE);

//共通関数呼び出し
require_once(dirname(__FILE__) . "/common/PDO_DB.php");
require_once(dirname(__FILE__) . "/common/common.php");

//オフセットを取得
$offset = comments_per_page * ($page - 1);

//SQL文実行(開始行数は$offset,表示行数はcomment_per_pageで定義)
$sql= "select * from tbl_news where regist_date <= ".$now." order by regist_date desc limit ".$offset.",".comments_per_page;
$resultList=sql_select($sql);

//レコード全体の行数取得
$sql ="select count(*) from tbl_news where regist_date <= ".$now."";
$rows =sql_select($sql);
$total = $rows[0][0];
$totalPages = ceil($total/comments_per_page);

//
$from = $offset + 1;
$to = ($offset + comments_per_page) < $total ? ($offset + comments_per_page): $total;

//新着アイコン表示日数を設定
$days = 7;
$days = $days - 1;
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	
	<body>
		<!--全件数と現在ページの表示件数出力-->
		<p>全<?php echo $total;?>件中、<?php echo$from;?>件～<?php echo$to;?>件を表示してます</p>
		
		
		<!--SQL実行結果を入れた配列を定義リストで出力-->
		<dl>
		<?php foreach($resultList as $result):?>
			<!--newを表示するか否か-->
			<?php if($now <= $result[1] + $days){
				echo"new";
			}?>
			<dt><?php echo date("Y年m月d日",strtotime(htmlspecialchars($result[1],ENT_QUOTES,'UTF-8'))); ?></dt>
			<a href="<?php echo htmlspecialchars($result[4],ENT_QUOTES,'UTF-8'); ?>"><dd><?php echo htmlspecialchars($result[2],ENT_QUOTES,'UTF-8'); ?></dd>
			</a>
		<?php endforeach;?>
		</dl>
		
		
		<!--別ページへのリンク作成-->
		<?php if ($page > 1) : ?>
		<a href="?page=<?php echo$page-1; ?>">前へ</a>
		<?php endif; ?>
		<?php for($i=1;$i<=$totalPages;$i++):?>
			<?php if($page == $i) : ?>
			<strong><a href="?page=<?php echo$i; ?>"><?php echo$i;?></a></strong>
			<?php else:?>
			<a href="?page=<?php echo$i; ?>"><?php echo$i;?></a>
			<?php endif;?>
		<?php endfor;?>
		<?php if ($page < $totalPages) : ?>
		<a href="?page=<?php echo$page+1; ?>">次へ</a>
		<?php endif; ?>
	</body>

</html>
