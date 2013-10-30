<?php
// File Name: proxy.php
if (!isset($_POST['url'])) die();
$url = urldecode($_POST['url']);
$url = 'http://' . str_replace('http://', '', $url); // Avoid accessing the file system
echo file_get_contents($url);
?>