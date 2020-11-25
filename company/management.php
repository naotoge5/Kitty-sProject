<?php
//ログイン成功後　管理ページ
include('../assets/functions.php');
$flag = true;
switch ($company = readCompanyData($_SESSION['id'])) {
    case -1:
        $flag = false;
        $_SESSION['alert'] = alertType('データーベース接続エラー', 'ERROR');
        break;
}
$title = '管理画面';
include('../assets/_inc/header.php');
?>
    <main>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= $name = h($company['name']) ?></h3>
                </div>
                <div class="card-body">
                    <?php if ($flag): ?>
                    <table>
                        <thead>
                        <tr>
                            <th colspan="2"><?= $name = h($company['name']) ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= h($company['prefecture']) . h($company['city']) . h($company['town']) ?></td>
                            <td>TEL：<a href="tel:<?= h($company['tel']) ?>"><?= h($company['tel']) ?></a></td>
                        </tr>
                        <tr>
                            <td>
                                <iframe src=" https://maps.google.co.jp/maps?output=embed&q=<?= $name ?>"></iframe>
                            </td>
                            <td><?= h($company['details']) ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">落とし物一覧</h3>
                    <a href="register.php">新規登録</a>
                </div>
                <div class="card-body">
                    <?php if (readObjectList($_SESSION['id'])): ?>
                        <table>
                            <thead>
                            <tr>
                                <th>名前</th>
                                <th>詳細</th>
                                <th>ジャンル</th>
                                <th>登録日時</th>
                            </tr>
                            </thead>
                            <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                                <tbody>
                                <?php foreach (readObjectList($_SESSION['id']) as $row): ?>
                                    <form name="edit<?= h($row['id']) ?>" action="register.php" method="get">
                                        <input type="hidden" name="id" value="<?= h($row['id']) ?>">
                                    </form>
                                    <tr>
                                        <td><?= h($row['name']) ?></td>
                                        <td><?= h($row['details']) ?></td>
                                        <td><?= h($row['category']) ?></td>
                                        <td><?= h($row['datetime']) ?></td>
                                        <td input class="edit"
                                            onClick="document.edit<?= h($row['id']) ?>.submit();return false;">編集/削除
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </div>
                        </table>
                    <?php else: ?>
                        <p>落とし物が登録されていません。</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php else: ?>
                <h4>申し訳ございません、<br>しばらくしてからもう一度お試しください。</h4>
            <?php endif; ?>
        </div>
    </main>
<?php include('../assets/_inc/footer.php') ?>