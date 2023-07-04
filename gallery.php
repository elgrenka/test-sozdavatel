<?php
$galleryPath = 'images/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

// Функция для проверки расширения файла
function isValidExtension($filename): bool {
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    global $allowedExtensions;
    return in_array($extension, $allowedExtensions);
}

// Функция для чтения файлов из папки галереи и отбора изображений
function getImagesFromGallery(): array {
    global $galleryPath;
    $images = [];
    $files = scandir($galleryPath);

    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && isValidExtension($file)) {
            $images[] = $galleryPath . $file;
        }
    }

    return $images;
}

// Обработка загрузки файла
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadedFile = $_FILES['image'];

    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
        $filename = $uploadedFile['name'];
        $fileTmp = $uploadedFile['tmp_name'];

        if (isValidExtension($filename)) {
            $destination = $galleryPath . $filename;
            move_uploaded_file($fileTmp, $destination);
            header("Location: gallery.php");
            exit();
        } else {
            $error = "Invalid file extension. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        $error = "File upload error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Photo Gallery</h1>

<h2>Gallery</h2>

<?php
// Вывод изображений из галереи
$images = getImagesFromGallery();
foreach ($images as $image) {
    echo '<div class="image-container">';
    echo "<img src='$image' alt='Image'>";
    echo '</div>';
}
?>

<h2>Add Image</h2>
<form action="gallery.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image" required>
    <input type="submit" value="Upload">
</form>

<?php
if (isset($error)) {
    echo '<p>Error: ' . $error . '</p>';
}
?>

</body>
</html>

