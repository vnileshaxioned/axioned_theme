<?php
  /* Template Name: Contact */

  get_header();

  if (have_rows('contact_page')) {
    while (have_rows('contact_page')) {
      the_row();

      switch (get_row_layout()) {
        case 'contact_us_section':
          get_template_part('template-parts/pages/contact/content', 'contact-us');
          break;
        case 'form_section':
          get_template_part('template-parts/pages/contact/content', 'form');
          break;
        case 'let_chat_section':
          get_template_part('template-parts/pages/contact/content', 'lets-chat');
          break;
        case 'hiring_section':
          get_template_part('template-parts/pages/contact/content', 'hiring');
          break;
      }
    }
  }
  get_footer();
?>