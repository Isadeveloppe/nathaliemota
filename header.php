<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <header class="header">
    <nav class="navform">
      <a href="<?php echo home_url('/'); ?>">
        <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo1.png" alt="Logo">
      </a>

      <?php wp_nav_menu(array(
        'theme_location' => 'header',
        'container'      => 'menu-header-container',
        'container_id'   => 'header-menu',
        'menu_class'     => 'navbar',
      ));
      ?>
      <button class="modal_burger modal-open">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
      </button>
    </nav>
</header>

<main>

