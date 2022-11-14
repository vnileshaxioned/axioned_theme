<!doctype html>

<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="en"> 

<head>
  <meta charset="utf-8">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> style="background-color: <?php echo get_theme_mod('theme_background_color', '#201547'); ?>">
  <!--container start-->
  <div class="container">
    <!--header section start-->
    <header  style="background-color: <?php echo get_theme_mod('theme_background_color', '#201547'); ?>">
      <div class="wrapper">
        <?php
          $custom_logo = get_theme_mod( 'custom_logo' );
          $logo = wp_get_attachment_image_src( $custom_logo, 'full' );
          $blog_name = get_bloginfo('name');
          $blog_url = get_bloginfo('url');
          $customizer_logo = get_theme_mod('custom_wesite_logo') ? get_theme_mod('custom_wesite_logo') : $logo[0];
        ?>
        <h1>
          <a href="<?php echo $blog_url; ?>" class="axioned-logo" title="<?php echo $blog_name; ?>">
            <figure>
              <img src="<?php echo $customizer_logo; ?>" class="axioned-logo-img" alt="<?php echo $blog_name; ?>">
            </figure>
          <?php echo $blog_name; ?></a>
        </h1>
        <?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'menu_class' => 'navbar',
          'container' => 'nav',
          'container_class' => 'menu',
          'items_wrap' => '<ul class="%2$s">%3$s</ul>',
        ) ); ?>
      </div>
    </header>
    <!--header section start-->

    <!--main section start-->
    <main>