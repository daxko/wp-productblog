<?php

add_action('widgets_init', 'daxkoblog_widgets_init');
function daxkoblog_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Training Sidebar', 'daxkoblog' ),
    'id'            => 'training-sidebar',
    'description'   => __( 'Sidebar that appears on the training pages', 'daxkoblog' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ));
  unregister_sidebar('sidebar-2');
  unregister_sidebar('sidebar-3');
}

add_filter('nav_menu_css_class', 'add_active_class', 10, 2);
function add_active_class($classes = array(), $menu_item) {
  global $post;

  if((is_page('daxko-community') && $menu_item->post_title === "community")
    || ((is_single() || is_archive() || is_home()) && $menu_item->post_title === "product blog")
    || (is_page($menu_item->object_id) || $post->post_parent == $menu_item->object_id)) {
    $classes[] = 'active';
  } else {
    $classes[] = '';
  }
  return $classes;
}

function is_training() {
  global $post;

  return is_page('training') || '19933' == $post->post_parent;
}

function is_community() {
  return is_page_template('page-templates/community-header.php');
}

function build_menu() {
  $menu = wp_nav_menu(array(
      'container' => false,
      'theme_location' => 'primary',
      'menu_class' => 'nav pull-right',
      'menu_id' => '',
      'echo' => false
    ));

  // The community header will be displayed in an iframe, so we need to set the parent target
  if(is_community()) {
    $menu = str_replace('<a', '<a target="_parent"', $menu);
  }

  echo $menu;
}

if (!function_exists( 'twentyfourteen_posted_on')) {
  function twentyfourteen_posted_on() {
    if ( is_sticky() && is_home() && ! is_paged() ) {
      echo '<span class="featured-post">' . __( 'Sticky', 'twentyfourteen' ) . '</span>';
    }

    // Set up and print post meta information.
    printf( '<span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%6$s %5$s</a></span></span><span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span>',
      esc_url( get_permalink() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      get_the_author(),
      get_avatar(get_the_author_meta( 'ID' ), 30)
    );
  }
}