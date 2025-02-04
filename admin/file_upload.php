<?php
// Upload handler (upload.php)
if ($_FILES['upload']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['upload']['tmp_name'];
    $fileName = $_FILES['upload']['name'];
    $uploadPath = '/uploads/' . $fileName;

    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
        echo json_encode([
            'url' => 'http://localhost/my-blog/admin/uploads/' . $fileName
        ]);
    } else {
        echo json_encode(['error' => 'Upload failed']);
    }
}
