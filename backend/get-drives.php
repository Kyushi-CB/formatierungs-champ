<?php

# TODO: NVME support currently missing only sata on /dev/sd*
# get array of paths for current available drives on /dev/sd* 
exec('lsblk -nd --output PATH | grep "sd"', $drivePath);


# declare empty Arrays for storing Type, Name and formatting status, gets cleared on each function call
$driveType = array();
$driveName = array();
$driveStatus = array();
$output = array();

# get drive type
function getDrivesType(&$drivePath, &$driveType) {

    # iterate through current drive paths 
    for ($i = 0; $i < count($drivePath); $i++) {

        # get Nominal Media Rotation Rate output with hdparm to string
        $getType = shell_exec('sudo hdparm -I ' . $drivePath[$i] . ' | grep "Nominal Media"');

        #remove \n\r\t\v\x00 chars in string on line start and end
        $getType = trim($getType);

        #check if SSD, non SSD or N/A
        if ($getType != "" && $getType != "Nominal Media Rotation Rate: Solid State Device") {
            $getType = "HDD";
        } 
        if ($getType == "Nominal Media Rotation Rate: Solid State Device") {
            $getType = "SSD";
        } 
        if ($getType == "" || $getType == null) {
            $getType = "N/A";
        }

        # push String output to Array on each iteration
        array_push($driveType, $getType);
    }
}

# get drive name
function getDrivesName(&$drivePath, &$driveName) {

    # iterate through current drive paths 
    for ($i = 0; $i < count($drivePath); $i++) {

       # get Modelnumber/Name output to String
       $getName = shell_exec('sudo hdparm -I ' . $drivePath[$i] . ' | grep "Model Number" | sed "s/Model Number://g"');

       #remove \n\r\t\v\x00 chars in string on line start and end
        $getName = trim($getName);

       # check if Name = "" or null 
       if ($getName == null || $getName == "") {
           $getName = "N/A";
       }
        # push String output to Array on each iteration
        array_push($driveName, $getName);
    }
}

#get drive formatting status
function getDrivesForm(&$drivePath, &$driveStatus) {
    # iterate through current drive paths 
    for ($i = 0; $i < count($drivePath); $i++) {

        # get Partitioning to String with parted
        $getStatus = shell_exec('sudo parted ' . $drivePath[$i] . ' print | grep "Partition" | sed "s/Partition Table://g"');
        
        #remove \n\r\t\v\x00 chars in string on line start and end
        $getStatus = trim($getStatus);

        # check if drive has Partition-Table, is unknown (formatted) or null (indicates drive is corrupted or removed)
        if ($getStatus == "unknown") {
            $getStatus = "Formatiert";
        }
        if ($getStatus != "Formatiert" && $getStatus != "" || $getStatus != "Formatiert" && $getStatus != null) {
            $getStatus = "Unformatiert";
        }
        if ($getStatus != "unknown" && $getStatus == "" || $getStatus == null) {
            $getStatus = "N/A";
        }
        # push String output to Array on each iteration
        array_push($driveStatus, $getStatus);
    }
}

# push all Arrays in Output Array
function pushOutput(&$output, &$drivePath, &$driveType, &$driveName, &$driveStatus) {
     
    for ($i = 0; $i < count($drivePath); $i++) {
        
        $obj = array(
            "Id" => str_replace("/dev/", "", $drivePath[$i]),
            "Path" => $drivePath[$i],
            "Type" => $driveType[$i],
            "Name" => $driveName[$i],
            "Status" => $driveStatus[$i]
        );
        array_push($output, $obj);
    }
    
}

# callback functions
getDrivesType($drivePath, $driveType);
getDrivesName($drivePath, $driveName);
getDrivesForm($drivePath, $driveStatus);
pushOutput($output, $drivePath, $driveType, $driveName, $driveStatus);

# export final output as json
echo json_encode($output);

?>