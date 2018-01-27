<?php
/*
Title: Update Notice - Admins Only
Version: 1.0
Last Updated: July 10, 2013
Description:  Disable Update Notices for non-Admins
*/
add_action('init', 'idp_checkusers');
function idp_checkusers(){
if ( !current_user_can('administrator') )
	add_action('admin_menu','idp_hidenag');
}
function idp_hidenag() {
	remove_action( 'admin_notices', 'update_nag', 3 );
}