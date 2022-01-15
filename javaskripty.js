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
function utriedNazov(trieda) {
    var divsToSort = document.getElementById(trieda);
    var triedene = document.getElementsByClassName("horne");
    var podla = divsToSort.getElementsByTagName("H3");
    vymena(triedene, podla);
}
function utriedCena(trieda) {
    var divsToSort = document.getElementById(trieda);
    var triedene = document.getElementsByClassName("horne");
    var podla = divsToSort.getElementsByClassName("cenaTr");
    vymenaCislo(triedene, podla);
}
function utriedPocet(trieda) {
    var divsToSort = document.getElementById(trieda);
    var triedene = document.getElementsByClassName("horne");
    var podla = divsToSort.getElementsByClassName("pocetTr");
    vymenaCislo(triedene, podla);
}
function vymena(triedene, podla) {
    var vymeniliSmeRaz = false;
    var vymeniliSme = true;
    var menime = true;
    while (vymeniliSme) {
        vymeniliSme = false;
        for (i = 0; i < (podla.length - 1); i++)
        {
            menime = false;
            if (podla[i].innerHTML.toLowerCase() > podla[i + 1].innerHTML.toLowerCase()) {
                menime = true;
                break;
            }
        }
        if (menime) {
            triedene[i].parentNode.insertBefore(triedene[i + 1], triedene[i]);
            vymeniliSme = true;
            vymeniliSmeRaz = true;
        }
    }
    if (!vymeniliSmeRaz) {
        vymeniliSme = true;
        menime = true;
        while (vymeniliSme) {
            vymeniliSme = false;
            for (i = 0; i < (podla.length - 1); i++)
            {
                menime = false;
                if (podla[i].innerHTML.toLowerCase() < podla[i + 1].innerHTML.toLowerCase()) {
                    menime = true;
                    break;
                }
            }
            if (menime) {
                triedene[i].parentNode.insertBefore(triedene[i + 1], triedene[i]);
                vymeniliSme = true;
                vymeniliSmeRaz = true;
            }
        }
    }
}
function vymenaCislo(triedene, podla) {
    var vymeniliSmeRaz = false;
    var vymeniliSme = true;
    var menime = true;
    while (vymeniliSme) {
        vymeniliSme = false;
        for (i = 0; i < (podla.length - 1); i++)
        {
            menime = false;
            if (parseInt(podla[i].innerHTML) > parseInt(podla[i + 1].innerHTML)) {
                menime = true;
                break;
            }
        }
        if (menime) {
            triedene[i].parentNode.insertBefore(triedene[i + 1], triedene[i]);
            vymeniliSme = true;
            vymeniliSmeRaz = true;
        }
    }
    if (!vymeniliSmeRaz) {
        vymeniliSme = true;
        menime = true;
        while (vymeniliSme) {
            vymeniliSme = false;
            for (i = 0; i < (podla.length - 1); i++)
            {
                menime = false;
                if (parseInt(podla[i].innerHTML) < parseInt(podla[i + 1].innerHTML)) {
                    menime = true;
                    break;
                }
            }
            if (menime) {
                triedene[i].parentNode.insertBefore(triedene[i + 1], triedene[i]);
                vymeniliSme = true;
                vymeniliSmeRaz = true;
            }
        }
    }
}
function filterList() {
    var input, filter, hlavny, horny, a, i, txtValue;
    input = document.getElementById("filtrovanie");
    filter = input.value.toUpperCase();
    hlavny = document.getElementById("hlav");
    horny = hlavny.getElementsByClassName("horne");
    for (i = 0; i < horny.length; i++) {
        a = horny[i].getElementsByTagName("h3")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            horny[i].style.display = "";
        } else {
            horny[i].style.display = "none";
        }
    }
}
var slideIndex = 4;
// showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}
function posuvaj() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    setTimeout(posuvaj, 8000); // Change image every 2 seconds
}