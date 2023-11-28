jQuery(document).ready(function ($) {
    console.log("loaded");

    // Function to toggle the accordion and update the icon
    function toggleAccordion($accordionTitle) {
        $accordionTitle.toggleClass("is-open");
        $accordionTitle.parent().toggleClass("container-open");

        // Check if the accordion is open and update the icon accordingly
        if ($accordionTitle.hasClass("is-open")) {
            $accordionTitle.find(".accordion-icon").html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 9h24v6h-24z"/></svg>');
        } else {
            $accordionTitle.find(".accordion-icon").html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z"/></svg>');
        }
    }

    // Attach click event to accordionTitle
    $(".accordion-container").on("click", ".accordionTitle", function () {
        toggleAccordion($(this));
    });


});