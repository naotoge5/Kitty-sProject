<?php
include '../assets/functions.php';
$companies = isset($_SESSION['data']['results']) ? $_SESSION['data']['results'] : null;
//unset($_SESSION['data']['results']);
$title = '落とし物検索';
include '../assets/_inc/header.php';
//print_r($_SESSION['data']['keywords']);
$keywords = '';
foreach ($_SESSION['data']['keywords'] as $index => $keyword) {
    if ($index == count(['keywords']) + 1) {
        $keywords .= '"' . $keyword . '"';
    } else {
        $keywords .= '"' . $keyword . '"' . '、';
    }
}
$keywords .= "に該当するデータは" . (count($companies)) . "件になりました。";
?>
<main>
    <div class="container">
    <?=$keywords?>
        <div class="row">
            <?php if ($companies): ?>
                <?php foreach ($companies as $company): ?>
                    <div class="col-12 col-sm-6 my-2">
                        <div class="card">
                            <div class="card-header">
                                <a href="show.php?id=<?=h($company['id'])?>" class="card-link">
                                    <?=h($company['name'])?>
                                </a>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?=h($company['details'])?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">該当するデータがありませんでした</p>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <a href="top.php">検索画面に戻る</a>
        </div>
    </div>
</main>
<?php include '../assets/_inc/footer.php'?>
