<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */
?>
<h3><?php esc_html_e( 'Test', 'vdz-call-back' ); ?></h3>

<form action="options.php" method="POST">
<?php
// Выводи идентификаторы группы полей + wp_nonce для нашего действия
settings_fields( 'vdz_call_back_test_settings_group' );
// Получаем данные из базы
$vdz_cb_test_settings = get_option( 'vdz_cb_test_settings' );
?>
	<div class="row">
	<div class="medium-12 columns">
		<label>
			<?php esc_html_e( 'Shortcode:', 'vdz-call-back' ); ?>
			<input type="text" placeholder="<?php esc_html_e( 'Write your shortcode here', 'vdz-call-back' ); ?>" name="vdz_cb_test_settings[vdz_cb_test_shortcode]" value="<?php esc_attr_e( $vdz_cb_test_settings['vdz_cb_test_shortcode'] ); ?>">
		</label>
		<div class="success callout" data-closable>
			<?php esc_html_e( 'Default use code:', 'vdz-call-back' ); ?> "[vdz_cb]popup button[/vdz_cb]"
		</div>
	</div>
		<div class="medium-12 columns">
			<button type="submit" class="button-primary button">
				<?php esc_html_e( 'Save TEST options', 'vdz-call-back' ); ?>
			</button>
		</div>
	</div>
</form>
<hr/>
<h3><?php esc_html_e( 'Shortcode in action:', 'vdz-call-back' ); ?></h3>
<div class="warning callout" data-closable>
	<p><?php esc_html_e( 'Warning on this page used WordPress and foundation framework styles. Your fields and button styles may be different on front', 'vdz-call-back' ); ?></p>
</div>
<hr/>
<div class="row">
	<div class="medium-12 columns">
		<?php
			$vdz_cb_test_shortcode = ! empty( $vdz_cb_test_settings['vdz_cb_test_shortcode'] ) ? $vdz_cb_test_settings['vdz_cb_test_shortcode'] : '[vdz_cb]popup button[/vdz_cb]';

		$vdz_call_back_widget_str = do_shortcode( $vdz_cb_test_shortcode );
		$vdz_call_back_widget_str = preg_replace( '|<!--(.*)-->|s', '', $vdz_call_back_widget_str );
		echo wp_kses( $vdz_call_back_widget_str, vdz_get_allow_html_tags() );
		?>
	</div>
</div>
