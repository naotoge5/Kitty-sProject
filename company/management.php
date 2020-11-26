<?php
include('../assets/functions.php');

$id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
$company = readCompanyData($id);
$objects = readObjectList($id);
$title = '管理画面';
include('../assets/_inc/header.php');
?>
<main>
    <div class="container">
        <div class="card my-4">
            <div class="card-header">
                <h3 class="card-title mb-0"><?= $name = h($company['name']) ?></h3>
            </div>
            <div class="card-body">
                <table>
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
        <div class="card my-4">
            <div class="card-header">
                <h3 class="card-title mb-0">拾得物</h3>
            </div>
            <div class="card-body">
                <?php if ($objects): ?>
                    <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                        <div class="list-group list-group-flush">
                            <?php foreach ($objects as $row): ?>
                                <form id="edit_<?= h($row['id']) ?>" action="register.php" method="get">
                                    <input type="hidden" name="id" value="<?= h($row['id']) ?>">
                                </form>
                                <button type="button" class="list-group-item list-group-flush list-group-item-action"
                                        value="<?= h($row['id']) ?>" onclick="toEdit(this);">
                                    <?= h($row['name']) . h($row['details']) . h($row['category']) . h($row['datetime']) ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="mb-0">落とし物が登録されていません。</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<?php include('../assets/_inc/footer.php') ?>
