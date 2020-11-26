<?php
include('../assets/functions.php');
$companies = isset($_SESSION['results']) ? $_SESSION['results'] : null;
unset($_SESSION['results']);
$title = '落とし物検索';
include('../assets/_inc/header.php');
?>
<main>
    <div class="container">
        <?php if ($companies): ?>
            <?php foreach ($companies as $company): ?>
                <form id="company_<?= h($company['id']) ?>" action="show.php" method="get">
                    <input type="hidden" name="id" value="<?= h($company['id']) ?>">
                </form>
                <div class="card my-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0"><?= h($company['name']) ?></h3>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="mb-0">落とし物が登録されていません。</p>
        <?php endif; ?>
</main>
<?php include('../assets/_inc/footer.php') ?>
