<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */
?>

<h3><?php esc_html_e( 'Plugin Settings', 'vdz-call-back' ); ?></h3>
<form action="options.php" method="POST">
	<?php
		// Выводи идентификаторы группы полей + wp_nonce для нашего действия
		settings_fields( 'vdz_call_back_plugin_settings_group' );
		// Получаем данные из базы
		$vdz_cb_plugin_settings = get_option( 'vdz_cb_plugin_settings' );
	?>
	<div class="row">
		<div class="medium-12 columns">
			<label><?php esc_html_e( 'Send Email to:', 'vdz-call-back' ); ?>
				<input type="email" placeholder="<?php echo sanitize_email( get_option( 'admin_email' ) ); ?>" name="vdz_cb_plugin_settings[vdz_cb_plugin_email]" value="<?php echo isset( $vdz_cb_plugin_settings['vdz_cb_plugin_email'] ) ? esc_attr( $vdz_cb_plugin_settings['vdz_cb_plugin_email'] ) : ''; ?>">
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default send on WordPress admin email: ', 'vdz-call-back' ); ?>
				<a href="mailto:<?php echo sanitize_email( get_option( 'admin_email' ) ); ?>"><?php echo sanitize_email( get_option( 'admin_email' ) ); ?></a>
				<button class="close-button hide" aria-label="Dismiss alert" type="button" data-close>
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		<div class="medium-12 columns">
			<label><?php esc_html_e( 'Send to other Emails:', 'vdz-call-back' ); ?>
				<input type="text" placeholder="<?php echo sanitize_email( get_option( 'admin_email' ) ); ?>,<?php echo sanitize_email( get_option( 'admin_email' ) ); ?>" name="vdz_cb_plugin_settings[vdz_cb_plugin_more_emails]" value="<?php echo isset( $vdz_cb_plugin_settings['vdz_cb_plugin_more_emails'] ) ? esc_attr( $vdz_cb_plugin_settings['vdz_cb_plugin_more_emails'] ) : ''; ?>">
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Enter a comma-delimited email address with no spaces', 'vdz-call-back' ); ?>
				<button class="close-button hide" aria-label="Dismiss alert" type="button" data-close>
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		<div class="medium-12 columns">
			<label>
				<?php esc_html_e( 'Action button class:', 'vdz-call-back' ); ?>
				<input type="text" placeholder="vdz_cb_btn " name="vdz_cb_plugin_settings[vdz_cb_popup_action_button_class]" value="<?php echo isset( $vdz_cb_plugin_settings['vdz_cb_popup_action_button_class'] ) ? esc_attr( $vdz_cb_plugin_settings['vdz_cb_popup_action_button_class'] ) : ''; ?>">
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default use class "vdz_cb_btn"', 'vdz-call-back' ); ?>
			</div>
		</div>
		<div class="medium-12 columns">
			<label><?php esc_html_e( 'Mail subject', 'vdz-call-back' ); ?>
				<input type="text" placeholder="<?php esc_html_e( 'Call back', 'vdz-call-back' ); ?>" name="vdz_cb_plugin_settings[vdz_cb_plugin_custom_mail_subject]" value="<?php echo isset( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_subject'] ) ? esc_attr( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_subject'] ) : ''; ?>">
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default subject: ', 'vdz-call-back' ) . ' "' . __( 'Call back', 'vdz-call-back' ) . '"'; ?>
			</div>
		</div>
		<div class="medium-12 columns">
			<label>
				<strong><?php esc_html_e( 'Use custom mail', 'vdz-call-back' ); ?></strong>
				<input type="checkbox" name="vdz_cb_plugin_settings[vdz_cb_plugin_custom_mail]" value="1" <?php echo ( isset( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail'] ) && ( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail'] == 1 ) ) ? 'checked="checked"' : ''; ?>>
			</label>
		</div>
		<div class="medium-12 columns">

			<label>
				<?php esc_html_e( 'Custom mail Text', 'vdz-call-back' ); ?>
				<textarea name="vdz_cb_plugin_settings[vdz_cb_plugin_custom_mail_text]" id="" cols="30" rows="5"><?php echo isset( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_text'] ) ? esc_attr( $vdz_cb_plugin_settings['vdz_cb_plugin_custom_mail_text'] ) : ''; ?></textarea>
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default empty. Use only TEXT here. Shortcode for send information: [name], [phone], [page]', 'vdz-call-back' ); ?>
			</div>
		</div>
		<div class="medium-12 columns">
			<button type="submit" class="button-primary button">
				<?php esc_html_e( 'Save Plugin options', 'vdz-call-back' ); ?>
			</button>
		</div>
	</div>
</form>
