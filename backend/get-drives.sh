#!/bin/bash

arrDrives=($(lsblk -nd --output PATH | grep "sd"))

for (( i=0; i< ${#arrDrives[@]}; i++ ))
    do 
        arrType=($( hdparm -I ${arrDrives[$i]} | grep "Solid State Device"))
        echo  ${arrDrives[$i]}":"$arrType

        
done
