<?php
if (isset($_GET['file'])) {
    $filePath = urldecode($_GET['file']);

    // Check if file exists
    if (file_exists($filePath)) {
        // Serve the file as a download
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename=' . basename($filePath));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush(); // Flush system output buffer
        readfile($filePath);

        // Optionally, delete the file after download
        unlink($filePath);
        exit;
    } else {
        echo "Error: File not found.";
    }
} else {
    echo "Error: No file specified.";
}
