<?php

/*

Title: ACF - Page Redirect Panel

Version: 1.6

Last Updated: May 24, 2017

Description: Adds page redirect abilities - requires Advanced Custom Fields plugin - Compatible with W3 Total Cache

*/

/**

 *  Register Field Groups

 *

 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group

 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF

 */



if(function_exists("register_field_group"))

{

	register_field_group(array (

		'id' => 'acf_page-redirection',

		'title' => 'Page Redirection',

		'fields' => array (

			array (

				'key' => 'field_515dbe2c4354e',

				'label' => 'Redirect To',

				'name' => 'redirect_to',

				'type' => 'radio',

				'choices' => array (

					'no' => 'No Redirect',

					'child' => 'First Child-Page',

					'page' => 'Specific Page Below',

					'other' => 'Other URL Specified Below',

				),

				'default_value' => 'no',

				'layout' => 'vertical',

			),

			array (

				'key' => 'field_515dbfea4354f',

				'label' => 'Open this link in a new window/tab',

				'name' => 'new_window',

				'type' => 'true_false',

				'conditional_logic' => array (

					'status' => 1,

					'rules' => array (

						array (

							'field' => 'field_515dbe2c4354e',

							'operator' => '==',

							'value' => 'other',

						),

					),

					'allorany' => 'all',

				),

				'message' => '',

				'default_value' => 0,

			),

			array (

				'key' => 'field_515dc00a43550',

				'label' => 'Specific Page',

				'name' => 'specific_page',

				'type' => 'page_link',

				'conditional_logic' => array (

					'status' => 1,

					'rules' => array (

						array (

							'field' => 'field_515dbe2c4354e',

							'operator' => '==',

							'value' => 'page',

						),

					),

					'allorany' => 'all',

				),

				'post_type' => array (

					0 => 'page',

				),

				'allow_null' => 0,

				'multiple' => 0,

			),

			array (

				'key' => 'field_515dc03843551',

				'label' => 'Other URL',

				'name' => 'other_url',

				'type' => 'text',

				'instructions' => 'Any URL starting with http://',

				'conditional_logic' => array (

					'status' => 1,

					'rules' => array (

						array (

							'field' => 'field_515dbe2c4354e',

							'operator' => '==',

							'value' => 'other',

						),

					),

					'allorany' => 'all',

				),

				'default_value' => '',

				'formatting' => 'html',

			),

		),

		'location' => array (

			'rules' => array (

				array (

					'param' => 'post_type',

					'operator' => '==',

					'value' => 'page',

					'order_no' => 0,

				),

			),

			'allorany' => 'all',

		),

		'options' => array (

			'position' => 'side',

			'layout' => 'default',

			'hide_on_screen' => array (

			),

		),

		'menu_order' => 0,

	));

}



function idp_redirect(){

	global $post, $wpdb;

	$redirect = get_post_meta($post->ID, 'redirect_to', 1);

	if( $redirect == 'no' ) return false;

	if( $redirect == 'page' ):

		$page = get_post_meta($post->ID, 'specific_page', 1);

		wp_redirect(get_permalink($page), 301); 

	elseif( $redirect == 'other' ):

		$URL = get_post_meta($post->ID, 'other_url', 1);

		if( strpos($URL, 'http') === false ) $URL = get_option('siteurl').$URL;

		wp_redirect($URL, 301);

	elseif($redirect == 'child'):

		$pageID = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_status='publish' AND post_type='page' AND post_parent=$post->ID ORDER BY menu_order ASC");

		if( $pageID ): 

			$page = get_permalink($pageID);

			wp_redirect($page, 301);

		endif;

	else:

		return false;

	endif;

}

add_action('template_redirect', 'idp_redirect');



//W3TC Cache Fix - Add JS as backup redirect

add_action('wp_head', 'idp_redirect_js');

function idp_redirect_js(){

	global $post, $wpdb;

	$redirect = get_post_meta($post->ID, 'redirect_to', 1);

        if( $redirect == 'no' ) return false;

        if( $redirect == 'page' ):

                $page = get_post_meta($post->ID, 'specific_page', 1);

                echo '<script>window.location = "'.$page.'"; </script>';

        elseif( $redirect == 'other' ):

                $URL = get_post_meta($post->ID, 'other_url', 1);

                if( strpos($URL, 'http') === false ) $URL = get_option('siteurl').$URL;

                echo '<script>window.location="'.$URL.'"; </script>'; 

        elseif($redirect == 'child'):

                $pageID = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_status='publish' AND post_type='page' AND post_parent=$post->ID ORDER BY menu_order ASC");

                if( $pageID ):

                        $page = get_permalink($pageID);

                        echo '<script>window.location="'.$page.'"; </script>';

                endif;

        else:

                return false;

        endif;

}



function idp_redirect_notify() {

		$type = get_post_meta( absint( $_GET['post'] ), 'redirect_to', true );

		switch($type):

			case 'child': $desc = "it's first Sub-Page"; break;

			case 'page': $desc = 'another Page in your website'; break;

			case 'other': $desc = 'an alternate URL'; break;

		endswitch;

		remove_post_type_support('page', 'editor');

		?><div class="updated"><p><?php _e( '<strong>Note</strong>: This page has no content as it is currently pointing to '.$desc.'. Use the <em><strong>Page Redirect</strong></em> box to change this behavior.', 'imagedesign' ); ?></p></div><?php

}

if ( isset( $_GET['post'] ) ) {

	if ( get_post_meta( absint( $_GET['post'] ), 'redirect_to', true ) && get_post_meta( absint( $_GET['post'] ), 'redirect_to', true ) != 'no') 

		add_action( 'admin_notices','idp_redirect_notify' );

}


function idp_redirection_urls( $url, $post, $leavename ) {
	global $wpdb;
	if ( $post->post_type == 'page' ) {
		$url = idpGetRedirectURL($post->ID);
	}
	return $url;
}
add_filter( 'post_link', 'idp_redirection_urls', 10, 3 );

function idpGetRedirectURL($pID){
	global $wpdb;
	$redirect = get_post_meta($pID, 'redirect_to', 1);
		if( $redirect == 'page' ):
			$pg = get_post_meta($pID, 'specific_page', 1);
			$url = get_permalink($pg); 	
		elseif( $redirect == 'other' ):
			$url = get_post_meta($pID, 'other_url', 1);	
			$hastarget = get_post_meta($pID, 'new_window', true);
			if( $hastarget )$target = ' target="_blank"'; else $target = false;
			$null = false;
		elseif($redirect == 'child'):
			global $wpdb;
			$pageID = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_status='publish' AND post_type='page' AND post_parent=$pID ORDER BY menu_order ASC");
			if( $pageID ): 
				$pg = idpGetRedirectURL($pageID);
				$url = $pg;	
			endif;
		else:
			$url = get_permalink($pID);
		endif;
	return $url;
}

class IDP_Redirect_Custom_Walker extends Walker_Page {
	function start_el( &$output, $page, $depth = 0, $args = Array(), $current_page = 0){
		if ( $depth )
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';
            extract($args, EXTR_SKIP);
            $css_class = array('page_item', 'page-item-'.$page->ID);
        if ( !empty($current_page) ) {
            $_current_page = get_post( $current_page );
            if ( in_array( $page->ID, $_current_page->ancestors ) )
                $css_class[] = 'current_page_ancestor';
            if ( $page->ID == $current_page )
                $css_class[] = 'current_page_item';
            elseif ( $_current_page && $page->ID == $_current_page->post_parent )
                $css_class[] = 'current_page_parent';
        }
        elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }

        $css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
     
		$url = idpGetRedirectURL($page->ID);
		
        $output .= $indent . '<li class="' . $css_class . '">';
            $output .= '<a href="' . $url . '"'.$target.'>' . $link_before;

                $output .= apply_filters( 'the_title', $page->post_title, $page->ID );
            $output .= $link_after . '</a>';

        if ( !empty($show_date) ) {
            if ( 'modified' == $show_date )
                $time = $page->post_modified;
                else
                $time = $page->post_date;
                $output .= " " . mysql2date($date_format, $time);
        }	
	}
}

add_action('wp_head', 'idp_newwin_js');

function idp_newwin_js(){

	global $wpdb;

	$pages = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status = 'publish'");

	foreach($pages as $p){

		$target = get_post_meta($p->ID, 'new_window', true);

		if( $target ) $targets[] = $p->ID;

	}

	if( $targets ):

	$targets = '.page-item-'.implode(' a, .page-item-', $targets).' a';

	echo '<script type="text/javascript">

jQuery(document).ready(function($) {	

	$("'.$targets.'").attr("target", "_blank");

});

</script>';

	endif;

}