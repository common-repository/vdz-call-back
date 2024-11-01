<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */

if ( ! defined( 'VDZ_CALL_BACK_VERSION' ) ) {
	exit;
}

// Add styles
add_action( 'wp_head', 'vdz_cb_style' );
add_action( 'admin_head', 'vdz_cb_style' );
function vdz_cb_style() {
	wp_register_style( 'jBox_css', VDZ_CALL_BACK_URL . 'assets//jBox-1.3.3/jBox.min.css' );
	wp_enqueue_style( 'jBox_css' );
	wp_register_style( 'intlTelInput', VDZ_CALL_BACK_URL . 'assets/int_tel_input/css/intlTelInput.css' );
	wp_enqueue_style( 'intlTelInput' );
	wp_register_style( 'vdz_cb_style', VDZ_CALL_BACK_URL . 'assets/style.css', array(), time() );
	wp_enqueue_style( 'vdz_cb_style' );
}

// Add scripts
add_action( 'wp_footer', 'vdz_cb_js' );
add_action( 'admin_footer', 'vdz_cb_js' );
function vdz_cb_js() {
	wp_register_script( 'jquery.jBox', VDZ_CALL_BACK_URL . 'assets/jBox-1.3.3/jBox.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery.jBox' );
	wp_register_script( 'jquery.maskedinput', VDZ_CALL_BACK_URL . 'assets/js/jquery.maskedinput.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery.maskedinput' );
	wp_register_script( 'vdz-call-back', VDZ_CALL_BACK_URL . 'assets/js/vdz_call_back.js', array( 'jquery' ) );
	wp_enqueue_script( 'vdz-call-back' );
	// wp_register_script('intlTelInput',  VDZ_CALL_BACK_URL . 'assets/int_tel_input/js/intlTelInput.min.js', array('jquery'));
	// wp_enqueue_script('intlTelInput');
}


// Add Js admin path to ajax sending
add_action( 'wp_head', 'vdz_cb_js_variables' );
add_action( 'admin_head', 'vdz_cb_js_variables' );
function vdz_cb_js_variables() {
	global $my_js_country_arr;
	$my_js_const = array(
		'ajax_url'  => admin_url( 'admin-ajax.php' ),
		'auth_flag' => is_user_logged_in(),
	);
	echo(
		'<script type="text/javascript">window.vdz_cb = ' .
		json_encode( $my_js_const ) .
		';</script>'
	);
}


