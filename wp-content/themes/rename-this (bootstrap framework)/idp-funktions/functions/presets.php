<?php
/*
Title: Image Design Presets
Version: 1.0
Last Updated: July 10, 2013
Description: Run on clean install of WP - applies defaults to settings
*/

if( get_option('idpCleanUp') != 'done' ) add_action('init', 'idpCleanUp');

function idpCleanUp(){
		global $wpdb;
		
		//Remove "Hello World" Post
		wp_delete_post(1, 1);
		
		//Update "About" page to "Home"
		$home = array( 'ID' => 2, 'post_content' => '', 'post_title' => 'Home', 'post_name' => 'home', 'comment_status' => 'closed', 'ping_status' => 'closed');
		wp_update_post($home);
		idpUpdateSettings();
		update_option('idpCleanUp', 'done');
}
function idpUpdateSettings(){
		global $wpdb;
		//General 
		update_option('blogdescription', '');//clear Tagline
		update_option('timezone_string', 'America/Edmonton');//set Timezone
		update_option('start_of_week', 0); //set Week Starts On Sunday
		
		//Writing
		update_option('use_smilies', 0);//disable Emoticons
		
		//Reading
		update_option('show_on_front', 'page');//set home to use page
		update_option('page_on_front', 2);//set home page to page ID 2
		
		//Discussion
		update_option('default_pingback_flag', 0); //disable notifications to blogs
		update_option('default_ping_status', 0); //disable link notifications from other blogs
		update_option('default_comment_status', 0); //disable comments
		
		//Media
		update_option('thumbnail_crop', 0); //disable thumbnail crop
		update_option('large_size_w', 1024); //Large Size width
		update_option('large_size_h', 768);//Large Size height
		
		//Permalinks
		update_option('permalink_structure', '/%year%/%monthnum%/%postname%'); //set Permalinks
	
		//Remove Links Manage
		update_option('link_manager_enabled', 0); //Disables Links menu and manager entirely
		
		//JetPack Modules
		//update_option('jetpack_active_modules', array('vaultpress', 'after-the-deadline', 'stats', 'shortcodes', 'enhanced-distribution') ); //Set Active Modules
		
		//JetPack Stats
		//$statops = get_option('stats_options');
		//update_option('stats_options', array('admin_bar' => '', 'roles' => array( 'administrator' ), 'blog_id' => $statops['blogid'], 'do_not_track' => 1, 'version' => $statops['version'], 'reg_users' => '', 'hide_smile' => 1) ); //Set Stat Options

		//Juiz Smart Mobile Admin 
		update_option('juiz_sma_settings', array('juiz_sma_footer' => 0, 'juiz_sma_adminbar' => 0) );//No Footer, No Admin Bar
		
		
	}