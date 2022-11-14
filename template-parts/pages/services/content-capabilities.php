<?php
  $title = get_sub_field('section_title');
  $contents = get_sub_field('service_content');

  if ($contents || $title) {
  ?>
  <section class="capabilities">
    <div class="wrapper inner-wrapper">
      <?php
        echo $title ? '<h2 class="main-heading">'. $title .'</h2>' : null;

        if ($contents) {
        ?>
        <ul class="service-outter-box">
          <?php
            foreach ($contents as $content) {
              $heading = $content['content_title'];
              $paragraph = $content['content_paragraph'];
              $image = $content['content_image']['url'] ? $content['content_image']['url'] : null;
              $image_alt = $content['content_image']['alt'] ? $content['content_image']['alt'] : $heading;
              $image_side = $content['image_side'];

              if ($heading || $paragraph || $image) {
            ?>
            <li class="service-list <?php echo $image_side; ?>">
              <?php if ($image) { ?>
                <figure class="service-img">
                  <img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
                </figure>
              <?php }
                if ($heading || $paragraph) {
                ?>
                <div class="service-content">
                  <?php 
                    echo $heading ? '<h3 class="service-title">'. $heading .'</h3>' : null;
                    echo $paragraph ? '<p class="service-paragraph">'. $paragraph .'</p>' : null;
                  ?>
                </div>
              <?php } ?>
            </li>
          <?php }
            } ?>
        </ul>
      <?php } ?>
    </div>
  </section>
<?php } ?>