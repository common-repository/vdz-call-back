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
// Add shorccode for more text Plugin
function vdz_cb_shortcode( $atts, $content ) {
	// Add defaults params and extract variables
	$attributes = shortcode_atts(
		array(
			'vdz_cb_popup_title'               => __( 'Call back', 'vdz-call-back' ),
			'vdz_cb_popup_mask'                => '(999) 999-99-99',
			'vdz_cb_popup_mask_off'            => 0,
			'vdz_cb_popup_name'                => __( 'Name', 'vdz-call-back' ),
			'vdz_cb_popup_name_required'       => 0,
			'vdz_cb_popup_name_disable'        => 0,
			'vdz_cb_popup_phone'               => __( 'Phone', 'vdz-call-back' ),
			'vdz_cb_popup_text'                => '',
			'vdz_cb_popup_custom_fields'       => '',
			'vdz_cb_popup_button'              => __( 'Send', 'vdz-call-back' ),
			'vdz_cb_popup_error'               => __( 'Error', 'vdz-call-back' ),
			'vdz_cb_popup_success'             => __( 'Thank you!', 'vdz-call-back' ),
			'vdz_cb_popup_button_class'        => '',
			'vdz_cb_btn_title'                 => get_theme_mod( 'vdz_call_back_widget_title', '' ),
			'vdz_cb_popup_action_button_class' => '',
			'vdz_cb_popup_button_open'         => ! empty( $content ) ? $content : __( 'Call back', 'vdz-call-back' ),
		),
		$atts
	);

	// Перезаписываем значениями из базы если они есть
	$vdz_cb_popup_settings = get_option( 'vdz_cb_popup_settings' );
	if ( is_array( $vdz_cb_popup_settings ) ) {
		foreach ( $vdz_cb_popup_settings as $k => $v ) {
			if ( isset( $attributes[ $k ] ) ) {
				$attributes[ $k ] = ( $v ) ? $v : $attributes[ $k ];
			}
		}
	}
	$vdz_cb_plugin_settings = get_option( 'vdz_cb_plugin_settings' );
	if ( is_array( $vdz_cb_plugin_settings ) ) {
		foreach ( $vdz_cb_plugin_settings as $k => $v ) {
			if ( isset( $attributes[ $k ] ) ) {
				if ( empty( $attributes[ $k ] ) ) {
					$attributes[ $k ] = ( $v ) ? $v : $attributes[ $k ];
				} else {
					$attributes[ $k ] .= ' ' . ( ( $v ) ? $v : $attributes[ $k ] );
				}
			}
		}
	}

	// template
	$vdz_cb_html               = '';
	$vdz_cb_shortcode_view_obj = new View( VDZ_CALL_BACK_DIR . 'front/templates/' );

	static $shortcode_count = 0;

	// Добавляем к атрибутам текст кнопки попапа
	$attributes = array_merge(
		$attributes,
		array(
			'shortcode_count' => $shortcode_count,
		)
	);

	$vdz_cb_html .= $vdz_cb_shortcode_view_obj->fetch( 'vdz_call_back_view', $attributes );
	$shortcode_count++;
	// do inside shortcode
	return $vdz_cb_html;
}

add_shortcode( 'vdz_cb', 'vdz_cb_shortcode' );
