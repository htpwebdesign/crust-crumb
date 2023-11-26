window.onload = function (e) {
    const menuBtn = document.querySelector('.hamburger');
    
    menuBtn.addEventListener('click', function () {
        menuBtn.classList.toggle('is-active');
    })
}