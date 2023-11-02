<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" ){ 
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg','gif','png','webp'];
    $maxFileSize = 1000000;

    if ((!in_array($extension, $authorizedExtensions))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou gif ou Png ou webp !';
    }

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    if (empty($errors)) {
        $uniqueFileName = uniqid('image_') . '.' . $extension;
        $uploadFile = $uploadDir . $uniqueFileName;
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
            echo "Votre fichier à été téléchargé avec succès.";
        } else {
            $errors[] = "Une erreur est survenue lors du téléchargement du fichier.";
        }
    }
}
$errors = [];
$uploadDir = 'public/uploads/';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
    <form method="post" enctype="multipart/form-data">
        <label for="imageUpload">Upload an profile image</label>    
        <input type="file" name="avatar" id="imageUpload" />
        <button name="send">Send</button>
    </form>
</body>
</html>