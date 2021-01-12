<?php
// レスポンスヘッダの設定
header("HTTP/1.0 200 OK");
header("Server: Apache");
header("Content-Type: text/html");

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
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>シンプル掲示板</h1>

<form method="POST" action="/">
    名前<br>
    <input name="name" type="text"><br>
    コメント<br>
    <textarea name="comment" id="" cols="50" rows="5"></textarea><br>
    <input type="submit" value="書き込む">
</form>

<?php
// csvのデータを変数に格納
$posts = [];
$idx = 0;
// ファイルが存在しているかチェックする
if (($handle=fopen('log.csv', 'r'))!==false) {
    // 1行ずつfgetcsv()関数を使って読み込む
    while ($data=fgetcsv($handle)) {
        $posts[] = array($idx+1,$data[0],$data[1],$data[2]);
        $idx++;
    }
    fclose($handle);
}
// 変数に格納したデータを表示
$count = count($posts);
// ページ設定
$page = 1; // デフォルトは１ページを表示
if ($_GET) {
    if ($_GET['page']) {
        $page = $_GET['page'];
        $count = $count - ($page-1)*10;
    }
}
for ($i=0;$i<10;$i++) {
    $post_num = $count;
    $count--;
    if ($count>=0) {
        $data = $posts[$count];
        echo "<p> $post_num 名前 : <span class='name'> $data[0] </span> Date: $data[2] <br>$data[1]</p>";
    }
}
?>

<!-- ページネーション -->
<div>
<?php
// 前へ戻るリンク
if ($page>1) {
    $back = $page-1;
    echo "<a href='/?page=".$back."'>戻る</a>";
}
// ページ番号指定リンク
$page_count = ceil(count($posts)/10);
for ($i=1;$i<=$page_count;$i++) {
    echo "<a href='/?page=".$i."'>".$i."</a>";
}
// 次へ進むリンク
if ($page<$page_count) {
    $next = $page+1;
    echo "<a href='/?page=".$next."'>次へ</a>";
}
?>
</div>

</body>
</html>