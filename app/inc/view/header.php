
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

    <script>
      class Redirect {
        timer = null;
        constructor(path, time) {
          this.timer = setInterval( () => {
            document.location.href = `${path}`;
          }, time )
        }
      }
    </script>

  </head>
  <body>
    <div id="app">
      <!-- Hero -->
      <div class="app__bg">
        <video
          class="app__video"
          autoplay="autoplay"
          loop="loop"
          muted="muted"
          playsinline="playsinline">
          <source src="./assets/video/background/7.mp4">
        </video>
      </div>
      <header>
        <div class="header__nav">
          <nav>
            <a href="/" aria-label=""><h1 class="nav__logo">Marvel Hotel</h1></a>
            <div class="nav__hamburger">
              <span></span><span></span><span></span>
            </div>

            <ul class="nav__menu">
              <?php foreach ($page['nav'] as $navItem ): ?>
              <?php
                // var_dump(isset($navItem[2]));
                if ( isset($navItem[2]) && isset($page['user']) ) {

                  // _log($navItem[2]);
                  // var_dump(in_array(($page['user']->getRole()), $navItem[2]));
                  if( !in_array(($page['user']->getRole()), $navItem[2]) )
                  {
                    continue;
                  }
                  

                }
                else
                {

                }

              ?>
              <?php 
                $classActive = ($navItem[0] === $page['path']) ? ' active' : "";
              ?>
              <li class="nav__menu-item<?=$classActive?>">
                <a href="<?= $navItem[0] ?>" data-ls="<?= $navItem[1] ?>"></a>
              </li>
              <?php endforeach; ?>
              <li id="nav__menu-flags"></li>
            </ul>
          </nav>
        </div>
      </header>


