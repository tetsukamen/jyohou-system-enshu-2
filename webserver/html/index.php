<?php
/*
** 初期化及びルーティングを行う
*/

// 初期設定
date_default_timezone_set('Asia/Tokyo'); // タイムゾーンの設定

// ポストされた情報をログファイルに保存
if ($_POST) {
    // カンマ、改行コードを置き換え
    $name = $_POST['name'];
    $name = str_replace(",", "&#44", $name);
    $comment = $_POST['comment'];
    $comment = str_replace(array("\r\n","\r","\n"), '<br>', $comment);
    $comment = str_replace(",", "&#44", $comment);
    // データをcsvに書き込み
    $data = array($name,$comment,date("Y/m/d H:i:s"));
    $line = implode(',', $data);
    $fp = fopen('log.csv', 'a');
    fwrite($fp, $line."\n");
    fclose($fp);
}

$page = 1; // デフォルトは１ページを表示
if ($_GET) {
    if ($_GET['page']) {
        $page = $_GET['page'];
    }
}

// csvのデータを変数に格納
$posts = [];
// ファイルが存在しているかチェックする
if (($handle=fopen('log.csv', 'r'))!==false) {
    // 1行ずつfgetcsv()関数を使って読み込む
    while ($data=fgetcsv($handle)) {
        $posts[] = array($data[0],$data[1],$data[2]);
    }
    fclose($handle);
}
$page_count = ceil(count($posts)/10);

// 存在しないページを指定された場合は404を返す

if ($page>$page_count) {
    include('./404.php');
} else {
    include('./main.php');
}
