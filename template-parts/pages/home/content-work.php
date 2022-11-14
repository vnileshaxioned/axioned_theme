<?php
  $works = get_sub_field('work_content');

  if ($works) {
  ?>
  <section class="work">
    <div class="wrapper inner-wrapper">
      <ul class="outter-box">
        <?php
          foreach ($works as $work) {
            $post_id = $work->ID;
            $title = $work->post_title;
            $excerpt = $work->post_excerpt;
            $image = get_field('image', $post_id);
            $image_url = $image['url'] ? $image['url'] : null;
            $image_alt = $image['alt'] ? $image['alt'] : $title;

            if ($title || $excerpt || $image_url) {
          ?>
          <li class="inner-box">
            <?php if ($image_url) { ?>
              <a href="#FIXME" class="work-link">
                <figure>
                  <img src="<?php echo $image_url; ?>" class="work-image" alt="<?php echo $image_alt; ?>">
                </figure>
              </a>
            <?php }
              if ($title || $excerpt) {
              ?>
              <div class="content">
                <?php
                  echo $title ? '<h3 class="work-heading">'. $title .'</h3>' : null;
                  echo $excerpt ? '<p class="work-paragraph">'. $excerpt .'</p>' : null;
                ?>
              </div>
            <?php } ?>
          </li>
        <?php }
          } ?>
      </ul>
    </div>
  </section>
<?php } ?>