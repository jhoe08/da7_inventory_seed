<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>
<div class="main-content-inner">
    <?php 
    $title_text = 'Monolithic Dome';
    $isBreadcrumbsOn = false;
    include_once(dirname(__FILE__) . "/../partials/search.php"); ?>  

<?php
    include '../functions/_database.php';  
     /* $sql = "SELECT * FROM `da7_product` ORDER BY lot;";
    $sql = "SELECT 
                p.*,  -- Select all columns from da7_product
                d.date_distributed, 
                d.bags_distributed, 
                d.remaining_bags, 
                d.purpose, 
                d.remarks
            FROM da7_product p
            LEFT JOIN da7_distribution d ON p.product_id = d.product_id
            ORDER BY p.lot;";
    $result = mysqli_query($conn, $sql);
    $cube = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $label = explode("_", $row["lot"])[0];
            $index = explode("_", $row["lot"])[1];

            $cube[$label][$index] = [
                "variety" => $row["variety"],
                "bags" => $row["bags_received"], 
                "age" => (new DateTime($row["date_received"]))->diff(new DateTime())->days,
            ];
        }
    } 
    
    // $inventoryData = json_decode(json_encode($cube));
    $inventoryData = json_encode($cube);
    */ 
    // SQL Query: Join `da7_product` with `da7_distribution`
    $sql = "SELECT 
                p.*,  
                d.date_distributed, 
                d.bags_distributed, 
                d.remaining_bags, 
                d.purpose, 
                d.remarks
            FROM da7_product p
            LEFT JOIN da7_distribution d ON p.product_id = d.product_id
            ORDER BY p.lot;";

    $result = mysqli_query($conn, $sql);
    $cube = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $label = explode("_", $row["lot"])[0];
            $index = explode("_", $row["lot"])[1];

            // Deduct distributed bags from received bags
            $bags_received = intval($row["bags_received"]);
            $bags_distributed = intval($row["bags_distributed"]);
            $remaining_bags = max(0, $bags_received - $bags_distributed); // Ensure no negative values

            $cube[$label][$index] = [
                "variety" => $row["variety"],
                "bags" => $remaining_bags,  // Updated to reflect deducted bags
                "age" => (new DateTime($row["date_received"]))->diff(new DateTime())->days,
                "purpose" => $row["purpose"]
            ];
        }
    } 

    // Convert array to JSON
    $inventoryData = json_encode($cube);

    ?>    

    

    <style>
        table.dome {
            border-collapse: collapse;
            margin: 20px auto;
            width: auto;
        }
        table.dome td {
            width: 50px;
            height: 50px;
            border: 1px solid black !important;
            text-align: left;
            vertical-align: bottom;
            padding: 0 0 0 10px;
            position: relative;
        }
        table.dome td:not(.empty) {
            cursor: pointer;
        }
        table.dome td:not(.empty):hover {
            box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.15);
        }
        table.dome tr.legend td {
            text-align: center;
            vertical-align: middle;
            padding: 0;
        }
        table.dome tr:not(.legend) td:not(.empty):before {
            content: "Purpose";
            position: absolute;
            font-size: 8px;
            transform: rotate(-90deg);
            left: -10px;
            visibility: hidden;
        }
        table.dome tr:not(.legend) td:not(.empty):after {
            content: "Lot # - # Bags";
            position: absolute;
            font-size: 8px;
            transform: rotate(90deg);
            top: 18px;
            right: -20px;
            visibility: hidden;
        }
        table.dome tr:not(.legend) td.has_purpose:not(.empty):before,
        table.dome tr:not(.legend) td.has_layer:not(.empty):after { 
            visibility: visible;
        }
        table.dome .empty {
            border: none !important;
        }
        table.dome .legend {
            font-weight: bold;
        }
        table.dome .legend td {
            border: none !important;
        }
        table.dome td .variety {
            position: absolute;
            font-size: 8px;
            left: 0;
            right: 0;
            text-align: center;
            transform: translate(0px, -30px);
            z-index: -1;
        }

        table.dome td .variety::before {
            content: attr(data-variety);
            font-weight: bold;
            color: blue;
            display: block;
            position: absolute;
            top: -18px;
            font-size: 6px;
            padding-right: 8px;
            text-align: left;
            line-height: 1.1;
        }

        #showDetailsTD {
            text-align: center;
        }
        #showDetailsTD .square {
            width: 300px;
            aspect-ratio: 1 / 1;
            background-color: #ffffff;
            border: 1px solid;
            display: inline-block;
            position: relative;
            display: flex;
            justify-content: flex-end;
        }

        #showDetailsTD .square strong, 
        #showDetailsTD .square label {
            position: absolute;
            bottom: 0;
            left: 10px;
            font-size: 40px;
        }

        #showDetailsTD .square label {
            transform: translate(0%, -120%);
            width: 90%;
            left: 0px;
            line-height: 1;
        }

        #showDetailsTD .square .layer-container {
            display: flex;
            flex-direction: column-reverse;
            justify-content: space-evenly;
            width: 80px;
        }
        
        #showDetailsTD .square .layer-container .label {
            display: block;
        }
        
        #showDetailsTD .square variety {
            position: absolute;
            top: 0px;
            left: 5px;
            font-size: 32px;
            text-align: left;
            line-height: 1;
        }

        #showDetailsTD .square purpose {
            position: absolute;
            left: -68px;
            bottom: 130px;
            transform: rotate(-90deg);
            font-size: 15px;
        }


        td.spoiling,
        .square .spoiling,
        .legends .square.spoiling {
            background-color: rgb(255 0 0 / 41%);
        }

        td.spoiled,
        .square .spoiled,
        .legends .square.spoiled {
            background-color: rgb(0 0 0 / 41%);
        }

        .legends .square {
            width: 50px;
            aspect-ratio: 1 / 1;
            background-color: #ffffff;
            border: 1px solid;
            display: inline-block;
            position: relative;
        }
        
    </style>
    <div class="row mt-5">
        <div class="col-md-6">
            <table class="dome">
                <!-- Row 1 -->
                <tr>
                    <td class="empty" colspan="6"></td>
                    <td data-label="E15">15</td>
                    <td data-label="F16">16</td>
                    <td data-label="G16">16</td>
                    <td data-label="H16">16</td>
                    <td data-label="I16">16</td>
                    <td data-label="J15">15</td>
                    <td class="empty" colspan="6"></td>
                </tr>
                <!-- Row 2 -->
                <tr>
                    <td class="empty" colspan="5"></td>
                    <td data-label="D13">13</td>
                    <td data-label="E14">14</td>
                    <td data-label="F13">15</td>
                    <td data-label="G15">15</td>
                    <td data-label="H15">15</td>
                    <td data-label="I15">15</td>
                    <td data-label="J14">14</td>
                    <td data-label="K13">13</td>
                    <td class="empty" colspan="5"></td>
                </tr>
                <!-- Row 3 -->
                <tr>
                    <td class="empty" colspan="4"></td>
                    <td data-label="C12">12</td>
                    <td data-label="D12">12</td>
                    <td data-label="E13">13</td>
                    <td data-label="F14">14</td>
                    <td data-label="G14">14</td>
                    <td data-label="H14">14</td>
                    <td data-label="I14">14</td>
                    <td data-label="J13">13</td>
                    <td data-label="K12">12</td>
                    <td data-label="L12">12</td>
                    <td class="empty" colspan="4"></td>
                </tr>
                <!-- Row 4 -->
                <tr>
                    <td class="empty" colspan="3"></td>
                    <td data-label="B8">8</td>
                    <td data-label="C11">11</td>
                    <td data-label="D11">11</td>
                    <td data-label="E12">12</td>
                    <td data-label="F13">13</td>
                    <td data-label="G13">13</td>
                    <td data-label="H13">13</td>
                    <td data-label="I13">13</td>
                    <td data-label="J12">12</td>
                    <td data-label="K11">11</td>
                    <td data-label="L11">11</td>
                    <td data-label="M8">8</td>
                    <td class="empty" colspan="3"></td>
                </tr>
                <!-- Row 5 -->
                <tr>
                    <td class="empty" colspan="3"></td>
                    <td data-label="B7">7</td>
                    <td data-label="C10">10</td>
                    <td data-label="D10">10</td>
                    <td data-label="E11">11</td>
                    <td data-label="F12">12</td>
                    <td data-label="G12">12</td>
                    <td data-label="H12">12</td>
                    <td data-label="I12">12</td>
                    <td data-label="J11">11</td>
                    <td data-label="K10">10</td>
                    <td data-label="L10">10</td>
                    <td data-label="M7">7</td>
                    <td class="empty" colspan="3"></td>
                </tr>
                <!-- Row 6 -->
                <tr>
                    <td class="empty" colspan="2"></td>
                    <td data-label="A6">6</td>
                    <td data-label="B6">6</td>
                    <td data-label="C9">9</td>
                    <td data-label="D9">9</td>
                    <td data-label="E10">10</td>
                    <td data-label="F11">11</td>
                    <td data-label="G11">11</td>
                    <td data-label="H11">11</td>
                    <td data-label="I11">11</td>
                    <td data-label="J10">10</td>
                    <td data-label="K9">9</td>
                    <td data-label="L9">9</td>
                    <td data-label="M6">6</td>
                    <td data-label="N6">6</td>
                    <td class="empty" colspan="2"></td>
                </tr>
                <!-- Row 7 -->
                <tr>
                    <td class="empty" colspan="2"></td>
                    <td data-label="A5">5</td>
                    <td data-label="B5">5</td>
                    <td data-label="C8">8</td>
                    <td data-label="D8">8</td>
                    <td data-label="E9">9</td>
                    <td data-label="F10">10</td>
                    <td data-label="G10">10</td>
                    <td data-label="H10">10</td>
                    <td data-label="I10">10</td>
                    <td data-label="J9">9</td>
                    <td data-label="K8">8</td>
                    <td data-label="L8">8</td>
                    <td data-label="M5">5</td>
                    <td data-label="N5">5</td>
                    <td class="empty" colspan="2"></td>
                </tr>
                <!-- Row 8 -->
                <tr>
                    <td class="empty" colspan="2"></td>
                    <td data-label="A4">4</td>
                    <td data-label="B4">4</td>
                    <td data-label="C7">7</td>
                    <td data-label="D7">7</td>
                    <td data-label="E8">8</td>
                    <td data-label="F9">9</td>
                    <td data-label="G9">9</td>
                    <td data-label="H9">9</td>
                    <td data-label="I9">9</td>
                    <td data-label="J8">8</td>
                    <td data-label="K7">7</td>
                    <td data-label="L7">7</td>
                    <td data-label="M4">4</td>
                    <td data-label="N4">4</td>
                    <td class="empty" colspan="2"></td>
                </tr>
                <!-- Row 9 -->
                <tr>
                    <td class="empty" colspan="2"></td>
                    <td data-label="A3">3</td>
                    <td data-label="B3">3</td>
                    <td data-label="C6">6</td>
                    <td data-label="D6">6</td>
                    <td data-label="E7">7</td>
                    <td data-label="F8">8</td>
                    <td data-label="G8">8</td>
                    <td data-label="H8">8</td>
                    <td data-label="I8">8</td>
                    <td data-label="J7">7</td>
                    <td data-label="K6">6</td>
                    <td data-label="L6">6</td>
                    <td data-label="M3">3</td>
                    <td data-label="N3">3</td>
                    <td class="empty" colspan="2"></td>
                </tr>
                <!-- Row 10 -->
                <tr>
                    <td class="empty" colspan="2"></td>
                    <td data-label="A2">2</td>
                    <td data-label="B2">2</td>
                    <td data-label="C5">5</td>
                    <td data-label="D5">5</td>
                    <td data-label="E6">6</td>
                    <td data-label="F7">7</td>
                    <td data-label="G7">7</td>
                    <td data-label="H7">7</td>
                    <td data-label="I7">7</td>
                    <td data-label="J6">6</td>
                    <td data-label="K5">5</td>
                    <td data-label="L5">5</td>
                    <td data-label="M2">2</td>
                    <td data-label="N2">2</td>
                    <td class="empty" colspan="2"></td>
                </tr>
                <!-- Row 11 -->
                <tr>
                    <td class="empty" colspan="2"></td>
                    <td data-label="A1">1</td>
                    <td data-label="B1">1</td>
                    <td data-label="C4">4</td>
                    <td data-label="D4">4</td>
                    <td data-label="E5">5</td>
                    <td data-label="F6">6</td>
                    <td data-label="G6">6</td>
                    <td data-label="H6">6</td>
                    <td data-label="I6">6</td>
                    <td data-label="J5">5</td>
                    <td data-label="K4">4</td>
                    <td data-label="L4">4</td>
                    <td data-label="M1">1</td>
                    <td data-label="N1">1</td>
                    <td class="empty" colspan="2"></td>
                </tr>
                <!-- Row 12 -->
                <tr>
                    <td class="empty" colspan="4"></td>
                    <td data-label="C3">3</td>
                    <td data-label="D3">3</td>
                    <td data-label="E4">4</td>
                    <td data-label="F5">5</td>
                    <td data-label="G5">5</td>
                    <td data-label="H5">5</td>
                    <td data-label="I5">5</td>
                    <td data-label="J4">4</td>
                    <td data-label="K3">3</td>
                    <td data-label="L3">3</td>
                    <td class="empty" colspan="4"></td>
                </tr>
                <!-- Row 13 -->
                <tr>
                    <td class="empty" colspan="4"></td>
                    <td data-label="C2">2</td>
                    <td data-label="D2">2</td>
                    <td data-label="E3">3</td>
                    <td data-label="F4">4</td>
                    <td data-label="G4">4</td>
                    <td data-label="H4">4</td>
                    <td data-label="I4">4</td>
                    <td data-label="J3">3</td>
                    <td data-label="K2">2</td>
                    <td data-label="L2">2</td>
                    <td class="empty" colspan="4"></td>
                </tr>
                <!-- Row 14 -->
                <tr>
                    <td class="empty" colspan="4"></td>
                    <td data-label="C1">1</td>
                    <td data-label="D1">1</td>
                    <td data-label="E2">2</td>
                    <td data-label="F3">3</td>
                    <td data-label="G3">3</td>
                    <td data-label="H3">3</td>
                    <td data-label="I3">3</td>
                    <td data-label="J2">2</td>
                    <td data-label="K1">1</td>
                    <td data-label="L1">1</td>
                    <td class="empty" colspan="4"></td>
                </tr>
                <!-- Row 15 -->
                <tr>
                    <td class="empty" colspan="6"></td>
                    <td data-label="E1">1</td>
                    <td data-label="F2">2</td>
                    <td data-label="G2">2</td>
                    <td data-label="H2">2</td>
                    <td data-label="I2">2</td>
                    <td data-label="J1">1</td>
                    <td class="empty" colspan="6"></td>
                </tr>
                <!-- Row 16 -->
                <tr>
                <td class="empty" colspan="7"></td>
                    <td data-label="F1">1</td>
                    <td data-label="G1">1</td>
                    <td data-label="H1">1</td>
                    <td data-label="I1">1</td>
                <td class="empty" colspan="7"></td>
                </tr>
                <tr>
                <td class="empty" colspan="14"></td>
                </tr>
                <tr class="legend">
                    <td class="empty" colspan="2"></td>
                    <td data-label="">A</td>
                    <td data-label="">B</td>
                    <td data-label="">C</td>
                    <td data-label="">D</td>
                    <td data-label="">E</td>
                    <td data-label="">F</td>
                    <td data-label="">G</td>
                    <td data-label="">H</td>
                    <td data-label="">I</td>
                    <td data-label="">J</td>
                    <td data-label="">K</td>
                    <td data-label="">L</td>
                    <td data-label="">M</td>
                    <td data-label="">N</td>
                    <td class="empty" colspan="2"></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <div id="showDetailsTD">
                <div class="square"></div>
            </div>
            <div class="legends mt-4">
                <h4 class="mb-2">Legends: </h4>
                <div class="legend dflex alignCenter mb-2">
                    <div name="spoiled" class="square spoiled mr-2"></div>
                    <label for="spoiled">Spoiled</label>
                </div>
                <div class="legend dflex alignCenter mb-2">
                    <div name="Spoiling" class="square spoiling mr-2"></div>
                    <label for="Spoiling">Spoiling</label>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const data = <?php echo $inventoryData; ?>;

    // Loop through each key in the data object
    Object.keys(data).forEach(label => {
        // Find the <td> element with the corresponding data-label
        const element = document.querySelector(`td[data-label="${label}"]`);
        
        // If element exists, set its data-layer attribute
        if (element) {
            let layerData = JSON.stringify(data[label])
            let setLayer = element.setAttribute('data-layer', layerData);
            if(layerData) {
                element.classList.add('has_layer')
            }

            // Extract the variety from the data object
            let varietyEntry = Object.values(data[label]).find(({ variety }) => variety);
            let variety = varietyEntry ? varietyEntry.variety : "";

            // Extract the variety from the data object
            let purposeEntry = Object.values(data[label]).find(({ purpose }) => purpose);
            let purpose = purposeEntry ? purposeEntry.purpose : "";

            // Set the data-variety attribute on the <td>
            element.setAttribute('data-variety', variety);

            // Set the data-purpose attribute on the <td>
            element.setAttribute('data-purpose', purpose);
            if(purpose) {
                element.classList.add('has_purpose')
            }

            // Check if a .variety div already exists, if not, create one
            let varietyDiv = element.querySelector(".variety");
            if (!varietyDiv) {
                varietyDiv = document.createElement("div");
                varietyDiv.classList.add("variety");
                element.appendChild(varietyDiv);
            }

            // Set the data-variety attribute on the newly created or existing .variety div
            varietyDiv.setAttribute("data-variety", variety);
            // varietyDiv.textContent = variety; // Display the variety inside the div
        }
    });
</script>
<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>