<?php
  get_header();
  
  if (have_rows('home_page')) {
    while (have_rows('home_page')) {
      the_row();

      switch (get_row_layout()) {
        case 'banner_section':
          get_template_part('template-parts/pages/home/content', 'banner');
          break;
        case 'work_section':
          get_template_part('template-parts/pages/home/content', 'work');
          break;
        case 'client_testimonials':
          get_template_part('template-parts/pages/options/content', 'client-testimonial');
          break;
      }
    }
  }
  get_footer();
?>