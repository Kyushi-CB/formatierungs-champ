<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/favico/favicon.ico">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <title>Formatierungs Champ</title>
</head>
<?php
exec('lsblk -nd --output PATH | grep "sd"', $arrDrives);
#                $getType = shell_exec('sudo hdparm -I ' . $getDrives[0] . ' | grep ""');
#                print_r($getType);
?>
    <body>
        <div class="wrapper-drives">
            <?php
            $arrType=array();
            for ($i = 0; $i < count($arrDrives); $i++) {
                $getType = shell_exec('sudo hdparm -I ${arrDrives[$i]} | grep "Solid State Device" | sed -e "s/Nominal Media Rotation Rate: Solid State Device/SSD/g"');
                array_push($arrType, $getType);
                echo $arrDrives[$i] . $arrType[$i];
                echo 
                    '<button class="button-sata" id="sata-' . $i . '" type="button">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 228 228" style="enable-background:new 0 0 228 228;" xml:space="preserve"><path d="M20,0v228h188V0H20z M200,220H28V8h172V220z"/><path d="M76.532,145.118l-20.924,10.62c-1.912,0.648-3.707,1.578-5.342,2.77c-8.92,6.48-10.906,19.012-4.426,27.934c3.908,5.379,10.016,8.238,16.209,8.238c4.074,0,8.188-1.238,11.73-3.812c1.637-1.192,3.076-2.609,4.281-4.226l31.504-31.604l-0.05,0.822c1.482,0.09,2.978,0.14,4.486,0.14c38.598,0,70-31.402,70-70c0-38.598-31.402-70-70-70c-38.598,0-70,31.402-70,70C44,110.168,56.34,132.323,76.532,145.118z M72.182,181.207c-0.15,0.152-0.289,0.312-0.414,0.488c-0.746,1.035-1.654,1.945-2.692,2.699c-5.356,3.902-12.871,2.703-16.764-2.656c-3.889-5.352-2.697-12.871,2.658-16.762c1.037-0.754,2.182-1.336,3.4-1.726c0.201-0.066,0.398-0.144,0.588-0.242l63.482-32.219L72.182,181.207z M114,24c34.188,0,62,27.812,62,62c0,33.27-26.361,60.426-59.284,61.862l29.04-29.132c1.389-1.391,1.558-3.586,0.404-5.176c-1.154-1.59-3.287-2.098-5.047-1.215l-56.104,28.476C64.647,130.02,52,109.035,52,86C52,51.812,79.812,24,114,24z"/><path d="M114,112c14.336,0,26-11.664,26-26s-11.664-26-26-26S88,71.664,88,86S99.664,112,114,112z M114,68c9.926,0,18,8.074,18,18s-8.074,18-18,18s-18-8.074-18-18S104.074,68,114,68z"/><circle cx="188" cy="20" r="8"/><circle cx="188" cy="208" r="8"/><circle cx="40" cy="20" r="8"/><circle cx="40" cy="208" r="8"/><circle cx="60" cy="176" r="8"/></svg>
                    </button>';
            }
            
            ?>
<!--
            <button class="button-sata" id="sata-0" type="button">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 228 228" style="enable-background:new 0 0 228 228;" xml:space="preserve"><path d="M20,0v228h188V0H20z M200,220H28V8h172V220z"/><path d="M76.532,145.118l-20.924,10.62c-1.912,0.648-3.707,1.578-5.342,2.77c-8.92,6.48-10.906,19.012-4.426,27.934c3.908,5.379,10.016,8.238,16.209,8.238c4.074,0,8.188-1.238,11.73-3.812c1.637-1.192,3.076-2.609,4.281-4.226l31.504-31.604l-0.05,0.822c1.482,0.09,2.978,0.14,4.486,0.14c38.598,0,70-31.402,70-70c0-38.598-31.402-70-70-70c-38.598,0-70,31.402-70,70C44,110.168,56.34,132.323,76.532,145.118z M72.182,181.207c-0.15,0.152-0.289,0.312-0.414,0.488c-0.746,1.035-1.654,1.945-2.692,2.699c-5.356,3.902-12.871,2.703-16.764-2.656c-3.889-5.352-2.697-12.871,2.658-16.762c1.037-0.754,2.182-1.336,3.4-1.726c0.201-0.066,0.398-0.144,0.588-0.242l63.482-32.219L72.182,181.207z M114,24c34.188,0,62,27.812,62,62c0,33.27-26.361,60.426-59.284,61.862l29.04-29.132c1.389-1.391,1.558-3.586,0.404-5.176c-1.154-1.59-3.287-2.098-5.047-1.215l-56.104,28.476C64.647,130.02,52,109.035,52,86C52,51.812,79.812,24,114,24z"/><path d="M114,112c14.336,0,26-11.664,26-26s-11.664-26-26-26S88,71.664,88,86S99.664,112,114,112z M114,68c9.926,0,18,8.074,18,18s-8.074,18-18,18s-18-8.074-18-18S104.074,68,114,68z"/><circle cx="188" cy="20" r="8"/><circle cx="188" cy="208" r="8"/><circle cx="40" cy="20" r="8"/><circle cx="40" cy="208" r="8"/><circle cx="60" cy="176" r="8"/></svg>
            </button>
            <button class="button-sata" id="sata-1" type="button">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 228 228" style="enable-background:new 0 0 228 228;" xml:space="preserve"><path d="M20,0v228h188V0H20z M200,220H28V8h172V220z"/><path d="M76.532,145.118l-20.924,10.62c-1.912,0.648-3.707,1.578-5.342,2.77c-8.92,6.48-10.906,19.012-4.426,27.934c3.908,5.379,10.016,8.238,16.209,8.238c4.074,0,8.188-1.238,11.73-3.812c1.637-1.192,3.076-2.609,4.281-4.226l31.504-31.604l-0.05,0.822c1.482,0.09,2.978,0.14,4.486,0.14c38.598,0,70-31.402,70-70c0-38.598-31.402-70-70-70c-38.598,0-70,31.402-70,70C44,110.168,56.34,132.323,76.532,145.118z M72.182,181.207c-0.15,0.152-0.289,0.312-0.414,0.488c-0.746,1.035-1.654,1.945-2.692,2.699c-5.356,3.902-12.871,2.703-16.764-2.656c-3.889-5.352-2.697-12.871,2.658-16.762c1.037-0.754,2.182-1.336,3.4-1.726c0.201-0.066,0.398-0.144,0.588-0.242l63.482-32.219L72.182,181.207z M114,24c34.188,0,62,27.812,62,62c0,33.27-26.361,60.426-59.284,61.862l29.04-29.132c1.389-1.391,1.558-3.586,0.404-5.176c-1.154-1.59-3.287-2.098-5.047-1.215l-56.104,28.476C64.647,130.02,52,109.035,52,86C52,51.812,79.812,24,114,24z"/><path d="M114,112c14.336,0,26-11.664,26-26s-11.664-26-26-26S88,71.664,88,86S99.664,112,114,112z M114,68c9.926,0,18,8.074,18,18s-8.074,18-18,18s-18-8.074-18-18S104.074,68,114,68z"/><circle cx="188" cy="20" r="8"/><circle cx="188" cy="208" r="8"/><circle cx="40" cy="20" r="8"/><circle cx="40" cy="208" r="8"/><circle cx="60" cy="176" r="8"/></svg>
            </button>
            <button class="button-sata" id="sata-2" type="button">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 228 228" style="enable-background:new 0 0 228 228;" xml:space="preserve"><path d="M20,0v228h188V0H20z M200,220H28V8h172V220z"/><path d="M76.532,145.118l-20.924,10.62c-1.912,0.648-3.707,1.578-5.342,2.77c-8.92,6.48-10.906,19.012-4.426,27.934c3.908,5.379,10.016,8.238,16.209,8.238c4.074,0,8.188-1.238,11.73-3.812c1.637-1.192,3.076-2.609,4.281-4.226l31.504-31.604l-0.05,0.822c1.482,0.09,2.978,0.14,4.486,0.14c38.598,0,70-31.402,70-70c0-38.598-31.402-70-70-70c-38.598,0-70,31.402-70,70C44,110.168,56.34,132.323,76.532,145.118z M72.182,181.207c-0.15,0.152-0.289,0.312-0.414,0.488c-0.746,1.035-1.654,1.945-2.692,2.699c-5.356,3.902-12.871,2.703-16.764-2.656c-3.889-5.352-2.697-12.871,2.658-16.762c1.037-0.754,2.182-1.336,3.4-1.726c0.201-0.066,0.398-0.144,0.588-0.242l63.482-32.219L72.182,181.207z M114,24c34.188,0,62,27.812,62,62c0,33.27-26.361,60.426-59.284,61.862l29.04-29.132c1.389-1.391,1.558-3.586,0.404-5.176c-1.154-1.59-3.287-2.098-5.047-1.215l-56.104,28.476C64.647,130.02,52,109.035,52,86C52,51.812,79.812,24,114,24z"/><path d="M114,112c14.336,0,26-11.664,26-26s-11.664-26-26-26S88,71.664,88,86S99.664,112,114,112z M114,68c9.926,0,18,8.074,18,18s-8.074,18-18,18s-18-8.074-18-18S104.074,68,114,68z"/><circle cx="188" cy="20" r="8"/><circle cx="188" cy="208" r="8"/><circle cx="40" cy="20" r="8"/><circle cx="40" cy="208" r="8"/><circle cx="60" cy="176" r="8"/></svg>
            </button>
            <button class="button-sata" id="sata-3" type="button">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 228 228" style="enable-background:new 0 0 228 228;" xml:space="preserve"><path d="M20,0v228h188V0H20z M200,220H28V8h172V220z"/><path d="M76.532,145.118l-20.924,10.62c-1.912,0.648-3.707,1.578-5.342,2.77c-8.92,6.48-10.906,19.012-4.426,27.934c3.908,5.379,10.016,8.238,16.209,8.238c4.074,0,8.188-1.238,11.73-3.812c1.637-1.192,3.076-2.609,4.281-4.226l31.504-31.604l-0.05,0.822c1.482,0.09,2.978,0.14,4.486,0.14c38.598,0,70-31.402,70-70c0-38.598-31.402-70-70-70c-38.598,0-70,31.402-70,70C44,110.168,56.34,132.323,76.532,145.118z M72.182,181.207c-0.15,0.152-0.289,0.312-0.414,0.488c-0.746,1.035-1.654,1.945-2.692,2.699c-5.356,3.902-12.871,2.703-16.764-2.656c-3.889-5.352-2.697-12.871,2.658-16.762c1.037-0.754,2.182-1.336,3.4-1.726c0.201-0.066,0.398-0.144,0.588-0.242l63.482-32.219L72.182,181.207z M114,24c34.188,0,62,27.812,62,62c0,33.27-26.361,60.426-59.284,61.862l29.04-29.132c1.389-1.391,1.558-3.586,0.404-5.176c-1.154-1.59-3.287-2.098-5.047-1.215l-56.104,28.476C64.647,130.02,52,109.035,52,86C52,51.812,79.812,24,114,24z"/><path d="M114,112c14.336,0,26-11.664,26-26s-11.664-26-26-26S88,71.664,88,86S99.664,112,114,112z M114,68c9.926,0,18,8.074,18,18s-8.074,18-18,18s-18-8.074-18-18S104.074,68,114,68z"/><circle cx="188" cy="20" r="8"/><circle cx="188" cy="208" r="8"/><circle cx="40" cy="20" r="8"/><circle cx="40" cy="208" r="8"/><circle cx="60" cy="176" r="8"/></svg>
            </button>
            <button class="button-nvme" id="nvme-0" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 512.12"><path d="M370.35 0c1.02 0 2.05.21 3.03.61.89.37 1.72.89 2.44 1.57 4.51 3.18 26.4 25.72 40.56 40.28 4.72 4.87 8.55 8.81 10.87 11.13l1.75 1.74-4.8 4.8c-1.49 1.5-2.57 3.3-3.26 5.25-.75 2.16-1.05 4.52-.93 6.92.13 2.57.73 5.17 1.76 7.56 1 2.3 2.4 4.43 4.17 6.2 1.78 1.77 3.91 3.18 6.2 4.17 2.39 1.03 4.99 1.64 7.56 1.76 2.39.12 4.76-.18 6.91-.93 1.96-.69 3.76-1.76 5.25-3.25l4.8-4.8 52.99 52.98c.75.75 1.33 1.64 1.73 2.61.41.99.62 2.04.62 3.06s-.21 2.06-.62 3.05c-.4.97-.98 1.87-1.73 2.61L169.33 487.64c-.77.76-1.66 1.34-2.6 1.73-.99.41-2.04.62-3.06.62s-2.06-.21-3.06-.62c-.95-.4-1.84-.97-2.6-1.73l-4.77-4.77-27.22 27.22a6.905 6.905 0 0 1-4.87 2.03c-1.76 0-3.53-.68-4.88-2.02L40.6 434.42a4.943 4.943 0 0 1 0-6.96l4.18-4.2c1.2-1.2 1.8-2.79 1.8-4.39 0-1.59-.6-3.19-1.8-4.39a6.224 6.224 0 0 0-4.39-1.8c-1.61 0-3.21.6-4.41 1.8l-4.16 4.18a4.931 4.931 0 0 1-6.98 0L1.76 395.59a6.037 6.037 0 0 1 0-8.52l27.84-27.84-5.24-5.24a7.997 7.997 0 0 1-1.73-2.6c-.41-.99-.62-2.04-.62-3.06 0-1.01.21-2.05.62-3.04.39-.94.96-1.82 1.72-2.6L364.68 2.35c.76-.76 1.65-1.34 2.59-1.73a8.22 8.22 0 0 1 3.08-.62zM63.68 343.24a6.79 6.79 0 0 1 9.63 0 6.808 6.808 0 0 1 0 9.63 6.808 6.808 0 0 1-9.63 0 6.808 6.808 0 0 1 0-9.63zm82.58 132.65L36.58 366.21l-25.11 25.12 5.91 5.91 17.34-17.35 6.98 6.99-17.34 17.34 3.98 3.98.67-.68c3.16-3.15 7.27-4.72 11.38-4.72 4.11 0 8.24 1.57 11.37 4.7 3.13 3.13 4.7 7.26 4.7 11.37 0 4.12-1.57 8.24-4.7 11.38l-.69.67 6.38 6.39 17.34-17.35 6.98 6.99-17.34 17.34 9.04 9.05 17.35-17.35 6.98 6.98-17.34 17.35 8.51 8.51 17.34-17.34 6.99 6.98-17.35 17.34 8.51 8.52 17.35-17.35 6.98 6.98-17.35 17.35 9.7 9.7 25.12-25.12zm44.97-117.05-21.87-4.03c-.73-.12-1.86-.85-3.38-2.21l-.23.23 15.74 15.74-11.66 11.66-36.44-36.44 10.96-10.96 21.87 4.02c.73.12 1.86.86 3.38 2.22l.23-.23-15.74-15.75 11.66-11.66 36.44 36.44-10.96 10.97zm143.93-144.1-5.03-7.09c2.82-1.69 5.12-3.43 6.93-5.23 1.79-1.8 3.17-3.32 4.12-4.57l-1.83-1.84-3.6 3.02c-3.26 2.71-6.02 4.05-8.3 4-2.28-.05-4.55-1.21-6.83-3.49-3.13-3.13-4.61-5.97-4.42-8.5.18-2.54 1.9-5.43 5.16-8.68 3.25-3.26 6.49-5.89 9.73-7.9l4.95 6.79c-2.64 1.91-4.65 3.55-6.02 4.92-1.37 1.37-2.47 2.6-3.3 3.68l1.8 1.79 2.9-2.38c3.52-2.89 6.5-4.34 8.94-4.36 2.43-.01 4.73 1.07 6.88 3.22 1.55 1.54 2.64 3.05 3.29 4.53.65 1.48.96 2.79.94 3.91-.03 1.13-.42 2.37-1.18 3.71-.76 1.35-1.5 2.45-2.24 3.31-.74.86-1.76 1.94-3.08 3.26-3.19 3.19-6.45 5.82-9.81 7.9zm22.02-22.01-5.03-7.09c2.81-1.69 5.12-3.43 6.92-5.24 1.8-1.79 3.18-3.32 4.13-4.57l-1.84-1.83-3.6 3.01c-3.25 2.72-6.02 4.05-8.29 4-2.28-.05-4.56-1.21-6.84-3.49-3.13-3.13-4.6-5.96-4.42-8.5.18-2.53 1.9-5.43 5.16-8.68 3.26-3.26 6.5-5.89 9.73-7.9l4.96 6.8c-2.64 1.91-4.65 3.55-6.02 4.91-1.37 1.38-2.48 2.6-3.31 3.68l1.8 1.8 2.9-2.39c3.53-2.89 6.51-4.34 8.95-4.35 2.43-.01 4.73 1.06 6.88 3.21 1.54 1.55 2.64 3.05 3.29 4.54.65 1.48.96 2.78.93 3.91-.02 1.12-.41 2.36-1.17 3.71-.76 1.34-1.51 2.45-2.24 3.3-.74.86-1.77 1.95-3.09 3.27-3.18 3.18-6.45 5.81-9.8 7.9zm23.33-22.53-22.94-22.95 10.28-10.28c4.13-4.15 7.86-6.1 11.16-5.88 3.3.22 7.02 2.39 11.14 6.51 4.13 4.13 6.3 7.85 6.52 11.15.23 3.31-1.73 7.03-5.87 11.16l-10.29 10.29zm-6.68-27.47-3.04 3.05 11.2 11.19 3.04-3.04c1.01-1 1.62-1.85 1.84-2.53.22-.69-.08-1.45-.92-2.28l-7.31-7.31c-.83-.83-1.59-1.14-2.27-.92-.69.22-1.53.84-2.54 1.84zM192.34 284.84l12.3-12.3 27.4 45.48-17.02 17.03-45.48-27.41 12.3-12.3 28.11 18.19.52-.52-18.13-28.17zm63.26 9.63-12.19 12.18L209.19 268l15.21-15.22 23.09 13.99.41-.41-13.99-23.08 15.21-15.22 38.66 34.22-12.19 12.19-18.36-16.97-.41.41 13.24 22.1-8.93 8.92-22.15-13.18-.35.35 16.97 18.37zm38.88-58.71 2.04 2.04c1.28-1.05 2.51-2.16 3.68-3.33 3.61-3.61 6.68-7.85 9.21-12.71l9.97 7.18c-3.19 5.51-6.92 10.41-11.2 14.69-5.44 5.44-10.65 8.1-15.62 7.99-4.98-.12-10.07-2.78-15.28-7.99-5.21-5.21-7.87-10.3-7.99-15.28-.11-4.97 2.54-10.17 7.96-15.59 5.42-5.43 9.91-8.43 13.44-9.01 3.54-.59 7.33 1.15 11.37 5.19 3.42 3.42 4.64 7.11 3.67 11.08-.97 3.96-4.72 9.21-11.25 15.74zm-9.15-9.16 2.39 2.39 2.39-2.39c1.4-1.4 2.27-2.56 2.62-3.49.35-.93 0-1.93-1.05-2.98l-2.39-2.39-2.39 2.39c-1.4 1.4-2.27 2.57-2.62 3.5-.35.93 0 1.93 1.05 2.97zM92.99 330.99 353 70.98a3.199 3.199 0 0 1 4.51 0l85.29 85.28a3.199 3.199 0 0 1 0 4.51L182.78 420.78a3.18 3.18 0 0 1-4.51 0L92.99 335.5a3.199 3.199 0 0 1 0-4.51zM68.5 332c-4.12 0-8.23 1.56-11.36 4.69-3.13 3.14-4.7 7.25-4.7 11.36 0 4.11 1.57 8.22 4.7 11.35 3.14 3.14 7.25 4.71 11.36 4.71 4.11 0 8.22-1.57 11.35-4.7 3.13-3.14 4.7-7.25 4.7-11.36 0-4.1-1.57-8.22-4.7-11.35A16.04 16.04 0 0 0 68.5 332z"/></svg>
            </button>
            <button class="button-nvme" id="nvme-1" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 512.12"><path d="M370.35 0c1.02 0 2.05.21 3.03.61.89.37 1.72.89 2.44 1.57 4.51 3.18 26.4 25.72 40.56 40.28 4.72 4.87 8.55 8.81 10.87 11.13l1.75 1.74-4.8 4.8c-1.49 1.5-2.57 3.3-3.26 5.25-.75 2.16-1.05 4.52-.93 6.92.13 2.57.73 5.17 1.76 7.56 1 2.3 2.4 4.43 4.17 6.2 1.78 1.77 3.91 3.18 6.2 4.17 2.39 1.03 4.99 1.64 7.56 1.76 2.39.12 4.76-.18 6.91-.93 1.96-.69 3.76-1.76 5.25-3.25l4.8-4.8 52.99 52.98c.75.75 1.33 1.64 1.73 2.61.41.99.62 2.04.62 3.06s-.21 2.06-.62 3.05c-.4.97-.98 1.87-1.73 2.61L169.33 487.64c-.77.76-1.66 1.34-2.6 1.73-.99.41-2.04.62-3.06.62s-2.06-.21-3.06-.62c-.95-.4-1.84-.97-2.6-1.73l-4.77-4.77-27.22 27.22a6.905 6.905 0 0 1-4.87 2.03c-1.76 0-3.53-.68-4.88-2.02L40.6 434.42a4.943 4.943 0 0 1 0-6.96l4.18-4.2c1.2-1.2 1.8-2.79 1.8-4.39 0-1.59-.6-3.19-1.8-4.39a6.224 6.224 0 0 0-4.39-1.8c-1.61 0-3.21.6-4.41 1.8l-4.16 4.18a4.931 4.931 0 0 1-6.98 0L1.76 395.59a6.037 6.037 0 0 1 0-8.52l27.84-27.84-5.24-5.24a7.997 7.997 0 0 1-1.73-2.6c-.41-.99-.62-2.04-.62-3.06 0-1.01.21-2.05.62-3.04.39-.94.96-1.82 1.72-2.6L364.68 2.35c.76-.76 1.65-1.34 2.59-1.73a8.22 8.22 0 0 1 3.08-.62zM63.68 343.24a6.79 6.79 0 0 1 9.63 0 6.808 6.808 0 0 1 0 9.63 6.808 6.808 0 0 1-9.63 0 6.808 6.808 0 0 1 0-9.63zm82.58 132.65L36.58 366.21l-25.11 25.12 5.91 5.91 17.34-17.35 6.98 6.99-17.34 17.34 3.98 3.98.67-.68c3.16-3.15 7.27-4.72 11.38-4.72 4.11 0 8.24 1.57 11.37 4.7 3.13 3.13 4.7 7.26 4.7 11.37 0 4.12-1.57 8.24-4.7 11.38l-.69.67 6.38 6.39 17.34-17.35 6.98 6.99-17.34 17.34 9.04 9.05 17.35-17.35 6.98 6.98-17.34 17.35 8.51 8.51 17.34-17.34 6.99 6.98-17.35 17.34 8.51 8.52 17.35-17.35 6.98 6.98-17.35 17.35 9.7 9.7 25.12-25.12zm44.97-117.05-21.87-4.03c-.73-.12-1.86-.85-3.38-2.21l-.23.23 15.74 15.74-11.66 11.66-36.44-36.44 10.96-10.96 21.87 4.02c.73.12 1.86.86 3.38 2.22l.23-.23-15.74-15.75 11.66-11.66 36.44 36.44-10.96 10.97zm143.93-144.1-5.03-7.09c2.82-1.69 5.12-3.43 6.93-5.23 1.79-1.8 3.17-3.32 4.12-4.57l-1.83-1.84-3.6 3.02c-3.26 2.71-6.02 4.05-8.3 4-2.28-.05-4.55-1.21-6.83-3.49-3.13-3.13-4.61-5.97-4.42-8.5.18-2.54 1.9-5.43 5.16-8.68 3.25-3.26 6.49-5.89 9.73-7.9l4.95 6.79c-2.64 1.91-4.65 3.55-6.02 4.92-1.37 1.37-2.47 2.6-3.3 3.68l1.8 1.79 2.9-2.38c3.52-2.89 6.5-4.34 8.94-4.36 2.43-.01 4.73 1.07 6.88 3.22 1.55 1.54 2.64 3.05 3.29 4.53.65 1.48.96 2.79.94 3.91-.03 1.13-.42 2.37-1.18 3.71-.76 1.35-1.5 2.45-2.24 3.31-.74.86-1.76 1.94-3.08 3.26-3.19 3.19-6.45 5.82-9.81 7.9zm22.02-22.01-5.03-7.09c2.81-1.69 5.12-3.43 6.92-5.24 1.8-1.79 3.18-3.32 4.13-4.57l-1.84-1.83-3.6 3.01c-3.25 2.72-6.02 4.05-8.29 4-2.28-.05-4.56-1.21-6.84-3.49-3.13-3.13-4.6-5.96-4.42-8.5.18-2.53 1.9-5.43 5.16-8.68 3.26-3.26 6.5-5.89 9.73-7.9l4.96 6.8c-2.64 1.91-4.65 3.55-6.02 4.91-1.37 1.38-2.48 2.6-3.31 3.68l1.8 1.8 2.9-2.39c3.53-2.89 6.51-4.34 8.95-4.35 2.43-.01 4.73 1.06 6.88 3.21 1.54 1.55 2.64 3.05 3.29 4.54.65 1.48.96 2.78.93 3.91-.02 1.12-.41 2.36-1.17 3.71-.76 1.34-1.51 2.45-2.24 3.3-.74.86-1.77 1.95-3.09 3.27-3.18 3.18-6.45 5.81-9.8 7.9zm23.33-22.53-22.94-22.95 10.28-10.28c4.13-4.15 7.86-6.1 11.16-5.88 3.3.22 7.02 2.39 11.14 6.51 4.13 4.13 6.3 7.85 6.52 11.15.23 3.31-1.73 7.03-5.87 11.16l-10.29 10.29zm-6.68-27.47-3.04 3.05 11.2 11.19 3.04-3.04c1.01-1 1.62-1.85 1.84-2.53.22-.69-.08-1.45-.92-2.28l-7.31-7.31c-.83-.83-1.59-1.14-2.27-.92-.69.22-1.53.84-2.54 1.84zM192.34 284.84l12.3-12.3 27.4 45.48-17.02 17.03-45.48-27.41 12.3-12.3 28.11 18.19.52-.52-18.13-28.17zm63.26 9.63-12.19 12.18L209.19 268l15.21-15.22 23.09 13.99.41-.41-13.99-23.08 15.21-15.22 38.66 34.22-12.19 12.19-18.36-16.97-.41.41 13.24 22.1-8.93 8.92-22.15-13.18-.35.35 16.97 18.37zm38.88-58.71 2.04 2.04c1.28-1.05 2.51-2.16 3.68-3.33 3.61-3.61 6.68-7.85 9.21-12.71l9.97 7.18c-3.19 5.51-6.92 10.41-11.2 14.69-5.44 5.44-10.65 8.1-15.62 7.99-4.98-.12-10.07-2.78-15.28-7.99-5.21-5.21-7.87-10.3-7.99-15.28-.11-4.97 2.54-10.17 7.96-15.59 5.42-5.43 9.91-8.43 13.44-9.01 3.54-.59 7.33 1.15 11.37 5.19 3.42 3.42 4.64 7.11 3.67 11.08-.97 3.96-4.72 9.21-11.25 15.74zm-9.15-9.16 2.39 2.39 2.39-2.39c1.4-1.4 2.27-2.56 2.62-3.49.35-.93 0-1.93-1.05-2.98l-2.39-2.39-2.39 2.39c-1.4 1.4-2.27 2.57-2.62 3.5-.35.93 0 1.93 1.05 2.97zM92.99 330.99 353 70.98a3.199 3.199 0 0 1 4.51 0l85.29 85.28a3.199 3.199 0 0 1 0 4.51L182.78 420.78a3.18 3.18 0 0 1-4.51 0L92.99 335.5a3.199 3.199 0 0 1 0-4.51zM68.5 332c-4.12 0-8.23 1.56-11.36 4.69-3.13 3.14-4.7 7.25-4.7 11.36 0 4.11 1.57 8.22 4.7 11.35 3.14 3.14 7.25 4.71 11.36 4.71 4.11 0 8.22-1.57 11.35-4.7 3.13-3.14 4.7-7.25 4.7-11.36 0-4.1-1.57-8.22-4.7-11.35A16.04 16.04 0 0 0 68.5 332z"/></svg>
            </button>
            <button class="button-nvme" id="nvme-2" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 512.12"><path d="M370.35 0c1.02 0 2.05.21 3.03.61.89.37 1.72.89 2.44 1.57 4.51 3.18 26.4 25.72 40.56 40.28 4.72 4.87 8.55 8.81 10.87 11.13l1.75 1.74-4.8 4.8c-1.49 1.5-2.57 3.3-3.26 5.25-.75 2.16-1.05 4.52-.93 6.92.13 2.57.73 5.17 1.76 7.56 1 2.3 2.4 4.43 4.17 6.2 1.78 1.77 3.91 3.18 6.2 4.17 2.39 1.03 4.99 1.64 7.56 1.76 2.39.12 4.76-.18 6.91-.93 1.96-.69 3.76-1.76 5.25-3.25l4.8-4.8 52.99 52.98c.75.75 1.33 1.64 1.73 2.61.41.99.62 2.04.62 3.06s-.21 2.06-.62 3.05c-.4.97-.98 1.87-1.73 2.61L169.33 487.64c-.77.76-1.66 1.34-2.6 1.73-.99.41-2.04.62-3.06.62s-2.06-.21-3.06-.62c-.95-.4-1.84-.97-2.6-1.73l-4.77-4.77-27.22 27.22a6.905 6.905 0 0 1-4.87 2.03c-1.76 0-3.53-.68-4.88-2.02L40.6 434.42a4.943 4.943 0 0 1 0-6.96l4.18-4.2c1.2-1.2 1.8-2.79 1.8-4.39 0-1.59-.6-3.19-1.8-4.39a6.224 6.224 0 0 0-4.39-1.8c-1.61 0-3.21.6-4.41 1.8l-4.16 4.18a4.931 4.931 0 0 1-6.98 0L1.76 395.59a6.037 6.037 0 0 1 0-8.52l27.84-27.84-5.24-5.24a7.997 7.997 0 0 1-1.73-2.6c-.41-.99-.62-2.04-.62-3.06 0-1.01.21-2.05.62-3.04.39-.94.96-1.82 1.72-2.6L364.68 2.35c.76-.76 1.65-1.34 2.59-1.73a8.22 8.22 0 0 1 3.08-.62zM63.68 343.24a6.79 6.79 0 0 1 9.63 0 6.808 6.808 0 0 1 0 9.63 6.808 6.808 0 0 1-9.63 0 6.808 6.808 0 0 1 0-9.63zm82.58 132.65L36.58 366.21l-25.11 25.12 5.91 5.91 17.34-17.35 6.98 6.99-17.34 17.34 3.98 3.98.67-.68c3.16-3.15 7.27-4.72 11.38-4.72 4.11 0 8.24 1.57 11.37 4.7 3.13 3.13 4.7 7.26 4.7 11.37 0 4.12-1.57 8.24-4.7 11.38l-.69.67 6.38 6.39 17.34-17.35 6.98 6.99-17.34 17.34 9.04 9.05 17.35-17.35 6.98 6.98-17.34 17.35 8.51 8.51 17.34-17.34 6.99 6.98-17.35 17.34 8.51 8.52 17.35-17.35 6.98 6.98-17.35 17.35 9.7 9.7 25.12-25.12zm44.97-117.05-21.87-4.03c-.73-.12-1.86-.85-3.38-2.21l-.23.23 15.74 15.74-11.66 11.66-36.44-36.44 10.96-10.96 21.87 4.02c.73.12 1.86.86 3.38 2.22l.23-.23-15.74-15.75 11.66-11.66 36.44 36.44-10.96 10.97zm143.93-144.1-5.03-7.09c2.82-1.69 5.12-3.43 6.93-5.23 1.79-1.8 3.17-3.32 4.12-4.57l-1.83-1.84-3.6 3.02c-3.26 2.71-6.02 4.05-8.3 4-2.28-.05-4.55-1.21-6.83-3.49-3.13-3.13-4.61-5.97-4.42-8.5.18-2.54 1.9-5.43 5.16-8.68 3.25-3.26 6.49-5.89 9.73-7.9l4.95 6.79c-2.64 1.91-4.65 3.55-6.02 4.92-1.37 1.37-2.47 2.6-3.3 3.68l1.8 1.79 2.9-2.38c3.52-2.89 6.5-4.34 8.94-4.36 2.43-.01 4.73 1.07 6.88 3.22 1.55 1.54 2.64 3.05 3.29 4.53.65 1.48.96 2.79.94 3.91-.03 1.13-.42 2.37-1.18 3.71-.76 1.35-1.5 2.45-2.24 3.31-.74.86-1.76 1.94-3.08 3.26-3.19 3.19-6.45 5.82-9.81 7.9zm22.02-22.01-5.03-7.09c2.81-1.69 5.12-3.43 6.92-5.24 1.8-1.79 3.18-3.32 4.13-4.57l-1.84-1.83-3.6 3.01c-3.25 2.72-6.02 4.05-8.29 4-2.28-.05-4.56-1.21-6.84-3.49-3.13-3.13-4.6-5.96-4.42-8.5.18-2.53 1.9-5.43 5.16-8.68 3.26-3.26 6.5-5.89 9.73-7.9l4.96 6.8c-2.64 1.91-4.65 3.55-6.02 4.91-1.37 1.38-2.48 2.6-3.31 3.68l1.8 1.8 2.9-2.39c3.53-2.89 6.51-4.34 8.95-4.35 2.43-.01 4.73 1.06 6.88 3.21 1.54 1.55 2.64 3.05 3.29 4.54.65 1.48.96 2.78.93 3.91-.02 1.12-.41 2.36-1.17 3.71-.76 1.34-1.51 2.45-2.24 3.3-.74.86-1.77 1.95-3.09 3.27-3.18 3.18-6.45 5.81-9.8 7.9zm23.33-22.53-22.94-22.95 10.28-10.28c4.13-4.15 7.86-6.1 11.16-5.88 3.3.22 7.02 2.39 11.14 6.51 4.13 4.13 6.3 7.85 6.52 11.15.23 3.31-1.73 7.03-5.87 11.16l-10.29 10.29zm-6.68-27.47-3.04 3.05 11.2 11.19 3.04-3.04c1.01-1 1.62-1.85 1.84-2.53.22-.69-.08-1.45-.92-2.28l-7.31-7.31c-.83-.83-1.59-1.14-2.27-.92-.69.22-1.53.84-2.54 1.84zM192.34 284.84l12.3-12.3 27.4 45.48-17.02 17.03-45.48-27.41 12.3-12.3 28.11 18.19.52-.52-18.13-28.17zm63.26 9.63-12.19 12.18L209.19 268l15.21-15.22 23.09 13.99.41-.41-13.99-23.08 15.21-15.22 38.66 34.22-12.19 12.19-18.36-16.97-.41.41 13.24 22.1-8.93 8.92-22.15-13.18-.35.35 16.97 18.37zm38.88-58.71 2.04 2.04c1.28-1.05 2.51-2.16 3.68-3.33 3.61-3.61 6.68-7.85 9.21-12.71l9.97 7.18c-3.19 5.51-6.92 10.41-11.2 14.69-5.44 5.44-10.65 8.1-15.62 7.99-4.98-.12-10.07-2.78-15.28-7.99-5.21-5.21-7.87-10.3-7.99-15.28-.11-4.97 2.54-10.17 7.96-15.59 5.42-5.43 9.91-8.43 13.44-9.01 3.54-.59 7.33 1.15 11.37 5.19 3.42 3.42 4.64 7.11 3.67 11.08-.97 3.96-4.72 9.21-11.25 15.74zm-9.15-9.16 2.39 2.39 2.39-2.39c1.4-1.4 2.27-2.56 2.62-3.49.35-.93 0-1.93-1.05-2.98l-2.39-2.39-2.39 2.39c-1.4 1.4-2.27 2.57-2.62 3.5-.35.93 0 1.93 1.05 2.97zM92.99 330.99 353 70.98a3.199 3.199 0 0 1 4.51 0l85.29 85.28a3.199 3.199 0 0 1 0 4.51L182.78 420.78a3.18 3.18 0 0 1-4.51 0L92.99 335.5a3.199 3.199 0 0 1 0-4.51zM68.5 332c-4.12 0-8.23 1.56-11.36 4.69-3.13 3.14-4.7 7.25-4.7 11.36 0 4.11 1.57 8.22 4.7 11.35 3.14 3.14 7.25 4.71 11.36 4.71 4.11 0 8.22-1.57 11.35-4.7 3.13-3.14 4.7-7.25 4.7-11.36 0-4.1-1.57-8.22-4.7-11.35A16.04 16.04 0 0 0 68.5 332z"/></svg>
            </button>
            <button class="button-nvme" id="nvme-3" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 512.12"><path d="M370.35 0c1.02 0 2.05.21 3.03.61.89.37 1.72.89 2.44 1.57 4.51 3.18 26.4 25.72 40.56 40.28 4.72 4.87 8.55 8.81 10.87 11.13l1.75 1.74-4.8 4.8c-1.49 1.5-2.57 3.3-3.26 5.25-.75 2.16-1.05 4.52-.93 6.92.13 2.57.73 5.17 1.76 7.56 1 2.3 2.4 4.43 4.17 6.2 1.78 1.77 3.91 3.18 6.2 4.17 2.39 1.03 4.99 1.64 7.56 1.76 2.39.12 4.76-.18 6.91-.93 1.96-.69 3.76-1.76 5.25-3.25l4.8-4.8 52.99 52.98c.75.75 1.33 1.64 1.73 2.61.41.99.62 2.04.62 3.06s-.21 2.06-.62 3.05c-.4.97-.98 1.87-1.73 2.61L169.33 487.64c-.77.76-1.66 1.34-2.6 1.73-.99.41-2.04.62-3.06.62s-2.06-.21-3.06-.62c-.95-.4-1.84-.97-2.6-1.73l-4.77-4.77-27.22 27.22a6.905 6.905 0 0 1-4.87 2.03c-1.76 0-3.53-.68-4.88-2.02L40.6 434.42a4.943 4.943 0 0 1 0-6.96l4.18-4.2c1.2-1.2 1.8-2.79 1.8-4.39 0-1.59-.6-3.19-1.8-4.39a6.224 6.224 0 0 0-4.39-1.8c-1.61 0-3.21.6-4.41 1.8l-4.16 4.18a4.931 4.931 0 0 1-6.98 0L1.76 395.59a6.037 6.037 0 0 1 0-8.52l27.84-27.84-5.24-5.24a7.997 7.997 0 0 1-1.73-2.6c-.41-.99-.62-2.04-.62-3.06 0-1.01.21-2.05.62-3.04.39-.94.96-1.82 1.72-2.6L364.68 2.35c.76-.76 1.65-1.34 2.59-1.73a8.22 8.22 0 0 1 3.08-.62zM63.68 343.24a6.79 6.79 0 0 1 9.63 0 6.808 6.808 0 0 1 0 9.63 6.808 6.808 0 0 1-9.63 0 6.808 6.808 0 0 1 0-9.63zm82.58 132.65L36.58 366.21l-25.11 25.12 5.91 5.91 17.34-17.35 6.98 6.99-17.34 17.34 3.98 3.98.67-.68c3.16-3.15 7.27-4.72 11.38-4.72 4.11 0 8.24 1.57 11.37 4.7 3.13 3.13 4.7 7.26 4.7 11.37 0 4.12-1.57 8.24-4.7 11.38l-.69.67 6.38 6.39 17.34-17.35 6.98 6.99-17.34 17.34 9.04 9.05 17.35-17.35 6.98 6.98-17.34 17.35 8.51 8.51 17.34-17.34 6.99 6.98-17.35 17.34 8.51 8.52 17.35-17.35 6.98 6.98-17.35 17.35 9.7 9.7 25.12-25.12zm44.97-117.05-21.87-4.03c-.73-.12-1.86-.85-3.38-2.21l-.23.23 15.74 15.74-11.66 11.66-36.44-36.44 10.96-10.96 21.87 4.02c.73.12 1.86.86 3.38 2.22l.23-.23-15.74-15.75 11.66-11.66 36.44 36.44-10.96 10.97zm143.93-144.1-5.03-7.09c2.82-1.69 5.12-3.43 6.93-5.23 1.79-1.8 3.17-3.32 4.12-4.57l-1.83-1.84-3.6 3.02c-3.26 2.71-6.02 4.05-8.3 4-2.28-.05-4.55-1.21-6.83-3.49-3.13-3.13-4.61-5.97-4.42-8.5.18-2.54 1.9-5.43 5.16-8.68 3.25-3.26 6.49-5.89 9.73-7.9l4.95 6.79c-2.64 1.91-4.65 3.55-6.02 4.92-1.37 1.37-2.47 2.6-3.3 3.68l1.8 1.79 2.9-2.38c3.52-2.89 6.5-4.34 8.94-4.36 2.43-.01 4.73 1.07 6.88 3.22 1.55 1.54 2.64 3.05 3.29 4.53.65 1.48.96 2.79.94 3.91-.03 1.13-.42 2.37-1.18 3.71-.76 1.35-1.5 2.45-2.24 3.31-.74.86-1.76 1.94-3.08 3.26-3.19 3.19-6.45 5.82-9.81 7.9zm22.02-22.01-5.03-7.09c2.81-1.69 5.12-3.43 6.92-5.24 1.8-1.79 3.18-3.32 4.13-4.57l-1.84-1.83-3.6 3.01c-3.25 2.72-6.02 4.05-8.29 4-2.28-.05-4.56-1.21-6.84-3.49-3.13-3.13-4.6-5.96-4.42-8.5.18-2.53 1.9-5.43 5.16-8.68 3.26-3.26 6.5-5.89 9.73-7.9l4.96 6.8c-2.64 1.91-4.65 3.55-6.02 4.91-1.37 1.38-2.48 2.6-3.31 3.68l1.8 1.8 2.9-2.39c3.53-2.89 6.51-4.34 8.95-4.35 2.43-.01 4.73 1.06 6.88 3.21 1.54 1.55 2.64 3.05 3.29 4.54.65 1.48.96 2.78.93 3.91-.02 1.12-.41 2.36-1.17 3.71-.76 1.34-1.51 2.45-2.24 3.3-.74.86-1.77 1.95-3.09 3.27-3.18 3.18-6.45 5.81-9.8 7.9zm23.33-22.53-22.94-22.95 10.28-10.28c4.13-4.15 7.86-6.1 11.16-5.88 3.3.22 7.02 2.39 11.14 6.51 4.13 4.13 6.3 7.85 6.52 11.15.23 3.31-1.73 7.03-5.87 11.16l-10.29 10.29zm-6.68-27.47-3.04 3.05 11.2 11.19 3.04-3.04c1.01-1 1.62-1.85 1.84-2.53.22-.69-.08-1.45-.92-2.28l-7.31-7.31c-.83-.83-1.59-1.14-2.27-.92-.69.22-1.53.84-2.54 1.84zM192.34 284.84l12.3-12.3 27.4 45.48-17.02 17.03-45.48-27.41 12.3-12.3 28.11 18.19.52-.52-18.13-28.17zm63.26 9.63-12.19 12.18L209.19 268l15.21-15.22 23.09 13.99.41-.41-13.99-23.08 15.21-15.22 38.66 34.22-12.19 12.19-18.36-16.97-.41.41 13.24 22.1-8.93 8.92-22.15-13.18-.35.35 16.97 18.37zm38.88-58.71 2.04 2.04c1.28-1.05 2.51-2.16 3.68-3.33 3.61-3.61 6.68-7.85 9.21-12.71l9.97 7.18c-3.19 5.51-6.92 10.41-11.2 14.69-5.44 5.44-10.65 8.1-15.62 7.99-4.98-.12-10.07-2.78-15.28-7.99-5.21-5.21-7.87-10.3-7.99-15.28-.11-4.97 2.54-10.17 7.96-15.59 5.42-5.43 9.91-8.43 13.44-9.01 3.54-.59 7.33 1.15 11.37 5.19 3.42 3.42 4.64 7.11 3.67 11.08-.97 3.96-4.72 9.21-11.25 15.74zm-9.15-9.16 2.39 2.39 2.39-2.39c1.4-1.4 2.27-2.56 2.62-3.49.35-.93 0-1.93-1.05-2.98l-2.39-2.39-2.39 2.39c-1.4 1.4-2.27 2.57-2.62 3.5-.35.93 0 1.93 1.05 2.97zM92.99 330.99 353 70.98a3.199 3.199 0 0 1 4.51 0l85.29 85.28a3.199 3.199 0 0 1 0 4.51L182.78 420.78a3.18 3.18 0 0 1-4.51 0L92.99 335.5a3.199 3.199 0 0 1 0-4.51zM68.5 332c-4.12 0-8.23 1.56-11.36 4.69-3.13 3.14-4.7 7.25-4.7 11.36 0 4.11 1.57 8.22 4.7 11.35 3.14 3.14 7.25 4.71 11.36 4.71 4.11 0 8.22-1.57 11.35-4.7 3.13-3.14 4.7-7.25 4.7-11.36 0-4.1-1.57-8.22-4.7-11.35A16.04 16.04 0 0 0 68.5 332z"/></svg>
            </button>
        </div> 
-->
        <div class="wrapper-format">
            <button id="format-all" type="button">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path d="M403.212,72.623L321.757,2.804C319.651,0.989,316.951,0,314.182,0H139.636c-19.247,0-34.909,15.663-34.909,34.909v116.364c0,6.435,5.213,11.636,11.636,11.636S128,157.708,128,151.273V34.909c0-6.423,5.225-11.636,11.636-11.636h170.24l78.196,67.014c4.887,4.201,12.218,3.642,16.396-1.268C408.657,84.143,408.099,76.8,403.212,72.623z"/><circle cx="81.455" cy="256" r="11.636"/><circle cx="128" cy="256" r="11.636"/><path d="M465.455,186.182h-58.182v-69.818c0-6.435-5.201-11.636-11.636-11.636h-69.818c-6.423,0-11.636-5.213-11.636-11.636V58.182c0-6.435-5.201-11.636-11.636-11.636c-6.435,0-11.636,5.201-11.636,11.636v34.909c0,19.247,15.663,34.909,34.909,34.909H384v69.818c0,6.435,5.201,11.636,11.636,11.636h69.818c6.423,0,11.636,5.213,11.636,11.636v69.818c0,6.423-5.213,11.636-11.636,11.636H46.545c-6.412,0-11.636-5.213-11.636-11.636v-69.818c0-6.423,5.225-11.636,11.636-11.636h302.545c6.435,0,11.636-5.201,11.636-11.636c0-6.435-5.201-11.636-11.636-11.636H46.545c-19.247,0-34.909,15.663-34.909,34.909v69.818c0,19.247,15.663,34.909,34.909,34.909h418.909c19.247,0,34.909-15.663,34.909-34.909v-69.818C500.364,201.844,484.701,186.182,465.455,186.182z"/><path d="M116.364,349.091c-6.423,0-11.636,5.201-11.636,11.636v139.636c0,6.435,5.213,11.636,11.636,11.636S128,506.799,128,500.364V360.727C128,354.292,122.787,349.091,116.364,349.091z"/><path d="M395.636,349.091c-6.435,0-11.636,5.201-11.636,11.636v139.636c0,6.435,5.201,11.636,11.636,11.636c6.435,0,11.636-5.201,11.636-11.636V360.727C407.273,354.292,402.071,349.091,395.636,349.091z"/><path d="M162.909,349.091c-6.423,0-11.636,5.201-11.636,11.636v139.636c0,6.435,5.213,11.636,11.636,11.636s11.636-5.201,11.636-11.636V360.727C174.545,354.292,169.332,349.091,162.909,349.091z"/><path d="M349.091,349.091c-6.435,0-11.636,5.201-11.636,11.636v93.091c0,6.435,5.201,11.636,11.636,11.636c6.435,0,11.636-5.201,11.636-11.636v-93.091C360.727,354.292,355.526,349.091,349.091,349.091z"/><path d="M256,349.091c-6.435,0-11.636,5.201-11.636,11.636v93.091c0,6.435,5.201,11.636,11.636,11.636c6.435,0,11.636-5.201,11.636-11.636v-93.091C267.636,354.292,262.435,349.091,256,349.091z"/><path d="M302.545,349.091c-6.435,0-11.636,5.201-11.636,11.636v116.364c0,6.435,5.201,11.636,11.636,11.636c6.435,0,11.636-5.201,11.636-11.636V360.727C314.182,354.292,308.98,349.091,302.545,349.091z"/><path d="M209.455,349.091c-6.435,0-11.636,5.201-11.636,11.636v116.364c0,6.435,5.201,11.636,11.636,11.636c6.435,0,11.636-5.201,11.636-11.636V360.727C221.091,354.292,215.889,349.091,209.455,349.091z"/><path d="M418.909,244.364h-93.091c-6.435,0-11.636,5.201-11.636,11.636c0,6.435,5.201,11.636,11.636,11.636h93.091c6.435,0,11.636-5.201,11.636-11.636C430.545,249.565,425.344,244.364,418.909,244.364z"/></svg>
            </button>
        </div>
    </body>
</html>