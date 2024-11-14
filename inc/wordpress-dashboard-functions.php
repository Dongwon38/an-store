<?php 

// Removing default dashboard widgets

function remove_dashboard_widgets() {
    remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress.com Blog
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); // Plugins
    remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal'); // Gravity Forms
    remove_action('welcome_panel', 'wp_welcome_panel'); // Welcome Panel
    remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Activity
    remove_meta_box('wc_admin_dashboard_setup', 'dashboard', 'normal'); // Woocomerce Widget
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); // Site Health
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // At A Glance
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Quick Draft
    remove_meta_box('sb_dashboard_widget', 'dashboard', 'normal'); // Smash Balloon Feeds
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
