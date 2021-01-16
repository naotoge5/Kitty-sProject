<?php
include_once("assets/functions.php"); //include_once -> result.php内でfunction読み込みの為

if (!empty($_GET['name'])) {
    $keywords = $param = [$_GET['name']];
    $companies = readAll('%' . $_GET['name'] . '%', "select id, name, details from companies where name like ? limit 10");
} else if (!empty($_GET['categories'])) {
    $keywords = $param = [$_GET['prefectures'], $_GET['cities']]; //基本
    $query = "select id, name, details from companies where prefecture = ? and city = ?"; //基本
    if (!empty($_GET['towns'])) {
        $param[] = $_GET['towns'] . '%';
        $keywords[] = $_GET['towns'];
        $query .= " and town like ?";
    }
    $param[] = $_GET['categories'];
    $keywords[] = $_GET['categories'];
    $query .= " and id in (select distinct company_id from objects where category = ?";
    if (!empty($_GET['objects'])) {
        $param[] = $_GET['objects'];
        $keywords[] = $_GET['objects'];
        $query .= " and name = ?";
    }
    if (!empty($_GET['start']) and !empty($_GET['finish'])) {
        $param = array_merge($param, [$_GET['start'] . ' 00:00:00', $_GET['finish'] . ' 23:59:59']);
        $query .= " and datetime between ? and ?";
        $keywords[] = $_GET['start'] . ' 〜 ' . $_GET['finish'];
    }
    $query .= ")";
    $companies = readAll($param, $query);
} else {
    header('Location:index.php');
    exit;
}
