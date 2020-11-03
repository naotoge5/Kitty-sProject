<?php
include('../assets/functions.php');
if(isset($message)){
    echo $message;
}
if (isset($_POST['id'])) {
    //編集
    $id = $_POST['id'];
    $title = "編集";
} else {
    //登録
    $title = "登録";
}
require 'header.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>落し物<?php print($title); ?> </title>
</head>
<body>
    <div>
        <h1>落し物<?php print($title); ?></h1>

        <form action="update.php" method="POST">
        <table>
            <tr>
                <th>名前</th>
                <td>
                    <input type="text" name="name" placeholder="名前を入力してください" size="25" maxlength="100" value="<?php if(isset($id))//データベースからnameを持ってくる ?>" required>
                </td>
            </tr>
            <tr>
                <th>詳細</th>
                <td>
                    <textarea name="details" placeholder="落し物の詳細を入力してください" rows="6" cols="60" value=""><?php if(isset($id))//データベースからdetailsを持ってくる?></textarea>
                </td>
            </tr>
            <tr>
                <th>カテゴリー</th>
                <td>
                    <select name="category" required>
                         <option disabled selected value>未選択</option>
                            <?php foreach($categorys as $category): ?>
                                <!-- データベースから
                                <?php //if($category == ) ?>
                                -->
                                <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                            <?php endforeach; ?>         
                    </select>
                </td>
            </tr>
            <tr>
                <th>発見時刻</th>
                <td>
                    <!--後々カレンダーから選択できるように 2020-10-20 13:00:00-->
                    <input type="text" name="datetime" placeholder="発見時刻を入力してください" size="25" maxlength="100" value="<?php if(isset($id))//データベースからnameを持ってくる ?>" required>
                </td>
            </tr>
        </table>
        <input type="submit" value="<?php print($title); ?>">
        </form>

    </div>
</body>
</html>