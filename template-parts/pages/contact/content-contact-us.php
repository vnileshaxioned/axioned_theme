<?php
  $title = get_sub_field('section_title');
  $contents = get_sub_field('add_content');

  if ($title || $contents) {
  ?>
  <section class="contact-us">
    <div class="wrapper inner-wrapper">
      <?php
        echo $title ? '<h2 class="main-heading">'. $title .'</h2>' : null;

        if ($contents) {
        ?>
        <ul class="contact-outter-box">
          <?php
            foreach ($contents as $content) {
              $heading = $content['title'];
              $address = $content['address'];
              $contact_number = $content['contact_number'];
              $image = $content['image']['url'] ? $content['image']['url'] : null;
              $image_alt = $content['image']['alt'] ? $content['image']['alt'] : $heading;

              if ($heading || $address || $contact_number || $image) {
            ?>
            <li class="contact-list">
              <?php if ($image) { ?>
                <figure>
                  <img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
                </figure>
              <?php }
                if ($heading || $address || $contact_number) {
                ?>
                <div class="contact-content">
                  <?php
                    echo $heading ? '<h3 class="contact-head">'. $heading .'</h3>' : null;
                    echo $address ? '<p class="contact-address">'. $address .'</p>' : null;
                    echo $contact_number ? '<p class="tel-number"><a href="tel:'. $contact_number .'" title="'. $contact_number .'">T: '. $contact_number .'</a></p>' : null;
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