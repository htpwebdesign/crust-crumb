jQuery(document).ready(function ($) {
    console.log("loaded");
    $(".location-container").on("click", ".accordionTitle", function () {
        $(this).toggleClass("is-open");
        $(this).parent().toggleClass("container-open");
    });
});
