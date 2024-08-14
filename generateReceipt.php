<?php
require_once './FPDF/fpdf.php';
require_once './FPDI/src/autoload.php';

use setasign\Fpdi\Fpdi;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $patient_name = $_POST['patient_name'];
    $case_type = $_POST['case_type'];
    $arch = $_POST['arch'];
    $model_3d = isset($_POST['3d_model']) ? 'Yes' : 'No';
    $alignova_box = isset($_POST['alignova_box']) ? 'Yes' : 'No';
    $discount = $_POST['discount'];
    $PreviousBalance = $_POST['PreviousBalance'];
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

    // DATE
    $currDate = date('d-m-Y'); 
    $pdf->SetXY(138.6, 47);
    $pdf->Write(0,"Date: " . $currDate);

    $pdf->SetFont('Arial', '', 11);
    // DOCTOR DETAILS
    $pdf->SetXY(20, 65); 
    $pdf->Write(0,$doctor_name);
    $pdf->SetXY(20, 70); // Adjust coordinates as needed
    $pdf->Write(0,$doc_address);

    $pdf->SetXY(20, 90); // Adjust coordinates as needed
    $pdf->Write(0, "Name: " . $patient_name);

    $pdf->SetXY(20, 96);
    $pdf->Write(0, "Case Type: " . $case_type);

    // CALCULATING THE casePrice
    $casePrice = 0;

    if ($case_type == "Case 1" && $arch == "Single Arch") {
        $casePrice = 20000;
    } elseif ($case_type == "Case 1" && $arch == "Double Arch") {
        $casePrice = 25000;
    } elseif ($case_type == "Case 2" && $arch == "Single Arch") {
        $casePrice = 40000;
    } elseif ($case_type == "Case 2" && $arch == "Double Arch") {
        $casePrice = 50000;
    } elseif ($case_type == "Case 3" && $arch == "Single Arch") {
        $casePrice = 55000;
    } elseif ($case_type == "Case 3" && $arch == "Double Arch") {
        $casePrice = 65000;
    }

    $pdf->SetXY(20, 149);
    $pdf->Write(0, $case_type . ": " . $arch);
    $pdf->SetXY(108, 149);
    $pdf->Write(0, '01');
    $pdf->SetXY(134, 149);
    $formatted_casePrice = number_format($casePrice, 0);
    $pdf->Write(0, $formatted_casePrice . "/-");

    // 3DMODEL & ALIGNOVA BOX
    if ($model_3d == "Yes" && $alignova_box == "Yes") {
        // Alignova Box
        $pdf->SetXY(20, 157);
        $pdf->Write(0, "Alignova Box");
        $pdf->SetXY(108, 157);
        $pdf->Write(0, "01");
        $pdf->SetXY(134, 157);
        $pdf->Write(0, "2,000/-");
    
        // 3D Model
        $pdf->SetXY(20, 165);
        $pdf->Write(0, "Alignova Aligners 3D Model");
        $pdf->SetXY(108, 165);
        $pdf->Write(0, "01");
        $pdf->SetXY(134, 165);
        $pdf->Write(0, "5,000/-");
    } elseif ($model_3d == "Yes" && $alignova_box == "No") {
        // 3D Model only
        $pdf->SetXY(20, 157);
        $pdf->Write(0, "Alignova Aligners 3D Model");
        $pdf->SetXY(108, 157);
        $pdf->Write(0, "01");
        $pdf->SetXY(134, 157);
        $pdf->Write(0, "5,000/-");
    } elseif ($model_3d == "No" && $alignova_box == "Yes") {
        // Alignova Box only
        $pdf->SetXY(20, 157);
        $pdf->Write(0, "Alignova Box");
        $pdf->SetXY(108, 157);
        $pdf->Write(0, "01");
        $pdf->SetXY(134, 157);
        $pdf->Write(0, "2,000/-");
    }

    // CALCULATING SUBTOTAL
    $subTotal = $casePrice;
    if ($model_3d == "Yes") {
        $subTotal += 5000;
    }
    if ($alignova_box == "Yes") {
        $subTotal += 2000;
    }

    // Previous Balance
    $formatted_PreviousBalance = number_format($PreviousBalance, 0);
    $pdf->SetXY(125, 211);
    $pdf->SetFont('Arial', 'b', 13);
    $pdf->Write(0,"Previous Balance:");

    $pdf->SetXY(170, 211);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Write(0, $formatted_PreviousBalance . "/-");

    // This Transaction
    $formatted_subTotal = number_format($subTotal, 0);
    $pdf->SetXY(125, 219);
    $pdf->SetFont('Arial', 'b', 13);
    $pdf->Write(0,"This Transaction:");

    $pdf->SetXY(170, 219);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Write(0, $formatted_subTotal . "/-");

    // After Discount 
    if($discount != 0){
        $AfterDiscount = $subTotal - $discount;
        $formatted_AfterDiscount = number_format($AfterDiscount, 0);
        $pdf->SetXY(125, 228);
        $pdf->SetFont('Arial', 'b', 13);
        $pdf->Write(0,"After Discount:");

        $pdf->SetXY(170, 228);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Write(0, $formatted_AfterDiscount . "/-" );

        // Updated Balance
        $updatedBalance = $PreviousBalance + $AfterDiscount;
        $formatted_updatedBalance = number_format($updatedBalance, 0);
        $pdf->SetXY(125, 237);
        $pdf->SetFont('Arial', 'b', 13);
        $pdf->Write(0,"Updated Balance:");

        $pdf->SetXY(170, 237);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Write(0, $formatted_updatedBalance . "/-" );
    }
    else{
        // Updated Balance
        $updatedBalance = $PreviousBalance + $subTotal;
        $formatted_updatedBalance = number_format($updatedBalance, 0);
        $pdf->SetXY(125, 228);
        $pdf->SetFont('Arial', 'b', 13);
        $pdf->Write(0,"Updated Balance:");

        $pdf->SetXY(170, 228);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Write(0, $formatted_updatedBalance . "/-" );
    }

    // Set the filename based on doctor name and date
    $filename = $doctor_name . ' ' . $currDate . '.pdf';
    $filename = str_replace(' ', '_', $filename); // Replace spaces with underscores

    // Output the PDF to the browser
    $pdf->Output('D', $filename); // 'D' forces the download

    exit;
} else {
    echo "Invalid request method.";
}
