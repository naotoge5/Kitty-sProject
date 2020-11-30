<?php
include('../assets/functions.php');
$companies = isset($_SESSION['results']) ? $_SESSION['results'] : null;
unset($_SESSION['results']);
$title = '落とし物検索';
include('../assets/_inc/header.php');
?>
<main>
    <div class="container">
        <div class="row">
            <?php if ($companies): ?>
                <?php foreach ($companies as $company): ?>
                    <div class="col-12 col-sm-6 my-2">
                        <div class="card">
                            <div class="card-header">
                                <a href="show.php?id=<?= h($company['id']) ?>" class="card-link">
                                    <?= h($company['name']) ?>
                                </a>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?= h($company['details']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">該当するデータがありませんでした</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php include('../assets/_inc/footer.php') ?>
