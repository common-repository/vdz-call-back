<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */
?>
<h3><?php esc_html_e( 'Data', 'vdz-call-back' ); ?></h3>

<?php
$vdz_cb_data = VDZ_CALL_BACK_DATA::GET();
if ( ! empty( $vdz_cb_data ) && is_array( $vdz_cb_data ) ) :
	?>
	<p id="data_btn_in_admin">
		<a href="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>&data=data.csv" target="_blank" class="button success"><?php esc_html_e( 'Download all', 'vdz-call-back' ); ?></a>
		<a href="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>&remove_data=yes" class="float-right button alert"><?php esc_html_e( 'Remove all', 'vdz-call-back' ); ?></a>
	</p>
	<div class="clearfix"></div>
	<p><strong><?php esc_html_e( 'Last 20 CALL BACK requests:', 'vdz-call-back' ); ?></strong></p>
<dl>
	<?php foreach ( $vdz_cb_data as $key_data => $item_arr ) : ?>
		<dt><?php echo sanitize_text_field( $key_data + 1 ); ?></dt>
		<dd>
			<ul>
				<?php foreach ( $item_arr as $item_key => $item_value ) : ?>
				<li>
					<strong><?php echo sanitize_text_field( $item_key ); ?>:</strong> <?php echo sanitize_text_field( $item_value ); ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<hr/>
		</dd>
	<?php endforeach; ?>
</dl>
<?php endif; ?>
