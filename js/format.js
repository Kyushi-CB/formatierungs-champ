function formatDrives() {
    let xhr = new XMLHttpRequest();
    xhr.open('POST','./backend/format-drives.php',true);
    xhr.onload = function() {
        console.log(this.responseText);
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('action=format');
}

buttonFormat.addEventListener('click', function() {
    let buttonFormat = document.querySelector("#format-all");
    if (buttonFormat.classList.contains("active")) {
        formatDrives();
    }
});