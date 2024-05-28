<?php

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if file was uploaded without errors
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $errors = array();
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
        $file_tmp = $_FILES["photo"]["tmp_name"];
        $extensions = array("jpg", "jpeg", "gif", "png");
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Verify file extension
        if (!in_array($file_ext, $extensions)) {
            $errors[] = "Error: Please select a valid file format.";
        }

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) {
            $errors[] = "Error: File size is larger than the allowed limit.";
        }

        // Verify MYME type of the file
        if (empty($errors)) {
            $upload_dir = "Upload/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            if (file_exists($upload_dir . $filename)) {
                echo $filename . " already exists.";
            } else {
                move_uploaded_file($file_tmp, $upload_dir . $filename);
                echo "File uploaded successfully";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    } else {
        echo "Error: " . $_FILES["photo"]["error"];
    }
}
?>
<html>

<body>
    <form method="post" enctype="multipart/form-data">
        <h2>Upload File Example</h2>
        <input type="file" name="photo" id="fileSelect">
        <input type="submit" name="submit" value="Upload File">
    </form>
</body>

</html>




 