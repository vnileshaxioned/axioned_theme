<?php
  $background_image = get_sub_field('background_image');
  $title = get_sub_field('section_title');
  $contents = get_sub_field('section_content');
  $image_url = $background_image['url'] ? $background_image['url'] : null;
  $image_alt = $background_image['alt'] ? $background_image['alt'] : $title;

  if ($image_url || $title || $contents) {
?>
	<section class="global-team">
    <div class="wrapper inner-wrapper">
      <?php if ($image_url) { ?>
        <figure class="section-background-image">
          <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
        </figure>
      <?php }
        if ($title || $contents) {
        ?>
        <div class="global-content">
          <?php
            echo $title ? '<h2 class="main-heading">'. $title .'</h2>' : null;

            if ($contents) {
            ?>
            <ul class="global-inner-content">
              <?php
                foreach ($contents as $content) {
                  $heading = $content['content_title'];
                  $all_list = $content['content_list'];
                  $image = $content['content_image']['url'] ? $content['content_image']['url'] : null;
                  $image_alt = $content['content_image']['alt'] ? $content['content_image']['alt'] : $heading;
                  
                  if ($heading || $all_list || $image) {
                ?>
                <li class="global-list">
                  <?php if ($image) { ?>
                    <figure>
                      <img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
                    </figure>
                  <?php }
                    echo $heading ? '<h3 class="global-list-heading">'. $heading .'</h3>' : null;

                    if ($all_list) {
                    ?>
                    <ul class="global-list-content">
                      <?php
                        foreach ($all_list as $lists) {
                          $single_list = $lists['list'];
                        ?>
                        <li class="global-inner-list">
                          <span><?php echo $single_list; ?></span>
                        </li>
                      <?php } ?>
                    </ul>
                  <?php } ?>
                </li>
              <?php }
                } ?>
            </ul>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
	</section>
<?php } ?>