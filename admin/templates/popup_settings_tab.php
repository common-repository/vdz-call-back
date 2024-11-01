<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */
?>

<h3><?php esc_html_e( 'Popup Settings', 'vdz-call-back' ); ?></h3>
<form action="options.php" method="POST">
	<?php
	// Выводи идентификаторы группы полей + wp_nonce для нашего действия
	settings_fields( 'vdz_call_back_popup_settings_group' );
	// Получаем данные из базы
	$vdz_cb_popup_settings = get_option( 'vdz_cb_popup_settings' );
	?>
	<div class="row">
		<div class="medium-12 columns">
			<label>
				<?php esc_html_e( 'Popup Title:', 'vdz-call-back' ); ?>
				<input type="text" placeholder="<?php esc_html_e( 'Call back', 'vdz-call-back' ); ?>" name="vdz_cb_popup_settings[vdz_cb_popup_title]" value="<?php echo isset( $vdz_cb_popup_settings['vdz_cb_popup_title'] ) ? esc_attr( $vdz_cb_popup_settings['vdz_cb_popup_title'] ) : ''; ?>">
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default use text "Call back"', 'vdz-call-back' ); ?>
			</div>
		</div>
		<div class="medium-12 columns">
			<label>
				<?php esc_html_e( 'Name placeholder:', 'vdz-call-back' ); ?>
				<input type="text" placeholder="<?php esc_html_e( 'Name', 'vdz-call-back' ); ?>" name="vdz_cb_popup_settings[vdz_cb_popup_name]" value="<?php echo isset( $vdz_cb_popup_settings['vdz_cb_popup_name'] ) ? esc_attr( $vdz_cb_popup_settings['vdz_cb_popup_name'] ) : ''; ?>">
			</label>
			<label>
				<strong><?php esc_html_e( 'Required field Name: ', 'vdz-call-back' ); ?></strong>
				<input type="checkbox" name="vdz_cb_popup_settings[vdz_cb_popup_name_required]" value="1" <?php echo ( isset( $vdz_cb_popup_settings['vdz_cb_popup_name_required'] ) && ( $vdz_cb_popup_settings['vdz_cb_popup_name_required'] == 1 ) ) ? 'checked="checked"' : ''; ?> >
			</label>
			<label style="margin: 8px 0;">
				<strong><?php esc_html_e( 'Disable field Name: ', 'vdz-call-back' ); ?></strong>
				<input type="checkbox" name="vdz_cb_popup_settings[vdz_cb_popup_name_disable]" value="1" <?php echo ( isset( $vdz_cb_popup_settings['vdz_cb_popup_name_disable'] ) && ( $vdz_cb_popup_settings['vdz_cb_popup_name_disable'] == 1 ) ) ? 'checked="checked"' : ''; ?> >
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default use text "Name"', 'vdz-call-back' ); ?>
			</div>
		</div>
		<div class="medium-12 columns">
			<label>
				<?php esc_html_e( 'Phone placeholder:', 'vdz-call-back' ); ?>
				<input type="text" placeholder="<?php esc_html_e( 'Phone', 'vdz-call-back' ); ?>" name="vdz_cb_popup_settings[vdz_cb_popup_phone]" value="<?php echo isset( $vdz_cb_popup_settings['vdz_cb_popup_phone'] ) ? esc_attr( $vdz_cb_popup_settings['vdz_cb_popup_phone'] ) : ''; ?>">
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default use text "Phone"', 'vdz-call-back' ); ?>
			</div>
		</div>
		<div class="medium-12 columns">
			<label>
				<?php esc_html_e( 'Phone Mask: ', 'vdz-call-back' ); ?>
				<input type="text" placeholder="(999) 999-99-99" name="vdz_cb_popup_settings[vdz_cb_popup_mask]" value="<?php echo isset( $vdz_cb_popup_settings['vdz_cb_popup_mask'] ) ? esc_attr( $vdz_cb_popup_settings['vdz_cb_popup_mask'] ) : ''; ?>">
			</label>

			<label>
				<strong><?php esc_html_e( 'Deactivate Phone Mask: ', 'vdz-call-back' ); ?></strong>
				<input type="checkbox" name="vdz_cb_popup_settings[vdz_cb_popup_mask_off]" value="1" <?php echo ( isset( $vdz_cb_popup_settings['vdz_cb_popup_mask_off'] ) && ( $vdz_cb_popup_settings['vdz_cb_popup_mask_off'] == 1 ) ) ? 'checked="checked"' : ''; ?>>
			</label>
			<div class="success callout" data-closable>
				<?php echo sprintf( __( 'Default mask (XXX) XXX-XX-XX. For customize see more  %s', 'vdz-call-back' ), '<a href="https://github.com/digitalBush/jquery.maskedinput" target="_blank">jQuery masked input popup</a>' ); ?>
				<button class="close-button hide" aria-label="Dismiss alert" type="button" data-close>
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		<div class="medium-12 columns">
			<label>
				<?php esc_html_e( 'Popup button text:', 'vdz-call-back' ); ?>
				<input type="text" placeholder="<?php esc_html_e( 'Send', 'vdz-call-back' ); ?>" name="vdz_cb_popup_settings[vdz_cb_popup_button]" value="<?php echo isset( $vdz_cb_popup_settings['vdz_cb_popup_button'] ) ? esc_attr( $vdz_cb_popup_settings['vdz_cb_popup_button'] ) : ''; ?>">
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default use text "Send"', 'vdz-call-back' ); ?>
			</div>
		</div>
		<div class="medium-12 columns">
			<label>
				<?php esc_html_e( 'Popup button class:', 'vdz-call-back' ); ?>
				<input type="text" placeholder="button btn btn-default " name="vdz_cb_popup_settings[vdz_cb_popup_button_class]" value="<?php echo isset( $vdz_cb_popup_settings['vdz_cb_popup_button_class'] ) ? esc_attr( $vdz_cb_popup_settings['vdz_cb_popup_button_class'] ) : ''; ?>">
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default use class "button btn btn-default"', 'vdz-call-back' ); ?>
			</div>
		</div>
		<div class="medium-12 columns">
			<label>
				<?php esc_html_e( 'Custom form fields', 'vdz-call-back' ); ?>
				<textarea name="vdz_cb_popup_settings[vdz_cb_popup_custom_fields]" id="" cols="30" rows="5"><?php echo isset( $vdz_cb_popup_settings['vdz_cb_popup_custom_fields'] ) ? esc_attr( $vdz_cb_popup_settings['vdz_cb_popup_custom_fields'] ) : ''; ?></textarea>
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default empty. Use TEXT or HTML here. Allow Input / Textarea / Select / Option tags.', 'vdz-call-back' ); ?>
				<br>
				<?php esc_html_e( 'You can use a shortcode. But before outputting, all the code will be cleaned up by the wp_kses function for safe output.', 'vdz-call-back' ); ?>
			</div>
		</div>
		<div class="medium-12 columns">
			<label>
				<?php esc_html_e( 'Popup Text', 'vdz-call-back' ); ?>
				<textarea name="vdz_cb_popup_settings[vdz_cb_popup_text]" id="" cols="30" rows="5"><?php echo isset( $vdz_cb_popup_settings['vdz_cb_popup_text'] ) ? esc_attr( $vdz_cb_popup_settings['vdz_cb_popup_text'] ) : ''; ?></textarea>
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default empty. Use TEXT or HTML here.', 'vdz-call-back' ); ?>
				<br>
				<?php esc_html_e( 'You can use a shortcode. But before outputting, all the code will be cleaned up by the wp_kses function for safe output.', 'vdz-call-back' ); ?>
			</div>
		</div>
		<div class="medium-12 columns">
			<label>
				<?php esc_html_e( 'Error text after send', 'vdz-call-back' ); ?>
				<textarea name="vdz_cb_popup_settings[vdz_cb_popup_error]" id="" cols="30" rows="2" placeholder="<?php esc_html_e( 'Error', 'vdz-call-back' ); ?>"><?php echo isset( $vdz_cb_popup_settings['vdz_cb_popup_error'] ) ? esc_attr( $vdz_cb_popup_settings['vdz_cb_popup_error'] ) : ''; ?></textarea>
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default use text "Error". Use TEXT or HTML here', 'vdz-call-back' ); ?>
			</div>
		</div>

		<div class="medium-12 columns">
			<label>
				<?php esc_html_e( 'Success text after send', 'vdz-call-back' ); ?>
				<textarea name="vdz_cb_popup_settings[vdz_cb_popup_success]" id="" cols="30" rows="2" placeholder="<?php esc_html_e( 'Thank you!', 'vdz-call-back' ); ?>"><?php echo isset( $vdz_cb_popup_settings['vdz_cb_popup_success'] ) ? esc_attr( $vdz_cb_popup_settings['vdz_cb_popup_success'] ) : ''; ?></textarea>
			</label>
			<div class="success callout" data-closable>
				<?php esc_html_e( 'Default use text "Thank you!". Use TEXT or HTML here', 'vdz-call-back' ); ?>
			</div>
		</div>
		<div class="medium-12 columns">
			<button type="submit" class="button-primary button">
				<?php esc_html_e( 'Save Popup options', 'vdz-call-back' ); ?>
			</button>
		</div>
	</div>
</form>
