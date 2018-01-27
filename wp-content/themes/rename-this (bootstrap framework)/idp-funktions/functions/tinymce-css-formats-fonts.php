<?php

/*

Title: TinyMCE Styles, Formats & Font Sizes

Version: 2.0

Last Updated: Sept 17, 2014

Description: Puts in default font sizes, block formats and your custom stylesheet

SETTING FORMAT
array(
	array( {fieldtype:text,textarea,truefalse,info}, {name/id}, {label}, {help/info}, {defaultvalue}, {help/info css styles} ) 
)
*/
$FNKOP[basename(__FILE__, '.php')] = array(
	array('text', 'tmce_formats', 'Text Formats', '', 'p,h1,h2,h3,h4,h5,h6'),
	array('text', 'tmce_sizes', 'Font Sizes', '', 'Small=10px,Medium=12px,Normal=14px,Large=16px,Extra Large=20px')
	);

add_filter( 'mce_css',  'idp_editorcss' );

add_filter('tiny_mce_before_init', 'idp_block_font' );

function idp_editorcss( $mce_css ){

	if ( ! empty( $mce_css ) )

		$mce_css .= ',';

	$custom = get_template_directory_uri().'/css/editor-style.css';	

	$mce_css .= str_replace( ',', '%2C', $custom );

	return $mce_css;

}

function idp_block_font($init) {
	$funkset = get_option('funktions');
	$formats = $funkset['tmce_formats'];
	$sizes = $funkset['tmce_sizes'];

	// Add block format elements you want to show in dropdown

	$init['theme_advanced_blockformats'] = $formats;

	$init['theme_advanced_font_sizes'] = $sizes;

		return $init;

}