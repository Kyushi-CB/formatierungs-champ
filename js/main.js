var getDrives = document.getElementsByClassName('button-sata');
var getType = document.getElementsByClassName('drive-type');
var getName = document.getElementsByClassName('drive-name');
var getIsFormatted = document.getElementsByClassName('drive-is-formatted');
var getSVG = document.querySelectorAll('svg');

function updateDrives() {
    for (let i=0; i < getDrives.length; i++) {
        if (getType[i].textContent || getName[i].textContent || getIsFormatted[i].textContent == "N/A") {

            getSVG[i].style.fill = '#f22';
            getType[i].style.color = '#999';
            getName[i].style.color = '#999';
            getIsFormatted[i].style.color = '#999';

        } else if (getIsFormatted == "Formatiert") {

            getSVG[i].style.fill = '#2f2';
            getType[i].style.color = '#fff';
            getName[i].style.color = '#fff';
            getIsFormatted[i].style.color = '#fff';

        } else if (getIsFormatted == "Unformatiert" ){
            getSVG[i].style.fill = '#fff';
            getType[i].style.color = '#fff';
            getName[i].style.color = '#fff';
            getIsFormatted[i].style.color = '#fff';          
        }
    }
}
updateDrives();