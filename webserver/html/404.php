<?php
// レスポンスヘッダの設定
header("HTTP/1.0 404 Not Found");
header("Server: Apache");
header("Content-Type: text/html");

include('./header.php')
?>

<main class="container">
    <h1 class="text-center mt-5">ページが見つかりませんでした。</h1>
</main>

<?php include('./footer.php');?>