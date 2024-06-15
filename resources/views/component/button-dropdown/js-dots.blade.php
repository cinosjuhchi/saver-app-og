<!-- JavaScript to handle dropdown functionality -->
<script>
    // Get all toggle-dropdown buttons
const toggleButtons = document.querySelectorAll('.toggle-dropdown');

// Add click event listener to each toggle button
toggleButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        // Prevent default behavior (redirecting to another page)
        event.preventDefault();
        // Close all dropdowns
        closeAllDropdowns();
        // Toggle the dropdown visibility
        const dropdown = this.parentElement.querySelector('.dropdown-container');
        dropdown.classList.toggle('hidden');
    });
});

// Function to close all dropdowns
function closeAllDropdowns() {
    const dropdowns = document.querySelectorAll('.dropdown-container');
    dropdowns.forEach(dropdown => {
        dropdown.classList.add('hidden');
    });
}

// Add click event listener to document
document.addEventListener('click', function(event) {
    // Close dropdowns when clicking outside of them
    if (!event.target.closest('.toggle-dropdown')) {
        closeAllDropdowns();
    }
});

</script>