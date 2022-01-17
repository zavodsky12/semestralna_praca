function dropdownSide(idcko) {
    var divsToHide = document.getElementsByClassName(idcko);
    if (divsToHide[0].style.display === "block") {
        for (var i = 0; i < divsToHide.length; i++) {
            divsToHide[i].style.display = "none";
        }
    } else {
        for (var i = 0; i < divsToHide.length; i++) {
            divsToHide[i].style.display = "block";
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
    while (vymeniliSme) {
        vymeniliSme = false;
        for (i = 0; i < (podla.length - 1); i++)
        {
            if (podla[i].innerHTML.toLowerCase() > podla[i + 1].innerHTML.toLowerCase()) {
                triedene[i].parentNode.insertBefore(triedene[i + 1], triedene[i]);
                vymeniliSme = true;
                vymeniliSmeRaz = true;
            }
        }
    }
    if (!vymeniliSmeRaz) {
        vymeniliSme = true;
        while (vymeniliSme) {
            vymeniliSme = false;
            for (i = 0; i < (podla.length - 1); i++)
            {
                if (podla[i].innerHTML.toLowerCase() < podla[i + 1].innerHTML.toLowerCase()) {
                    triedene[i].parentNode.insertBefore(triedene[i + 1], triedene[i]);
                    vymeniliSme = true;
                    vymeniliSmeRaz = true;
                }
            }
        }
    }
}
function vymenaCislo(triedene, podla) {
    var vymeniliSmeRaz = false;
    var vymeniliSme = true;
    while (vymeniliSme) {
        vymeniliSme = false;
        for (i = 0; i < (podla.length - 1); i++)
        {
            if (parseInt(podla[i].innerHTML) > parseInt(podla[i + 1].innerHTML)) {
                triedene[i].parentNode.insertBefore(triedene[i + 1], triedene[i]);
                vymeniliSme = true;
                vymeniliSmeRaz = true;
            }
        }
    }
    if (!vymeniliSmeRaz) {
        vymeniliSme = true;
        while (vymeniliSme) {
            vymeniliSme = false;
            for (i = 0; i < (podla.length - 1); i++)
            {
                if (parseInt(podla[i].innerHTML) < parseInt(podla[i + 1].innerHTML)) {
                    triedene[i].parentNode.insertBefore(triedene[i + 1], triedene[i]);
                    vymeniliSme = true;
                    vymeniliSmeRaz = true;
                }
            }
        }
    }
}
function filterList() {
    var input, hlavny, horny, a, i, txtValue;
    input = document.getElementById("filtrovanie");
    hlavny = document.getElementById("hlav");
    horny = hlavny.getElementsByClassName("horne");
    for (i = 0; i < horny.length; i++) {
        a = horny[i].getElementsByTagName("h3")[0];
        txtValue = a.innerText;
        if (txtValue.toUpperCase().includes(input.value.toUpperCase())) {
            horny[i].style.display = "";
        } else {
            horny[i].style.display = "none";
        }
    }
}
function vytvorPrihlasenie(prih) {
    var htmlElement = document.getElementById('stranka');
    htmlElement.style.backgroundColor = "#33b5e5";
    if (window.screen.width > 500) {
        htmlElement.style.width = "500px";
    } else {
        htmlElement.style.width = "100%";
    }
    htmlElement.style.height = "100%";
    htmlElement.style.padding = "10px";
    htmlElement.style.margin = "auto";
    let hlavna = document.createElement('div');
    hlavna.style.backgroundColor = "#bbb";
    let nadpis = document.createElement('h1');
    nadpis.style.padding = "5px";
    nadpis.innerHTML = "Prihlásenie";
    htmlElement.append(hlavna);
    hlavna.append(nadpis);
    let formicka = document.createElement('form');
    formicka.method = "post";
    let menoNadpis = document.createElement('label');
    let menoText = document.createElement('input');
    menoNadpis.innerHTML = "Email: ";
    menoText.className = "registr";
    menoText.type = "email";
    menoText.placeholder = "Email";
    menoText.name = "login";
    menoText.id = "login";
    let hesloNadpis = document.createElement('label');
    let hesloText = document.createElement('input');
    hesloNadpis.innerHTML = "Heslo: ";
    hesloText.className = "registr";
    hesloText.type = "password";
    hesloText.placeholder = "Heslo";
    hesloText.name = "password";
    hesloText.id = "password";
    let tlacitko = document.createElement('button');
    tlacitko.innerHTML = "Prihlásiť";
    tlacitko.type = "submit";
    tlacitko.id = 'btn';
    if (prih) {
        let p = document.createElement('p');
        p.className = "cervena";
        p.innerHTML = "Zadali ste zlý login";
        hlavna.append(p);
    }
    hlavna.append(formicka);
    formicka.appendChild(menoNadpis);
    formicka.appendChild(menoText);
    formicka.appendChild(hesloNadpis);
    formicka.appendChild(hesloText);
    formicka.appendChild(tlacitko);
}