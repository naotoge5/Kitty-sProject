<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    echo '<h1>ここは' . $id . 'の編集</h1>';
} else {
    echo '<h1>新規登録</h1>';
}
require 'header.php';
//ようすけさん