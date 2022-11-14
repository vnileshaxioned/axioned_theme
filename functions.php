<?php

// customizer api
add_action('customize_register', 'custom_axioned_customizer_register');
function custom_axioned_customizer_register($wp_customize) {
  $wp_customize->add_section('home_page_section', array(
    'title' => 'Home Page Section',
    'description' => __('Customize your Home page section'),
  ));
  $wp_customize->add_setting('theme_background_color', array(
    'default' => '#201547',
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_background_color', array(
    'label' => 'Theme Background Color',
    'section' => 'home_page_section',
  )));

  $wp_customize->add_setting('custom_wesite_logo', array(
    'default' => '',
  ));
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_wesite_logo', array(
    'label' => 'Edit Website Logo',
    'section' => 'home_page_section',
  )));
}

// for contact form dropdown
add_filter('wpcf7_form_tag_data_option', 'drop_down_cf', 10, 3);
function drop_down_cf($data, $options, $args) {
  $data = [];
  if (in_array('values', $options)){
    $args = array(
      'post_type' => 'session',
      'orderby' => 'title',
      'order' =>'ASC',
      'post_status' => 'publish',
      'posts_per_page' => 10
    );
    $query = new WP_Query( $args );
    $total_posts = $query->found_posts;
    if ($query -> have_posts()) {
      while ($query -> have_posts()) {
        $query -> the_post();
        $name = get_field('name');
        $date = date_i18n("c", strtotime(get_field('date')));
        $data[] = $name.' '.$date;
      }
      wp_reset_postdata();
    }
  }
  return $data;
}

function pa_infosession_assets() {

    // if (basename(get_permalink()) == "infosessionsignup" || basename(get_permalink()) == "lp-info-session"){

        $args = array(
          'post_type' => 'session',
          'post_status' => 'publish',
          'posts_per_page' => '8',
          'meta_key' => 'date',
          'orderby'	=> 'meta_value',
          'order' => 'ASC',
          // 'meta_query'	=> array(
          //   'relation'		=> 'AND',
          //   array(
          //     'key'	  	=> 'date_info',
          //     // 'value'	  	=> date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 1 days')),
          //     'value'	  	=> date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
          //     'compare' 	=> '>',
          //   ),
          // ),
        );
      
        $info_query = new WP_Query($args);
        
        $info_sessions = array();
        if ($info_query->have_posts()) {
          while($info_query->have_posts()) {
            $info_query->the_post();
            $id = get_the_ID();
            $name = get_field('name', $id);
            $session_date = get_field('date', $id);
            $date = date('d', strtotime($session_date));
            $month = date('m', strtotime($session_date));
            $year = date('Y', strtotime($session_date));
            $day = date('d', strtotime($session_date));
            $hour = date('G', strtotime($session_date));
            $minute = date('i', strtotime($session_date));
            $ampm = date('a', strtotime($session_date));
      
            $session_info = array(
              'name' => $name,
              'date' => $session_date,
              'year' => $year,
              'month' => $month,
              'day' => $day,
              'hours' =>  $hour,
              'minutes' => $minute,
          );
          
            array_push($info_sessions, $session_info);
          }
          wp_reset_postdata();
        }

        $timezone_list = generate_timezone_list();
        $pa_infosession_data = array(
            'timezone_list'=>$timezone_list,
            'info_sessions_time' => $info_sessions
        );

        // echo "<pre>";
        // var_dump($pa_infosession_data);
        // echo "</pre>";
        wp_enqueue_script( 'pa_infosession', get_stylesheet_directory_uri() . '/assets/js/pa_infosession.js', array('custom-jquery'));
        wp_localize_script( 'pa_infosession', 'pa_infosession_data', $pa_infosession_data );
    // }
	
	// wp_enqueue_script( 'pa_researchpapers', get_stylesheet_directory_uri() . '/js/researchpapers.js');
}
add_action('wp_enqueue_scripts','pa_infosession_assets');

function generate_timezone_list()
{
    static $regions = array(
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    );
    $timezones = array();
    foreach( $regions as $region )
    {
        $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers($region) );
    }

    $timezone_offsets = array();
    foreach( $timezones as $timezone )
    {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }
    // sort timezone by offset
    asort($timezone_offsets);

    $timezone_list = array();
    foreach( $timezone_offsets as $timezone => $offset )
    {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate( 'H:i', abs($offset) );

        $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

        $timezone_list[] = array(
            'timezone' => $timezone,
            'timezone_label' =>"(${pretty_offset}) $timezone",
        );
    }
    return $timezone_list;
}

// info session function
add_action("wp_ajax_infosession_data", "infosession_data");
add_action("wp_ajax_nopriv_infosession_data", "infosession_data");
function infosession_data () {

  $args = array(
    'post_type' => 'session',
    'post_status' => 'publish',
    'posts_per_page' => '8',
    'meta_key' => 'date',
    'orderby'	=> 'meta_value',
    'order' => 'ASC',
  );

  $info_query = new WP_Query($args);
  
  $info_sessions = array();
  if ($info_query->have_posts()) {
    while($info_query->have_posts()) {
      $info_query->the_post();
      $id = get_the_ID();
      $name = get_field('name', $id);
      // $session_date = date_i18n("c", strtotime(get_field('date')));
      $session_date = get_field('date', $id);
      $date = date('d', strtotime($session_date));
      $month = date('m', strtotime($session_date));
      $year = date('Y', strtotime($session_date));
      $day = date('d', strtotime($session_date));
      $hour = date('G', strtotime($session_date));
      $minute = date('i', strtotime($session_date));
      $ampm = date('a', strtotime($session_date));

      $session_info = array(
        'name' => $name,
        'date' => $session_date,
        'year' => $year,
        'month' => $month,
        'day' => $day,
        'hours' =>  $hour,
        'minutes' => $minute,
      );

      array_push($info_sessions, $session_info);
    }
    wp_reset_postdata();
  }
  echo json_encode($info_sessions);
  die();
}

// for option page
add_action( 'init', 'client_testimonial_option_page');
function client_testimonial_option_page() {
  if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
      'page_title' 	=> 'Client Testimonial',
      'menu_title'	=> 'Client Testimonial',
      'menu_slug' 	=> 'client-testimonial',
      'icon_url'    => 'dashicons-businessperson',
    ));
  }
}

// enqueue the style and script files
add_action('wp_enqueue_scripts', 'test_theme_script');
function test_theme_script() {
  wp_enqueue_script( 'pa_timezones', get_stylesheet_directory_uri() . '/assets/js/timezones.js');
  wp_enqueue_script( 'pa_moment', get_stylesheet_directory_uri() . '/assets/js/moment.js');
  wp_enqueue_script( 'pa_moment-timezone-with-data', get_stylesheet_directory_uri() . '/assets/js/moment-timezone-with-data.js');
  wp_enqueue_style('custom-styling', get_stylesheet_uri());
  wp_enqueue_style('custom-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_script('custom-script', get_template_directory_uri().'/assets/js/script.js', array('custom-jquery'), '', true);
  wp_enqueue_script('custom-jquery', get_stylesheet_directory_uri().'/assets/vendor/jquery-1.8.3.min.js', '', '', true);
  wp_enqueue_script('custom-moment-js', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js', '', '');
  wp_enqueue_script('custom-momenttz-js', 'https://momentjs.com/downloads/moment-timezone-with-data.js', '', '');
  wp_localize_script( 'custom-script', 'ajax', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
}

// filter and search function
add_action("wp_ajax_filter_search", "filter_search");
add_action("wp_ajax_nopriv_filter_search", "filter_search");
function filter_search() {
  $post_per_page = $_POST['post_per_page'];
  $tag_name = $_POST['tag_name'];
  $search = $_POST['search'];

  // all post query
  $args = array(
    'post_type' => 'work',
    'orderby' => 'title',
    'order' =>'ASC',
    'post_status' => 'publish',
    'posts_per_page' => $post_per_page,
  );
  
  // taxonomy query
  if ($tag_name) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'Tags',
        'field' => 'slug',
        'terms' => $tag_name
      )
    );
  }
  
  // search query
  $search ? $args['s'] = $search : null;

  $query = new WP_Query($args);
  $result = '';
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $title = get_the_title();
      $description = get_the_excerpt();
      $permalink = get_the_permalink();
      $image = get_field('image')['url'] ? get_field('image')['url'] : null;
      $image_alt = get_field('image')['alt'] ? get_field('image')['alt'] : $title;

      if ($title || $description || $image || $permalink) {
        $result .= '<li class="work-list">';
        $result .= '<a href="'. $permalink .'">';

        if ($image) {
          $result .= '<figure><img src="'.$image .'" alt="'. $image_alt .'"></figure>';
        }

        if ($title || $description) {
          $result .= '<div class="content">';
          $result .= $title ? '<h2 class="work-heading">'. $title .'</h2>' : null;
          $result .= $description ? '<p class="work-paragraph">'. $description .'</p>' : null;
          $result .= '</div>';
        }

        $result .= '</a>';
        $result .= '</li>';
        
      }
    }
    wp_reset_postdata();
  }
  echo $result;
  die();
}

// theme support
add_action('after_setup_theme', 'test_theme_setup');
function test_theme_setup() {
  add_theme_support('title-tag');
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'custom-logo' );
  register_nav_menus( array(
    'primary' => __('Primary Menu', 'axionedtheme'),
    'secondary' => __('Secondary Menu', 'axionedtheme')
  ) );
}

// custom post type
add_action( 'init', function() {
  custom_post_type('work', 'dashicons-portfolio');
  custom_post_type('session', 'dashicons-clock');
});
function custom_post_type($cpt, $icon = 'dashicons-admin-post') {
  $capitalize_cpt = ucfirst($cpt);
  $labels = array(
    'name'                => _x( $capitalize_cpt.'s', 'Post Type General Name', 'customtheme' ),
    'singular_name'       => _x( $cpt, 'Post Type Singular Name', 'customtheme' ),
    'menu_name'           => __( $capitalize_cpt.'s', 'customtheme' ),
    'all_items'           => __( 'All '.$capitalize_cpt.'s', 'customtheme' ),
    'add_new'             => __( 'Add New', 'customtheme' ),
    'edit_item'           => __( 'Edit '.$capitalize_cpt, 'customtheme' ),
    'update_item'         => __( 'Update '.$capitalize_cpt, 'customtheme' ),
    'search_items'        => __( 'Search '.$capitalize_cpt.'s', 'customtheme' ),
    'not_found'           => __( 'Not Found', 'customtheme' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'customtheme' ),
  );
  $args = array(
    'label'               => __( $cpt, 'customtheme' ),
    'description'         => __( $cpt.' description', 'customtheme' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail' ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 4,
    'menu_icon'           => $icon,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( $cpt, $args );
}

// custom taxonomy
add_action( 'init', 'custom_tag_taxonomy');
function custom_tag_taxonomy() {
  $labels = array(
    'name' => _x('Tags', 'taxonomy general name'),
    'singular_name' => _x('Tag', 'taxonomy_singular_name'),
    'search_items' => __('Search Tags'),
    'all items' => __('All Tags'),
    'parent_item' => __('Parent Tag'),
    'parent_item_colon' => __('Parent Tag:'),
    'edit_item' => __('Edit Tag'),
    'update_item' => __('Update Tag'),
    'add_new_item' => __('Add New Tag'),
    'new_item_name' => __('New Tag Name'),
    'menu_name' => __('Tags'),
  );

  register_taxonomy('Tags', array('work'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tag' ),
  ));
}

// for classic editor
add_filter('use_block_editor_for_post', '__return_false');

?>