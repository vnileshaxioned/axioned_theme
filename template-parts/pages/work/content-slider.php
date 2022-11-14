<?php
  $sliders = get_sub_field('slider');

  if ($sliders) {
  ?>
  <div class="clients">
    <div class="wrapper inner-wrapper">
      <ul class="client-slider">
        <?php
          foreach ($sliders as $slide) {
            $image = $slide['client_image']['url'] ? $slide['client_image']['url'] : null;
            $image_alt = $slide['client_image']['alt'] ? $slide['client_image']['alt'] : 'Client image';
          ?>
          <li class="list">
            <figure>
              <img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
            </figure>
          </li>
        <?php } ?>
        <li class="client-slider-action">
          <a href="#FIXME" class="client-slider-button previous-button" title="Previous slide">Previous slide</a>
        </li>
        <li class="client-slider-action">
          <a href="#FIXME" class="client-slider-button next-button" title="Next slide">Next slide</a>
        </li>
      </ul>
    </div>
  </div>
<?php } ?>