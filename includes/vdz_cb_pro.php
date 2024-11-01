<?php
class VDZ_CALL_BACK_PRO {
	const WIDGET_COLOR       = '#2098D1';
	const WIDGET_HOVER_COLOR = '#ffffff';
	const ICON_COLOR         = '#ffffff';
	const ICON_HOVER_COLOR   = '#0F9E5E';
	const POST_TYPE          = 'vdz_orders';
}
/*Добавляем новые поля в настройках шаблона для управления виджетом*/
function vdz_call_back_customizer_pro( $wp_customize ) {

	if ( ! class_exists( 'WP_Customize_Color_Control' ) ) {
		return;
	}

	// Добавляем настройки
	$wp_customize->add_setting(
		'vdz_call_back_widget_color',
		array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'default'           => VDZ_CALL_BACK_PRO::WIDGET_COLOR,
		)
	);
	$wp_customize->add_setting(
		'vdz_call_back_widget_hover_color',
		array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'default'           => VDZ_CALL_BACK_PRO::WIDGET_HOVER_COLOR,
		)
	);
	$wp_customize->add_setting(
		'vdz_call_back_icon_color',
		array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'default'           => VDZ_CALL_BACK_PRO::ICON_COLOR,
		)
	);
	$wp_customize->add_setting(
		'vdz_call_back_icon_hover_color',
		array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'default'           => VDZ_CALL_BACK_PRO::ICON_HOVER_COLOR,
		)
	);

	// Add Controls
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'vdz_call_back_widget_color',
			array(
				'label'    => 'Widget Color',
				'section'  => 'vdz_call_back_section',
				'settings' => 'vdz_call_back_widget_color',
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'vdz_call_back_widget_hover_color',
			array(
				'label'    => 'Widget Hover Color',
				'section'  => 'vdz_call_back_section',
				'settings' => 'vdz_call_back_widget_hover_color',
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'vdz_call_back_icon_color',
			array(
				'label'    => 'Icon Color',
				'section'  => 'vdz_call_back_section',
				'settings' => 'vdz_call_back_icon_color',
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'vdz_call_back_icon_hover_color',
			array(
				'label'    => 'Icon Hover Color',
				'section'  => 'vdz_call_back_section',
				'settings' => 'vdz_call_back_icon_hover_color',
			)
		)
	);
}
add_action( 'customize_register', 'vdz_call_back_customizer_pro', 10 );

function vdz_call_back_pro_css() {
	// var_dump( get_option('vdz_call_back_widget_color'));
	// var_dump( get_theme_mods());
	$widget_color       = sanitize_hex_color( get_option( 'vdz_call_back_widget_color', VDZ_CALL_BACK_PRO::WIDGET_COLOR ) );
	$widget_hover_color = sanitize_hex_color( get_option( 'vdz_call_back_widget_hover_color', VDZ_CALL_BACK_PRO::WIDGET_HOVER_COLOR ) );
	$icon_color         = sanitize_hex_color( get_option( 'vdz_call_back_icon_color', VDZ_CALL_BACK_PRO::ICON_COLOR ) );
	$icon_hover_color   = sanitize_hex_color( get_option( 'vdz_call_back_icon_hover_color', VDZ_CALL_BACK_PRO::ICON_HOVER_COLOR ) );

	$css  = '';
	$css .= sprintf( '%s { %s: %s !important; } ', '#vdz_cb_widget', 'border-color', vdz_hex2rgba( $widget_color, 0.3 ) );
	$css .= sprintf( '%s { %s: %s !important; } ', '#vdz_cb_widget', 'background-color', vdz_hex2rgba( $widget_color, 0.5 ) );
	$css .= sprintf( '%s { %s: %s !important; } ', '#vdz_cb_widget:before', 'border-color', vdz_hex2rgba( $widget_color, 0.5 ) );
	$css .= sprintf( '%s { %s: %s !important; } ', '#vdz_cb_widget:after', 'background-color', vdz_hex2rgba( $widget_color, 0.3 ) );

	$css .= sprintf( '%s { %s: %s !important; } ', '.vdz_cb_widget:hover', 'border-color', vdz_hex2rgba( $widget_hover_color, 0.3 ) );
	$css .= sprintf( '%s { %s: %s !important; } ', '.vdz_cb_widget:hover', 'background-color', vdz_hex2rgba( $widget_hover_color, 0.7 ) );
	if ( ( strtolower( $widget_hover_color ) == '#fff' ) || ( strtolower( $widget_hover_color ) == '#ffffff' ) ) {
		$css .= sprintf( '%s { %s: %s !important; } ', '#vdz_cb_widget:hover:before', 'border-color', vdz_hex2rgba( $widget_color, 0.5 ) );
		$css .= sprintf( '%s { %s: %s !important; } ', '#vdz_cb_widget:hover:after', 'background-color', vdz_hex2rgba( $widget_color, 0.3 ) );
	} else {
		$css .= sprintf( '%s { %s: %s !important; } ', '#vdz_cb_widget:hover:before', 'border-color', vdz_hex2rgba( $widget_hover_color, 0.5 ) );
		$css .= sprintf( '%s { %s: %s !important; } ', '#vdz_cb_widget:hover:after', 'background-color', vdz_hex2rgba( $widget_hover_color, 0.3 ) );
	}
	$css .= sprintf( '%s { %s: %s !important; } ', '.vdz_cb_widget span svg', 'fill', vdz_hex2rgba( $icon_color ) );
	$css .= sprintf( '%s { %s: %s !important; } ', '.vdz_cb_widget span:hover svg', 'fill', vdz_hex2rgba( $icon_hover_color ) );
	// var_export( wp_strip_all_tags( $css));
	// #vdz_cb_widget { border-color
	wp_add_inline_style( 'vdz_cb_widget_style', wp_strip_all_tags( $css ) );
}
add_action( 'wp_head', 'vdz_call_back_pro_css', 1000 );


function vdz_hex2rgba( $hex = '', $alpha = 1 ) {
	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	// $rgb = array($r, $g, $b);
	// return implode(",", $rgb); // returns the rgb values separated by commas
	$rgba = sprintf( ' rgba(%s,%s,%s,%s) ', $r, $g, $b, $alpha );
	return $rgba; // returns an array with the rgb values
}


if ( ! function_exists( 'vdz_cb_post_type_vdz_orders' ) ) {

	function vdz_cb_post_type_vdz_orders() {

		$labels = array(
			'name'                  => _x( 'Orders', 'Post Type General Name', 'vdz_cb' ),
			'singular_name'         => _x( 'Order', 'Post Type Singular Name', 'vdz_cb' ),
			'menu_name'             => __( 'Orders', 'vdz_cb' ),
			'name_admin_bar'        => __( 'Orders', 'vdz_cb' ),
			'archives'              => __( 'Item Archives', 'vdz_cb' ),
			'attributes'            => __( 'Item Attributes', 'vdz_cb' ),
			'parent_item_colon'     => __( 'Parent Item:', 'vdz_cb' ),
			'all_items'             => __( 'All Items', 'vdz_cb' ),
			'add_new_item'          => __( 'Add New Item', 'vdz_cb' ),
			'add_new'               => __( 'Add New', 'vdz_cb' ),
			'new_item'              => __( 'New Item', 'vdz_cb' ),
			'edit_item'             => __( 'Edit Item', 'vdz_cb' ),
			'update_item'           => __( 'Update Item', 'vdz_cb' ),
			'view_item'             => __( 'View Item', 'vdz_cb' ),
			'view_items'            => __( 'View Items', 'vdz_cb' ),
			'search_items'          => __( 'Search Item', 'vdz_cb' ),
			'not_found'             => __( 'Not found', 'vdz_cb' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'vdz_cb' ),
			'featured_image'        => __( 'Featured Image', 'vdz_cb' ),
			'set_featured_image'    => __( 'Set featured image', 'vdz_cb' ),
			'remove_featured_image' => __( 'Remove featured image', 'vdz_cb' ),
			'use_featured_image'    => __( 'Use as featured image', 'vdz_cb' ),
			'insert_into_item'      => __( 'INSERT INTO item', 'vdz_cb' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'vdz_cb' ),
			'items_list'            => __( 'Items list', 'vdz_cb' ),
			'items_list_navigation' => __( 'Items list navigation', 'vdz_cb' ),
			'filter_items_list'     => __( 'Filter items list', 'vdz_cb' ),
		);
		$args   = array(
			'label'               => __( 'Order', 'vdz_cb' ),
			'description'         => __( 'Order Description', 'vdz_cb' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor' ),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => current_user_can( 'administrator' ),
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-phone',
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'can_export'          => false,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'page',
			'show_in_rest'        => false,

		);
		register_post_type( VDZ_CALL_BACK_PRO::POST_TYPE, $args );
	}

	add_action( 'init', 'vdz_cb_post_type_vdz_orders', 10 );

}


// Отправка пользователю письма из попапа с содержимым по акциям и промокодам
remove_action( 'wp_ajax_vdz_cb_send', 'vdz_cb_send' );
remove_action( 'wp_ajax_nopriv_vdz_cb_send', 'vdz_cb_send' );
add_action( 'wp_ajax_vdz_cb_send', 'vdz_cb_pro_send', -10 );
add_action( 'wp_ajax_nopriv_vdz_cb_send', 'vdz_cb_pro_send', -10 );
function vdz_cb_pro_send() {
	// Проверка безопасности
	$do = wp_verify_nonce( $_POST['_wpnonce'], 'vdz_cb' );
	if ( empty( $do ) ) {
		wp_die( json_encode( array( 'status' => 'error' ) ) );
	}

	// Удаляем не нужные значения
	unset( $_POST['_wpnonce'] );
	unset( $_POST['action'] );

	// Выборка настроек плагина
	$vdz_cb_plugin_settings = get_option( 'vdz_cb_plugin_settings' );

	$email = ( isset( $vdz_cb_plugin_settings['vdz_cb_plugin_email'] ) && ! empty( $vdz_cb_plugin_settings['vdz_cb_plugin_email'] ) ) ? $vdz_cb_plugin_settings['vdz_cb_plugin_email'] : get_option( 'admin_email' );

	if ( ! empty( $vdz_cb_plugin_settings['vdz_cb_plugin_more_emails'] ) ) {
		$email .= ',' . $vdz_cb_plugin_settings['vdz_cb_plugin_more_emails'];
	}

	$custom_email  = ( isset( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail'] ) && ! empty( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail'] ) && isset( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_text'] ) && ! empty( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_text'] ) ) ? true : false;
	$custom_text   = ( isset( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_text'] ) && ! empty( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_text'] ) ) ? $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_text'] : '';
	$email_subject = ( isset( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_subject'] ) && ! empty( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_subject'] ) ) ? $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_subject'] : __( 'Call back', 'vdz-call-back' );

	$push_arr = array(
		'send_to_email' => $email,
	);
	// Добавляем новые данные
	foreach ( $_POST as $key => $value ) {
		$push_arr[ $key ] = sanitize_text_field( $value );
	}
	// Бекапим в файл
	// VDZ_CALL_BACK_DATA::PUSH($push_arr);

	// Удаляем - Этот параметр только для бекапа в файл
	unset( $push_arr['send_to_email'] );

	// Подготавливаем для отправки строку
	if ( $custom_email ) {
		$mail_str = vdz_cb_custom_email( $push_arr, $custom_text );
	} else {
		$mail_str = vdz_cb_get_string_from_arr( $push_arr );
	}

	// Сохраняем в админке
	$post_title  = '';
	$post_title .= isset( $push_arr['phone'] ) ? $push_arr['phone'] : '';
	$post_title .= '___';
	$post_title .= isset( $push_arr['name'] ) ? $push_arr['name'] : '';

	$post_data = array(
		'post_title'   => $post_title,
		'post_content' => $mail_str,
		'post_status'  => 'pending',
		'post_type'    => VDZ_CALL_BACK_PRO::POST_TYPE,
	);

	$post_id = wp_insert_post( wp_slash( $post_data ) );

	// Отправляем мыло
	wp_mail( $email, $email_subject, $mail_str );

	wp_die( json_encode( array( 'status' => 'success' ) ) );
}

add_action(
	'admin_head',
	function () {
		// wp_add_inline_style('foundation', wp_strip_all_tags('ul#vdz-call-back.tabs a[href="#data_setttings"]:display: none!important;'));
		wp_add_inline_style( 'vdz_cb_style', wp_strip_all_tags( 'ul#vdz-call-back.tabs a[href="#data_setttings"]{display: none!important;}' ) );
	},
	100
);
// name from
// add_filter( 'wp_mail_from_name', function(){
// return 'VDZ_CALL_BACK';
// } );

// email from
// add_filter( 'wp_mail_from', function(){
// $email_from = 'info@'. $_SERVER['SERVER_NAME'];
// return $email_from;
// } );
