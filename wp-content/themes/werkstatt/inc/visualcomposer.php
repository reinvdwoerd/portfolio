<?php
add_action('init', 'thb_VC_init');
function thb_VC_init() {
	if (function_exists('visual_composer')) {
		remove_action('wp_head', array(visual_composer(), 'addMetaData'));
		remove_action('wp_head', array(visual_composer(), 'addIEMinimalSupport'));
	}
}

add_action('init', 'thb_TheShortcodesForVC');
function thb_TheShortcodesForVC() {
	if (function_exists('visual_composer')) {
		if(function_exists('vc_set_default_editor_post_types')) { vc_set_default_editor_post_types( array('page', 'portfolio') ); }
		
		if(function_exists('vc_set_as_theme')) { vc_set_as_theme(); }
		
		add_filter( 'vc_load_default_templates', 'thb_custom_template_modify_array' );
		function thb_custom_template_modify_array( $data ) {
		    return array();
		}
		
		if (is_admin()) {
			function remove_vc_teaser() {
				remove_meta_box('vc_teaser', 'post' , 'side');
				remove_meta_box('vc_teaser', 'page' , 'side');
			}
			add_action( 'admin_head', 'remove_vc_teaser' );
		}
		
		// Shortcodes 
		require get_template_directory().'/inc/visualcomposer-extend.php';
		
		
		/* Offsets */
		function thb_column_offset_class_merge($class_string, $tag) {
	
			if($tag === 'vc_column' || $tag === 'vc_column_inner') {
				$class_string = preg_replace('/offset-/', 'push-', $class_string);
				$class_string = preg_replace('/vc_col-/', '', $class_string);
				$class_string = preg_replace('/lg/', 'large', $class_string);
				$class_string = preg_replace('/md/', 'medium', $class_string);
				$class_string = preg_replace('/sm/', 'small-12 medium', $class_string);
				$class_string = preg_replace('/xs/', 'small', $class_string);
				$class_string = preg_replace('/vc_column_container/', 'columns', $class_string);
				
				/* Change visibility */
				$class_string = preg_replace('/vc_hidden-large/', 'hide-for-large', $class_string);
				$class_string = preg_replace('/vc_hidden-medium/', 'hide-for-medium-only', $class_string);
				$class_string = preg_replace('/vc_hidden-small/', 'hide-for-small-only', $class_string);
				$class_string = preg_replace('/vc_hidden-smallall/', 'hide-for-small-only', $class_string);
			} else if ($tag === 'vc_row' || $tag === 'vc_row_inner') {
				$class_string = preg_replace('/vc_row/', 'row', $class_string);
			}
			return $class_string;
		}
		add_filter('vc_shortcodes_css_class', 'thb_column_offset_class_merge', 10, 2);
		
		// Remove visual composer plugin update notifications
		function thb_filter_vc_updates( $value ) {
			if ( isset($value) && is_object($value) ) {
		    unset( $value->response['js_composer/js_composer.php'] );
		    return $value;
			}
		}
		add_filter( 'site_transient_update_plugins', 'thb_filter_vc_updates' );
	}
}
if(!function_exists('thb_admin_css')) {
	function thb_admin_css() {
		echo '<style>';
			echo 'tr[data-slug="slider-revolution"] + .plugin-update-tr, .vc_license-activation-notice, .rs-update-notice-wrap, tr.plugin-update-tr.active#js_composer-update { display: none !important;}';
		echo '</style>';
	}
}
add_action('admin_head', 'thb_admin_css');