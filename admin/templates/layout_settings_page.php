<?php
/**
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ VDZ Call Back - WordPress plugin
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 */

?>

<div class="wrap">
	<div class="row ">
		<h1>
			<?php esc_html_e( 'VDZ Call Back Settings Page', 'vdz-call-back' ); ?>
		</h1>
	</div>
	<hr>
	<div class="row ">
		<div class="small-6 columns text-left">
			<a href="<?php echo get_admin_url(); ?>customize.php?autofocus[section]=vdz_call_back_section"><?php esc_html_e( 'VDZ CallBack Widget Settings' ); ?></a>
		</div>
		<div class="small-6 columns text-right">
			<?php
				$plugin_data = get_plugin_data( VDZ_CALL_BACK_FILE );
			if ( isset( $plugin_data['AuthorURI'] ) && ! empty( $plugin_data['AuthorURI'] ) && isset( $plugin_data['AuthorName'] ) && ! empty( $plugin_data['AuthorName'] ) ) :
				?>
					<a href="<?php echo esc_url( $plugin_data['AuthorURI'] ); ?>" target="_blank"><?php echo sanitize_text_field( $plugin_data['AuthorName'] ); ?></a>
			<?php endif; ?>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="small-12 columns">
			<ul class="tabs" data-tabs id="vdz-call-back">
				<li class="tabs-title  is-active"><a href="#popup_setttings" aria-selected="true"><?php esc_html_e( 'Popup Settings', 'vdz-call-back' ); ?></a></li>
				<li class="tabs-title"><a href="#plugin_setttings"><?php esc_html_e( 'Plugin Settings', 'vdz-call-back' ); ?></a></li>
				<li class="tabs-title"><a href="#test"><?php esc_html_e( 'Test', 'vdz-call-back' ); ?></a></li>
				<li class="tabs-title"><a href="#data_setttings"><?php esc_html_e( 'Data', 'vdz-call-back' ); ?></a></li>
				<li class="tabs-title"><a href="#info"><?php esc_html_e( 'Info', 'vdz-call-back' ); ?></a></li>
			</ul>
			<?php if ( isset( $vdz_cb_admin_view_obj ) ) : ?>
			<div class="tabs-content" data-tabs-content="vdz-call-back">
				<div class="tabs-panel is-active" id="popup_setttings">
					<?php echo wp_kses( $vdz_cb_admin_view_obj->render( 'popup_settings_tab' ), vdz_get_allow_html_tags() ); ?>
				</div>
				<div class="tabs-panel" id="plugin_setttings">
					<?php echo wp_kses( $vdz_cb_admin_view_obj->render( 'plugin_settings_tab' ), vdz_get_allow_html_tags() ); ?>
				</div>
				<div class="tabs-panel" id="test">
					<?php echo wp_kses( $vdz_cb_admin_view_obj->render( 'test_tab' ), vdz_get_allow_html_tags() ); ?>
				</div>
				<div class="tabs-panel" id="data_setttings">
					<?php echo wp_kses( $vdz_cb_admin_view_obj->render( 'data_tab' ), vdz_get_allow_html_tags() ); ?>
				</div>
				<div class="tabs-panel" id="info">
					<?php echo wp_kses( $vdz_cb_admin_view_obj->render( 'info_tab' ), vdz_get_allow_html_tags() ); ?>
				</div>
			</div>
			<?php endif; ?>


		</div>
	</div>
<pre>
<?php

// var_dump(get_current_screen());
?>
</pre>
</div>
