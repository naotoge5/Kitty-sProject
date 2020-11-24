<?php
include('../assets/functions.php');
$flag = true;
$id = isset($_GET['id']) ? $_GET['id'] : null;
/*if (is_null($id)) {
    $_SESSION['alert'] = messageType('不正なアクセスです');
    header('Location:top.php');
    exit;
} else {
switch ($company = read_companyData($id)) {
    case -1:
        $flag = false;
        $_SESSION['alert'] = messageType('データーベース接続エラー');
        break;
    }
}*/
$title = '企業情報';
include('../assets/_inc/header.php');
?>
<main>
    <h1><?= $title ?></h1>
    <div>
        <table border="4">
            <tr>
                <th>店名</th>
                <th>お店の電話番号</th>
            </tr>
            <?php foreach ($company as $contact): ?>
                <tr>
                    <td>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <table border="4">
            <tr>
                <th>名前</th>
            </tr>
            <tr>
                <th>ジャンル</th>
            </tr>
            <tr>
                <th>詳細</th>
            </tr>
        </table>
    </div>
</main>
<script src="../assets/js/jquery-3.5.1.js"></script>
<script src="../assets/js/public.js"></script>
<?php include('../assets/_inc/footer.php') ?>
