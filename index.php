<?php 
$title = "Home Page"; // title var 
require_once "template/header.php" // include the header file
?> 
<!-- set the title var as h1 -->
<h1> Welcome to <?php echo $config["app_name"]; ?> </h1>
<a href="./contact.php"> Go to contact </a>
<!-- include the footer file -->
<?php require_once "template/footer.php" ?>