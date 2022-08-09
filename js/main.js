// set url to fetch data from
const url = "./backend/get-drives.php";

// create new html custom class to fetch and inject external svg file
class ExtSVG extends HTMLElement {
    constructor() {
      super();
    }
    connectedCallback() {
      fetch(this.getAttribute('src'))
        .then(response => response.text())
        .then(text => {
          this.innerHTML = text;
        });
    }
  }

customElements.define('ext-svg', ExtSVG);




// query required html elements
const wrapperDrives = document.querySelector('.wrapper-drives');
let drivesLoad = document.querySelector('.drives-load');

// declare required arrays
let drivePath = [];
let driveType = [];
let driveName = [];
let driveForm = [];
let currentDrives = [];
let newDrives = [];
let obsoletDrives = [];

// fetch json data from backend to arrays
async function fetchDrives() {
    let drives;
    let response = await fetch(url);
    drives = await response.json();
    //TODO: index of other arrays must be the same after filter!
    drivePath = await drives[0];
    driveType = await drives[1];
    driveName = await drives[2];
    driveForm = await drives[3];
}

async function compareDrives() {
    await fetchDrives();
    currentDrives = [];
    newDrives = [];
    obsoletDrives = [];
    let drivesAvailable = document.querySelectorAll('.wrapper-drives button');
    for (let i = 0; i < drivesAvailable.length; i++) {
        currentDrives.push(drivesAvailable[i].getAttribute('name'));
    }
    //TODO: index of other arrays must be the same after filter!
    // compare fetched drive array with current elements array and filter not matched strings   
    obsoletDrives = currentDrives.filter(x => !drivePath.includes(x));
    newDrives = drivePath.filter(x => !currentDrives.includes(x));
    console.log("old", currentDrives, "new", drivePath, "create", newDrives, "obsolet", obsoletDrives); //TODO: remove log
}

async function handleDrives() {
    await compareDrives();
    if (currentDrives.length > drivePath.length) {

    }
    if (currentDrives.length < drivePath.length) {
        
        createDrives();   
    }
    setDriveState();   
}

async function loading() {
    await handleDrives();
    let drivesAvailable = document.querySelectorAll('.wrapper-drives button');   
    if (drivesAvailable.length >= 1) {
        drivesLoad.classList.remove('visible');
    }
    if (drivesAvailable.length < 1) {
        drivesLoad.classList.add('visible');
    }
}

loading();

function createDrives() {
    //TODO: index of other arrays must be the same after filter!
    for (let i = 0; i < newDrives.length; i++) {
        if (driveType[i] == "HDD" || driveType[i] == "N/A") {
            let newButton = document.createElement("button");
            let hddSvg = document.createElement('ext-svg');
            let newType = document.createElement("span");
            let newName = document.createElement("span");
            let newFormat = document.createElement("span");

            hddSvg.setAttribute('src', './assets/svg/hdd.svg');
               
            newButton.setAttribute("type", "button");
            newButton.setAttribute("name", drivePath[i]);
            
            newType.className = 'drive-type';
            newType.textContent = driveType[i];

            newName.className = 'drive-name';
            newName.textContent = driveName[i];

            newFormat.className = 'drive-is-formatted';
            newFormat.textContent = driveForm[i];
            
            wrapperDrives.appendChild(newButton);
            newButton.appendChild(hddSvg);
            newButton.appendChild(newType);
            newButton.appendChild(newName);
            newButton.appendChild(newFormat);
        }
        if (driveType[i] == "SSD") {
            let newButton = document.createElement("button");
            let ssdSvg = document.createElement('ext-svg');
            let newType = document.createElement("span");
            let newName = document.createElement("span");
            let newFormat = document.createElement("span");
            
            ssdSvg.setAttribute('src', './assets/svg/ssd.svg');

            newButton.setAttribute("type", "button");
            newButton.setAttribute("name", drivePath[i]);
            
            newType.className = 'drive-type';
            newType.textContent = driveType[i];

            newName.className = 'drive-name';
            newName.textContent = driveName[i];

            newFormat.className = 'drive-is-formatted';
            newFormat.textContent = driveForm[i];
            
            wrapperDrives.appendChild(newButton);
            newButton.appendChild(ssdSvg);
            newButton.appendChild(newType);
            newButton.appendChild(newName);
            newButton.appendChild(newFormat);
        }
    }
    
}

// set element style for each element based on status
function setDriveState() {
    let drivesAvailable = document.querySelectorAll('.wrapper-drives button');
    let getType = document.getElementsByClassName('drive-type');
    let getName = document.getElementsByClassName('drive-name');
    let getIsFormatted = document.getElementsByClassName('drive-is-formatted');


    for (let i = 0; i < drivesAvailable.length; i++) {
        if (getType[i].textContent || getName[i].textContent == "N/A") {
            drivesAvailable[i].classList.remove("formatted");
            drivesAvailable[i].classList.add("error");
        }
        if (getIsFormatted[i].textContent == "Formatiert" && getType[i].textContent && getName[i].textContent != "N/A") {
            drivesAvailable[i].classList.add("formatted");
            drivesAvailable[i].classList.remove("error");
        }
        if (getIsFormatted[i].textContent == "Unformatiert" && getType[i].textContent && getName[i].textContent != "N/A"){
            drivesAvailable[i].classList.remove("formatted");
            drivesAvailable[i].classList.remove("error");       
        }
    }
}

// execute above functions every 3 seconds to update drive status without full page refresh
setInterval(function () {
    loading();
}, 3000);