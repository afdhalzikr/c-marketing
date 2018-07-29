<?php
	/** Blaize Custom Controls **/
	require get_template_directory() . '/inc/blaize-custom-controls.php';

	/** Widget Areas **/
	require get_template_directory() . '/inc/widgets/register-widget-areas.php';

	/** Metaboxes **/
	require get_template_directory() . '/inc/blaize-metabox.php';

	/** Breadcrumb **/
	require get_template_directory() . '/inc/breadcrumbs.php';

	/** Template Hooks **/
	require get_template_directory() . '/inc/blaize-hooks.php';

	/** Custom template tags for this theme. **/
	require get_template_directory() . '/inc/template-tags.php';

	/** Implement the Custom Header feature.**/
	require get_template_directory() . '/inc/custom-header.php';

	/** Woocommerce Hooks.**/
	require get_template_directory() . '/inc/woo.php';

	/** TGM **/
	require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
	require get_template_directory() . '/inc/blaize-tgmpa.php';