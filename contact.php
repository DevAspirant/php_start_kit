<?php 
$title = "contact";
require_once "template/header.php";
echo "information of the POST data: ";
/* print the output of POST data : if($_SERVER['REQUEST_METHOD'] == 'POST'){echo "<pre>";print_r($_POST);print_r($_FILES);echo "</pre>";}*/
// validate the upload files 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_FILES['document']) && $_FILES['document']['error'] == 0){
        echo "<pre style='color:green;'>";
        echo "the file is fine";
        echo "</pre>";
        // allowed to upload the file types
        $allowed = [
            'jpg'=>'images/jpg',
            'gif'=>'images/gif'
        ];

        $fileType = $_FILES['document']['type'];
        if(!in_array($fileType,$allowed)){
            echo "<pre style='color:red;'>";
            echo 'file is not allowed';
            die();
            echo "</pre>";
        }    
        
    }
}
?>

<h1> Welcome to <?php echo $title ?></h1>
<!-- create a Contact Form  -->
<!-- set the POST action and confirm the data was sent and encript the data  -->
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Your name</label>
        <input type="text" name="name" class="form-control" placeholder="your name"> 
    </div>
    <div class="form-group">
        <label for="email">your email</label>
        <input type="email" name="email" class="form-control" placeholder=" your email">
    </div>
    <div class="form-group">
        <label for="document"> your document </label>
        <input type="file" name="document">
    </div>
    <div class="form-group">
        <label for="name"> your name </label>
        <textarea name="message" class="form-control" placeholder="type your meesage"></textarea>
    </div>
    <button class="btn btn-primary">Send</button>
</form>
<?php require_once "template/footer.php" ?>