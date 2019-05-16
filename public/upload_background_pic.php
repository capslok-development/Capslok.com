<?php
if(isset($_FILES["file"]["type"]))
{
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);
    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
        ) && ($_FILES["file"]["size"] < 10000000)//Approx. 10000kb files can be uploaded.
        && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        }
        else
        {
            if (file_exists("images/background_pictures/" . $_POST['user_id'] . $_FILES["file"]["name"])) {
                echo "<div class=\"alert alert-danger alert-dismissable\">
                        <a class=\"panel-close close\" data-dismiss=\"alert\">×</a>
                       ". $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span>
                    </div>";
            }
            else
            {
                $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                $targetPath = "images/background_pictures/".$_POST['user_id'].$_FILES['file']['name']; // Target path where file is to be stored
                move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
                echo "<div class=\"alert alert-success alert-dismissable\">
                        <a class=\"panel-close close\" data-dismiss=\"alert\">×</a>
                        Your new profile picture has uploaded successfully!
                    </div>";
            }
        }
    }
    else
    {
        echo "<span id='invalid'>***Invalid file Size or Type***<span>";
    }
}
?>