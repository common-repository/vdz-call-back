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


add_filter(
	'safe_style_css',
	function( $styles ) {
		$styles[] = 'display';
		return $styles;
	}
);

if ( ! function_exists( 'vdz_get_allow_html_tags' ) ) {
	function vdz_get_allow_html_tags( $custom_allowed_tags = array() ) {
		$allowed_tags = wp_kses_allowed_html( 'post' );
		if ( is_array( $allowed_tags ) ) {
			$allowed_tags = array_merge(
				$allowed_tags,
				array(
					'style'    => array(
						'class' => array(),
						'id'    => array(),
						'type'  => array(),
					),
					// Allow SVG
					'svg'      => array(
						'class'           => array(),
						'id'              => array(),
						'data'            => array(),
						'version'         => array(),
						'xmlns'           => array(),
						'width'           => array(),
						'height'          => array(),
						'viewBox'         => array(),
						'viewbox'         => array(),
						'aria-hidden'     => array(),
						'aria-labelledby' => array(),
						'role'            => array(),
					),
					'img'      => array(
						'class'  => array(),
						'id'     => array(),
						'data'   => array(),
						'width'  => array(),
						'height' => array(),
						'role'   => array(),
						'src'    => array(),
						'alt'    => array(),
						'title'  => array(),
					),
					'path'     => array(
						'class' => array(),
						'id'    => array(),
						'data'  => array(),
						'd'     => array(),
						'fill'  => array(),
					),
					'g'        => array( 'fill' => true ),
					'title'    => array( 'title' => true ),

					'div'      => array(
						'class' => array(),
						'id'    => array(),
						'data'  => array(),
						'style' => array(),
					),
					'form'     => array(
						'class'          => array(),
						'id'             => array(),
						'name'           => array(),
						'action'         => array(),
						'accept'         => array(),
						'accept-charset' => array(),
						'enctype'        => array(),
						'method'         => array(),
						'target'         => array(),
					),
					'input'    => array(
						'class'         => array(),
						'id'            => array(),
						'name'          => array(),
						'value'         => array(),
						'type'          => array(),
						'placeholder'   => array(),
						'required'      => array(),
						'checked'       => array(),
						'pattern'       => array(),
						'minlength'     => array(),
						'maxlength'     => array(),
						'data'          => array(),
						'data-mask'     => array(),
						'data-mask_off' => array(),
					),
					'textarea' => array(
						'class'       => array(),
						'id'          => array(),
						'name'        => array(),
						'value'       => array(),
						'type'        => array(),
						'placeholder' => array(),
						'required'    => array(),
					),
					'select'   => array(
						'class'    => array(),
						'id'       => array(),
						'name'     => array(),
						'value'    => array(),
						'type'     => array(),
						'required' => array(),
					),
					'option'   => array(
						'selected' => array(),
					),
				)
			);
		}
		if ( is_array( $custom_allowed_tags ) ) {
			$allowed_tags = array_merge( $allowed_tags, $custom_allowed_tags );
		}
		return $allowed_tags;
	}
}

// Add LOG Class
require_once VDZ_CALL_BACK_DIR . 'includes/classes/vdz_cb_log.php';
// Add DATA Class
require_once VDZ_CALL_BACK_DIR . 'includes/classes/vdz_cb_data.php';

if ( ! class_exists( 'View', false ) ) {
	// Add VIEW Class
	require_once VDZ_CALL_BACK_DIR . 'includes/classes/View.php';
}
// Add Send functions
require_once VDZ_CALL_BACK_DIR . 'includes/vdz_cb_send.php';
// Add Shortcode
require_once VDZ_CALL_BACK_DIR . 'includes/vdz_cb_shortcode.php';
// All front and admin assets
require_once VDZ_CALL_BACK_DIR . 'includes/vdz_cb_assets.php';
// Customizer
require_once VDZ_CALL_BACK_DIR . 'includes/vdz_cb_customize.php';
// For backend
if ( is_admin() ) {
	require_once VDZ_CALL_BACK_DIR . 'admin/api.php';
	require_once VDZ_CALL_BACK_DIR . 'admin/a_construct.php';
}
// For frontend
else {
	require_once VDZ_CALL_BACK_DIR . 'front/f_construct.php';
}




