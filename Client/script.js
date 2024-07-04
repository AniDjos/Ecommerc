document.getElementById('product-menu').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default action of the link
    var submenu = document.getElementById('submenu');
    if (submenu.style.display === 'block') {
        submenu.style.display = 'none';
    } else {
        submenu.style.display = 'block';
    }
});
