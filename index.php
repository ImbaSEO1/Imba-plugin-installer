<?php
/*
Plugin Name: Imba plugin installer.
Plugin URI: https://www.imbaseo.se
Description: A plugin that help you with installing and updating your plugins.
Version: 0.1
Author: Mikael
Author URI: https://www.imbaseo.se
License: GPLv2 or later
Text Domain: Imba SEO
*/
/* -- Above code in comments is for separate plugin -- */

/* -- Below code is the actual code for TGMPA -- */
$main_file = dirname( __FILE__ ) . "/class-tgm-plugin-activation.php";
if (file_exists($main_file)) {
    include $main_file;
} else {
    /* -- Fetching the code from GitHub and creating new php file -- */
    $ch = curl_init("https://raw.githubusercontent.com/TGMPA/TGM-Plugin-Activation/develop/class-tgm-plugin-activation.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $src = curl_exec($ch);
    curl_close($ch);
    file_put_contents($main_file, $src);
    include $main_file;
}

add_action( "tgmpa_register", function() {
    $plugins = array(
        /* -- this plugin not available on WordPress directory. Please give complete url to zip file. -- */
        array(
            "name"    => "Wp Super Minify",
            "slug"    => "wp-super-minify"
        ),/* -- this plugin not available on WordPress directory. Please give complete url to zip file. -- */
        array(
            "name"    => "Redirection",
            "slug"    => "redirection"
        ),/* -- this plugin not available on WordPress directory. Please give complete url to zip file. -- */
        array(
            "name"    => "Wp Super Cache",
            "slug"    => "wp-super-cache"
        ),
        array(
            "name"    => "GTranslate",
            "slug"    => "gtranslate"
        ),
        array(
            "name"    => "Google Site Kit",
            "slug"    => "google-site-kit"
        ),
        array(
            "name"    => "Wp Smushit",
            "slug"    => "wp-smushit"
        ),
        array(
            "name"    => "Specify Missing Image Dimensions",
            "slug"    => "specify-missing-image-dimensions"
        ),
        array(
            "name"    => "Elementor",
            "slug"    => "elementor"
        ),
        array(
          'name'      => 'Elementor PRO free',
          'slug'      => 'pro-elements',
          'source'    => 'https://github.com/proelements/proelements/releases/download/v3.6.4/pro-elements.zip',
        ),
        array(
          'name'      => 'Imba Admin Central',
          'slug'      => 'imba-admin-central',
          'source'    => 'https://github.com/ImbaSEO1/imba-admin-central/archive/refs/heads/main.zip',
        ),
    );

    /* -- You can replace text values below. Dont change array keys (left side values) -- */
    $config = array(
        "id"           => "haysky-post-plugins",   // Unique ID for hashing notices for multiple instances of TGMPA.
        "default_path" => "",                      // Default absolute path to bundled plugins.
        "menu"         => "tgmpa-install-plugins", // Menu slug.
        "parent_slug"  => "plugins.php",           // Parent menu slug.
        "capability"   => "manage_options",        // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        "has_notices"  => true,                    // Show admin notices or not.
        "dismissable"  => true,                    // If false, a user cannot dismiss the nag message.
        "dismiss_msg"  => "",                      // If "dismissable" is false, this message will be output at top of nag.
        "is_automatic" => false,                   // Automatically activate plugins after installation or not.
        "message"      => "",                      // Message to output right before the plugins table.


        "strings"      => array(
            "page_title"                      => __( "Install Required Plugins", "haysky-post-plugins" ),
            "menu_title"                      => __( "Install Plugins", "haysky-post-plugins" ),
            /* translators: %s: plugin name. */
            "installing"                      => __( "Installing Plugin: %s", "haysky-post-plugins" ),
            /* translators: %s: plugin name. */
            "updating"                        => __( "Updating Plugin: %s", "haysky-post-plugins" ),
            "oops"                            => __( "Something went wrong with the plugin API.", "haysky-post-plugins" ),
            "notice_can_install_required"     => _n_noop(
                /* translators: 1: plugin name(s). */
                "Imba requires the following plugin: %1$s.",
                "Imba requires the following plugins: %1$s.",
                "Imba-post-plugins"
            ),
            "notice_can_install_recommended"  => _n_noop(
                /* translators: 1: plugin name(s). */
                "Imba recommends the following plugin: %1$s.",
                "Imba recommends the following plugins: %1$s.",
                "Imba-post-plugins"
            ),
            /*
            "notice_ask_to_update"            => _n_noop(
                /* translators: 1: plugin name(s). * /
                "The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.",
                "The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.",
                "haysky-post-plugins"
            ),
            "notice_ask_to_update_maybe"      => _n_noop(
                /* translators: 1: plugin name(s). * /
                "There is an update available for: %1$s.",
                "There are updates available for the following plugins: %1$s.",
                "haysky-post-plugins"
            ),
            "notice_can_activate_required"    => _n_noop(
                /* translators: 1: plugin name(s). * /
                "The following required plugin is currently inactive: %1$s.",
                "The following required plugins are currently inactive: %1$s.",
                "haysky-post-plugins"
            ),
            "notice_can_activate_recommended" => _n_noop(
                /* translators: 1: plugin name(s). * /
                "The following recommended plugin is currently inactive: %1$s.",
                "The following recommended plugins are currently inactive: %1$s.",
                "haysky-post-plugins"
            ),
            "install_link"                    => _n_noop(
                "Begin installing plugin",
                "Begin installing plugins",
                "haysky-post-plugins"
            ),
            "update_link"                       => _n_noop(
                "Begin updating plugin",
                "Begin updating plugins",
                "haysky-post-plugins"
            ),
            "activate_link"                   => _n_noop(
                "Begin activating plugin",
                "Begin activating plugins",
                "haysky-post-plugins"
            ),
            "return"                          => __( "Return to Required Plugins Installer", "haysky-post-plugins" ),
            "plugin_activated"                => __( "Plugin activated successfully.", "haysky-post-plugins" ),
            "activated_successfully"          => __( "The following plugin was activated successfully:", "haysky-post-plugins" ),
            /* translators: 1: plugin name. * /
            "plugin_already_active"           => __( "No action taken. Plugin %1$s was already active.", "haysky-post-plugins" ),
            /* translators: 1: plugin name. * /
            "plugin_needs_higher_version"     => __( "Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.", "haysky-post-plugins" ),
            /* translators: 1: dashboard link. * /
            "complete"                        => __( "All plugins installed and activated successfully. %1$s", "haysky-post-plugins" ),
            "dismiss"                         => __( "Dismiss this notice", "haysky-post-plugins" ),
            "notice_cannot_install_activate"  => __( "There are one or more required or recommended plugins to install, update or activate.", "haysky-post-plugins" ),
            "contact_admin"                   => __( "Please contact the administrator of this site for help.", "haysky-post-plugins" ),

            "nag_type"                        => "", // Determines admin notice type - can only be one of the typical WP notice classes, such as "updated", "update-nag", "notice-warning", "notice-info" or "error". Some of which may not work as expected in older WP versions.
        */
        ),
    );

    tgmpa( $plugins, $config );
});
?>
<?php
/* Powered By Haysky Code Generator: KEY
[["text","wp-super-minify"],["text","redirection"],["text","wp-super-cache"],["submit","TGM Plugin Installer"]]
*/
?>
