<?php
include_once("assets/functions.php"); //include_once -> result.php内でfunction読み込みの為

if (!empty($_GET['name'])) {
    $param = [$_GET['name']];
    $companies = readAll('%' . $_GET['name'] . '%', "select id, name, details from companies where name like ? limit 10");
} else if (!empty($_GET['categories'])) {
    $param = [$_GET['prefectures'], $_GET['cities']]; //基本
    $query = "select id, name, details from companies where prefecture = ? and city = ?"; //基本
    if (!empty($_GET['towns'])) {
        $param = array_push($param, $_GET['towns'] . '%');
        $query .= " and town like ?";
    }

    $param[] = $_GET['categories'];
    $query .= " and id in (select distinct company_id from objects where category = ?";
    if (!empty($_GET['objects'])) {
        $param[] = $_GET['objects'];
        $query .= " and name = ?";
    }
    if (!empty($_GET['start']) and !empty($_GET['finish'])) {
        $param = array_merge($param, [$_GET['start'] . ' 00:00:00', $_GET['finish'] . ' 23:59:59']);
        $query .= " and datetime between ? and ?";
    }
    $query .= ")";
    $companies = readAll($param, $query);
    $query_json = json_encode($query);
    echo "<script>console.log( '$query_json' );</script>";
} else {
    header('Location:index.php');
    exit;
}
