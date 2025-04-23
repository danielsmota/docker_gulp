<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />

  <!-- displays site properly based on user's device -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" type="text/css" href="<?php bloginfo("stylesheet_directory"); ?>/style.min.css?v=<?php echo date('i:s'); ?>" />
  <title>danielsmota.dev</title>

  <?php
  wp_head();
  global $post;
  $post_slug = $post->post_name;
  ?>
</head>

<body <?php body_class(); ?>>
  <header id="top">
    <div class="nav__top wrapper">
      <a id="nav__logo" class="nav__logo" href="<?php echo esc_url(home_url()); ?>">
        <img src="<?php bloginfo("stylesheet_directory"); ?>/img/logo.svg?v=<?php echo date('is'); ?>" alt="danielsmota" />
      </a>
      <nav class="nav__principal">
        <span id="nav__label" hidden>Navigation</span>
        <button id="btnOpen" class="nav__button nav__open" aria-expanded="false" aria-labelledby="nav__label">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
            <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
          </svg>
        </button>
        <div class="nav__menu" role="dialog" aria-labelledby="nav__label">
          <button id="btnClose" class="nav__button nav__close" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
              <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg>
          </button>
          <?php wp_nav_menu(array('theme_location' => 'principal')); ?>
          <button id="theme-switch">
            <img class="nav__darkmode" src="<?php bloginfo("stylesheet_directory"); ?>/img/darkmode.svg?v=<?php echo date('i:s'); ?>" alt="dark mode" />
          </button>
        </div>
      </nav>
    </div>
  </header>