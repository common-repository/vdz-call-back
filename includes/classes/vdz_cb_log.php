<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */

if ( ! defined( 'VDZ_CALL_BACK_VERSION' ) || ! defined( 'VDZ_CALL_BACK_LOG_FILE' ) ) {
	wp_die( 'Not defined VDZ_CALL_BACK_VERSION of VDZ_CALL_BACK_LOG_FILE' );
}

/**
 * Class VDZ_CALL_BACK_LOG
 */
class VDZ_CALL_BACK_LOG {

	/**
	 * @param string $value Msg for save in Log file
	 */
	static function PUSH( $value ) {
		$push_arr = array(
			'msg'       => $value,
			'date_time' => date( 'Y-m-d H:i:s', time() ),
		);
		$log_str  = serialize( $push_arr ) . PHP_EOL;
		file_put_contents( VDZ_CALL_BACK_LOG_FILE, $log_str, FILE_APPEND | LOCK_EX );
	}

	/**
	 * @return array|bool Get all data from Log file
	 */
	static function GET() {
		if ( ! file_exists( VDZ_CALL_BACK_LOG_FILE ) ) {
			return false;
		}

		$file_data_arr = file( VDZ_CALL_BACK_LOG_FILE );
		if ( empty( $file_data_arr ) ) {
			return false;
		}

		foreach ( $file_data_arr as $key => $value ) {
			$file_data_arr[ $key ] = unserialize( $value );
		}
		krsort( $file_data_arr );
		return $file_data_arr;
	}
}



