<?php
  $video = get_sub_field('banner_video');
  $content = get_sub_field('banner_content');
  $video_src = $video['url'];
  $video_type = $video['mime_type'];
  
  if ($video || $content) {
  ?>
  <section class="banner">
    <div class="wrapper inner-wrapper">
      <?php if ($video) { ?>
        <video class="banner-video" autoplay loop muted>
          <source src="<?php echo $video_src; ?>" type="<?php echo $video_type; ?>">
          Your browser does not support the video tag.
        </video>
      <?php }
        echo $content ? '<div class="banner-content">'. $content .'</div>' : null;
      ?>
    </div>
  </section>
<?php } ?>