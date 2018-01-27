<?php
/*
Title: Remove SEO Columns
Version: 1.0
Last Updated: July 10, 2013
Description: Removes SEO By Yoast SEO columns on pages and posts
*/
function idp_remove_seo_columns($columns) {
  unset($columns['wpseo-score']);
  unset($columns['wpseo-focuskw']);
  unset($columns['wpseo-metadesc']);
  unset($columns['wpseo-title']);
  return $columns;
}
foreach ( get_post_types( array( 'public' => true ), 'names' ) as $pt ) {
	add_filter( 'manage_' . $pt . '_posts_columns', 'idp_remove_seo_columns', 12, 1 );	
}
add_filter( 'manage_event_posts_columns', 'idp_remove_seo_columns', 12, 1 );