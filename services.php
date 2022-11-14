<?php
/* Template Name: Services */

  get_header();

  if (have_rows('services_page')) {
    while (have_rows('services_page')) {
      the_row();

      switch (get_row_layout()) {
        case 'services_and_capabilities_section':
          get_template_part('template-parts/pages/services/content', 'capabilities');
          break;
        case 'team_axioned_section':
          get_template_part('template-parts/pages/services/content', 'team-axioned');
          break;
        case 'tools_and_technologies_section':
          get_template_part('template-parts/pages/services/content', 'technologies');
          break;
      }
    }
  }
  get_footer();
?>