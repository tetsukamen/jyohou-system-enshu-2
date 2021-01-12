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
    <title>シンプル掲示板</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">シンプル掲示板</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">トップ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">会員登録</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
</header>

<main class="container">
    <div class="card my-3">
        <form class="card-body" method="POST" action="/">
            <div class="mb-3">
                <label for="name" class="form-label">名前</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">コメント</label>
                <textarea class="form-control" name="comment" id="comment" cols="50" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">投稿</button>
        </form>
    </div>

<?php
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
        echo <<<EOD
<div class='mx-2 mb-3'>
    <div class='border-bottom text-secondary'><small>$post_num 名前：<span class="text-primary">$data[0]</span>&nbsp;&nbsp;日付：$data[2]</small></div>
    <div class='mx-3'>$data[1]</div>
</div>
EOD;
    }
}
?>

</main>

<!-- ページネーション -->
<aside class="container d-flex justify-content-center my-3">
<?php
// 前へ戻るリンク
if ($page>1) {
    $back = $page-1;
    echo "<div class='p-1'><a href='/?page=".$back."'前へ</a></div>";
}
// ページ番号指定リンク
$page_count = ceil(count($posts)/10);
for ($i=1;$i<=$page_count;$i++) {
    echo "<div class='p-1'><a href='/?page=".$i."'>".$i."</a></div>";
}
// 次へ進むリンク
if ($page<$page_count) {
    $next = $page+1;
    echo "<div class='p-1'><a href='/?page=".$next."'>次へ</a></div>";
}
?>
</aside>

<footer class="text-center bg-secondary text-white"><small>copyright Waddy</small></footer>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>