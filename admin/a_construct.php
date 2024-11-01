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

/*
LOG*/
// Пишем лог при активации плагина
register_activation_hook( VDZ_CALL_BACK_FILE, 'vdz_cb_activate_plugin' );
function vdz_cb_activate_plugin() {

	VDZ_CALL_BACK_LOG::PUSH( 'Activate VDZ_CALL_BACK' );

	global $wp_version;
	if ( version_compare( $wp_version, '3.8', '<' ) ) {
		// Деактивируем плагин
		deactivate_plugins( plugin_basename( VDZ_CALL_BACK_FILE ) );
		VDZ_CALL_BACK_LOG::PUSH( 'Error old WordPress version = ' . $wp_version );
		wp_die( 'This plugin required WordPress version 3.8 or higher' );
	}

	add_option( 'vdz_call_back_widget_show_flag', 1 );

	// Add options array to options table
	add_option(
		'vdz_cb_plugin_settings',
		array(
			'vdz_cb_plugin_email'               => '',
			'vdz_cb_plugin_custom_mail'         => 0,
			'vdz_cb_plugin_custom_mail_text'    => '',
			'vdz_cb_plugin_custom_mail_subject' => '',
		)
	);
	add_option(
		'vdz_cb_popup_settings',
		array(
			'vdz_cb_popup_title'               => '',
			'vdz_cb_popup_mask'                => '',
			'vdz_cb_popup_mask_off'            => 0,
			'vdz_cb_popup_name'                => '',
			'vdz_cb_popup_name_required'       => 0,
			'vdz_cb_popup_name_disable'        => 0,
			'vdz_cb_popup_phone'               => '',
			'vdz_cb_popup_button'              => '',
			'vdz_cb_popup_button_class'        => '',
			'vdz_cb_popup_action_button_class' => '',
			'vdz_cb_popup_text'                => '',
			'vdz_cb_popup_custom_fields'       => '',
			'vdz_cb_popup_success'             => '',
			'vdz_cb_popup_error'               => '',
		)
	);
	add_option(
		'vdz_cb_test_settings',
		array(
			'vdz_cb_test_shortcode' => '',
		)
	);
	// Создаем файл базы
	if ( ! file_exists( VDZ_CALL_BACK_DATA_FILE ) ) {
		file_put_contents( VDZ_CALL_BACK_DATA_FILE, '' );
	}

	do_action( VDZ_CALL_BACK_API, 'on', plugin_basename( __FILE__ ) );
}
// Пишем лог при деактивации плагина
register_deactivation_hook( VDZ_CALL_BACK_FILE, 'vdz_cb_deactivate_plugin' );
function vdz_cb_deactivate_plugin() {
	VDZ_CALL_BACK_LOG::PUSH( 'Deactivate VDZ_CALL_BACK' );
}
/*END LOG*/

/*
ASSETS*/
// Only for plugin settings page
if ( substr_count( $_SERVER['REQUEST_URI'], 'page=vdz_call_back' )
    || substr_count( $_SERVER['REQUEST_URI'], 'page=vdz-call-back' )
) {
	// Add styles
	add_action( 'admin_head', 'vdz_call_back_style', 1 );
	function vdz_call_back_style() {
		wp_register_style( 'foundation', VDZ_CALL_BACK_URL . 'assets/foundation-6.2.3/css/foundation.min.css', array(), VDZ_CALL_BACK_VERSION );
		wp_enqueue_style( 'foundation' );
	}

	// Add scripts
	add_action( 'admin_footer', 'vdz_call_back_js', 1 );
	function vdz_call_back_js() {
		wp_register_script( 'foundation', VDZ_CALL_BACK_URL . 'assets/foundation-6.2.3/js/vendor/foundation.min.js', 'jquery', VDZ_CALL_BACK_VERSION );
		wp_enqueue_script( 'foundation' );
		wp_register_script( 'vdz_call_back_admin_js', VDZ_CALL_BACK_URL . 'assets/js/admin.js', array( 'jquery', 'foundation' ), VDZ_CALL_BACK_VERSION );
		wp_enqueue_script( 'vdz_call_back_admin_js' );
	}
}
/*END ASSETS*/

/*PAGES & LINKS*/
$vdz_cb_admin_view_obj = new View( VDZ_CALL_BACK_DIR . 'admin/templates/' );

// Добавляем ссылку в меню для настроек плагина
add_action( 'admin_menu', 'vdz_cb_menu' );
// create the Halloween Masks sub-menu
function vdz_cb_menu() {
	add_options_page( __( 'VDZ Call Back Settings Page', 'vdz-call-back' ), __( 'VDZ Call Back', 'vdz-call-back' ), 'manage_options', 'vdz-call-back', 'vdz_call_back_settings_page' );

	// Вызываем ф-ции для регистрации настроек плагина
	add_action( 'admin_init', 'vdz_call_back_register_setting' );
}

// Регистрируем группы параметров
function vdz_call_back_register_setting() {
	// настройки для плагина
	register_setting( 'vdz_call_back_plugin_settings_group', 'vdz_cb_plugin_settings', 'vdz_call_back_plugin_settings_sanitize' );
	// настройки для попапа
	register_setting( 'vdz_call_back_popup_settings_group', 'vdz_cb_popup_settings', 'vdz_call_back_popup_settings_sanitize' );
	// Настройки для тестирования
	register_setting( 'vdz_call_back_test_settings_group', 'vdz_cb_test_settings', 'vdz_call_back_test_settings_sanitize' );
}
// Очистка данных плагина перед созранением в базу
function vdz_call_back_plugin_settings_sanitize( $input ) {
	$input['vdz_cb_plugin_email'] = isset( $input['vdz_cb_plugin_email'] ) ? sanitize_email( $input['vdz_cb_plugin_email'] ) : '';

	$input['vdz_cb_plugin_more_emails'] = isset( $input['vdz_cb_plugin_more_emails'] ) ? sanitize_text_field( $input['vdz_cb_plugin_more_emails'] ) : '';

	// Проверяем введенные данные оставляя только email в строке настроек
	if ( ! empty( $input['vdz_cb_plugin_more_emails'] ) ) {
		if ( substr_count( $input['vdz_cb_plugin_more_emails'], ',' ) ) {
			$vdz_cb_plugin_more_emails_arr = explode( ',', $input['vdz_cb_plugin_more_emails'] );
			if ( is_array( $vdz_cb_plugin_more_emails_arr ) ) {
				$allow_emails = array();
				foreach ( $vdz_cb_plugin_more_emails_arr as $email ) {
					$allow_email = sanitize_email( $email );
					if ( ! empty( $allow_email ) ) {
						$allow_emails[] = $allow_email;
					}
				}
				$vdz_cb_plugin_more_emails_arr = $allow_emails;
			}
			if ( ! empty( $vdz_cb_plugin_more_emails_arr ) && is_array( $vdz_cb_plugin_more_emails_arr ) ) {
				$input['vdz_cb_plugin_more_emails'] = implode( ',', $vdz_cb_plugin_more_emails_arr );
			}
		} else {
			$input['vdz_cb_plugin_more_emails'] = sanitize_email( $input['vdz_cb_plugin_more_emails'] );
		}
	}

	$input['vdz_cb_plugin_custom_mail']         = isset( $input['vdz_cb_plugin_custom_mail'] ) ? (int) ( $input['vdz_cb_plugin_custom_mail'] ) : 0;
	$input['vdz_cb_plugin_custom_mail_text']    = isset( $input['vdz_cb_plugin_custom_mail_text'] ) ? sanitize_textarea_field( $input['vdz_cb_plugin_custom_mail_text'] ) : '';
	$input['vdz_cb_plugin_custom_mail_subject'] = isset( $input['vdz_cb_plugin_custom_mail_subject'] ) ? sanitize_text_field( $input['vdz_cb_plugin_custom_mail_subject'] ) : '';

	$input['vdz_cb_popup_action_button_class'] = isset( $input['vdz_cb_popup_action_button_class'] ) ? sanitize_text_field( $input['vdz_cb_popup_action_button_class'] ) : '';

	// Добавляем вывод сообщения при успешном сохранении
	add_settings_error( 'vdz_cb_plugin_settings', 'settings_updated', __( 'Plugin Settings UPDATED', 'vdz-call-back' ), 'updated' );

	return $input;
}
// Очистка данных попапа перед созранением в базу
function vdz_call_back_popup_settings_sanitize( $input ) {
	$input['vdz_cb_popup_title']    = isset( $input['vdz_cb_popup_title'] ) ? sanitize_text_field( $input['vdz_cb_popup_title'] ) : '';
	$input['vdz_cb_popup_mask']     = isset( $input['vdz_cb_popup_mask'] ) ? sanitize_text_field( $input['vdz_cb_popup_mask'] ) : '';
	$input['vdz_cb_popup_mask_off'] = isset( $input['vdz_cb_popup_mask_off'] ) ? boolval( $input['vdz_cb_popup_mask_off'] ) : false;

	$input['vdz_cb_popup_name_required'] = isset( $input['vdz_cb_popup_name_required'] ) ? boolval( $input['vdz_cb_popup_name_required'] ) : false;
	$input['vdz_cb_popup_name_disable']  = isset( $input['vdz_cb_popup_name_disable'] ) ? boolval( $input['vdz_cb_popup_name_disable'] ) : false;

	$input['vdz_cb_popup_name']          = isset( $input['vdz_cb_popup_name'] ) ? sanitize_text_field( $input['vdz_cb_popup_name'] ) : '';
	$input['vdz_cb_popup_phone']         = isset( $input['vdz_cb_popup_phone'] ) ? sanitize_text_field( $input['vdz_cb_popup_phone'] ) : '';
	$input['vdz_cb_popup_button']        = isset( $input['vdz_cb_popup_button'] ) ? wp_kses_post( $input['vdz_cb_popup_button'] ) : '';
	$input['vdz_cb_popup_button_class']  = isset( $input['vdz_cb_popup_button_class'] ) ? sanitize_text_field( $input['vdz_cb_popup_button_class'] ) : '';
	$input['vdz_cb_popup_text']          = isset( $input['vdz_cb_popup_text'] ) ? wp_kses_post( $input['vdz_cb_popup_text'] ) : '';
	$allowed_tags                        = vdz_get_allow_html_tags();
	$input['vdz_cb_popup_custom_fields'] = isset( $input['vdz_cb_popup_custom_fields'] ) ? wp_kses( $input['vdz_cb_popup_custom_fields'], $allowed_tags ) : '';
	$input['vdz_cb_popup_success']       = isset( $input['vdz_cb_popup_success'] ) ? wp_kses_post( $input['vdz_cb_popup_success'] ) : '';
	$input['vdz_cb_popup_error']         = isset( $input['vdz_cb_popup_error'] ) ? wp_kses_post( $input['vdz_cb_popup_error'] ) : '';

	// Добавляем вывод сообщения при успешном сохранении
	add_settings_error( 'vdz_cb_popup_settings', 'settings_updated', __( 'Popup Settings UPDATED', 'vdz-call-back' ), 'updated' );

	return $input;
}
// Очистка данных для тестирования перед созранением в базу
function vdz_call_back_test_settings_sanitize( $input ) {
	$input['vdz_cb_test_shortcode'] = wp_kses_post( $input['vdz_cb_test_shortcode'] );

	// Добавляем вывод сообщения при успешном сохранении
	add_settings_error( 'vdz_cb_test_settings', 'settings_updated', __( 'TEST Settings UPDATED', 'vdz-call-back' ), 'updated' );

	return $input;
}

// Рендерим всю нашу страницу настроек
function vdz_call_back_settings_page() {
	global $vdz_cb_admin_view_obj;
	$code_str = $vdz_cb_admin_view_obj->render(
		'layout_settings_page',
		array(
			'vdz_cb_admin_view_obj' => $vdz_cb_admin_view_obj,
		)
	);
	// echo $code_str;
	echo wp_kses( $code_str, vdz_get_allow_html_tags() );
}



// Ссылка на настройки плагина в списке плагинов
add_filter( 'plugin_action_links', 'vdz_cb_plugin_action_links', 10, 2 );
function vdz_cb_plugin_action_links( $links, $file ) {
	// Если это наш файл плагина - добавлем ссылку
	if ( $file == plugin_basename( VDZ_CALL_BACK_FILE ) ) {
		// echo get_admin_url();
		$settings_link  = '<a href="' . get_admin_url() . 'options-general.php?page=vdz-call-back">' . __( 'Settings' ) . '</a>';
		$settings_link2 = '<a href="' . get_admin_url() . 'customize.php?autofocus[section]=vdz_call_back_section">' . __( 'Widget Settings' ) . '</a>';
		array_unshift( $links, $settings_link, $settings_link2 );
	}
	return $links;
}
/*END PAGES & LINKS*/

// Загрузка всех значений в csv формате
if ( substr_count( $_SERVER['REQUEST_URI'], 'data=data.csv' ) ) {
	// отправляем Заголовки
	header( 'Pragma: public' );
	header( 'Expires: 0' );
	header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
	header( 'Cache-Control: private', false );
	header( 'Content-Type: application/octet-stream' );
	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename="data.csv"' );
	// Получаем CSV
	$vdz_call_back_data_csv = vdz_call_back_do_csv();
	// echo $vdz_call_back_data_csv;
	echo wp_kses( $vdz_call_back_data_csv, vdz_get_allow_html_tags() );
	exit();
}
// Создание потока csv
function vdz_call_back_do_csv() {

	// Создаем указатель файлв в выходном потоке
	$output = fopen( 'php://output', 'w' );
	$data   = VDZ_CALL_BACK_DATA::GET();
	if ( empty( $data ) ) {
		return null;
	}

	// Заголовки
	if ( ! empty( $data ) && isset( $data[0] ) && ! empty( $data[0] ) && is_array( $data[0] ) ) {
		$header = array_keys( $data[0] );
		fputcsv( $output, $header, ';' );
	}
	foreach ( $data as $row ) {
		fputcsv( $output, $row, ';' );
	}
	return $output;
}

// Очистка базы контактов
add_action(
	'plugins_loaded',
	function () {
		if ( substr_count( $_SERVER['REQUEST_URI'], '&remove_data=yes' ) ) {
			$return_url = str_replace( '&remove_data=yes', '', $_SERVER['REQUEST_URI'] );

			if ( defined( 'VDZ_CALL_BACK_DATA_FILE' ) && file_exists( VDZ_CALL_BACK_DATA_FILE ) ) {
				unlink( VDZ_CALL_BACK_DATA_FILE );
			}
			// Сообщение об удалении
			set_transient( 'vdz_call_back_remove_data', true, 5 );
			wp_redirect( $return_url, 302 );
			exit;
			// exit($return_url);
		}
	}
);
// Добавляем вывод сообщения при удалении данных
add_action(
	'admin_notices',
	function () {
		if ( get_transient( 'vdz_call_back_remove_data' ) ) {
			?>
		<div class="error notice">
			<p><?php _e( 'Data REMOVED', 'vdz-call-back' ); ?></p>
		</div>
			<?php
			/* Delete transient, only display this notice once. */
			delete_transient( 'vdz_call_back_remove_data' );
		}
	}
);
