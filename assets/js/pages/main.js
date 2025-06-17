var getTotalBags = document.querySelector("select[name='product_id']")
var bags_distributed = document.getElementById("bags_distributed")

var selectAssoc = document.querySelector("select[name='assoc_id']")
var selectLGU = document.querySelector("select[name='lgu_id']")
var selectProvince = document.querySelector("select[name='province_id']")

var germinationModal = document.getElementById("germinationModal")
var germinationWaitingModal = document.getElementById("germinationWaitingModal")
var germinationAddModal = document.getElementById("germinationAddModal")

// Get total bags received
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

if(selectAssoc) {
    selectAssoc.addEventListener("change", function(){
        let selectedOption = this.options[this.selectedIndex]
        let getProvince = selectedOption.dataset.province
        let getLGU = selectedOption.dataset.lgu

        selectLGU.value = getLGU
        selectProvince.value = getProvince

    })
}

if(germinationModal) {
    $('#germinationModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var product_id = button.data('product-id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input[name="product_id"]').val(product_id)
    })
}

if(germinationWaitingModal) {
    $('#germinationWaitingModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var date_started = button.data('date-started') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        console.log(date_started)
        // modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body .date_started').text(date_started)
    })
}

if(germinationAddModal) {
    $('#germinationAddModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var product_id = button.data('product-id') // Extract info from data-* attributes
        var date_started = button.data('date-started')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input[name="product_id"]').val(product_id).prop("readonly", true);
        modal.find('.modal-body input[name="test_date"]').val(date_started).prop("readonly", true);
    })
}