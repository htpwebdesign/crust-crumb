jQuery(document).ready(function($) {
    $(".accordionTitle").on("click", function() {
        if ($(this).hasClass("is-open")) {
            $(this).removeClass("is-open");
        } else {
            $(".accordionTitle.is-open").removeClass("is-open");
            // $(this).addClass("is-open");
        }
    });
});
