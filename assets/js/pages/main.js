document.getElementById("bags_distributed").addEventListener("input", function() {
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