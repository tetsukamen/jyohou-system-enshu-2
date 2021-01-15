<?php
// レスポンスヘッダの設定
header("HTTP/1.0 200 OK");
header("Server: Apache");
header("Content-Type: text/html");

include('./header.php')
?>

<main class="container">
    <h1 class="h3 m-3">トップページ</h1>
    <div class="card my-3">
        <form class="card-body" method="POST" action="/">
            <div class="mb-3">
                <label for="name" class="form-label">名前</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">コメント</label>
                <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">投稿</button>
        </form>
    </div>
<?php

// 変数に格納したデータを表示
$count = count($posts);
$count = $count - ($page-1)*10; // ページ設定
// 投稿の表示
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
    echo "<div class='p-1'><a href='/?page=".$back."'>前へ</a></div>";
}
// ページ番号指定リンク
for ($i=1;$i<=$page_count;$i++) {
    if ($i==$page) {
        echo "<div class='p-1'>".$i."</div>";
    } else {
        echo "<div class='p-1'><a href='/?page=".$i."'>".$i."</a></div>";
    }
}
// 次へ進むリンク
if ($page<$page_count) {
    $next = $page+1;
    echo "<div class='p-1'><a href='/?page=".$next."'>次へ</a></div>";
}
?>
</aside>

<?php
include('./footer.php')
?>