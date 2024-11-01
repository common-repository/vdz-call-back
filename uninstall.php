<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */

// if uninstall/delete not called from WordPress exit
if ( ! defined( 'ABSPATH' ) && ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// Delete options array from options table
delete_option( 'vdz_cb_plugin_settings' );
delete_option( 'vdz_cb_popup_settings' );
delete_option( 'vdz_cb_test_settings' );
delete_option( 'vdz_call_back_widget_show_flag' );
