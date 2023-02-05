<!DOCTYPE html>
<html lang="pl-PL">
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name='author' content="Dawid Michura"/>
    <meta name='description' content="Marvel Hotel"/>
    <meta name='keywords' content="Marvel Hotel, Hotel w Polsce"/>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
    />
    <title><?= isset($page['title']) ? $page['title'] : 'Hotel Marvel' ?></title>
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
    <link rel="stylesheet" href="/css/style.css"/>
  </head>
  <body>
    <div class="app">
      <header>
        <div class="header-hamburger__wrapper">
          <button type="button" class="header-hamburger">
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>
        <nav id="header-nav">
          <ul class="header-nav">
            <?php
            foreach ($page['nav'] as $value) {
                $active = '';
                if ( isset($page['path']) && strcmp($value[0], $page['path']) == 0 ) {
                  $active = 'active';
                }
                echo "<li class='$active'><a href='/{$value[0]}'>{$value[1]}</a></li>";
            }
            ?>
          </ul>
        </nav>
        <div class="header-logo__wrapper">
          <h1>Hotel Marvel</h1>
        </div>
      </header>

