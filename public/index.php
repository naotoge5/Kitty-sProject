<?php
include('../assets/functions.php');
//var_dump(object_date(true));
//var_dump($_POST['category']);


if(isset($_POST['category'])){//カテゴリー
  $array=objects_category($_POST['category']);

}else if(isset($_POST['name'])){//名前
  $array=objects_name($_POST['name']);
 }else{
  $array=objects_date(true);
  }
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>落とし物検索サービス（仮）</title>
</head>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<body>
<h1>落とし物検索サービス（仮)</h1>
<form action="index.php" method="POST">
<input type="text"  placeholder="名前を入力してください"   name="name"  onchange="submit(this.form)" ></br>
<select name="category" onchange="submit(this.form)">
<option disabled selected value >未選択</option>//未選択を選択したらすべて表示if文で条件をつけて表示する
<option value="雨具">雨具</option>　//dbからカテゴリーを引っ張ってきて表示する　　　    
    
<option value="筆記用具">筆記用具</option>
</select>
</form>

<?php foreach ($array as $row):?>
    <td>【名前】<?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
    <td>【詳細】<?= htmlspecialchars($row['details'], ENT_QUOTES, 'UTF-8') ?></td>
    <td>【カテゴリー】<?= htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8') ?></td>
    <td>【時間】<?= htmlspecialchars($row['datetime'], ENT_QUOTES, 'UTF-8') ?></td></br>
 <?php endforeach;?>
 　  <button onclick="location.href='index.php'">検索条件をリセットする</button>
 </body>
</html>
