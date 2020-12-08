<?php
include('../assets/functions.php');

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$object = $id ? readObjectData($id) : 0;
$datetime = $id ? explode(' ', $object['datetime']) : 0;

$title = $id ? '拾得物-編集' : '拾得物-新規';
include('../assets/_inc/header.php');
?>
    <main>
        <div class="container">
            <div class="card my-4"><!--my-4:card外の上下に空間-->
                <div class="card-header pb-0">
                    <h3 class="card-title"><?= $title ?></h3>
                </div>
                <div class="card-body d-none d-sm-block">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group">
                            <label>名前</label>
                            <input type="text" name="name" class="form-control" placeholder="名前を入力してください" size="25"
                                   maxlength="100" value="<?php if ($object) echo h($object['name']) ?>"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>詳細</label>
                            <textarea name="details" class="form-control" placeholder="落し物の詳細を入力してください" rows="4"
                                      cols="60"><?php if ($object) echo h($object['details']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>カテゴリー</label>
                            <select name="category" class="form-control" required>
                                <?php if (!$object): ?>
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
                            <label>発見時刻</label>
                            <div class="input-group date" id="date">
                                <label for="date" class="pr-2 pt-1" >日付</label>
                                <input type="text" name="date" class="form-control rounded-left" value="<?php if (isset($object)) echo h($datetime[0]); ?>" required />
                                <span class="input-group-append ">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                        <label>&nbsp;</label>
                            <div class="input-group date" id="time">
                                <label for="time" class="pr-2 pt-1">時間</label>
                                <input type="text" name="time" class="form-control rounded-left" value="<?php if (isset($object)) echo h($datetime[1]); ?>" required />
                                <span class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success"
                                   value="<?php if ($id) echo '更新'; else echo '登録' ?>">
                            <?php if ($id): ?>
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
<?php include('../assets/_inc/footer.php') ?>