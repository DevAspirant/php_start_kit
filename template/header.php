<?php 
// start the session 
session_start();
require_once __DIR__.'/../config/app.php'?>
<!-- هذه عشان نختبر الاخطاء في المشروع -->
<!-- error_reporting(E_ALL); -->
<!-- ini_set('display_errors',1); -->

<!DOCTYPE html>
<html dir="<?php $config["dir"]?>" lang="<?php echo $config["lang"]?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config["app_name"] . " | " . $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container">
<!-- if the sender_name == nil  -->
<?php isset($_SESSION['visitor_name']) ? $sender = $_SESSION['visitor_name'] : $sender = '' ?>

<!-- output the sessions -->
<p>Hello, <?php echo $_SESSION['visitor_name'] ?></p>

