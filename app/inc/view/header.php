<!DOCTYPE html>
<html lang="pl-PL" class="preload">
  <head>
    <meta
      http-equiv="Content-Security-Policy"
      content="style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;"
    />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Dawid Michura" />
    <meta
      name="description"
      content="Hotel Marvel w Bułgarii oferuje luksusowe pokoje i doskonałe warunki do wypoczynku nad morzem. Nasz hotel położony jest w malowniczej miejscowości nadmorskiej, a goście mogą korzystać z basenu, sauny oraz wielu atrakcji w okolicy."
    />
    <meta
      name="keywords"
      content="Hotel Marvel w Bułgarii, Noclegi w Bułgarii - Marvel Hotel, Pokoje hotelowe Marvel w Bułgarii, Wakacje w Bułgarii - Marvel Hotel, Hotele w Bułgarii - Marvel, Bułgarskie wakacje - Marvel Hotel, Hotel Marvel - Bułgaria, Bułgarski hotel Marvel, Marvel Hotel - Bułgarskie wakacje, Bułgarski hotel nad morzem - Marvel"
    />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
    />
    <title><?= isset($page['title']) ? $page['title'] : 'Hotel Marvel' ?></title>
    <link
      href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="/css/style.css" />
  </head>
  <body>
    <div id="app">
      <!-- Hero -->

      <header>
        <div class="header__bg">
          <video
            class="header__video"
            autoplay="autoplay"
            loop="loop"
            muted="muted"
            playsinline="playsinline"
            src="./assets/video/background/7.mp4"
          ></video>
        </div>
        <div class="header__nav">
          <nav>
            <a href="/"><h1 class="nav__logo">Marvel Hotel</h1></a>
            <div class="nav__hamburger">
              <span></span><span></span><span></span>
            </div>
            <ul class="nav__menu">
              <li class="nav__menu-item active">
                <a href="" data-ls="homepage"></a>
              </li>
              <li class="nav__menu-item">
                <a href="" data-ls="aboutus"></a>
              </li>
              <li class="nav__menu-item">
                <a href="" data-ls="rooms"></a>
              </li>
              <li class="nav__menu-item">
                <a href="" data-ls="gallery"></a>
              </li>
              <li class="nav__menu-item">
                <a href="" data-ls="contact"></a>
              </li>

              <li id="nav__menu-flags"></li>
            </ul>
          </nav>

          <div class="header__content">
            <div class="typing__wrapper">
              <h2 class="typing__text" id="header-logo"></h2>
              <div class="typing__bar"></div>
            </div>
          </div>
        </div>
      </header>

      <div id="cookie-modal" class="">
        <p class="cookie-modal__content" data-ls="cookie-message"></p>
        <button type="button" id="cookie-modal__button" data-ls="btn-accept">
          Akceptuj
        </button>
      </div>
