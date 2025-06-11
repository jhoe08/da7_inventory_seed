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
    $sql = "SELECT * FROM `da7_product` ORDER BY lot;";
    $result = mysqli_query($conn, $sql);
    $cube = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $label = explode("_", $row["lot"])[0];
            $index = explode("_", $row["lot"])[1];

            $cube[$label][$index] = [
                "bags" => $row["bags_received"], 
                "age" => (new DateTime($row["date_received"]))->diff(new DateTime())->days,
            ];
        }
    } 
    
    // $inventoryData = json_decode(json_encode($cube));
    $inventoryData = json_encode($cube);

    ?>    

    

    <style>
        table.dome {
            border-collapse: collapse;
            margin: 20px auto;
            width: auto;
        }
        table.dome td {
            width: 60px;
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
            box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.5);
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
        }
        table.dome tr:not(.legend) td:not(.empty):after {
            content: "Lot # - # Bags";
            position: absolute;
            font-size: 8px;
            transform: rotate(90deg);
            top: 18px;
            right: -20px;
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
            font-size: 7px;
            padding-right: 8px;
            text-align: left;
            line-height: 1.1;
        }

        #showDetailsTD {
            text-align: center;
        }
        .square {
            width: 300px;
            aspect-ratio: 1 / 1;
            background-color: #ffffff;
            border: 1px solid;
            display: inline-block;
            position: relative;
            display: flex;
            justify-content: flex-end;
        }

        .square strong, .square label {
            position: absolute;
            bottom: 0;
            left: 10px;
            font-size: 40px;
        }

        .square .layer-container {
            display: flex;
            flex-direction: column-reverse;
            justify-content: space-evenly;
            width: 80px;
        }
        
        .square .layer-container .label {
            display: block;
        }
        
        td.spoiling,
        .square .spoiling {
            background-color: rgb(255 0 0 / 41%);
        }

        td.spoiled,
        .square .spoiled {
            background-color: rgb(0 0 0 / 41%);
        }

    </style>
    <div class="row mt-5">
        <div class="col-md-6">
            <table class="dome">
                <!-- Row 1 -->
                <tr>
                    <td class="empty" colspan="6"></td>
                    <td data-variety="NSIC Rc 486H (LP534)" data-label="E15" data-purpose="" data-layer='{"1": {"bags": 100, "age": 31},"2": {"bags": 100, "age": 31},"3": {"bags": 0, "age": 0},"4": {"bags": 0, "age": 0},"5": {"bags": 100, "age": 31}}'>
                        15
                        <div class="variety">100</div>
                    </td>

                    <td data-label="F16">16 <div class="variety">100</div></td>
                    <td data-label="G16">16 <div class="variety">100</div></td>
                    <td data-label="H16">16 <div class="variety">21</div></td>
                    <td data-label="I16">16 <div class="variety">100</div></td>
                    <td data-label="J15">15 <div class="variety">100</div></td>
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
        </div>
    </div>
</div>

<script>
        // Get PHP JSON data
        const data = <?php echo $inventoryData; ?>;
        // Loop through each key in the data object
        Object.keys(data).forEach(label => {
            // Find the <td> element with the corresponding data-label
            const element = document.querySelector(`td[data-label="${label}"]`);

            // // Debugging: Log if element is found or not
            // console.log(`Searching for td[data-label="${label}"]`, element);

            // If element exists, set its data-layer attribute
            if (element) {
                element.setAttribute('data-layer', JSON.stringify(data[label]));
            }
        });

</script>
<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>