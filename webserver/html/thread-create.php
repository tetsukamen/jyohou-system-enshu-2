<?php
// レスポンスヘッダの設定
header("HTTP/1.0 200 OK");
header("Server: Apache");
header("Content-Type: text/html");

$auth = false;
$errors = [];

if ($_POST) {
    // カンマを置き換え
    $thread_name = $_POST['thread-name'];
    $thread_name = str_replace(",", "&#44", $thread_name);
    $name = $_POST['name'];
    $name = str_replace(",", "&#44", $name);
    $password = $_POST['password'];
    $password = str_replace(",", "&#44", $password);
    // スレッド名が１文字未満ならエラー
    if (mb_strlen($thread_name)<1) {
        $errors[] = 'スレッド名は１文字以上を指定してください';
    }
    // 会員名とパスワードが一致していなければエラー
    if (($handle=fopen('members.csv', 'r'))!==false) {
        while ($data=fgetcsv($handle)) {
            if ($name==$data[0] && $password==$data[1] && $data[2]==true) {
                $auth = true;
                break;
            }
        }
        fclose($handle);
    }
    if (!$auth) {
        $errors[]='会員名またはパスワードが間違っています。';
    }
}

include('./header.php');
?>

<main class="container">

<?php
if ($errors):
    foreach ($errors as $error) {
        echo "<div class='text-danger'>".$error."</div>";
    } elseif ($_POST['status']=='request'):
?>
    <div class="card my-3">
        <div class="card-header">以下の内容でスレッドを作成します。</div>
        <form class="card-body" method="POST" action="/thread-create.php">
            <div class="mb-3">
                <div>スレッド名：<?php echo $thread_name ?></div>
                <input type='hidden' name='thread-name' value='<?php echo $thread_name ?>'>
                <input type='hidden' name='name' value='<?php echo $name ?>'>
                <input type='hidden' name='password' value='<?php echo $password ?>'>
                <input type='hidden' name='status' value='confirm'>
            </div>
            <button type="submit" class="btn btn-primary">スレッドを作成</button>
        </form>
    </div>

<?php elseif ($_POST['status']=='confirm'):
// スレッドリストに追記
if (($handle=fopen('thread-list.csv', 'w'))!==false) {
    $data = array($thread_name,$name,$password);
    $line = implode(',', $data);
    fwrite($handle, $line."\n");
    fclose($handle);
}
// スレッドのcsv作成
$count=0;
if (($handle=fopen('thread-list.csv', 'r'))!==false) {
    while ($data=fgetcsv($handle)) {
        $count++;
    }
    fclose($handle);
}
touch($count.'.csv');
?>
    <div class="card my-3">
        <div class="card-header">スレッドを作成しました。</div>
        <div class="card-body">
            <div>スレッド名：<a href="/?thread_id=<?php echo $count ?>"><?php echo $thread_name ?></a></div>
        </div>
    </div>
<?php endif; ?>
    
</main>

<?php include('./footer.php'); ?>