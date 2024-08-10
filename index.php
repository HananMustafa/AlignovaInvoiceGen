<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Receipt</title>
    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Link to your stylesheet -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Alignova Invoice Generator BETA</h2>
        <form action="generateReceipt.php" method="POST">
            <div class="input-group">
                <label for="doctor_name">Doctor Name:</label>
                <input type="text" id="doctor_name" name="doctor_name" required>
            </div>
            <div class="input-group">
                <label for="doc_address">Doctor Address:</label>
                <input type="text" id="doc_address" name="doc_address" required>
            </div>
            <div class="input-group">
                <label for="patient_name">Patient Name:</label>
                <input type="text" id="patient_name" name="patient_name" required>
            </div>
            <div class="input-group select-wrapper">
                <label for="case_type">Case Type:</label>
                <select id="case_type" name="case_type" required>
                    <option value="Case 1">Case 1</option>
                    <option value="Case 2">Case 2</option>
                    <option value="Case 3">Case 3</option>
                </select>
            </div>
            <div class="input-group select-wrapper">
                <label for="arch">Arch:</label>
                <select id="arch" name="arch" required>
                    <option value="Single Arch">Single Arch</option>
                    <option value="Double Arch">Double Arch</option>
                </select>
            </div>
            <div class="input-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="0" required>
            </div>
<div class="input-group">
    <label for="3d_model">3D Model:</label>
    <input type="checkbox" id="3d_model" name="3d_model">
    <label for="3d_model"></label>
</div>
<div class="input-group">
    <label for="alignova_box">Alignova Box:</label>
    <input type="checkbox" id="alignova_box" name="alignova_box">
    <label for="alignova_box"></label>
</div>


            <div class="input-group">
                <label for="discount">Discount:</label>
                <input type="number" id="discount" name="discount" min="0" required>
            </div>
            <div class="input-group">
                <input type="submit" value="Generate Receipt">
            </div>
        </form>
    </div>
</body>
</html>
