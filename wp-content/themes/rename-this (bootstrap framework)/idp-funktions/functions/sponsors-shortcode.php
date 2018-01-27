<?php

/*

Title: Sponsors Shortcode

Version: 1.0

Last Updated: July 10, 2013

Description: Code needs updating

SETTING FORMAT
array(
	array( {fieldtype:text,textarea,truefalse,info}, {name/id}, {label}, {help/info}, {defaultvalue}, {help/info css styles} ) 
)
*/
$FNKOP[basename(__FILE__, '.php')] = array(array('info', false, false, '<strong>Usage:</strong> add shorcode <code>[sponsors]</code> or function <code>echo idp_show_sponsors();</code> to output.', false, 'font-style:italic',));
add_shortcode('sponsors', 'idp_show_sponsors');

function idp_show_sponsors(){

	$sponsordata = get_field('sponsor_level');



	if( $sponsordata ):

		foreach($sponsordata as $sp):

	if( $sp['sponsorship_range'] ) $range = ' | '.$sp['sponsorship_range'];

	$output .= '<h2 class="aligncenter">'.$sp['sponsorship_level'].$range.'</h2>';

			$output .= '<table border="0" style="width:100%;vertical-align:center;border:0"><tr>';

			$sponsors = $sp['sponsors'];

			$width = $sp['logo_width'];

			

			$cols = $sp['sponsor_columns'];

			$i = 1;

			foreach( $sponsors as $si ):

				$imgID = $si['company_logo'];

				$name = $si['company_name'];

				$cw = $si['custom_logo_width'];

				$url = 'http://'.str_replace('http://', '', $si['company_url']);

				if( $url ): 

					$a = '<a href="'.$url.'" target="_blank">'; 

					$aa = '</a>'; 

				else: 

					$a = false; 

					$aa = false; 

				endif;

				if( $cw ) $width = $cw;

				$colwidth = floor(100/$cols);

				

				if( $imgID ){

					$imgsrc = $imgID['sizes']['sponsorpg']; //wp_get_attachment_image_src( $imgID, 'sponsorpg' );

					$thumb = get_bloginfo('template_directory').'/timthumb.php';

					$atts = '?src='.urlencode($imgsrc).'&w='.$width;

					

					$output .= '<td style="width:'.$colwidth.'%; text-align:center; padding-top:5px;padding-bottom:5px;border:none!important;vertical-align:middle;">'.$a.'<img src="'.$thumb.$atts.'" title="'.$name.'"  \>'.$aa.'</td>';

				}else{

					$output .= '<td style="width:'.$colwidth.'%; text-align:left;padding-top:5px;padding-bottom:5px; font-weight:bold;border:none!important;vertical-align:middle;">'.$a.$name.$aa.'</td>';	

				}

				if( $i % $cols == 0 ) $output .= '</tr><tr>';

				$i++;

			endforeach;

			$output .= '</tr></table>';

		endforeach;

	endif;

	return $output;

}