<?php

# get path of current available drives on sd*
exec('lsblk -nd --output PATH | grep "sd"', $drivePath);

# declare empty Arrays for storing Type, Name and formatting status, gets cleared on each function call
$driveType = array();
$driveName = array();
$driveForm = array();
$output = array();

# get drive type
function getDrivesType(&$drivePath, &$driveType) {

    # iterate through current drive paths 
    for ($i = 0; $i < count($drivePath); $i++) {

        # get Nominal Media Rotation Rate output with hdparm to string
        $getType = shell_exec('sudo hdparm -I ' . $drivePath[$i] . ' | grep "Nominal Media"');

        #remove all tabs/space chars in String
        $getType = preg_replace("/\s+/", "", $getType);

        #check if SSD, non SSD or N/A
        if ($getType != "" && $getType != "NominalMediaRotationRate:SolidStateDevice") {
            $getType = "HDD";
        } 
        if ($getType == "NominalMediaRotationRate:SolidStateDevice") {
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
       $getName = shell_exec('sudo hdparm -I ' . $drivePath[$i] . ' | grep "Model Number" | sed -e "s/^[\t]*Model Number:\s*//g"');
        
       # check if Name = "" or null 
       if ($getName == null || $getName == "") {
           $getName = "N/A";
       }
        # push String output to Array on each iteration
        array_push($driveName, $getName);
    }
}

#get drive formatting status
function getDrivesForm(&$drivePath, &$driveForm) {
    # iterate through current drive paths 
    for ($i = 0; $i < count($drivePath); $i++) {

        # get Partitioning to String with parted
        $getForm = shell_exec('sudo parted ' . $drivePath[$i] . ' print | grep "Partition" | sed "s/^[\t]*Partition Table:\s*//g"');
        
        # check if drive has Partition-Table, is unknown (formatted) or null (indicates drive is corrupted or removed)
        if ($getForm == "unknown") {
            $getForm = "Formatiert";
        }
        if ($getForm != "unknown" && $getForm != "" || $getForm != null) {
            $getForm = "Unformatiert";
        }
        if ($getForm != "unknown" && $getForm == "" || $getForm == null) {
            $getForm = "N/A";
        }
        # push String output to Array on each iteration
        array_push($driveForm, $getForm);
    }
}

# push all Arrays in Output Array
function pushOutput(&$output, &$drivePath, &$driveType, &$driveName, &$driveForm) {
    array_push($output, $drivePath, $driveType, $driveName, $driveForm);
}

# callback functions
getDrivesType($drivePath, $driveType);
getDrivesName($drivePath, $driveName);
getDrivesForm($drivePath, $driveForm);
pushOutput($output, $drivePath, $driveType, $driveName, $driveForm);

# export final output as json
echo json_encode($output);

?>