// COMMENT THIS FOR FURTHER INVESTIGATION
// document.querySelector('select[name="association"]').addEventListener("change", function() {
//     let assocId = this.value;
//     let assocSelects = document.querySelectorAll('select[name="lgu"], select[name="province"]'); // Fixed querySelectorAll

//     // Ensure all selects are cleared before fetching new data
//     assocSelects.forEach(select => {
//         select.innerHTML = "<option value=''>Loading...</option>";
//     });

//     if (assocId) {
//         fetch("../functions/getAssociation.php?assoc_id=" + assocId)
//             .then(response => response.json())
//             .then(data => {
//                 assocSelects.forEach(select => {
//                     // Clear previous options
//                     select.innerHTML = "";

//                     // Assign correct values for LGU & Province
//                     if (data.length > 0) {  // Ensures `data` isn't empty
//                         if (select.name === "lgu") {
//                             select.value = data[0].lgu_id || "";
//                         }
//                         if (select.name === "province") {
//                             select.value = data[0].province_id || "";
//                         }
//                     }
//                 });
//             })

//             .catch(error => console.error("Error fetching associations:", error));
//     } else {
//         assocSelects.forEach(select => {
//             select.innerHTML = "<option value=''>Select Association</option>";
//         });
//     }
// });