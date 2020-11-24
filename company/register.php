<?php
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
    <div class="container">
    <div class="card">
    <div class="card-body">
        <h3 class="card-header mb-3" ><?= $title ?></h3>
        <?php if ($flag): ?>
            <div class="ml-3">
                <form action="update.php" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group">
                            <h5 class="card-title">名前</h5>
                                <input type="text" name="name" class="form-control" placeholder="名前を入力してください" size="25" maxlength="100"
                                       value="<?php if (isset($object)) echo h($object['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <h5 class="card-title">詳細</h5>
                                <textarea name="details" class="form-control" placeholder="落し物の詳細を入力してください" rows="4" cols="60"value=""><?php if (isset($object)) echo h($object['details']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <h5 class="card-title">カテゴリー</h5>
                                <select name="category" class="form-control" required>
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
                        </div>
                        <div class="form-group">
                            <h5>発見時刻</h5>
                                <!--後々カレンダーから選択できるように 2020-10-20 13:00:00-->
                                <input type="datetime" name="datetime" class="form-control" placeholder="発見時刻を入力してください" size="25"
                                       maxlength="100"
                                       value="<?php if (isset($object)) echo h($object['datetime']) ?>" required>
                         </div>
                    <input type="submit" class="btn btn-success" value="<?php if (empty($id)) echo '登録'; else echo '更新' ?>">
                </form>
            </div>
        </div>
    </div>
    </div>
        <?php else: ?>
            <h4>申し訳ございません、<br>しばらくしてからもう一度お試しください。</h4>
        <?php endif; ?>
    </main>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <script src="../assets/js/company.js"></script>
<?php include('../assets/_inc/footer.php') ?>