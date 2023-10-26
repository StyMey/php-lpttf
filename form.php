<?php

if (isset($_POST["send"])){ 
    $file = $_FILES['avatar'];
    $fileName = $_FILES['avatar']['name'];
    $fileTmpName = $_FILES['avatar']['tmp_name'];
    $fileSize = $_FILES['avatar']['size'];
    $fileType = $_FILES['avatar']['type'];
    $fileError = $_FILES['avatar']['error'];
    var_dump($file);


    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg','gif','png','webp'];
    $maxFileSize = 1000000;
    

    if ((!in_array($extension, $authorizedExtensions))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou gif ou Png ou webp !';
    }

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1M !";
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST" ){ 
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
}

if (empty($error)) {
    $uploadDir = 'public/uploads/';
    move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <label for="imageUpload">Upload an profile image</label>    
        <input type="file" name="avatar" id="imageUpload" />
        <button name="send">Send</button>
    </form>
</body>
</html>