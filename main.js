window.onscroll = function() {
    let nav = document.querySelector('nav');
    if (window.scrollY > 50) {
        nav.style.backgroundColor = '#444';
    } else {
        nav.style.backgroundColor = '#333';
    }
};
