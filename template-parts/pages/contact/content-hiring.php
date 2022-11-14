<?php
  $title = get_sub_field('hiring_title');

  if ($title) {
  ?>
  <section class="hiring">
    <div class="wrapper inner-wrapper">
      <div class="wysiwyg-editor">
        <?php echo $title; ?>
      </div>
    </div>
  </section>
<?php } ?>