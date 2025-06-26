<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Path to the file
    $filePath = 'data_dir/' . $file;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Delete the file
        unlink($filePath);

        // Redirect to the list page after deletion
        header('Location: list.php');
        exit;
    } else {
        echo "Error: File does not exist!";
    }
} else {
    echo "No file specified to delete.";
}
?>