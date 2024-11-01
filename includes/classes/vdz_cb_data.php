<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */

if ( ! defined( 'VDZ_CALL_BACK_VERSION' ) || ! defined( 'VDZ_CALL_BACK_DATA_FILE' ) ) {
	wp_die( 'Not defined VDZ_CALL_BACK_VERSION of VDZ_CALL_BACK_DATA_FILE' );
}

/**
 * Class VDZ_CALL_BACK_DATA
 */
class VDZ_CALL_BACK_DATA {

	/**
	 * @param array $array_value Save all data in file
	 */
	static function PUSH( $array_value ) {
		if ( ! is_array( $array_value ) ) {
			$array_value = array(
				'data' => $array_value,
			);
		}
		$push_arr = array(
			'date_time' => date( 'Y-m-d H:i:s', time() ),
		);
		$push_arr = array_merge( $push_arr, $array_value );
		$data_str = serialize( $push_arr ) . PHP_EOL;

		file_put_contents( VDZ_CALL_BACK_DATA_FILE, $data_str, FILE_APPEND | LOCK_EX );
	}


	/**
	 * @return array|bool Get all data from file
	 */
	static function GET() {
		if ( ! file_exists( VDZ_CALL_BACK_DATA_FILE ) ) {
			return false;
		}

		$file_data_arr = file( VDZ_CALL_BACK_DATA_FILE );
		if ( empty( $file_data_arr ) ) {
			return false;
		}

		foreach ( $file_data_arr as $key => $value ) {
			$file_data_arr[ $key ] = unserialize( $value );
		}
		krsort( $file_data_arr );
		return array_slice( $file_data_arr, 0, 20 );
	}

	/**
	 * @return bool|int Get count records of data in file
	 */
	static function GET_COUNT() {
		if ( ! file_exists( VDZ_CALL_BACK_DATA_FILE ) ) {
			return false;
		}

		$file_data_arr = file( VDZ_CALL_BACK_DATA_FILE );
		if ( empty( $file_data_arr ) ) {
			return 0;
		}
		return count( $file_data_arr );
	}
}



