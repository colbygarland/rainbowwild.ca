<?php

/*

Title: Login Branding

Version: 2.0

Last Updated: Feb 23, 2015

Description: Adds the company logo to login/header bar and footer credits

SETTING FORMAT
array(
	array( {fieldtype:text,textarea,truefalse,info}, {name/id}, {label}, {help/info}, {defaultvalue}, {help/info css styles} ) 
)
*/
//echo 'BRANDING ON!'; exit();
$FNKOP[basename(__FILE__, '.php')] = array(array('text', 'branding_logo', 'Logo URL', '', 'http://imagedesignpros.com/logo.svg'));


add_action('login_head', 'idp_LoginLogo' );

add_filter('admin_footer_text', 'idp_AdminFooterCredits' );



function idp_AdminFooterCredits () {

	  echo 'Managed by <a href=”http://imagedesignpros.com” target=”_blank”>imageDESIGN</a>';

}

function idp_LoginLogo() {
	$funkset = get_option('funktions');
	
	$logoURL = $funkset['branding_logo']; //replace with client logo
	list( $logoW, $logoH, $type, $attr) = getimagesize($logoURL);
	
	$width = ' width:auto!important;';
	//$height = ' height:auto!important;';
	if( $logoW ) $width =  ' width:'.$logoW.'px!important;';
	if( $logoH  ) $height =  ' height:'.$logoH.'px!important;'; 

	echo '<style type="text/css">

	h1 a { background-image:url('.$logoURL.') !important; background-size:contain!important; '.$height.$width.'}

</style>

<script type="text/javascript">

function linkswap(){

	var x=document.getElementById("login");

	var y=x.getElementsByTagName("h1")[0];

	y.innerHTML = "<a href=\''.get_option('siteurl').'\' title=\'Back to Website\'>'.get_option('sitename').'</a>";

}

window.onload = linkswap;

</script>

';



}