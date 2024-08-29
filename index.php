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
    <style>
        /* Hide fields initially */
        .hidden {
            display: none;
        }
        .visible {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Alignova Invoice Generator</h2>
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

            <h4>Arch Details</h4>
            <!-- DYNAMIC DATA -->
            <div class="input-group select-wrapper">
                <label for="arch">Arch:</label>
                <select id="arch" name="arch" required>
                    <option value="Single Upper Arch">Single Upper Arch</option>
                    <option value="Single Lower Arch">Single Lower Arch</option>
                    <option value="Double Arch">Double Arch</option>
                </select>
            </div>

            <!-- Single Upper Arch -->
            <div id="SUA_Fields" class="hidden">
                <div class="input-group">
                    <label for="SUA">Upper Aligners Qty:</label>
                    <input type="number" id="SUA" name="SUA" min="0" value="0" required class="qty-field">
                </div>
                <div class="input-group">
                    <label for="SUA_Retainer">Retainers:</label>
                    <input type="checkbox" id="SUA_Retainer" name="SUA_Retainer">
                    <label for="SUA_Retainer"></label>
                </div>
            </div>

            <!-- Retainer qty for Single Upper Arch -->
            <div id="SUA_Retainer_qty_Field" class="input-group hidden">
                <label for="SUA_Retainer_qty">Retainers Qty:</label>
                <input type="number" id="SUA_Retainer_qty" name="SUA_Retainer_qty" min="0" value="01" required class="qty-field">
            </div>

            <!-- Single Lower Arch -->
            <div id="SLA_Fields" class="hidden">
                <div class="input-group">
                    <label for="SLA">Lower Aligners Qty:</label>
                    <input type="number" id="SLA" name="SLA" min="0" value="0" required class="qty-field">
                </div>
                <div class="input-group">
                    <label for="SLA_Retainer">Retainers:</label>
                    <input type="checkbox" id="SLA_Retainer" name="SLA_Retainer">
                    <label for="SLA_Retainer"></label>
                </div>
            </div>

            <!-- Retainer qty for Single Lower Arch -->
            <div id="SLA_Retainer_qty_Field" class="input-group hidden">
                <label for="SLA_Retainer_qty">Retainers Qty:</label>
                <input type="number" id="SLA_Retainer_qty" name="SLA_Retainer_qty" min="0" value="01" required class="qty-field">
            </div>

            <!-- Double Arch -->
            <div id="DUA_DLA_Fields" class="hidden">
                <div class="input-group">
                    <label for="DUA">Upper Aligners Qty:</label>
                    <input type="number" id="DUA" name="DUA" min="0" value="0" required class="qty-field">
                </div>
                <div class="input-group">
                    <label for="DUA_Retainer">Retainers:</label>
                    <input type="checkbox" id="DUA_Retainer" name="DUA_Retainer">
                    <label for="DUA_Retainer"></label>
                </div>
            <!-- Retainer qty for Double Upper Arch -->
            <div id="DUA_Retainer_qty_Field" class="input-group hidden">
                <label for="DUA_Retainer_qty">Retainers Qty:</label>
                <input type="number" id="DUA_Retainer_qty" name="DUA_Retainer_qty" min="0" value="01" required class="qty-field">
            </div>


                <div class="input-group">
                    <label for="DLA">Lower Aligners Qty:</label>
                    <input type="number" id="DLA" name="DLA" min="0" value="0" required class="qty-field">
                </div>
                <div class="input-group">
                    <label for="DLA_Retainer">Retainers:</label>
                    <input type="checkbox" id="DLA_Retainer" name="DLA_Retainer">
                    <label for="DLA_Retainer"></label>
                </div>
            </div>
            <!-- Retainer qty for Double Lower Arch -->
            <div id="DLA_Retainer_qty_Field" class="input-group hidden">
                <label for="DLA_Retainer_qty">Retainers Qty:</label>
                <input type="number" id="DLA_Retainer_qty" name="DLA_Retainer_qty" min="0" value="01" required class="qty-field">
            </div>



            <h4>Other Details</h4>

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
                <input type="number" id="discount" name="discount" min="0" value="0" required>
            </div>
            <div class="input-group">
                <label for="PreviousBalance">Previous Balance:</label>
                <input type="number" id="PreviousBalance" name="PreviousBalance" min="0" required>
            </div>
            <div class="input-group">
                <input type="submit" value="Generate Receipt">
            </div>

            <div id="error-message" style="color: red;"></div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var archDropdown = document.getElementById("arch");
            var suaFields = document.getElementById("SUA_Fields");
            var slaFields = document.getElementById("SLA_Fields");
            var duaDlaFields = document.getElementById("DUA_DLA_Fields");

            var suaRetainer = document.getElementById("SUA_Retainer");
            var suaRetainerQtyField = document.getElementById("SUA_Retainer_qty_Field");

            var slaRetainer = document.getElementById("SLA_Retainer");
            var slaRetainerQtyField = document.getElementById("SLA_Retainer_qty_Field");

            var duaRetainer = document.getElementById("DUA_Retainer");
            var duaRetainerQtyField = document.getElementById("DUA_Retainer_qty_Field");

            var dlaRetainer = document.getElementById("DLA_Retainer");
            var dlaRetainerQtyField = document.getElementById("DLA_Retainer_qty_Field");










            
            function updateFields() {
                var selectedArch = archDropdown.value;

                // Hide all fields initially
                suaFields.classList.add('hidden');
                slaFields.classList.add('hidden');
                duaDlaFields.classList.add('hidden');

                // Reset retainer checkboxes and hide retainer qty fields
                suaRetainer.checked = false;
                slaRetainer.checked = false;
                duaRetainer.checked = false;
                dlaRetainer.checked = false;

                suaRetainerQtyField.classList.add('hidden');
                slaRetainerQtyField.classList.add('hidden');
                duaRetainerQtyField.classList.add('hidden');
                dlaRetainerQtyField.classList.add('hidden');

                // Reset the quantities based on selected arch
                if (selectedArch === "Single Upper Arch") {
                    document.getElementById("SLA").value = '0';
                    document.getElementById("DUA").value = '0';
                    document.getElementById("DLA").value = '0';
                    suaFields.classList.remove('hidden');
                    if (suaRetainer.checked) {
                        suaRetainerQtyField.classList.remove('hidden');
                    }
                } else if (selectedArch === "Single Lower Arch") {
                    document.getElementById("SUA").value = '0';
                    document.getElementById("DUA").value = '0';
                    document.getElementById("DLA").value = '0';
                    slaFields.classList.remove('hidden');
                    if (slaRetainer.checked) {
                        slaRetainerQtyField.classList.remove('hidden');
                    }
                } else if (selectedArch === "Double Arch") {
                    document.getElementById("SUA").value = '0';
                    document.getElementById("SLA").value = '0';
                    duaDlaFields.classList.remove('hidden');
                    if (duaRetainer.checked) {
                        duaRetainerQtyField.classList.remove('hidden');
                    }
                    if (dlaRetainer.checked) {
                        dlaRetainerQtyField.classList.remove('hidden');
                    }
                }
            }

            archDropdown.addEventListener("change", updateFields);
            suaRetainer.addEventListener("change", function () {
                suaRetainerQtyField.classList.toggle('hidden', !this.checked);
            });
            slaRetainer.addEventListener("change", function () {
                slaRetainerQtyField.classList.toggle('hidden', !this.checked);
            });
            duaRetainer.addEventListener("change", function () {
                duaRetainerQtyField.classList.toggle('hidden', !this.checked);
            });
            dlaRetainer.addEventListener("change", function () {
                dlaRetainerQtyField.classList.toggle('hidden', !this.checked);
            });

            // Set default selection and update fields on load
            archDropdown.value = "Single Upper Arch";
            updateFields();
        });












//ERROR MSG IF THE ALIGNERS QTY FIELDS ARE NULL
        document.querySelector('form').addEventListener('submit', function(event) {
    var selectedArch = document.getElementById("arch").value;
    var SUA = document.getElementById("SUA").value;
    var SLA = document.getElementById("SLA").value;
    var DUA = document.getElementById("DUA").value;
    var DLA = document.getElementById("DLA").value;

    var errorMessageDiv = document.getElementById('error-message');
    var errorMessage = ''; // Initialize as an empty string

    // Validation conditions
    if (selectedArch === "Single Upper Arch" && (SUA === '' || SUA === '0')) {
        errorMessage = 'Single Upper Arch cannot be null or 0.';
    } else if (selectedArch === "Single Lower Arch" && (SLA === '' || SLA === '0')) {
        errorMessage = 'Single Lower Arch cannot be null or 0.';
    } else if (selectedArch === "Double Arch" && ((DUA === '' || DUA === '0') || (DLA === '' || DLA === '0'))) {
        errorMessage = 'Both Double Upper and Lower Arch quantities cannot be null or 0.';
    }

    // Display error message or clear it
    if (errorMessage !== '') {
        errorMessageDiv.innerHTML = errorMessage;
        event.preventDefault(); // Prevent form submission
    } else {
        errorMessageDiv.innerHTML = ''; // Clear any previous errors
    }
});


    </script>
</body>
</html>
