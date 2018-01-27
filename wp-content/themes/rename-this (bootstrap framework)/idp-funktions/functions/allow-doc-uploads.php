<?php
/*
Title: Allow Word Doc Uploads
Version: 1.0
Last Updated: July 10, 2013
Description: allows Word .doc file uploads
*/
add_filter('upload_mimes', 'idp_custom_upload_mimes');
function idp_custom_upload_mimes ( $existing_mimes=array() ) {
	$existing_mimes['extension'] = 'mime/type';
	$existing_mimes['doc'] = 'application/msword';  
	return $existing_mimes;
}