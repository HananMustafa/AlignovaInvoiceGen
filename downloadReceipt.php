<?php
if (isset($_GET['file'])) {
    $fileName = urldecode($_GET['file']);

    // Check if file exists
    if (file_exists($fileName)) {
        // Serve the file as a download
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename=' . basename($fileName));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        flush(); // Flush system output buffer
        readfile($fileName);

        // Optionally, delete the file after download
        unlink($fileName);
        exit;
    } else {
        echo "Error: File not found.";
    }
} else {
    echo "Error: No file specified.";
}
?>