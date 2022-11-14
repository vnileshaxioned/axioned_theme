<?php
  /* Template Name: Works */

  get_header();

  if (have_rows('work_page')) {
    while (have_rows('work_page')) {
      the_row();

      switch (get_row_layout()) {
        case 'our_work':
          get_template_part('template-parts/pages/work/content', 'work');
          break;
        case 'work_slider':
          get_template_part('template-parts/pages/work/content', 'slider');
          break;
      }
    }
  }
  get_footer();
?>