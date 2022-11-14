<?php
  $show_section = get_sub_field('show_section');

  if ($show_section) {
    $background_image = $args['background_image'];
    $section_title = get_field('section_title', 'option');
    $contents = get_field('client_testimonial', 'option');
    $image_url = $background_image['url'] ? $background_image['url'] : null;
    $image_alt = $background_image['alt'] ? $background_image['alt'] : $section_title;

    if ($image_url || $section_title || $contents) {?>
    <section class="client-testimonials">
      <div class="wrapper inner-wrapper">
        <?php if ($image_url) { ?>
          <figure class="section-background-image">
            <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
          </figure>
        <?php }
          if ($section_title || $contents) { ?>
          <div class="client-content">
            <?php
              echo $section_title ? '<h2 class="main-heading">'. $section_title .'</h2>' : null;

              if ($contents) { ?>
              <ul class="client-outter-box">
                <?php 
                  foreach ($contents as $content) {
                    $title = $content['title'];
                    $description = $content['description'];
                    $image = $content['image']['url'] ? $content['image']['url'] : null;
                    $image_alt = $content['image']['alt'] ? $content['image']['alt'] : $title;

                    if ($title || $image || $description) { ?>
                    <li class="client-inner-box">
                      <?php if ($image) { ?>
                        <figure>
                          <img src="<?php echo $image; ?>" class="client-image" alt="<?php echo $image_alt; ?>">
                        </figure>
                      <?php }
                        if ($title || $description) { ?>
                        <div class="content">
                          <?php 
                            echo $title ? '<h4 class="client-heading">'. $title .'</h4>' : null;
                            echo $description ? '<p class="client-paragraph">'. $description .'</p>' : null;
                          ?>
                        </div>
                      <?php } ?>
                    </li>
                  <?php }
                    } ?>
                  <li class="client-slider-action">
                    <a href="#FIXME" class="client-slider-button previous-slide" title="Previous slide">Previous slide</a>
                  </li>
                  <li class="client-slider-action">
                    <a href="#FIXME" class="client-slider-button next-slide" title="Next slide">Next slide</a>
                  </li>
                </ul>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
      </section>
    <?php }
      } ?>