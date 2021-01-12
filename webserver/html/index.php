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
<?php
$row = 1;
// ファイルが存在しているかチェックする
if (($handle=fopen('log.csv', 'r'))!==false) {
    // 1行ずつfgetcsv()関数を使って読み込む
    while ($data=fgetcsv($handle)) {
        echo "<p> $row 名前 : <span class='name'> $data[0] </span> Date: $data[2] <br>$data[1]</p>";
        $row++;
    }
    fclose($handle);
}
?>
</p>

<form method="POST" action="/">
    名前<br>
    <input name="name" type="text"><br>
    コメント<br>
    <textarea name="comment" id="" cols="50" rows="5"></textarea><br>
    <input type="submit" value="書き込む">
</form>
</body>
</html>