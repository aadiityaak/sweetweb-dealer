<?php
/* Loads parent stylesheet */
add_action('wp_enqueue_scripts', 'wpchild_enqueue_styles');
function wpchild_enqueue_styles()
{
  wp_enqueue_style('sweetweb-style', get_template_directory_uri() . '/style.css');
}


// Sweetweb's includes directory.
$sweetweb_inc_dir = 'inc';

// Array of files to include.
$sweetweb_includes = array(
  'function-child.php', 
  'post-type.php',                  // Initialize theme default settings.
  'metabox.php',
);

// Include files.
foreach ($sweetweb_includes as $file) {
  require_once get_stylesheet_directory() . '/' . $sweetweb_inc_dir . '/' . $file;
}