const header = document.getElementById('myHeader');
header.style.marginLeft = 0;

window.onload = function() {
    setVerticalHeaderWidth();
};
  
window.onresize = function() {
    setVerticalHeaderWidth();
};
  
function setVerticalHeaderWidth() {
    var header = document.getElementById("vertical-header");
    var windowHeight = window.innerHeight;
    header.style.width = windowHeight + "px";
}