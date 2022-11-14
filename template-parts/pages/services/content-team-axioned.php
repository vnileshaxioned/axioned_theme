<?php
  $title = get_sub_field('section_title');
  $contents = get_sub_field('section_content');

  if ($contents || $title) {
  ?>
  <section class="team_axioned">
    <div class="wrapper inner-wrapper">
      <?php
        echo $title ? '<h2 class="main-heading">'. $title .'</h2>' : null;
        
        if ($contents) {
        ?>
        <ul class="team-outter-box">
          <?php
            foreach ($contents as $content) {
              $heading = $content['content_title'];
              $paragraph = $content['content_paragraph'];
              $content_lists = $content['content_list'];
              $image = $content['content_image']['url'] ? $content['content_image']['url'] : null;
              $image_alt = $content['content_image']['alt'] ? $content['content_image']['alt'] : $heading;

              if ($heading || $paragraph || $content_lists || $image) {
            ?>
            <li class="team-list">
              <?php if ($image) { ?>
                <figure class="team-img">
                  <img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
                </figure>
              <?php }
                if ($heading || $paragraph || $content_lists) {
                ?>
                <div class="team-content">
                  <?php 
                    echo $heading ? '<h4 class="team-title">'. $heading .'</h4>' : null;
                    echo $paragraph ? '<p class="team-paragraph">'. $paragraph .'</p>' : null;

                    if ($content_lists) {
                    ?>
                    <ul class="team-content-box">
                      <?php
                        foreach ($content_lists as $content_list) {
                          $list = $content_list['list'];
                        ?>
                        <li class="team-content-list">
                          <span><?php echo $list; ?></span>
                        </li>
                      <?php } ?>
                    </ul>
                  <?php } ?>
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