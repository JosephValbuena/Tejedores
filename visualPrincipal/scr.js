$(".sidebar-dropdown > a").click(function() {
    $(".sidebar-submenu").slideUp(50);
    if (
        $(this)
        .parent()
        .hasClass("active")
    ) {
        $(".sidebar-dropdown").removeClass("active");
        $(this)
            .parent()
            .removeClass("active");
    } else {
        $(".sidebar-dropdown").removeClass("active");
        $(this)
            .next(".sidebar-submenu")
            .slideDown(50);
        $(this)
            .parent()
            .addClass("active");
    }
});

$("#close-sidebar").click(function() {
    $(".page-wrapper").removeClass("toggled");
    console.log("cerrando");
});
$("#show-sidebar").click(function() {
    $(".page-wrapper").addClass("toggled");
});