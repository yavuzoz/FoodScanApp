<?php require_once 'inc/init.php'; ?>

    <!doctype html>
    <html lang="en">
    <head>
        <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
        <link rel="manifest" href="favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Food Scan App</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <link href=
              "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css"
              rel='stylesheet'>
        <script src="https://unpkg.com/html5-qrcode"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src=
                "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
        </script>
    </head>
<body class="min-vh-100">
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <header>
        <div class="navbar navbar-light bg-light shadow-sm" style="background-color: #192440 !important">
            <div class="container">
                <a href="list.php" class="navbar-brand d-flex align-items-center link-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z"/>
                    </svg>
                    <strong class="ms-2">Food Scan App</strong>
                </a>
                <?php if ($_SESSION['username']) : ?>
                    <li class="nav-item text-nowrap d-flex align-items-center">
                        <a class="nav-link link-light" href="logout.php">Sign out</a>
                    </li>
                <?php endif; ?>
            </div>
        </div>
    </header>

<?php if ($_GET['msg_s']) : ?>
    <div class='alert alert-success'>
        <?= $_GET['msg_s'] == 1 ? 'SUCCESS!' : $_GET['msg_s'] ?>
    </div>
<?php endif; ?>
<?php if ($_GET['msg_f']) : ?>
    <div class='alert alert-danger'>
        <?= $_GET['msg_f'] == 1 ? 'AN ERROR OCCURED!' : $_GET['msg_f'] ?>
    </div>
<?php endif; ?>