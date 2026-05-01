<?php
/**
 * Loads Cinnamon Control as a must-use plugin.
 */

$plugin = WP_CONTENT_DIR . '/plugins/cinnamon-control/cinnamon-control.php';

if ( file_exists( $plugin ) ) {
    require_once $plugin;
}
