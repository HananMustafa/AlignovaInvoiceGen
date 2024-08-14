<?php
require_once 'db_connection.php';

// Check if the data is received via GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Capture the form data
    $doctorName = $_GET['doctor_name'];
    $doctorAddress = $_GET['doc_address'];
    $patientName = $_GET['patient_name'];
    $patientAddress = $_GET['patient_address'];
    $caseType = $_GET['case_type'];
    $arch = $_GET['arch'];
    $model3D = $_GET['model3d'];
    $alignovaBox = $_GET['alignova_box'];
    $formattedCasePrice = $_GET['formatted_case_price'];
    $formattedPreviousBalance = $_GET['formatted_previous_balance'];
    $formattedSubTotal = $_GET['formatted_sub_total'];
    $formattedAfterDiscount = $_GET['formatted_after_discount'];
    $formattedUpdatedBalance = $_GET['formatted_updated_balance'];

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

    // Optionally, redirect or show a confirmation message
    echo "Data saved successfully.";
    exit;
} else {
    echo "Invalid request method.";
}
