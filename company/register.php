<?php
include('../assets/functions.php');

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$object = empty($id) ? null : readObjectData($id);

$title = empty($id) ? '拾得物-新規' : '拾得物-編集';
include('../assets/_inc/header.php');
?>
<header>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.0.0/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/ja.js" type="text/javascript"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js">
</script>
<style type="text/css">
    .datepicker-days th.dow:first-child,
    .datepicker-days td:first-child {
        color: #f00;
    }
    .datepicker-days th.dow:last-child,
    .datepicker-days td:last-child {
        color: #00f;
    }
</style>
</header>
    <main>
        <div class="container">
            <div class="card my-4"><!--my-4:card外の上下に空間-->
                <div class="card-header pb-0"><!--pb-0:card-header内の下の空間を無視-->
                    <h3 class="card-title"><?= $title ?></h3>
                </div>
                <div class="card-body d-none d-sm-block">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group">
                            <h5 class="cord-title">名前</h5>
                            <input type="text" name="name" class="form-control" placeholder="名前を入力してください" size="25"
                                   maxlength="100" value="<?php if (isset($object)) echo h($object['name']) ?>"
                                   required>
                        </div>
                        <div class="form-group">
                            <h5 class="card-title">詳細</h5>
                            <textarea name="details" class="form-control" placeholder="落し物の詳細を入力してください" rows="4"
                                      cols="60"><?php if (isset($object)) echo h($object['details']); ?></textarea>
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
                        <div class="form-row">
                        <div class="form-group col-sm-6">
                            <h5 class="card-title">発見時刻</h5>
                            <div class="input-group date" id="datetimepicker1">
                                <label for="datetimepicker1" class="pt-2 pr-2">日付</label>
                                <input type="text" name="date" class="form-control" required />
                                <span class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                        <h5 class="card-title">&nbsp;</h5>
                            <div class="input-group date" id="datetimepicker2">
                                <label for="datetimepicker2" class="pt-2 pr-2">時間</label>
                                <input type="text" name="time" class="form-control" required />
                                <span class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                </span>
                            </div>
                        </div>
                        </div>
                       <!--  value="<?php if (isset($object)) echo h($object['datetime']) ?>" required> -->
                        <div class="form-group">
                            <input type="submit" class="btn btn-success"
                                   value="<?php if (empty($id)) echo '登録'; else echo '更新' ?>">
                            <?php if (!empty($id)): ?>
                                <input type="button" id="delete" class="btn btn-danger" value="削除">
                            <?php endif; ?>
                        </div>
                    </form>
                    <form method="POST" name="delete" action="delete.php" class="mb-0">
                        <input type="hidden" name="id" value="<?= $id ?>">
                    </form>
                </div>
                <div class="card-body d-block d-sm-none">
                    <p class="card-text">
                        この画面ではご利用になれません
                    </p>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            dayViewHeaderFormat: 'YYYY年 MMMM',
            tooltips: {
                close: '閉じる',
                selectMonth: '月を選択',
                prevMonth: '前月',
                nextMonth: '次月',
                selectYear: '年を選択',
                prevYear: '前年',
                nextYear: '次年',
                selectTime: '時間を選択',
                selectDate: '日付を選択',
                prevDecade: '前期間',
                nextDecade: '次期間',
                selectDecade: '期間を選択',
                prevCentury: '前世紀',
                nextCentury: '次世紀'
            },
            format: 'YYYY-MM-DD',
            locale: 'ja',
            showClose: true
        });
        $('#datetimepicker2').datetimepicker({
            tooltips: {
                close: '閉じる',
                pickHour: '時間を取得',
                incrementHour: '時間を増加',
                decrementHour: '時間を減少',
                pickMinute: '分を取得',
                incrementMinute: '分を増加',
                decrementMinute: '分を減少',
                pickSecond: '秒を取得',
                incrementSecond: '秒を増加',
                decrementSecond: '秒を減少',
                togglePeriod: '午前/午後切替',
                selectTime: '時間を選択'
            },
            format: 'HH:mm',
            locale: 'ja',
            showClose: true
        });
    });
</script>
<?php include('../assets/_inc/footer.php') ?>