<?php 
$title = "contact";
require_once "template/header.php";
include('includes/uploader.php');
if(isset($_SESSION['contact_form'])){
    print_r($_SESSION['contact_form']);
}
?>

<!-- contact page structre  -->
<h1> Welcome to <?php echo $title ?></h1>
<!-- create a Contact Form  -->
<!-- set the POST action and confirm the data was sent and encript the data  -->
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Your name</label>
        <!-- make a value for name -->
        <input type="text" name="name" value="<?php if(isset($_SESSION['contact_form']['name'])) echo $_SESSION['contact_form']['name'] ?>" class="form-control" placeholder="your name"> 
        <!-- save text before sending data  -->
        <span class="text-danger"><?php echo $nameError ?></span>
    </div>
    <div class="form-group">
        <label for="email">your email</label>
        <!-- make a value for email -->
        <input type="email" value="<?php if(isset($_SESSION['contact_form']['email']))echo $email ?>" name="email" class="form-control" placeholder=" your email">
        <!-- saving email before sending data -->
        <span class="text-danger"><?php echo $emailError ?></span>
    </div>
    <div class="form-group">
        <label for="document"> your document </label>
        <!-- make a value for document  -->
        <input type="file" value="<?php echo $document ?>" name="document">
        <!-- save document before data -->
        <span class="text-danger"><?php echo $documentError ?></span>
    </div>
    <div class="form-group">
        <label for="message"> your message </label>
        <textarea name="message" class="form-control" placeholder="your message"><?php if(isset($_SESSION['contact_form']['message'])) echo $_SESSION['contact_form']['email'] ?></textarea>
        <span class="text-danger"><?php echo $messageError ?></span>
    </div>
    <!-- send button  -->
    <button class="btn btn-primary">Send</button>
</form>

<?php require_once "template/footer.php";
/* $input = "<script>$('body').html('<h1> you have been hacked</h1>')</script>"; echo $input;*/
?>