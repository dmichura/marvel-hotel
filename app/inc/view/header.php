
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name='author' content="Dawid Michura"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= isset($page['title']) ? $page['title'] : 'Hotel Marvel' ?></title>
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
    <link rel="stylesheet" href="/css/style.css"/>
</head>
<body>
    <div class="app">
        <header>
            <div class="row">
                <div class="header-hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <nav class="nav">
                    <ul class="nav-menu">
                        <li class="nav-item"><a href="/">Home</a></li>
                        <li class="nav-item"><a href="/4">4</a></li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="header-logo__wrapper">
                    <img src="favicon.ico" alt="">
                </div>
            </div>

            <div class="row">
                <div class="header-accessibility">

                </div>
            </div>

        </header>
