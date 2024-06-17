<?php
header("Access-Control-Allow-Origin: https://www.game4free.tn");

if (!isset($_GET['appName']) || !isset($_GET['extension'])) {
    http_response_code(400);
    die("Missing parameter");
}

$appName = $_GET['appName'];
$appExtension = $_GET['extension'];

if ($appExtension == 'XAPK'){
    $downloadLink = "https://d.apkpure.net/b/XAPK/" . urlencode($appName) . "?version=latest";
    
    $modifiedFilename = $appName . "_Game4Free.xapk";
    header("Content-Disposition: attachment; filename=\"$modifiedFilename\"");
    header("Content-Type: application/octet-stream");
}else{
    $downloadLink = "https://d.apkpure.net/b/APK/" . urlencode($appName) . "?version=latest";
    
    $modifiedFilename = $appName . "_Game4Free.apk";
    
    header("Content-Disposition: attachment; filename=\"$modifiedFilename\"");
    header("Content-Type: application/octet-stream");
}

readfile($downloadLink);