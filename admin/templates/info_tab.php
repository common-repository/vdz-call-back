<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */
?>
<h3><?php esc_html_e( 'Info', 'vdz-call-back' ); ?></h3>

<ul class="accordion" data-accordion>
	<li class="accordion-item is-active" data-accordion-item>
		<a href="#" class="accordion-title"><?php esc_html_e( 'Usage shortcode', 'vdz-call-back' ); ?></a>
		<div class="accordion-content" data-tab-content>
			<strong>[vdz_cb]popup button[/vdz_cb]</strong>
		</div>
	</li>
	<li class="accordion-item" data-accordion-item>
		<a href="#" class="accordion-title"><?php esc_html_e( 'Data', 'vdz-call-back' ); ?></a>
		<div class="accordion-content" data-tab-content>
			<?php echo sanitize_text_field( sprintf( __( 'Found %d Call back records', 'vdz-call-back' ), VDZ_CALL_BACK_DATA::GET_COUNT() ) ); ?>
		</div>
	</li>
	<li class="accordion-item" data-accordion-item>
		<a href="#" class="accordion-title"><?php esc_html_e( 'VDZ Call back Plugin', 'vdz-call-back' ); ?></a>
		<div class="accordion-content" data-tab-content>
			<?php
				$plugin_data = get_plugin_data( VDZ_CALL_BACK_FILE );
			// print_r($plugin_data);
			?>
			<p><strong><?php esc_html_e( 'Version:', 'vdz-call-back' ); ?></strong></p>
			<div class="stat"><?php echo sanitize_text_field( VDZ_CALL_BACK_VERSION ); ?></div>
			<hr/>
			<?php if ( isset( $plugin_data['AuthorURI'] ) && ! empty( $plugin_data['AuthorURI'] ) && isset( $plugin_data['AuthorName'] ) && ! empty( $plugin_data['AuthorName'] ) ) : ?>
				<p><strong><?php esc_html_e( 'Site & Author:', 'vdz-call-back' ); ?></strong></p>
				<div class="stat">
					<a href="<?php echo esc_url( $plugin_data['AuthorURI'] ); ?>" target="_blank"><?php echo sanitize_text_field( $plugin_data['AuthorName'] ); ?></a>
				</div>
				<hr/>
			<?php endif; ?>
			<?php
				$vdz_cb_log = VDZ_CALL_BACK_LOG::GET();
			if ( ! empty( $vdz_cb_log ) && is_array( $vdz_cb_log ) ) :
				?>
			<p><strong><?php esc_html_e( 'Log:', 'vdz-call-back' ); ?></strong></p>
			<dl>
				<?php foreach ( $vdz_cb_log as $item_arr ) : ?>
					<dt><?php echo sanitize_text_field( $item_arr['msg'] ); ?></dt>
					<dd><?php echo sanitize_text_field( $item_arr['date_time'] ); ?></dd>
				<?php endforeach; ?>
			</dl>
			<?php endif; ?>
		</div>
	</li>
</ul>
