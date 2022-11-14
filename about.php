<?php
/* Template Name: About */

  get_header();

  if (have_rows('about_page')) {
    while (have_rows('about_page')) {
      the_row();
      
      switch (get_row_layout()) {
        case 'about_section':
          get_template_part('template-parts/pages/about/content', 'about');
          break;
        case 'remote_and_team_section':
          get_template_part('template-parts/pages/about/content', 'team');
          break;
        case 'client_testimonials':
          $args = array('background_image' => get_sub_field('background_image'));
          get_template_part('template-parts/pages/options/content', 'client-testimonial', $args);
          break;
      }
    }
  }
  get_footer();
?>