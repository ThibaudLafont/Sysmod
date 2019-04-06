window.onresize = moveHoneycombOnTop;
window.onload = moveHoneycombOnTop;

function moveHoneycombOnTop() {
    var honeycomb = document.getElementById("honeycomb");
    var section = document.getElementById("honeycomb-display")
    if(window.outerWidth <= 900) {
        section.prepend(honeycomb)
    } else {
        section.append(honeycomb)
    }
}