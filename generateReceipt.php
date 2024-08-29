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

    $SUA = $_POST['SUA'];
    $SUA_Retainer = isset($_POST['SUA_Retainer']) ? 'Yes' : 'No';
    $SUA_Retainer_qty = $_POST['SUA_Retainer_qty'];

    $SLA = $_POST['SLA'];
    $SLA_Retainer = isset($_POST['SLA_Retainer']) ? 'Yes' : 'No';
    $SLA_Retainer_qty = $_POST['SLA_Retainer_qty'];

    $DUA = $_POST['DUA'];
    $DUA_Retainer = isset($_POST['DUA_Retainer']) ? 'Yes' : 'No';
    $DUA_Retainer_qty = $_POST['DUA_Retainer_qty'];

    $DLA = $_POST['DLA'];
    $DLA_Retainer = isset($_POST['DLA_Retainer']) ? 'Yes' : 'No';
    $DLA_Retainer_qty = $_POST['DLA_Retainer_qty'];

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
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 14, 36);









$free_coordinate = 149;
    //MAIN LOGIC FOR ITEMS 
    if($SUA != 0){
        //it means its a Single UpperArch case
        
            //Item
            $pdf->SetXY(20, 149);
            $pdf->Write(0, "Upper Aligners");
        
            //Qty
            $pdf->SetXY(108, 149);
            $pdf->Write(0, $SUA);

            //Setting Model_3d & AlignovaBox Coordinates
            $free_coordinate = 157;
        
        if($SUA_Retainer == "Yes"){
        //it means SUA_Retainer_qty has a value
            //Item
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(21, 157);
            $pdf->Write(0, "Retainers");
        
            //Qty
            $pdf->SetXY(108, 157);
            $pdf->Write(0, $SUA_Retainer_qty);

            //Back to normal
            $pdf->SetFont('Arial', '', 10);

            //Setting Model_3d & AlignovaBox Coordinates
            $free_coordinate = 165;
        }
        }
        
        else if ($SLA != 0){
            //it means its a Single Lower Arch case
        
            //Item
            $pdf->SetXY(20, 149);
            $pdf->Write(0, "Lower Aligners");
        
            //Qty
            $pdf->SetXY(108, 149);
            $pdf->Write(0, $SLA);

                        //Setting Model_3d & AlignovaBox Coordinates
                        $free_coordinate = 157;
        
        if($SLA_Retainer == "Yes"){
        //it means SLA_Retainer_qty has a value
            //Item
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(21, 157);
            $pdf->Write(0, "Retainers");
        
            //Qty
            $pdf->SetXY(108, 157);
            $pdf->Write(0, $SLA_Retainer_qty);

            //Back to normal
            $pdf->SetFont('Arial', '', 10);

                        //Setting Model_3d & AlignovaBox Coordinates
                        $free_coordinate = 165;
        }
        
        }
        else if ($DUA != 0){
        //it means its a Double Arch case
        
        
        if($DUA_Retainer == "Yes" && $DLA_Retainer == "Yes"){
        //it means DLA/DUA has Retainers
        
            //DUA
            //Item
            $pdf->SetXY(20, 149);
            $pdf->Write(0, "Upper Aligners");
            //Qty
            $pdf->SetXY(108, 149);
            $pdf->Write(0, $DUA);

            //Retainer
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(21, 157);
            $pdf->Write(0, "Upper Retainers");
            //Qty
            $pdf->SetXY(108, 157);
            $pdf->Write(0, $DUA_Retainer_qty);

            //Back to normal
            $pdf->SetFont('Arial', '', 10);
        
            //DLA
            //Item
            $pdf->SetXY(20, 165);
            $pdf->Write(0, "Lower Aligners");
            //Qty
            $pdf->SetXY(108, 165);
            $pdf->Write(0, $DLA);

           //Retainer
           $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(21, 173);
            $pdf->Write(0, "Lower Retainers");
            //Qty
            $pdf->SetXY(108, 173);
            $pdf->Write(0, $DLA_Retainer_qty);

            //Back to normal
            $pdf->SetFont('Arial', '', 10);

                        //Setting Model_3d & AlignovaBox Coordinates
                        $free_coordinate = 181;
        }
        else if ($DUA_Retainer == "Yes" && $DLA_Retainer == "No"){
        //it means only DUA has Retainers
            //DUA
            //Item
            $pdf->SetXY(20, 149);
            $pdf->Write(0, "Upper Aligners");
            //Qty
            $pdf->SetXY(108, 149);
            $pdf->Write(0, $DUA);


            //Retainer
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(21, 157);
            $pdf->Write(0, "Upper Retainers");
            //Qty
            $pdf->SetXY(108, 157);
            $pdf->Write(0, $DUA_Retainer_qty);

            //Back to normal
            $pdf->SetFont('Arial', '', 10);
        
            //DLA
            //Item
            $pdf->SetXY(20, 165);
            $pdf->Write(0, "Lower Aligners");
            //Qty
            $pdf->SetXY(108, 165);
            $pdf->Write(0, $DLA);

                        //Setting Model_3d & AlignovaBox Coordinates
                        $free_coordinate = 173;
        }
        else if ($DUA_Retainer == "No" && $DLA_Retainer == "Yes"){
        //it means only DLA has Retainers
            //DUA
            //Item
            $pdf->SetXY(20, 149);
            $pdf->Write(0, "Upper Aligners");
            //Qty
            $pdf->SetXY(108, 149);
            $pdf->Write(0, $DUA);
        
            //DLA
            //Item
            $pdf->SetXY(20, 157);
            $pdf->Write(0, "Lower Aligners");
            //Qty
            $pdf->SetXY(108, 157);
            $pdf->Write(0, $DLA);


           //Retainer
           $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(21, 165);
            $pdf->Write(0, "Lower Retainers");
            //Qty
            $pdf->SetXY(108, 165);
            $pdf->Write(0, $DLA_Retainer_qty);

            //Back to normal
            $pdf->SetFont('Arial', '', 10);

                        //Setting Model_3d & AlignovaBox Coordinates
                        $free_coordinate = 173;


        }
        else{
        //it means DUA/DLA dont has Retainers
            //DUA
            //Item
            $pdf->SetXY(20, 149);
            $pdf->Write(0, "Upper Aligners");
        
            //Qty
            $pdf->SetXY(108, 149);
            $pdf->Write(0, $DUA);
        
            //DLA
            //Item
            $pdf->SetXY(20, 157);
            $pdf->Write(0, "Lower Aligners");
        
            //Qty
            $pdf->SetXY(108, 157);
            $pdf->Write(0, $DLA);

                        //Setting Model_3d & AlignovaBox Coordinates
                        $free_coordinate = 165;
        }
        
        }

    // CALCULATING THE casePrice
    $casePrice = 0;

    if($arch == "Single Upper Arch" || $arch == "Single Lower Arch"){
        if($case_type == "Case 1"){
            $casePrice = 20000;
        }
        else if($case_type == "Case 2"){
            $casePrice = 40000;
        }
        else if($case_type == "Case 3"){
            $casePrice = 55000;
        }
    }
    else if ($arch == "Double Arch"){
        if($case_type == "Case 1"){
            $casePrice = 25000;
        }
        else if($case_type == "Case 2"){
            $casePrice = 50000;
        }
        else if($case_type == "Case 3"){
            $casePrice = 65000;
        }
    }




    if ($case_type == "Case 1") {
        if($arch == "Single Upper Arch" || $arch == "Single Lower Arch"){
            $casePrice = 20000;
        }
    } elseif ($case_type == "Case 1" && $arch == "Double Arch") {
        $casePrice = 25000;
    } elseif ($case_type == "Case 2") {
        if($arch == "Single Upper Arch" || $arch == "Single Lower Arch"){
            $casePrice = 40000;
        }
    } elseif ($case_type == "Case 2" && $arch == "Double Arch") {
        $casePrice = 50000;
    } elseif ($case_type == "Case 3") {
        if($arch == "Single Upper Arch" || $arch == "Single Lower Arch"){
            $casePrice = 55000;
        }
    } elseif ($case_type == "Case 3" && $arch == "Double Arch") {
        $casePrice = 65000;
    }
    $formatted_casePrice = number_format($casePrice, 0);
    $pdf->SetXY(134, 149);
    $pdf->Write(0, $formatted_casePrice . "/-");
    






    
    // 3DMODEL & ALIGNOVA BOX
    $coordinate1 = $free_coordinate; 
    $coordinate2 = $coordinate1 + 8;
    $coordinate3 = $coordinate2 + 8;     
    if ($model_3d == "Yes" && $alignova_box == "Yes") {
        // Alignova Box
        $pdf->SetXY(20, $coordinate1);
        $pdf->Write(0, "Alignova Box");
        $pdf->SetXY(108, $coordinate1);
        $pdf->Write(0, "01");
        $pdf->SetXY(134, $coordinate1);
        $pdf->Write(0, "2,000/-");
    
        // 3D Model
        $pdf->SetXY(20, $coordinate2);
        $pdf->Write(0, "Alignova Aligners 3D Model");
        $pdf->SetXY(108, $coordinate2);
        $pdf->Write(0, "01");
        $pdf->SetXY(134, $coordinate2);
        $pdf->Write(0, "5,000/-");
    } elseif ($model_3d == "Yes" && $alignova_box == "No") {
        // 3D Model only
        $pdf->SetXY(20, $coordinate1);
        $pdf->Write(0, "Alignova Aligners 3D Model");
        $pdf->SetXY(108, $coordinate1);
        $pdf->Write(0, "01");
        $pdf->SetXY(134, $coordinate1);
        $pdf->Write(0, "5,000/-");
    } elseif ($model_3d == "No" && $alignova_box == "Yes") {
        // Alignova Box only
        $pdf->SetXY(20, $coordinate1);
        $pdf->Write(0, "Alignova Box");
        $pdf->SetXY(108, $coordinate1);
        $pdf->Write(0, "01");
        $pdf->SetXY(134, $coordinate1);
        $pdf->Write(0, "2,000/-");
    }





















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
    $pdf->Write(0, "Case Type: " . $case_type . " " . $arch);




















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

    // Output the PDF directly to the browser for download
    $pdf->Output('D', $filename);




    //LOG
    try{
        // Generate a log message
    $logMessage = "DOCTOR: $doctor_name
                   PATIENT: $patient_name 
                   THIS TRANSACTION: $subTotal
                   UPDATED BALANCE: $updatedBalance
                   ";

    // Display the log message as an error (if errors are logged)
    trigger_error($logMessage, E_USER_NOTICE);
    error_log($logMessage);

    // Proceed with receipt generation
    // ... (your existing code)

    echo "Receipt generated successfully!";
} catch (Exception $e) {
    // Log the exception message
    trigger_error("Error: " . $e->getMessage(), E_USER_ERROR);
    }




exit;
} else {
    echo "Invalid request method.";
}
