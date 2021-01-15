<?php
// レスポンスヘッダの設定
header("HTTP/1.0 200 OK");
header("Server: Apache");
header("Content-Type: text/html");

$errors = [];
$messages = [];

if ($_POST) {
    // カンマを置き換え
    $name = $_POST['name'];
    $name = str_replace(",", "&#44", $name);
    $password = $_POST['password'];
    $password = str_replace(",", "&#44", $password);
    // members.csvから登録済みの会員情報を取り出し、会員名がそれらに重複しないか確認する
    if (($handle=fopen('members.csv', 'r'))!==false) {
        while ($data=fgetcsv($handle)) {
            if ($data[0]==$name) {
                $errors[] = 'その会員名は登録済みです。';
                break;
            }
        }
        fclose($handle);
    }
    // エラーがなければmembers.csvに会員情報を書き込む
    if (!$errors) {
        $data = array($name,$password,true);
        $line = implode(',', $data);
        $handle = fopen('members.csv', 'a');
        fwrite($handle, $line."\n");
        fclose($handle);
        $messages[] = '登録しました。';
    }
}

include('./header.php');
?>

<main class="container">
    <h1 class="h3 m-3">会員登録ページ</h1>
    <?php
    foreach ($errors as $error) {
        echo "<div class='text-danger'>".$error."</div>";
    }
    foreach ($messages as $msg) {
        echo "<div class='text-success'>".$msg."</div>";
    }
    if (!$messages):
    ?>
    <div class="card my-3">
        <form class="card-body" method="POST" action="/sign-up.php">
            <div class="mb-3">
                <label for="name" class="form-label">会員名</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </div>
    <?php else: ?>
    <div><a href="/member-menu.php">会員メニューへ</a></div>
    <?php endif; ?>
</main>

<?php
include('./footer.php')
?>