<?php
<<<<<<< HEAD
=======
include('../assets/functions.php');
?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>落とし物詳細</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link rel="stylesheet" media="all" href="assets/css/style.css"/>
</head>
<body>
<main>
<table border="4">
        <tr>
            <th>店名</th>
            <th>お店の電話番号</th>
        </tr>
        <?php foreach (read_companyData($_POST['id']) as $contact): ?>
            <tr>
                <td>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<table border="4">
        <tr>
            <th>名前</th>
        </tr>
        <tr>
            <th>ジャンル</th>
        </tr>
        <tr>
            <th>詳細</th>
        </tr>
    </table>
</main>
</body>
</html>
>>>>>>> main
