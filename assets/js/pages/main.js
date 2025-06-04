var getTotalBags = document.querySelector("select[name='product_id']")
var bags_distributed = document.getElementById("bags_distributed")
if(getTotalBags) {
    getTotalBags.addEventListener("change", function() {
        let selectedOption = this.options[this.selectedIndex]; // Get the selected option
        let maxBags = selectedOption.dataset.maxbags; // Access dataset attribute
        this.dataset.maxBags = maxBags

        
        bags_distributed.setAttribute('max', maxBags);
    });
}

// Calculate the remaing bags
if(bags_distributed) {
    console.log(bags_distributed)
    bags_distributed.addEventListener("input", function() {
        let maxBags = parseInt(this.getAttribute("max")) || 0; // Get max value safely
        let distributedBags = parseInt(this.value) || 0; // Ensure it's a number

        // Prevent input beyond max
        if (distributedBags > maxBags) {
            this.value = maxBags; // Reset to max if exceeded
            alert("You cannot enter more than " + maxBags);
            distributedBags = maxBags; // Set safe value for calculation
        }

        // Calculate remaining bags
        let remainingBags = maxBags - distributedBags;
        document.getElementById("remaining_bags").value = remainingBags >= 0 ? remainingBags : 0; // Prevent negative values
    });
}
