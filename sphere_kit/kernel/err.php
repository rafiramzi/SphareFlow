<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SphereF | Error</title>
    <link rel="stylesheet" href="/app.css">
</head>
<body>
    <div class="fixed mt-0 text-white z-top w-full bd-blur">
        <div class="p-3 z-top justify-start">
            <p class="font-bold font-sm bg-red z-top"><span>Oupss, Error (<?php echo $error['errno']; ?>): <?php echo $error['errstr']; ?>,</span></p>
            <br>
            <p class="bg-taro-dark text-white">Error File: <span style="color:yellow;"><?php echo $errfile; ?></span></p>
            <p class="bg-taro-dark text-white">Error Line: <span style="color:yellow;"><?php echo $errline; ?></span></p>
        </div>
    </div>
</body>
</html>
