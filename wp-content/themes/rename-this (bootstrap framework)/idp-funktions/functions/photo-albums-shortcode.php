<?php

/*

Title: Photo Albums Shortcode - Flexible Layout

Version: 2.2

Last Updated: Dec 9, 2014 (Uses embedded ids instead of attached, fixes bad post_types)

Description: Use [albums] to display children page gallery links

array(
	array( {fieldtype:text,textarea,truefalse,info}, {name/id}, {label}, {help/info}, {defaultvalue}, {help/info css styles} ) 
)
*/
$FNKOP[basename(__FILE__, '.php')] = array(array('info', '','', '<strong>Usage:</strong> Add the shortcode <code>[albums]</code> to your parent page, and create child pages containing galleries - parent page will automatically create album links.', '', 'font-style:italic'));
add_shortcode('albums', 'idp_photo_albums');

function idp_photo_albums(){

	global $wpdb, $post;

	

	$children = $wpdb->get_results("SELECT ID, post_title, post_content, post_type FROM $wpdb->posts WHERE post_parent=$post->ID AND post_status='publish' AND post_type='page' ORDER BY menu_order, post_title ASC");

	if( $_GET['admintest'] == 1 ){

		print_r($children); exit;	

	}

	$output = '

	<style type="text/css">

			#album {

				margin: auto;

			}

			#album .gallery-item {

				float: left;

				margin-top: 10px;

				text-align: center;

				width: 25%;

			}

			#album img {

				border: 2px solid #cfcfcf;

			}

			#album .gallery-caption {

				margin-left: 0;

			}

			/* see gallery_shortcode() in wp-includes/media.php */

		</style>

	<div id="album" class="gallery album gallery-columns-4">';

	foreach( $children as $child ):

		$link = get_permalink($child->ID);

		$title = $child->post_title;

		while( has_sub_field('content', $child->ID) ):

			foreach( get_sub_field('section') as $col ):

				$type = $col['content_type'];

				if( $type == 'gallery'):

					$photoIDs = $col['photo_gallery'];

					//break 2;

				endif;

			endforeach;

		endwhile;

		if( $photoIDs[0]['id'] ):

			$cover = wp_get_attachment_image($photoIDs[0]['id'], 'thumbcrop');	

			$output .= '<dl class="gallery-item"><dt class="gallery-icon"><a href="'.$link.'" title="'.$title.'">'.$cover.'</a></dt><dd class="wp-caption-text gallery-caption"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></dd></dl>';



		endif;

	endforeach;

	$output .= '<br style="clear:left" /></div>';

	

	return $output;

	

}