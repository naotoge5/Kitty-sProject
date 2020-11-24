<?php
//manegementの編集ボタンから
include('../assets/functions.php');
$flag = true;
if (isset($_GET['id'])) {
    $title = '拾得物-編集';
    $id = $_GET['id'];
    switch ($object = read_objectData($id)) {
        case -1:
            $flag = false;
            $_SESSION['alert'] = messageType('データーベース接続エラー');
            break;
        case 0:
            $title = 'non';
            break;
        default:
            if ($object['company_id'] != $_SESSION['id']) {
                $_SESSION['alert'] = messageType('不正なアクセスです。');
                header('Location:management.php');
                exit;
            }
    }
} else {
    $title = '拾得物-新規';
    $id = '';
    $object = null;
}
include('../assets/_inc/header.php');
include('nav.php');
?>
    <main>
        <h1><?= $title ?></h1>
        <?php if ($flag): ?>
            <div>
                <form action="update.php" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <table>
                        <tr>
                            <th>名前</th>
                            <td>
                                <input type="text" name="name" placeholder="名前を入力してください" size="25" maxlength="100"
                                       value="<?php if (isset($object)) echo h($object['name']); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <th>詳細</th>
                            <td>
                    <textarea name="details" placeholder="落し物の詳細を入力してください" rows="6" cols="60"
                              value=""><?php if (isset($object)) echo h($object['details']); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>カテゴリー</th>
                            <td>
                                <select name="category" required>
                                    <?php if (!isset($object)): ?>
                                        <option disabled selected value>未選択</option>
                                    <?php endif; ?>
                                    <?php foreach ($categories as $category): ?>
                                        <?php if ($category == $object['category']): ?>
                                            <option selected="selected"
                                                    value="<?= $category ?>"><?= $category ?></option>
                                        <?php else: ?>
                                            <option value="<?= $category; ?>"><?= $category; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>発見時刻</th>
                            <td>
                                <!--後々カレンダーから選択できるように 2020-10-20 13:00:00-->
                                <input type="datetime" name="datetime" placeholder="発見時刻を入力してください" size="25"
                                       maxlength="100"
                                       value="<?php if (isset($object)) echo h($object['datetime']) ?>" required>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="<?php if (empty($id)) echo '登録'; else echo '更新' ?>">
                </form>

                <form action="delete.php" method="POST">
                <?php if (empty($id)); else echo '<input type="submit" value="削除">' ?> 
                <input type="hidden" name="id" value="<?= $id ?>">
                </form>

            </div>
        <?php else: ?>
            <h4>申し訳ございません、<br>しばらくしてからもう一度お試しください。</h4>
        <?php endif; ?>
    </main>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <script src="../assets/js/company.js"></script>
<?php include('../assets/_inc/footer.php') ?>