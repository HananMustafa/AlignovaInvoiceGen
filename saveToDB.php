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
        IF OBJECT_ID('Invoices', 'U') IS NULL
        CREATE TABLE Invoices (
            id INT IDENTITY(1,1) PRIMARY KEY,
            DoctorName NVARCHAR(255),
            DoctorAddress NVARCHAR(255),
            PatientName NVARCHAR(255),
            PatientAddress NVARCHAR(255),
            CaseType NVARCHAR(255),
            Arch NVARCHAR(255),
            Model3D NVARCHAR(10),
            AlignovaBox NVARCHAR(10),
            CasePrice DECIMAL(10, 2),
            PreviousBalance DECIMAL(10, 2),
            SubTotal DECIMAL(10, 2),
            AfterDiscount DECIMAL(10, 2),
            UpdatedBalance DECIMAL(10, 2)
        )
    ";

    // Execute the query to create the table
    $stmt = sqlsrv_query($conn, $createTableSQL);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Insert data into the 'Invoices' table
    $insertSQL = "
        INSERT INTO Invoices (DoctorName, DoctorAddress, PatientName, PatientAddress, CaseType, Arch, Model3D, AlignovaBox, CasePrice, PreviousBalance, SubTotal, AfterDiscount, UpdatedBalance)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

    $params = [
        $doctorName, $doctorAddress, $patientName, $patientAddress, $caseType, $arch, $model3D, $alignovaBox,
        $formattedCasePrice, $formattedPreviousBalance, $formattedSubTotal, $formattedAfterDiscount, $formattedUpdatedBalance
    ];

    $stmt = sqlsrv_query($conn, $insertSQL, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Optionally, redirect or show a confirmation message
    echo "Data saved successfully.";
    exit;
} else {
    echo "Invalid request method.";
}
?>
