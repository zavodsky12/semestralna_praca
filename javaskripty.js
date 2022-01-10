
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
/*var dropdown = document.getElementsByClassName("hlavne");
var i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("opacne");
        var divsToHide = document.getElementsByClassName("classname");
        if (divsToHide.style.display === "block") {
            divsToHide.style.display = "none";
        } else {
            divsToHide.style.display = "block";
        }
    });
}*/
function dropdownSide(idcko) {
    var divsToHide = document.getElementsByClassName(idcko); //divsToHide is an array
    if (divsToHide[0].style.display === "block") {
        for (var i = 0; i < divsToHide.length; i++) {
            divsToHide[i].style.display = "none"; // depending on what you're doing
        }
    } else {
        for (var i = 0; i < divsToHide.length; i++) {
            divsToHide[i].style.display = "block"; // depending on what you're doing
        }
    }
}