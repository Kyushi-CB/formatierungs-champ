// set url to fetch data from
const url = "./backend/get-drives.php";

// query required html elements
let wrapperDrives = document.querySelector('.wrapper-drives');
let drivesLoad = document.querySelector('.drives-load');

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
    let drivesAvailable = document.querySelectorAll('.wrapper-drives button');

    for (let i = 0; i < drivesAvailable.length; i++) {
        currentDrives.push(drivesAvailable[i].getAttribute("name"));
    }

    // compare current drives with fetched data, delete obsolet drives from DOM
    if (currentDrives.length > drives.length) {
        obsoletDrives = currentDrives.filter((o1) => !drives.some((o2) => o1 == o2.Id));
        for (let i = 0; i < obsoletDrives.length; i++) {
            document.querySelector('.wrapper-drives button[name="' + obsoletDrives[i] + '"]').remove();
        }
    }

    // compare if fetched data is different from current data and push new objects to "newDrives"
    if (currentDrives.length < drives.length) {
        
        if (drivesAvailable != 0) {
            newDrives = drives.filter((o1) => !currentDrives.some((o2) => o1.Id === o2));
        }
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
    for (let i = 0; i < newDrives.length; i++) {

        if (newDrives[i].Type == "HDD" || newDrives[i].Type == "N/A") {
            let newButton = document.createElement("button");
            let hddSvg = document.createElement('ext-svg');
            let newType = document.createElement("span");
            let newName = document.createElement("span");
            let newFormat = document.createElement("span");

            hddSvg.setAttribute('src', './assets/svg/hdd.svg');
               
            newButton.setAttribute("type", "button");
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
            let newButton = document.createElement("button");
            let ssdSvg = document.createElement('ext-svg');
            let newType = document.createElement("span");
            let newName = document.createElement("span");
            let newFormat = document.createElement("span");
            
            ssdSvg.setAttribute('src', './assets/svg/ssd.svg');

            newButton.setAttribute("type", "button");
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