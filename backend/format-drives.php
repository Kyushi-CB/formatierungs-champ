<?php
if($_POST['action'] == 'format') {
  formatDrives();
}

function formatDrives() {
  # TODO: NVME support currently missing, only sata on /dev/sd*
  # get array of paths for current available drives on /dev/sd* 
  exec('lsblk -nd --output PATH | grep "sd"', $drivePath);

  for ($i = 0; $i < count($drivePath); $i++) {

    # get Nominal Media Rotation Rate output with hdparm to string
    $getType = shell_exec('sudo hdparm -I ' . $drivePath[$i] . ' | grep "Nominal Media"');

    #remove \n\r\t\v\x00 chars in string on line start and end
    $getType = trim($getType);

    #check if SSD, non SSD or N/A
    if ($getType != "" && $getType != "Nominal Media Rotation Rate: Solid State Device") {
      
      echo shell_exec('sudo hdparm --user-master u --security-set-pass format ' . $drivePath[$i] . ' && sudo hdparm --user-master u --security-erase format ' . $drivePath[$i]);
        #$getType = "HDD";
    } 
    if ($getType == "Nominal Media Rotation Rate: Solid State Device") {
        #$getType = "SSD";
    } 
    if ($getType == "" || $getType == null) {
        #$getType = "N/A";
    }
  }
}

?>
