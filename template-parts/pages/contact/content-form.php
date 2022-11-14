<?php
  $title = get_sub_field('title');
  $content = get_sub_field('content');

  if ($title && $content) {
  ?>
  <section class="contact-form">
    <div class="wrapper inner-wrapper">
      <?php
        echo $title ? '<h2 class="main-heading">'. $title .'</h2>' : null;
        echo $content ? $content : null;
      ?>
    </div>
  </section>
<?php } ?>