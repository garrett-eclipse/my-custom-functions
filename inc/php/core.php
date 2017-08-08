<?php

/**
 * Prevent Direct Access
 *
 * @since 0.1
 */
defined( 'ABSPATH' ) or die( "Restricted access!" );

/**
 * Register text domain
 *
 * @since 4.1
 */
function MCFunctions_textdomain() {
    load_plugin_textdomain( MCFUNC_TEXT, false, MCFUNC_DIR . '/languages/' );
}
add_action( 'init', MCFUNC_PREFIX . '_textdomain' );

/**
 * Print direct link to plugin admin page
 *
 * Fetches array of links generated by WP Plugin admin page ( Deactivate | Edit )
 * and inserts a link to the plugin admin page
 *
 * @since  4.1
 * @param  array $links Array of links generated by WP in Plugin Admin page.
 * @return array        Array of links to be output on Plugin Admin page.
 */
function MCFunctions_settings_link( $links ) {
    $page = '<a href="' . admin_url( 'themes.php?page=' . MCFUNC_SLUG . '.php' ) .'">' . __( 'Settings', MCFUNC_TEXT ) . '</a>';
    array_unshift( $links, $page );
    return $links;
}
add_filter( 'plugin_action_links_' . MCFUNC_BASE, MCFUNC_PREFIX . '_settings_link' );

/**
 * Print link to My Custom Functions PRO page
 *
 * @since 4.4.1
 */
function MCFunctions_upgrade_link( $links ) {
    $upgrade_page = '<a href="https://www.spacexchimp.com/plugins/my-custom-functions-pro.html" target="_blank"><b style="color:red;">' . __( 'Upgrade to PRO', MCFUNC_TEXT ) . '</b></a>';
    array_unshift( $links, $upgrade_page );
    return $links;
}
add_filter( 'plugin_action_links_' . MCFUNC_BASE, MCFUNC_PREFIX . '_upgrade_link' );

/**
 * Print additional links to plugin meta row
 *
 * @since 4.4.1
 */
function MCFunctions_plugin_row_meta( $links, $file ) {

    if ( strpos( $file, MCFUNC_SLUG . '.php' ) !== false ) {

        $new_links = array(
                           'donate' => '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8A88KC7TFF6CS" target="_blank"><span class="dashicons dashicons-heart"></span> ' . __( 'Donate', MCFUNC_TEXT ) . '</a>',
                           'upgrage' => '<a href="https://www.spacexchimp.com/plugins/my-custom-functions-pro.html" target="_blank"><span class="dashicons dashicons-star-filled"></span> ' . __( 'Upgrade to PRO', MCFUNC_TEXT ) . '</a>'
                           );
        $links = array_merge( $links, $new_links );
    }

    return $links;
}
add_filter( 'plugin_row_meta', MCFUNC_PREFIX . '_plugin_row_meta', 10, 2 );

/**
 * Register plugin's submenu in the "Appearance" Admin Menu
 *
 * @since 4.1
 */
function MCFunctions_register_submenu_page() {
    $menu_title = __( 'Custom Functions', MCFUNC_TEXT );
    $capability = 'edit_theme_options';
    add_theme_page( MCFUNC_NAME, $menu_title, $capability, MCFUNC_SLUG, MCFUNC_PREFIX . '_render_submenu_page' );
}
add_action( 'admin_menu', MCFUNC_PREFIX . '_register_submenu_page' );

/**
 * Register settings
 *
 * @since 4.1
 */
function MCFunctions_register_settings() {
    register_setting( MCFUNC_SETTINGS . '_settings_group', MCFUNC_SETTINGS . '_settings' );
    register_setting( MCFUNC_SETTINGS . '_settings_group', MCFUNC_SETTINGS . '_service_info' );
    register_setting( MCFUNC_SETTINGS . '_settings_group', MCFUNC_SETTINGS . '_error' );
}
add_action( 'admin_init', MCFUNC_PREFIX . '_register_settings' );
