

var domeCells = document.querySelectorAll('table.dome td'); // Select all <td> inside table with class "dome"

// Loop through each <td> and add event listener
domeCells.forEach(function(td) {
    td.addEventListener("click", function(event) {
        showDetails(event.target); // Pass clicked <td> to showDetails function
    });
});

function showDetails(td) {
    if (td) {
        var { label, purpose, layer, variety } = td.dataset;

        var container = document.getElementById('showDetailsTD');
        var square = container.querySelector('.square')
        var html = `<strong>${label}</strong>`;
        let totalBags = 0;

        if (layer) {
            layer = JSON.parse(layer); // Convert JSON string to object
            console.log(layer);
            html += `<div class="layer-container">`; // Start wrapping div
            html += Object.entries(layer)
                .map(([key, value]) => {
                    const { bags, age, variety } = value;
                    totalBags += parseInt(bags);
                    return `<span class="${(age >= 30 && age <= 59) ? "spoiling": (age >= 60) ? "spoiled" : ""}"><span class="label">Lot #${key}</span> ${bags} bags</span>`;
                })
                .join(""); // Convert array to string
            
            html += `</div>`; // Close wrapping div
        }
        html += variety ? "<variety> "+ variety + "</variety>" : "";
        html += purpose ? "<purpose> "+ purpose + "</purpose>" : "";
        html += totalBags ? "<label>Total <br>"+ totalBags + " bags</label>" : "";

        square.innerHTML = html;
    }
}

document.querySelectorAll("td[data-layer]").forEach(td => {
    try {
        // Parse the data-layer attribute
        let layer = JSON.parse(td.dataset.layer);

        // Check age conditions
        let hasSpoiling = Object.values(layer).some(({ age }) => age >= 30 && age <= 59);
        let hasSpoiled = Object.values(layer).some(({ age }) => age >= 60);

        // Add class based on age range
        if (hasSpoiled) {
            td.classList.add("spoiled"); // Higher priority
        } else if (hasSpoiling) {
            td.classList.add("spoiling");
        }
    } catch (error) {
        console.error("Invalid JSON format in data-layer:", error);
    }
});


document.querySelectorAll("td[data-variety]").forEach(td => {
    let varietyValue = td.getAttribute("data-variety");
    let varietyDiv = td.querySelector(".variety");

    if (varietyDiv) {
        varietyDiv.setAttribute("data-variety", varietyValue); // Move attribute to .variety
    }
});
