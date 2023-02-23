// set url to fetch data from
const url = "./backend/get-drives.php";

// query required html elements
const wrapperDrives = document.querySelector('.wrapper-drives');
const drivesLoad = document.querySelector('.drives-load');
const formatButton = document.querySelector('#format-all');
const submitWrapper = document.querySelector('.submit-wrapper');
const submitButton = document.querySelector('#submit');
const cancelButton = document.querySelector('#cancel');
let textLoad = document.querySelector('#text-load');
let textNotification = document.querySelector('#text-notification');

// set text notifications
const txtFormatting = "Secure Erase wird ausgeführt...";
const txtNoDrives = "Es wurden keine Datenträger erkannt..."
const txtDamaged = "Secure Erase nicht möglich! Es sind fehlerhafte Datenträger verbunden.";
const txtDone = "Secure Erase abgeschlossen. Die Datenträger können nun entfernt werden."
const txtRemoveDone = "Secure Erase nicht möglich! Es sind bereits Formatierte Datenträger verbunden."

// declare required arrays
let drives = []; 
let newDrives = [];
let currentDrives = []; 
let obsoletDrives = []; 



// fetch json data from backend to arrays
async function fetchDrives() {

    let response = await fetch(url);
    drives = await response.json();
    currentDrives = [];
    obsoletDrives = [];
}

async function handleDrives() {
    await fetchDrives();


    // get currently displayed drives and push name attribute to array of strings
    let drivesAvailable = document.querySelectorAll('.wrapper-drives div');

    for (let i = 0; i < drivesAvailable.length; i++) {
        currentDrives.push(drivesAvailable[i].getAttribute("name"));
    }

    // compare current drives with fetched data, delete obsolet drives from DOM
    if (currentDrives.length > drives.length) {
        obsoletDrives = currentDrives.filter((o1) => !drives.some((o2) => o1 == o2.Id));
        for (let i = 0; i < obsoletDrives.length; i++) {
            document.querySelector('.wrapper-drives div[name="' + obsoletDrives[i] + '"]').remove();
        }
    }

    // compare if fetched data is different from current data and push new objects to "newDrives"
    if (currentDrives.length < drives.length) {
        
        if (drivesAvailable != 0) {
            newDrives = drives.filter((o1) => !currentDrives.some((o2) => o1.Id === o2));
        }
       createDrives();
    }
    setState();   
}

async function loading() {
    await handleDrives();

    let drivesAvailable = document.querySelectorAll('.wrapper-drives div');

    if (drivesAvailable.length >= 1) {
        drivesLoad.classList.remove('visible');
        textLoad.textContent = "";
    }

    if (drivesAvailable.length == 0) {
        drivesLoad.classList.add('visible');
        textLoad.textContent = txtNoDrives;
        textNotification.textContent = "";
    }
}

loading();

function createDrives() {
    for (let i = 0; i < newDrives.length; i++) {

        if (newDrives[i].Type == "HDD" || newDrives[i].Type == "N/A") {
            let newButton = document.createElement("div");
            let hddSvg = document.createElement('ext-svg');
            let newType = document.createElement("span");
            let newName = document.createElement("span");
            let newFormat = document.createElement("span");

            hddSvg.setAttribute('src', './assets/svg/hdd.svg');

            newButton.className = "drive";
            newButton.setAttribute("name", newDrives[i].Id);
            
            newType.className = 'drive-type';
            newType.textContent = newDrives[i].Type;

            newName.className = 'drive-name';
            newName.textContent = newDrives[i].Name;

            newFormat.className = 'drive-is-formatted';
            newFormat.textContent = newDrives[i].Status;
            
            wrapperDrives.appendChild(newButton);
            newButton.appendChild(hddSvg);
            newButton.appendChild(newType);
            newButton.appendChild(newName);
            newButton.appendChild(newFormat);
        }

        if (newDrives[i].Type == "SSD") {
            let newButton = document.createElement("div");
            let ssdSvg = document.createElement('ext-svg');
            let newType = document.createElement("span");
            let newName = document.createElement("span");
            let newFormat = document.createElement("span");
            
            ssdSvg.setAttribute('src', './assets/svg/ssd.svg');

            newButton.className = "drive";
            newButton.setAttribute("name", newDrives[i].Id);
            
            newType.className = 'drive-type';
            newType.textContent = newDrives[i].Type;

            newName.className = 'drive-name';
            newName.textContent = newDrives[i].Name;

            newFormat.className = 'drive-is-formatted';
            newFormat.textContent = newDrives[i].Status;
            
            wrapperDrives.appendChild(newButton);
            newButton.appendChild(ssdSvg);
            newButton.appendChild(newType);
            newButton.appendChild(newName);
            newButton.appendChild(newFormat);
        }
    }
    
}

// refresh status for each drive
async function setDriveState() {
    let drivesAvailable = document.querySelectorAll('.wrapper-drives div');
    let getType = document.getElementsByClassName('drive-type');
    let getName = document.getElementsByClassName('drive-name');
    let getIsFormatted = document.getElementsByClassName('drive-is-formatted');

    for (let i = 0; i < drivesAvailable.length; i++) {

        getName[i].textContent = drives[i].Name;
        getType[i].textContent = drives[i].Type;
        getIsFormatted[i].textContent = drives[i].Status;
        
        if (getName[i].textContent == "N/A") {
            drivesAvailable[i].classList.remove("formatted");
            drivesAvailable[i].classList.add("error");
        }
        if (getIsFormatted[i].textContent == "Formatiert" && getType[i].textContent != "N/A" && getName[i].textContent != "N/A") {
            drivesAvailable[i].classList.add("formatted");
            drivesAvailable[i].classList.remove("error");
        }
        if (getIsFormatted[i].textContent == "Unformatiert" && getType[i].textContent != "N/A" && getName[i].textContent != "N/A"){
            drivesAvailable[i].classList.remove("formatted");
            drivesAvailable[i].classList.remove("error");  
        }

    }
}

async function setState() {
    await setDriveState();

    let drivesAvailable = document.querySelectorAll('.wrapper-drives div');
    let getName = document.getElementsByClassName('drive-name');
    let getIsFormatted = document.getElementsByClassName('drive-is-formatted');
    let arrName = [];
    let arrIsFormatted = [];

    if (drivesAvailable.length == 0) {
        formatButton.classList.remove("active");
        return;
    }

    for (let i = 0; i < drivesAvailable.length; i++) {
        arrName.push(getName[i].textContent);
        arrIsFormatted.push(getIsFormatted[i].textContent);
    }

    if (arrIsFormatted.includes("N/A") || arrName.includes("N/A")) {
        formatButton.classList.remove("active");
        textNotification.textContent = txtDamaged;
        return;
    }
    if (arrIsFormatted.includes("Formatiert") && arrIsFormatted.includes("Unformatiert")) {
        formatButton.classList.remove("active");
        textNotification.textContent = txtRemoveDone;
    }
    if (arrIsFormatted.includes("Formatiert") && !arrIsFormatted.includes("Unformatiert")) {
        formatButton.classList.remove("active");
        textNotification.textContent = txtDone;
    }
    if (arrIsFormatted.includes("Unformatiert") && !arrIsFormatted.includes("Formatiert")) {
        formatButton.classList.add("active");
        textNotification.textContent = "";
    }


}

function formatDrives() {
    drivesLoad.classList.add('visible');
    textLoad.textContent = txtFormatting;
    let xhr = new XMLHttpRequest();
    xhr.open('POST','./backend/get-drives.php',true);
    xhr.onload = function() {
        drivesLoad.classList.remove('visible');
        textLoad = "";
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('action=format');
}

formatButton.addEventListener('click', function() {
    if (formatButton.classList.contains("active")) {
        submitWrapper.classList.add("active");
    }
});



let formatRunning = false;

submitButton.addEventListener('click', function() {
    if (submitWrapper.classList.contains("active")) {
        submitWrapper.classList.remove("active");
        formatRunning = true;
        formatDrives();
        formatRunning = false;
    }
});

cancelButton.addEventListener('click', function() {
    submitWrapper.classList.remove("active");
});

// execute above functions every 1.5 seconds to update drive status without full page refresh
setInterval(function () {
    if (formatRunning == false) {
        loading();
    }
    
}, 1500);
