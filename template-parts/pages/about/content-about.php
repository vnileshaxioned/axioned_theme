<?php
  $background_image = get_sub_field('background_image');
  $title = get_sub_field('section_title');
  $paragraph = get_sub_field('paragraph');
  $image_url = $background_image['url'] ? $background_image['url'] : null;
  $image_alt = $background_image['alt'] ? $background_image['alt'] : $title;

  if ($image_url || $title || $paragraph) {
  ?>
  <section class="about">
    <div class="wrapper inner-wrapper">
      <?php if ($image_url) { ?>
        <figure class="section-background-image">
          <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
        </figure>
      <?php }
        if ($title || $paragraph) {
        ?>
        <div class="about-content">
          <?php
            echo $title ? '<h2 class="main-heading">'. $title .'</h2>' : null;
            echo $paragraph ? '<div class="wysiwyg-editor">'. $paragraph .'</div>' : null;
          ?>
        </div>
      <?php } ?>
    </div>
  </section>
<?php } ?>