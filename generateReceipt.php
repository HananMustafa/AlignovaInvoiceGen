<?php
require_once './FPDF/fpdf.php';
require_once './FPDI/src/autoload.php';

use setasign\Fpdi\Fpdi;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $patient_name = $_POST['patient_name'];
    $case_type = $_POST['case_type'];
    $arch = $_POST['arch'];
    $quantity = $_POST['quantity'];
    $model_3d = isset($_POST['3d_model']) ? 'Yes' : 'No';
    $alignova_box = isset($_POST['alignova_box']) ? 'Yes' : 'No';
    $discount = $_POST['discount'];
    $doctor_name = $_POST['doctor_name'];
    $doc_address = $_POST['doc_address'];

    // Create new PDF
    $pdf = new FPDI();
    // Set the source PDF file
    $pdf->setSourceFile('template.pdf');
    // Import the first page of the template PDF
    $tplIdx = $pdf->importPage(1);
    // Add a page to the PDF
    $pdf->AddPage();
    // Use the imported page as the template
    $pdf->useTemplate($tplIdx);

    // Set font for dynamic content
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 14, 36);

    //DATE
    $currDate = date('d-m-Y'); 
    $pdf->SetXY(138.6, 47);
    $pdf->Write(0,"Date: " . $currDate);

    $pdf->SetFont('Arial', '', 11);
    //DOCTOR DETAILS
    $pdf->SetXY(20, 65); 
    $pdf->Write(0,$doctor_name);
    $pdf->SetXY(20, 70); // Adjust coordinates as needed
    $pdf->Write(0,$doc_address);

    $pdf->SetXY(20, 90); // Adjust coordinates as needed
    $pdf->Write(0, "Name: " . $patient_name);

    $pdf->SetXY(20, 96);
    $pdf->Write(0, "Case Type: " . $case_type);

    //CALCULATING THE casePrice
    $casePrice = 0;

    if ($case_type == "Case 1" && $arch == "Single Arch") {
        $casePrice = 20000;
    } elseif ($case_type == "Case 1" && $arch == "Double Arch") {
        $casePrice = 50000;
    } elseif ($case_type == "Case 2" && $arch == "Single Arch") {
        $casePrice = 40000;
    } elseif ($case_type == "Case 2" && $arch == "Double Arch") {
        $casePrice = 50000;
    } elseif ($case_type == "Case 3" && $arch == "Single Arch") {
        $casePrice = 55000;
    } elseif ($case_type == "Case 4" && $arch == "Double Arch") {
        $casePrice = 65000;
    }

    $pdf->SetXY(20, 149);
    $pdf->Write(0, $case_type . ": " . $arch);
    $pdf->SetXY(108, 149);
    $pdf->Write(0, $quantity);
    $pdf->SetXY(134, 149);
    $pdf->Write(0, $casePrice . "/-");

    //3DMODEL & ALIGNOVA BOX
    if ($model_3d == "Yes" && $alignova_box == "Yes") {
        // Alignova Box
        $pdf->SetXY(20, 157);
        $pdf->Write(0, "Alignova Box");
        $pdf->SetXY(108, 157);
        $pdf->Write(0, "1");
        $pdf->SetXY(134, 157);
        $pdf->Write(0, "2000/-");
    
        // 3D Model
        $pdf->SetXY(20, 165);
        $pdf->Write(0, "Alignova Aligners 3D Model");
        $pdf->SetXY(108, 165);
        $pdf->Write(0, "1");
        $pdf->SetXY(134, 165);
        $pdf->Write(0, "5000/-");
    } elseif ($model_3d == "Yes" && $alignova_box == "No") {
        // 3D Model only
        $pdf->SetXY(20, 157);
        $pdf->Write(0, "Alignova Aligners 3D Model");
        $pdf->SetXY(108, 157);
        $pdf->Write(0, "1");
        $pdf->SetXY(134, 157);
        $pdf->Write(0, "5000/-");
    } elseif ($model_3d == "No" && $alignova_box == "Yes") {
        // Alignova Box only
        $pdf->SetXY(20, 157);
        $pdf->Write(0, "Alignova Box");
        $pdf->SetXY(108, 157);
        $pdf->Write(0, "1");
        $pdf->SetXY(134, 157);
        $pdf->Write(0, "2000/-");
    }

    //CALCULATING SUBTOTAL
    $subTotal = $casePrice;
    if ($model_3d == "Yes") {
        $subTotal += 5000;
    }
    if ($alignova_box == "Yes") {
        $subTotal += 2000;
    }

    //CALCULATING GRANDTOTAL
    $grandTotal = $subTotal - $discount;

    $pdf->SetXY(145, 211);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Write(0,$subTotal . "/-");
    $pdf->SetXY(145, 219);
    $pdf->Write(0,$discount . "/-");
    $pdf->SetXY(145, 228);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Write(0,$grandTotal . "/-");

    // Save the PDF to a temporary directory
    $tempDir = sys_get_temp_dir(); // Get the system's temp directory
    $fileName = $doctor_name . ' ' . $currDate . '.pdf';
    $filePath = $tempDir . DIRECTORY_SEPARATOR . $fileName;

    $pdf->Output('F', $filePath);

    // Redirect to downloadReceipt.php
    header('Location: downloadReceipt.php?file=' . urlencode($filePath));
    exit;
} else {
    echo "Invalid request method.";
}
