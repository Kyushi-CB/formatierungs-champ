function formatDrives() {
    drivesLoad.classList.add('visible');
    let xhr = new XMLHttpRequest();
    xhr.open('POST','./backend/format-drives.php',true);
    xhr.onload = function() {
        drivesLoad.classList.remove('visible');
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('action=format');
}
let buttonFormat = document.querySelector("#format-all");
buttonFormat.addEventListener('click', function() {
    if (buttonFormat.classList.contains("active")) {
        formatDrives();
    }
});