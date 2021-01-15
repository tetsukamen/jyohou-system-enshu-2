<?php
// レスポンスヘッダの設定
header("HTTP/1.0 200 OK");
header("Server: Apache");
header("Content-Type: text/html");

// スレッドリストの読み込み
$threads = [];
if (($handle=fopen('thread-list.csv', 'r'))!==false) {
    while ($data=fgetcsv($handle)) {
        $threads[] = array($data[0],$data[1]);
    }
}

include('./header.php');
?>

<main class="container">
    <h1 class="h3 m-3">スレッドリスト</h1>
    <div class="card my-3">
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>スレッド名</th>
                    <th>作成者</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($threads as $idx => $thread) {
                        echo "<tr>";
                        echo "<td><a href='/?thread=".$idx."'>".$thread[0]."</a></td>";
                        echo "<td>".$thread[1]."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
include('./footer.php')
?>