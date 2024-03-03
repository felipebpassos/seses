window.addEventListener('scroll', function() {
    var header = document.querySelector('header');
    var navItems = document.querySelectorAll('nav ul li');

    if (window.scrollY > 100) {
        header.classList.add('nav-up');
        header.classList.remove('nav-down');
        navItems.forEach(function(item) {
            item.classList.add('nav-up');
            item.classList.remove('nav-down');
        });
    } else {
        header.classList.remove('nav-up');
        header.classList.add('nav-down');
        navItems.forEach(function(item) {
            item.classList.remove('nav-up');
            item.classList.add('nav-down');
        });
    }
});
