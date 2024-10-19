<?php
// If uninstall not called from WordPress, exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

// Delete the transient related to login attempts.
delete_transient( 'attempted_login' );
