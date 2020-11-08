<?php
try {
    include('../assets/functions.php');
    if (isset($_POST['prefecture'])) {
        $prefecture = $_POST['prefecture'];
        $cities = read_cities($prefecture);
        echo json_encode($cities); //配列をJSONコードに変換して出力する。
        exit;
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
