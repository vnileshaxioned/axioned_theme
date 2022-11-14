<?php
  $title = get_sub_field('section_title');
  $contents = get_sub_field('section_content');

  if ($contents || $title) {
  ?>
  <section class="tools">
    <div class="wrapper inner-wrapper">
      <?php
        echo $title ? '<h2 class="main-heading">'. $title .'</h2>' : null;
        
        if ($contents) {
        ?>
        <ul class="tools-outter-box">
          <?php
            foreach ($contents as $content) {
              $tab_title = $content['tab_title'];

              if ($tab_title) {
            ?>
            <li class="tools-list">
              <a href="#FIXME" class="list-name" data-tab-name="<?php echo $tab_title; ?>" title="<?php echo $tab_title; ?>"><?php echo $tab_title; ?></a>
            </li>
          <?php }
            } ?>
        </ul>
        <ul class="tools-image-box">
          <?php
            foreach ($contents as $content) {
              $tab_title = $content['tab_title'];
              $tab_images = $content['tab_images'];

              if ($tab_title && $tab_images) {
                foreach ($tab_images as $tab_image) {
                $image = $tab_image['image']['url'] ? $tab_image['image']['url'] : null;
                $image_alt = $tab_image['image']['alt'] ? $tab_image['image']['alt'] : $tab_title;
            ?>
            <li class="tools-image-list" data-list-name="<?php echo $tab_title; ?>">
              <figure class="image-list">
                <a href="#FIXME" target="_blank" class="tab-images" title="<?php echo $image_alt; ?>">
                  <img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
                </a>
              </figure>
            </li>
          <?php }
              }
            } ?>
        </ul>
      <?php } ?>
    </div>
  </section>
<?php } ?>