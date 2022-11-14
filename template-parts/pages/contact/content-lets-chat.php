<?php
  $title = get_sub_field('section_title');
  $contents = get_sub_field('section_content');

  if ($title || $contents) {
  ?>
  <section class="lets-chat">
    <div class="wrapper inner-wrapper">
      <?php echo $title ? '<h2 class="main-heading">'. $title .'</h2>' : null; ?>
      <ul class="contact-outter-box">
        <?php
          foreach ($contents as $content) {
            $name = $content['name'];
            $position = $content['position'];
            $url_title = $content['url_title'];
            $chat_url = $content['chat_url'];
            $icon = $content['chat_icon']['url'] ? $content['chat_icon']['url'] : null;
            $icon_alt = $content['chat_icon']['alt'] ? $content['chat_icon']['url'] : $url_title;
            $image = $content['profile_image']['url'] ? $content['profile_image']['url'] : null;
            $image_alt = $content['profile_image']['alt'] ? $content['profile_image']['alt'] : $name;

            if ($name || $position || $url_title || $chat_url || $icon || $image) {
          ?>
          <li class="chat-list">
            <?php 
              echo $chat_url ? '<a href="'. $chat_url .'" target="_blank">' : null;

              if ($image) {  
              ?>
              <figure>
                <img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
              </figure>
            <?php }
              if ($name || $position || $url_title || $chat_url || $icon) {
              ?>
              <div class="chat-content">
                <?php
                  echo $name ? '<h5 class="chat-head">'. $name .'</h5>' : null;
                  echo $position ? '<p class="chat-position">'. $position .'</p>' : null;

                  if ($url_title || $icon) {
                ?>
                  <div class="chat-link">
                    <?php if ($icon) { ?>
                      <figure>
                        <img src="<?php echo $icon; ?>" alt="<?php echo $icon_alt; ?>">
                      </figure>
                    <?php } 
                      echo $url_title ? '<span class="chat-link-text">'. $url_title .'</span>' : null;
                    ?>
                  </div>
                <?php } ?>
              </div>
            <?php }
              echo $chat_url ? '</a>' : null;?>
          </li>
        <?php }
          } ?>
      </ul>
    </div>
  </section>
<?php } ?>