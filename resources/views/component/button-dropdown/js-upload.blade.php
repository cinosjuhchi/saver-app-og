<script>
    // Function to toggle dropdown
    function toggleDropdown(id) {
        let dropdown = document.querySelector('#dropdownButton' + id + ' #dropdown' + id);
        dropdown.classList.toggle("hidden");

        if (!dropdown.classList.contains("hidden")) {
            // Remove width style to allow it to expand based on content
            dropdown.style.width = "max-content";

            // Get bounding rectangle of dropdown and button
            let dropdownRect = dropdown.getBoundingClientRect();
            let buttonRect = document.getElementById('dropdownButton' + id).getBoundingClientRect();

            // Check if there is enough space on the right side of the button
            let spaceRight = window.innerWidth - buttonRect.right;

            // Check if there is enough space on the left side of the button
            let spaceLeft = buttonRect.left;

            // If there is not enough space on the right side, show the dropdown on the left side
            if (spaceRight < dropdownRect.width && spaceLeft >= dropdownRect.width) {
                dropdown.classList.remove("left-0");
                dropdown.classList.add("right-0");
            } else {
                dropdown.classList.remove("right-0");
                dropdown.classList.add("left-0");
            }
        }
    }

    // Add click event listener to document
    document.addEventListener('click', function(event) {
        // Check if the clicked element is part of any dropdown or the dropdown button
        let isDropdown = event.target.closest('[id^="dropdownButton"]') || event.target.closest('[id^="dropdownButton"] [id^="dropdown"]');

        // If the clicked element is not part of any dropdown, close all dropdowns
        if (!isDropdown) {
            let dropdowns = document.querySelectorAll('[id^="dropdownButton"] [id^="dropdown"]');
            dropdowns.forEach(function(dropdown) {
                dropdown.classList.add("hidden");
            });
        }
    });
</script>
