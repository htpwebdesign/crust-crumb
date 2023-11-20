jQuery(document).ready(function ($) {
    console.log("loaded");
    $(".accordion-container").on("click", ".accordionTitle", function () {
        $(this).toggleClass("is-open");
    });
});
