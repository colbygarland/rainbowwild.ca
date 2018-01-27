<?php
/*
Title: SEO Enhancements
Version: 1.0
Last Updated: Sept 12, 2013
Description: SEO Enhancements include Sanitizing the title to remove unneeded words
*/
add_filter('sanitize_title', 'remove_short_words');
function remove_short_words($slug) {
	$keys_exempt = strtolower('SEO'); // Add all words to exempt into this comma delimited list
	$keys_ignore =  '';	
	if (!is_admin()) return $slug;
	$slug = explode('-', $slug);
	foreach ($slug as $k => $word) {
		if (strlen($word) < 3) { //adjust the number here to fix the deleted word length
			$exempt = explode(',', $keys_exempt);
			if (!in_array( $word, $exempt ) ) {
				unset($slug[$k]);
			}
		}else{
			$ignore = explode(',',$keys_ignore);
			if( in_array( $word, $ignore )  ){
				unset($slug[$k]);	
			}
		}
	}
	return implode('-', $slug);
}
