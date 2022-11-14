      </main>
      <!--main section end-->

      <!--footer section start-->
      <footer>
        <div class="wrapper">
          <div class="left-footer">
            <?php
              $custom_logo = get_theme_mod( 'custom_logo' );
              $logo = wp_get_attachment_image_src( $custom_logo, 'full' );
              $blog_name = get_bloginfo('name');
              $blog_url = get_bloginfo('url');
              $customizer_logo = get_theme_mod('custom_wesite_logo') ? get_theme_mod('custom_wesite_logo') : $logo[0];
            ?>
            <h6>
              <a href="<?php echo $blog_url; ?>" class="axioned-logo" title="<?php echo $blog_name; ?>">
                <figure>
                  <img src="<?php echo $customizer_logo; ?>" class="axioned-logo-img" alt="<?php echo $blog_name; ?>">
                </figure>
              <?php echo $blog_name; ?></a>
            </h6>
            <ul class="social-links">
              <li class="social-icons"><a href="#FIXME" target="_blank" class="icon" title="instagram">instagram</a></li>
              <li class="social-icons"><a href="#FIXME" target="_blank" class="icon" title="twitter">twitter</a></li>
              <li class="social-icons"><a href="#FIXME" target="_blank" class="icon" title="linkedin">linkedin</a></li>
            </ul>
            <h6><a href="#FIXME" class="footer-head" title="We're hiring">We're hiring</a></h6>
            <div class="signup">
              <a href="#FIXME" class="newsletter-signup" title="Newsletter sign-up">Newsletter sign-up</a>
            </div>
          </div>
          <div class="right-footer">
            <?php wp_nav_menu( array(
              'theme_location' => 'secondary',
              'menu_class' => 'navbar',
              'container' => 'nav',
              'container_class' => 'menu',
              'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            ) ); ?>
            <div class="site-info">
              <figure class="agency-partner">
                <img src="<?php echo get_template_directory_uri()."/assets/image/download.svg"; ?>" alt="Agency Partner">
              </figure>
              <a href="#FIXME" class="site-health" title="Microsoft BI Site Health">Microsoft BI Site Health
                <figure class="gear-icon">
                  <img src="<?php echo get_template_directory_uri()."/assets/image/footer-microsoft-button.png"; ?>" alt="">
                </figure>
              </a>
            </div>
          </div>
        </div>
      </footer>
      <!--footer section end-->
      
    </div>
    <!--container end-->
  <?php wp_footer(); ?>
</body>
</html>