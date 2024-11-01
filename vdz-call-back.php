<?php
/*
Plugin Name: VDZ Call Back Plugin
Plugin URI:  http://online-services.org.ua
Description: Simple CALL BACK from shortcode with customization
Version:     1.15.16
Author:      VadimZ
Author URI:  http://online-services.org.ua#vdz_call_back
Text Domain: vdz-call-back
Domain Path: /languages
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define( 'VDZ_CALL_BACK_VERSION', '1.15.16' );
define( 'VDZ_CALL_BACK_DOMAIN', 'vdz-call-back' );
define( 'VDZ_CALL_BACK_API', 'vdz_info_call_back' );

define( 'VDZ_CALL_BACK_DIR', plugin_dir_path( __FILE__ ) );
define( 'VDZ_CALL_BACK_URL', plugin_dir_url( __FILE__ ) );
define( 'VDZ_CALL_BACK_FILE', __FILE__ );
define( 'VDZ_CALL_BACK_DATA_FILE', plugin_dir_path( __FILE__ ) . 'data' . DIRECTORY_SEPARATOR . 'bkp.db' );
define( 'VDZ_CALL_BACK_LOG_FILE', plugin_dir_path( __FILE__ ) . 'data' . DIRECTORY_SEPARATOR . 'vdz_cb.log' );

// Init plugin
require_once VDZ_CALL_BACK_DIR . 'includes/vdz_cb_construct.php';
require_once 'updated_plugin_admin_notices.php';



// Код деактивации плагина
register_deactivation_hook( __FILE__, function () {
	$plugin_name = preg_replace( '|\/(.*)|', '', plugin_basename( __FILE__ ));
	$response = wp_remote_get( "http://api.online-services.org.ua/off/{$plugin_name}" );
	if ( ! is_wp_error( $response ) && isset( $response['body'] ) && ( json_decode( $response['body'] ) !== null ) ) {
		//TODO Вывод сообщения для пользователя
	}
} );
//Сообщение при отключении плагина
add_action( 'admin_init', function (){
	if(is_admin()){
		$plugin_data = get_plugin_data(__FILE__);
		$plugin_name = isset($plugin_data['Name']) ? $plugin_data['Name'] : ' us';
		$plugin_dir_name = preg_replace( '|\/(.*)|', '', plugin_basename( __FILE__ ));
		$handle = 'admin_'.$plugin_dir_name;
		wp_register_script( $handle, '', null, false, true );
		wp_enqueue_script( $handle );
		$msg = '';
		if ( function_exists( 'get_locale' ) && in_array( get_locale(), array( 'uk', 'ru_RU' ), true ) ) {
			$msg .= "Спасибо, что были с нами! ({$plugin_name}) Хорошего дня!";
		}else{
			$msg .= "Thanks for your time with us! ({$plugin_name}) Have a nice day!";
		}
		wp_add_inline_script( $handle, "document.getElementById('deactivate-".esc_attr($plugin_dir_name)."').onclick=function (e){alert('".esc_attr( $msg )."');}" );
	}
} );

