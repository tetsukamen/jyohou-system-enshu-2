<?php
// レスポンスヘッダの設定
header("HTTP/1.0 200 OK");
header("Server: Apache");
header("Content-Type: text/html");

$errors = [];
$logined = false;

if ($_POST) {
    // カンマを置き換え
    $name = $_POST['name'];
    $name = str_replace(",", "&#44", $name);
    $password = $_POST['password'];
    $password = str_replace(",", "&#44", $password);
    // members.csvに会員名とパスワードが一致するレコードがあればログイン
    if (($handle=fopen('members.csv', 'r'))!==false) {
        while ($data=fgetcsv($handle)) {
            if ($name==$data[0] && $password==$data[1] && $data[2]==true) {
                $logined = true;
                break;
            }
        }
        fclose($handle);
    }
    if (!$logined) {
        $errors[] = '会員名またはパスワードが間違っています。';
    }
}

include('./header.php');

if ($logined):
?>
<!-- 会員メニューテンプレート -->
<main class="container">
    <h1 class="h3 m-3">会員メニュー</h1>
    <div class="card my-3">
        <div class="card-header">スレッド作成</div>
        <form class="card-body" method="POST" action="/thread-create.php">
            <div class="mb-3">
                <label for="thread-name" class="form-label">スレッド名</label>
                <input type="text" class="form-control" name="thread-name" id="thread-name">
                <?php echo "<input type='hidden' name='name' value='".$name."'>" ?>
                <?php echo "<input type='hidden' name='password' value='".$password."'>" ?>
                <input type='hidden' name='status' value='request'>
            </div>
            <button type="submit" class="btn btn-primary">スレッドを作成</button>
        </form>
    </div>
</main>

<?php else: ?>
<!-- ログインウィジェット -->
<main class="container">
    <?php
    foreach ($errors as $error) {
        echo "<div class='text-danger'>".$error."</div>";
    }
    ?>
    <div class="card my-3">
        <div class="card-header">ログインしてください</div>
        <form class="card-body" method="POST" action="/member-menu.php">
            <div class="mb-3">
                <label for="name" class="form-label">会員名</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">ログイン</button>
        </form>
    </div>
</main>
<?php endif; ?>

<?php
include('./footer.php')
?>