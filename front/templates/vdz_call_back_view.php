<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */

?>

<a id="vdz_cb_btn<?php echo ( ( $shortcode_count > 0 ) ? $shortcode_count : '' ); ?>" class="vdz_cb_btn  <?php echo sanitize_html_class( $vdz_cb_popup_action_button_class ); ?>" href="#vdz_cb" title="<?php esc_attr_e( $vdz_cb_btn_title ); ?>">
	<?php echo wp_kses( $vdz_cb_popup_button_open, vdz_get_allow_html_tags() ); ?>
</a>

<?php if ( $shortcode_count == 0 ) : ?>
<div id="vdz_cb" style="display:none;">
	<h3><?php echo sanitize_text_field( $vdz_cb_popup_title ); ?></h3>
	<form id="vdz_cb_form">
	<?php wp_nonce_field( 'vdz_cb' ); ?>

		<?php if ( ! $vdz_cb_popup_name_disable ) : ?>
		<input id="vdz_cb_name" type="text" name="name" minlength="3" maxlength="50" placeholder="<?php esc_attr_e( $vdz_cb_popup_name ); ?>" <?php echo ( isset( $vdz_cb_popup_name_required ) && ! empty( $vdz_cb_popup_name_required ) ) ? 'required="required"' : ''; ?>>
		<?php endif; ?>

	<input id="vdz_cb_phone" type="text" name="phone" required="required" placeholder="<?php esc_attr_e( $vdz_cb_popup_phone ); ?>*" data-mask="<?php esc_attr_e( $vdz_cb_popup_mask ); ?>" data-mask_off="<?php echo ( isset( $vdz_cb_popup_mask_off ) && ! empty( $vdz_cb_popup_mask_off ) ) ? 'off' : 'on'; ?>">
	<input type="hidden" name="action" value="vdz_cb_send" >
<!--<input id="full_phone" type="hidden" name="full_phone">-->

		<?php if ( ! empty( $vdz_cb_popup_custom_fields ) ) : ?>
			<div class="vdz_custom_fields">
				<?php echo do_shortcode( wp_kses( $vdz_cb_popup_custom_fields, vdz_get_allow_html_tags() ) ); ?>
			</div>
		<?php endif; ?>

		<button class="button btn btn-default <?php echo sanitize_html_class( $vdz_cb_popup_button_class ); ?>" type="submit"><?php echo sanitize_text_field( $vdz_cb_popup_button ); ?></button>
		<?php if ( ! empty( $vdz_cb_popup_text ) ) : ?>
		<hr/>
		<div>
			<?php echo do_shortcode( wp_kses( $vdz_cb_popup_text, vdz_get_allow_html_tags() ) ); ?>
		</div>
		<?php endif; ?>
	</form>
	<div id="vdz_cb_unsver">
		<div class="warning" style="display: none;"><?php echo wp_kses( $vdz_cb_popup_error, vdz_get_allow_html_tags() ); ?></div>
		<div class="success" style="display: none;"><?php echo wp_kses( $vdz_cb_popup_success, vdz_get_allow_html_tags() ); ?></div>
	</div>
</div>
<?php endif; ?>
