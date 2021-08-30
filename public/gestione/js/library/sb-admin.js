$(function() {
    var sidebarToggle = $('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.on('click', function(e) {
            e.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});