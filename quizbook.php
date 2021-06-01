<?php
/*
Plugin Name: Quizbook
Plugin URI: 
Description: Plugin to add quizzes or questions with WordPress
Version: 1.0
Author: Luciano Nicacio
Author URI: https://lucianonicacio.com/
License: GPL2
License URI: https://www.gnu.org/licences/gpl-2.0.html
Text Domain: quizbook
*/

// Add Quizzes Post Types
require_once plugin_dir_path(__FILE__) . 'includes/post-types.php';

// Remove rewrite rules and then recreate rewrite rules
register_activation_hook( __FILE__, 'quizbook_rewrite_flush' );

// Add metaboxes to the quizzes
require_once plugin_dir_path(__FILE__) . 'includes/metaboxes.php';