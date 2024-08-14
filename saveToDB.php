<?php
require_once 'db_connection.php';

// Check if the data is received via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture the form data
    $doctorName = $_POST['doctor_name'];
    $doctorAddress = $_POST['doc_address'];
    $patientName = $_POST['patient_name'];
    $patientAddress = $_POST['patient_address'];
    $caseType = $_POST['case_type'];
    $arch = $_POST['arch'];
    $model3D = isset($_POST['3d_model']) ? 'Yes' : 'No';
    $alignovaBox = isset($_POST['alignova_box']) ? 'Yes' : 'No';
    $formattedCasePrice = $_POST['formatted_case_price'];
    $formattedPreviousBalance = $_POST['formatted_previous_balance'];
    $formattedSubTotal = $_POST['formatted_sub_total'];
    $formattedAfterDiscount = $_POST['formatted_after_discount'];
    $formattedUpdatedBalance = $_POST['formatted_updated_balance'];

    // Create the 'Invoices' table if it doesn't exist
    $createTableSQL = "
        CREATE TABLE IF NOT EXISTS Invoices (
            id INT AUTO_INCREMENT PRIMARY KEY,
            DoctorName VARCHAR(255),
            DoctorAddress VARCHAR(255),
            PatientName VARCHAR(255),
            PatientAddress VARCHAR(255),
            CaseType VARCHAR(255),
            Arch VARCHAR(255),
            Model3D VARCHAR(10),
            AlignovaBox VARCHAR(10),
            CasePrice DECIMAL(10, 2),
            PreviousBalance DECIMAL(10, 2),
            SubTotal DECIMAL(10, 2),
            AfterDiscount DECIMAL(10, 2),
            UpdatedBalance DECIMAL(10, 2)
        )
    ";

    // Execute the query to create the table
    $pdo->exec($createTableSQL);

    // Insert data into the 'Invoices' table
    $insertSQL = "
        INSERT INTO Invoices (DoctorName, DoctorAddress, PatientName, PatientAddress, CaseType, Arch, Model3D, AlignovaBox, CasePrice, PreviousBalance, SubTotal, AfterDiscount, UpdatedBalance)
        VALUES (:doctorName, :doctorAddress, :patientName, :patientAddress, :caseType, :arch, :model3D, :alignovaBox, :casePrice, :previousBalance, :subTotal, :afterDiscount, :updatedBalance)
    ";

    $stmt = $pdo->prepare($insertSQL);
    $stmt->execute([
        ':doctorName' => $doctorName,
        ':doctorAddress' => $doctorAddress,
        ':patientName' => $patientName,
        ':patientAddress' => $patientAddress,
        ':caseType' => $caseType,
        ':arch' => $arch,
        ':model3D' => $model3D,
        ':alignovaBox' => $alignovaBox,
        ':casePrice' => $formattedCasePrice,
        ':previousBalance' => $formattedPreviousBalance,
        ':subTotal' => $formattedSubTotal,
        ':afterDiscount' => $formattedAfterDiscount,
        ':updatedBalance' => $formattedUpdatedBalance,
    ]);

    // Redirect to downloadReceipt.php
    header('Location: downloadReceipt.php?file=' . urlencode($_POST['file']));
    exit;
} else {
    echo "Invalid request method.";
}
