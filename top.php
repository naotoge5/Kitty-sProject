<?php
//データベースに接続
$db_host ='127.0.0.1';          // サーバーのホスト名
$db_name ='kittydb';       // データベース名
$db_user ='kitty';      // データベースのユーザー名
$db_pass ='pro02';      // データベースのパスワード
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=kittydb', $db_user,$db_pass);
} catch (PDOException $e) {
    exit('データベース接続失敗 ' . $e->getMessage());
}

if (isset($_POST["lookfor"])) {//条件なしでの検索
$sql ='SELECT * FROM objects';
$stmt = $dbh->query($sql);
$objects = $stmt->fetchAll(PDO::FETCH_ASSOC); // データベースに登録されている全ての注文内容を連想配列で取得}
};


 if(isset($_POST["Serch"])) {//名前で検索する
    $name=$_POST['name'];
    $sql = 'SELECT * FROM objects WHERE name = :name';
    $serch= array(':name' => $name);
    $stmt =  $dbh -> prepare($sql);
    $stmt -> execute($serch);
    $objects  = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetch(PDO::FETCH_ASSOC)は連想配列で行を取り出す
};

if((isset($_POST["details"]))){//カテゴリー検索
     $details=$_POST['details'];
     $sql = 'SELECT * FROM objects WHERE details= :details';
     $category= array(':details' => $details);
     $stmt =  $dbh -> prepare($sql);
     $stmt -> execute($category);
     $objects  = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetch(PDO::FETCH_ASSOC)は連想配列で行を取り出す
}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>落とし物検索サービス（仮）</title>
</head>
<body>
</body>
<h1>落とし物検索サービス（仮）</h1>
<form action="top.php" method="POST">
<input type="submit" name="lookfor" value="条件をつけずに検索する" class="button"></br>
<input type="text"  placeholder="名前を入力してください" name="name" value="">
<input type="submit" name="Serch" value="名前で検索する" class="button"></br>

<select name= "details">
<option selected value >未選択</option>
<option value="雨具">雨具</option>
<option value="筆記用具">筆記用具</option>
</select>
<input type="submit" name="send" value="カテゴリーで検索" class="button">
</form>

<?php if(isset($_POST["lookfor"])||isset($_POST["name"])||isset($_POST["details"]))://検索または表示ボタンが押されたとき?>
<?php foreach ($objects as $object):?>
    <td>【名前】<?= htmlspecialchars($object['name'], ENT_QUOTES, 'UTF-8') ?></td>
    <td>【カテゴリー】<?= htmlspecialchars($object['details'], ENT_QUOTES, 'UTF-8') ?></td>
    <td>【詳細】<?= htmlspecialchars($object['category'], ENT_QUOTES, 'UTF-8') ?></td>
    <td>【時間】<?= htmlspecialchars($object['datetime'], ENT_QUOTES, 'UTF-8') ?></td></br>
 <?php endforeach;?>
 <?php endif ?>
<a href= "top.php">検索条件をリセットする</a>
</html>