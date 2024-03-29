<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/favico/favicon.ico">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/spinner.css" type="text/css">
    <title>Formatierungs Champ</title>
</head>
    <body>
        <div class="submit-wrapper">
            <div class="submit-erase">
                <p>
                Ein Secure Erase kann bei HDDs mehrere Stunden dauern.</br>
                Der oder die Datenträger dürfen während des gesamten Vorgangs nicht entfernt werden.</br>
                Ein Wiederherstellen der Daten ist nicht mehr möglich.</br>
                Soll der Secure Erase gestartet werden?
                </p>
                <div class="submit-field">
                    <button type="button" name="submit" id="submit">JA</button>
                    <button type="button" name="cancel" id="cancel">NEIN</button>
                </div>
            </div>
        </div>
        <div class="drives-load visible">
            <div class="spinner"><div></div><div></div><div></div><div></div></div>
            <span id="text-load"></span>
        </div>
        <div class="wrapper-drives"></div>
        <div class="wrapper-format">
            <button id="format-all" type="button">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path d="M403.212,72.623L321.757,2.804C319.651,0.989,316.951,0,314.182,0H139.636c-19.247,0-34.909,15.663-34.909,34.909v116.364c0,6.435,5.213,11.636,11.636,11.636S128,157.708,128,151.273V34.909c0-6.423,5.225-11.636,11.636-11.636h170.24l78.196,67.014c4.887,4.201,12.218,3.642,16.396-1.268C408.657,84.143,408.099,76.8,403.212,72.623z"/><circle cx="81.455" cy="256" r="11.636"/><circle cx="128" cy="256" r="11.636"/><path d="M465.455,186.182h-58.182v-69.818c0-6.435-5.201-11.636-11.636-11.636h-69.818c-6.423,0-11.636-5.213-11.636-11.636V58.182c0-6.435-5.201-11.636-11.636-11.636c-6.435,0-11.636,5.201-11.636,11.636v34.909c0,19.247,15.663,34.909,34.909,34.909H384v69.818c0,6.435,5.201,11.636,11.636,11.636h69.818c6.423,0,11.636,5.213,11.636,11.636v69.818c0,6.423-5.213,11.636-11.636,11.636H46.545c-6.412,0-11.636-5.213-11.636-11.636v-69.818c0-6.423,5.225-11.636,11.636-11.636h302.545c6.435,0,11.636-5.201,11.636-11.636c0-6.435-5.201-11.636-11.636-11.636H46.545c-19.247,0-34.909,15.663-34.909,34.909v69.818c0,19.247,15.663,34.909,34.909,34.909h418.909c19.247,0,34.909-15.663,34.909-34.909v-69.818C500.364,201.844,484.701,186.182,465.455,186.182z"/><path d="M116.364,349.091c-6.423,0-11.636,5.201-11.636,11.636v139.636c0,6.435,5.213,11.636,11.636,11.636S128,506.799,128,500.364V360.727C128,354.292,122.787,349.091,116.364,349.091z"/><path d="M395.636,349.091c-6.435,0-11.636,5.201-11.636,11.636v139.636c0,6.435,5.201,11.636,11.636,11.636c6.435,0,11.636-5.201,11.636-11.636V360.727C407.273,354.292,402.071,349.091,395.636,349.091z"/><path d="M162.909,349.091c-6.423,0-11.636,5.201-11.636,11.636v139.636c0,6.435,5.213,11.636,11.636,11.636s11.636-5.201,11.636-11.636V360.727C174.545,354.292,169.332,349.091,162.909,349.091z"/><path d="M349.091,349.091c-6.435,0-11.636,5.201-11.636,11.636v93.091c0,6.435,5.201,11.636,11.636,11.636c6.435,0,11.636-5.201,11.636-11.636v-93.091C360.727,354.292,355.526,349.091,349.091,349.091z"/><path d="M256,349.091c-6.435,0-11.636,5.201-11.636,11.636v93.091c0,6.435,5.201,11.636,11.636,11.636c6.435,0,11.636-5.201,11.636-11.636v-93.091C267.636,354.292,262.435,349.091,256,349.091z"/><path d="M302.545,349.091c-6.435,0-11.636,5.201-11.636,11.636v116.364c0,6.435,5.201,11.636,11.636,11.636c6.435,0,11.636-5.201,11.636-11.636V360.727C314.182,354.292,308.98,349.091,302.545,349.091z"/><path d="M209.455,349.091c-6.435,0-11.636,5.201-11.636,11.636v116.364c0,6.435,5.201,11.636,11.636,11.636c6.435,0,11.636-5.201,11.636-11.636V360.727C221.091,354.292,215.889,349.091,209.455,349.091z"/><path d="M418.909,244.364h-93.091c-6.435,0-11.636,5.201-11.636,11.636c0,6.435,5.201,11.636,11.636,11.636h93.091c6.435,0,11.636-5.201,11.636-11.636C430.545,249.565,425.344,244.364,418.909,244.364z"/></svg>
            </button>
            <span id="text-notification"></span>
        </div>
    </body>
    <script type="text/javascript" src="js/injectSvg.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</html>
