<?php 
$title = "contact";
require_once "template/header.php";
echo "information of the POST data: ";
/* print the output of POST data : if($_SERVER['REQUEST_METHOD'] == 'POST'){echo "<pre>";print_r($_POST);print_r($_FILES);echo "</pre>";}*/

// filter the string
function filterString($field){
    $field = filter_var(trim($field),FILTER_SANITIZE_STRING); // clean the string 
    if(empty($field)){
        return false;
    }else{
        return $field;   
    }
}

// validate file function 
function canUpload($file){
        // check the file 
        echo "<pre style='color:green;'>";
        echo "the file is fine";
        echo "</pre>";
        // allowed to upload the file types
        $allowed = [
            'jpg'=>'image/jpg',
            'gif'=>'image/gif',
            'png'=>'image/png',
            'jpeg'=>'image/jpeg'
        ];
        /* know the file type $fileType = $_FILES['document']['type']; echo $fileType;*/
        $fileMimeType = mime_content_type($file['tmp_name']);
        $maxFileSize = 50 * 1024;
        $fileSize = $file['size'];
        echo $fileSize." KB ";
        // allowed condition 
        if(!in_array($fileMimeType,$allowed)){
            // echo "<pre style='color:red;'>";echo 'file is not allowed';die();echo "</pre>";
            return "file type is not allowed";
        }
        
        // validate the file size 
        if($fileSize > $maxFileSize){
            return "File size is not allowed";
        // close the app die(" max file size, kindly resize the file ".$maxFileSize);
        }
        return true;
}
// filter the email 
function filterEmail($field){
    $field = filter_var(trim($field),FILTER_SANITIZE_EMAIL); // clean the email 
    
    if(filter_var($field,FILTER_VALIDATE_EMAIL)){
        return $field;
    }else{
        return false;
    }
}

// Error var
$nameError = $emailError = $messageError = $documentError = '';
$name = $email = $document = $message= '';


// validate the upload files 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // to show the error message into contact page when the name is empty 
    $name = filterString($_POST['name']);
    if(!$name){
        $nameError = 'your name is required';
    }
    // to show the error message into contact page when the email is empty
    $email = filterEmail($_POST['email']);
    if(!$email){
        $emailError = "invalied email is required";
    } 

    // to show the error message into contact page when the message is empty
    $message = filterString($_POST['message']);
    if(!$message){
        $messageError = "insert your message";
    }


    // validate document 
    /*if(!filterEmail($_POST['email'])){ echo "<pre style='color:red;'>"; die('your email is incorrect'); echo "</pre>";}*/
    // check the file is clean or not 
    if(isset($_FILES['document']) && $_FILES['document']['error'] == 0){
         $canUpload = canUpload($_FILES['document']);
         // upload the files 
         $uploadDir = "uploads";
         if($canUpload === true){
            // check the if there is a directory for upload the files 
            if(!is_dir($uploadDir)){
                umask(0); // for change the permission of the files === chmod
                // if did not find make the direectory & make a permission 0775 
                // chmod($uploadDir,0775);
                mkdir($uploadDir,0775,true);
            }
            echo "<h3>you can upload</h3>";
            $fileName = time().$_FILES['document']['name']; // file name var and upload the file with time stamp
            // check if the file exiest 
            if(file_exists($uploadDir.'/'.$fileName)){
                $documentError = "file is exists";
            }else{
                // upload the files 
                move_uploaded_file($_FILES['document']['tmp_name'],$uploadDir.'/'.$fileName);
            }
         }else{
             $documentError = $canUpload;
         }
    }
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
        <input type="text" name="name" value="<?php echo $name ?>" class="form-control" placeholder="your name"> 
        <!-- save text before sending data  -->
        <span class="text-danger"><?php echo $nameError ?></span>
    </div>
    <div class="form-group">
        <label for="email">your email</label>
        <!-- make a value for email -->
        <input type="email" value="<?php echo $email ?>" name="email" class="form-control" placeholder=" your email">
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
        <label for="message"> your name </label>
        <textarea name="message" class="form-control" placeholder="your message"><?php echo $message ?></textarea>
        <span class="text-danger"><?php echo $messageError ?></span>
    </div>
    <!-- send button  -->
    <button class="btn btn-primary">Send</button>
</form>

<?php require_once "template/footer.php";
/* $input = "<script>$('body').html('<h1> you have been hacked</h1>')</script>"; echo $input;*/
?>