<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */

add_action( 'wp_ajax_vdz_cb_send', 'vdz_cb_send' );
add_action( 'wp_ajax_nopriv_vdz_cb_send', 'vdz_cb_send' );

function vdz_cb_send() {

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
	VDZ_CALL_BACK_DATA::PUSH( $push_arr );

	// Удаляем - Этот параметр только для бекапа в файл
	unset( $push_arr['send_to_email'] );

	// Подготавливаем для отправки строку
	if ( $custom_email ) {
		$mail_str = vdz_cb_custom_email( $push_arr, $custom_text );
	} else {
		$mail_str = vdz_cb_get_string_from_arr( $push_arr );
	}

	// Отправляем мыло
	wp_mail( $email, $email_subject, $mail_str );

	wp_die( json_encode( array( 'status' => 'success' ) ) );
}

/**
 * Преобразуем данные в строку
 *
 * @param array $arr - Данные
 *
 * @return string -
 */
function vdz_cb_get_string_from_arr( $arr = array() ) {

	if ( empty( $arr ) ) {
		return '';
	}

	$str = '';
	foreach ( $arr as $key => $value ) {
		$str .= $key . ': ' . $value . "\r\n";
	}

	return $str;
}

/**
 * Кастомный шаблон письма для отправки данных
 *
 * @param array  $arr Массив данных для письма
 * @param string $str - Строка шаблона письма
 *
 * @return mixed|string - Текст письма
 */
function vdz_cb_custom_email( $arr = array(), $str = '' ) {
	if ( empty( $arr ) ) {
		return '';
	}
	foreach ( $arr as $key => $value ) {
		if ( $key == '_wp_http_referer' ) {
			$str = str_replace( '[page]', $value, $str );
		}
		$str = str_replace( '[' . $key . ']', $value, $str );
	}
	if ( empty( $str ) ) {
		$str = vdz_cb_get_string_from_arr( $arr );
	}
	return $str;
}
