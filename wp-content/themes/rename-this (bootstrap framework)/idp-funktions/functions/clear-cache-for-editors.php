<?php

/*

Title: Clear Cache for Editors (WP Rocket)

Version: 1.0

Last Updated: Jan 1, 2017

Description: adds a button to the WP toolbar to clear the WP Rocket cache for editor accounts

*/
add_action('admin_bar_menu', 'idp_toolbar_cacheclear', 999);
function idp_toolbar_cacheclear($wp_admin_bar){
	$wp_admin_bar->add_node( array(
		'id'    => 'clearcache',
		'title' => 'Clear Cache',
		'href'  => '/wp-admin/index.php?cachefix=clearall',
		'meta'  => array(
			'title' => 'Clears the Performance Cache to ensure recent updates appear for the public',	
			'target' => '_blank'
		)
	));
}
add_action('init', 'idp_clear_cache');
function idp_clear_cache(){
	if( is_admin() && $_GET['cachefix'] == 'clearall' ){
	  rocket_clean_domain();
		add_action( 'admin_notices', 'idp_cache_notice' );
	}elseif(isset($_GET['cachefix']) && $_GET['cachefix'] != 'clearall'){
		add_action( 'admin_notices', 'idp_cache_error' );
	}
}

function idp_cache_notice() {
    echo '
    <div class="updated">
        <p><strong>SUCCESS:</strong> Cache Cleared!</p>
    </div>';
}

function idp_cache_error() {
    echo '
    <div class="updated">
        <p><strong>ERROR:</strong> Unable to clear cache!</p>
    </div>';
}