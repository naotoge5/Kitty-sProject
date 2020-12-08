<?php
include('../assets/functions.php');

$url = isset($_GET['request_url']) ? $_GET['request_url'] : 0;
$details = isset($_POST['details']) ? $_POST['details'] : 0;

if ($url) {
    echo file_get_contents($url);
} else if ($details) {
    //updateDetailsの呼び出し

} else {
    alert('不正なアクセスです', 'CAUTION');
    header('Location:management.php');
}