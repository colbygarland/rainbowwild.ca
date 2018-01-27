<?php
/*
Title: Convert Phone Number to linkable format
Version: 1.0
Last Updated: Aug 22, 2013
Description: Converts a phone number to a linkable format
*/
function phone_format($number){
	return preg_replace('~.*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4}).*~', '($1) $2-$3', $number). "\n";	
}