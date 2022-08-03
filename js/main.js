

function updateDrives() {
    var getDrives = document.getElementsByClassName('button-sata');
    var getType = document.getElementsByClassName('drive-type');
    var getName = document.getElementsByClassName('drive-name');
    var getIsFormatted = document.getElementsByClassName('drive-is-formatted');
    var getSVG = document.querySelectorAll('svg');

    for (let i=0; i < getDrives.length; i++) {
        if (getType[i].textContent || getName[i].textContent == "N/A") {
            getSVG[i].style.fill = '#f22';
            getType[i].style.color = '#999';
            getName[i].style.color = '#999';
            getIsFormatted[i].style.color = '#999';
        }
        if (getIsFormatted[i].textContent == "Formatiert" && getType[i].textContent && getName[i].textContent != "N/A") {
            getSVG[i].style.fill = '#2f2';
            getType[i].style.color = '#fff';
            getName[i].style.color = '#fff';
            getIsFormatted[i].style.color = '#fff';
        }
        if (getIsFormatted[i].textContent == "Unformatiert" && getType[i].textContent && getName[i].textContent != "N/A"){
            getSVG[i].style.fill = '#fff';
            getType[i].style.color = '#fff';
            getName[i].style.color = '#fff';
            getIsFormatted[i].style.color = '#fff';         
        }
    }
}
const url = "./backend/get-drives.php";
let drives = document.querySelector(".wrapper-drives");

let request = new XMLHttpRequest();
request.open('GET', url);
request.responseType = 'text';
request.send();
request.onload = function() {
    let data;
    data = request.response;
    drives.innerHTML = data;
    updateDrives();
}

function requestDrives() {
    let request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text';
    request.send();
    request.onload = function() {
        let data;
        data = request.response;
        drives.innerHTML = data;
        updateDrives();
    }
 
}

setInterval(function () { 
    requestDrives();
}, 5000);