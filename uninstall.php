<?php
//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

delete_option('rwbe_onez');
unregister_setting('rwbe_onez','rwbe_onez');

?>