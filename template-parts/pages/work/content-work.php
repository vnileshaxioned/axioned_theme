<?php
  $title = get_sub_field('section_title');
  $posts_per_page = 12;

  $all_tags = get_terms(array(
    'taxonomy' => 'Tags',
    'hide_empty' => true,
  ));

  if ($title || $all_tags) { ?>
  <section class="works">
    <div class="wrapper inner-wrapper">
      <?php echo $title ? '<h2 class="main-heading">'. $title .'</h2>' : null; ?>
        <div class="filter-search">
          <ul class="all-tags">
            <li class="tag-list">
              <a href="#FIXME" class="work-tag tag-active" data-slug="all" data-post="<?php echo $posts_per_page; ?>" title="All">All</a>
            </li>
            <?php
              foreach ($all_tags as $tag_list) {
                $tag_count = $tag_list->count;
                $tag_slug = $tag_list->slug;
                $tag_name = $tag_list->name; ?>
                
              <li class="tag-list">
                <a href="#FIXME" class="work-tag" data-slug="<?php echo $tag_slug; ?>" data-post="<?php echo $posts_per_page; ?>" title="<?php echo $tag_name; ?>"><?php echo $tag_name; ?></a>
              </li>
            <?php } ?>
          </ul>
          <div class="form-group">
            <input type="text" data-post="<?php echo $posts_per_page; ?>" class="form-content">
          </div>
        </div>
      <ul class="our-work"></ul>
    </div>
  </section>   
<?php } ?>