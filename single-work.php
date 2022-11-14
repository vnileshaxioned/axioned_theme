<?php
  /* This is used to display single post */

  get_header();

  $post_type = get_post_type();
  $title = get_the_title();
  $excerpt = get_the_excerpt();
  $description = get_the_content();
  $permalink = get_the_permalink();
  $heading = get_field('heading');
  $image = get_field('image')['url'] ? get_field('image')['url'] : null;
  $image_alt = get_field('image')['alt'] ? get_field('image')['alt'] : $title;
  $work_content = get_field('work_detail');
  $content_title = $work_content['work_title'];
?>
  <section class="work-post">
    <div class="wrapper inner-wrapper">
      <div class="main-content">
        <div class="main-left-content">
          <?php
            echo $post_type ? '<h2 class="main-heading">'. $post_type .'</h2>' : null;
            echo $title ? '<h2 class="main-title">'. $title .'</h2>' : null;
            echo $excerpt ? '<p class="short-description">'. $excerpt .'</p>' : null;
          ?>
        </div>
        <figure class="main-content-image">
          <img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>" />
        </figure>
      </div>
      <div class="client-content">
        <?php
          echo $heading ? '<h3 class="main-heading">'. $heading .'</h3>' : null;
          echo $description ? '<p class="main-paragraph">'. $description .'</p>' : null;
        ?>
      </div>
      <?php if ($work_content) { ?>
        <ul class="work-outter-box">
          <?php
            foreach ($work_content as $content) {
              $heading = $content['work_title'];
              $paragraph = $content['work_paragraph'];
              $image = $content['work_image']['url'] ? $content['work_image']['url'] : null;
              $image_alt = $content['work_image']['alt'] ? $content['work_image']['alt'] : $heading;
              $image_side = $content['image_side'] ? 'right' : null;

              if ($heading || $paragraph || $image) {
            ?>
            <li class="work-list <?php echo $image_side; ?>">
              <?php if ($image) { ?>
                <figure class="work-img">
                  <img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
                </figure>
              <?php }
                if ($heading || $paragraph) {
                ?>
                <div class="work-content">
                  <?php 
                    echo $heading ? '<h3 class="work-title">'. $heading .'</h3>' : null;
                    echo $paragraph ? '<p class="work-paragraph">'. $paragraph .'</p>' : null;
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
<?php get_footer(); ?>