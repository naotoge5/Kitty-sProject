<?php
include '../assets/functions.php';
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$company = readCompanyData($id);
$objects = readObjectList($id);
$title = '企業情報';
include '../assets/_inc/header.php';
?>
<main>
    <div class="container">
        <div class="card my-4">
            <div class="card-header">
                <h4 class="card-title mb-0"><?=$name = h($company['name'])?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title">住所</h5>
                        <p class="card-text">〒&nbsp;<?=substr(h($company['postal']), 0, 3) . '-' . substr(h($company['postal']), -4) . "<br>" . h($company['prefecture']) . h($company['city']) . h($company['town'])?></p>
                        <h5 class="card-title">電話番号</h5>
                        <?php if (strlen($company['tel']) === 10): ?>
                            TEL：<a href="tel:<?=h($company['tel'])?>"><?=substr(h($company['tel']), 0, 4) . '-' . substr(h($company['tel']), 4, 3) . '-' . substr(h($company['tel']), 7, 3)?></a>
                        <?php else: ?>
                            TEL：<a href="tel:<?=h($company['tel'])?>"><?=substr(h($company['tel']), 0, 3) . '-' . substr(h($company['tel']), 3, 4) . '-' . substr(h($company['tel']), 6, 4)?></a>
                        <?php endif;?>
                    </div>
                    <div class="col-6">
                        <h5 class="card-title">営業時間等</h5>
                        <p class="card-text"><?=h($company['details'])?></p>
                    </div>
                </div>
                <iframe width="100%" height="100%"
                        src=" https://maps.google.co.jp/maps?output=embed&q=<?=h($company['name'])?>"></iframe>
            </div>
        </div>
        <div class="card my-4">
            <div class="card-header">
                <h3 class="card-title mb-0">拾得物</h3>
            </div>
            <div class="card-body">
                <?php if ($objects): ?>
                    <table id="objects_table" class="table">
                        <thead>
                        <tr>
                            <th>名前</th>
                            <th>発見日時</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($objects as $row): ?>
                            <tr>
                                <td><?=h($row['name'])?></td>
                                <td><?=date('Y年m月d日 H時i分', strtotime(h($row['datetime'])))?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="mb-0">落とし物が登録されていません。</p>
                <?php endif;?>
            </div>
        </div>
    </div>
</main>
<?php include '../assets/_inc/footer.php'?>
