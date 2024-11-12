const leftArrow = document.getElementById("left-arrow");

setInterval(rotate_svg, 500);

function rotate_svg() {
    leftArrow.classList.toggle("rotate");
}