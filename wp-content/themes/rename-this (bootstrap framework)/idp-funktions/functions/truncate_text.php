<?php
/*
Title: Truncate Text
Version: 1.0
Last Updated: Aug 26, 2013
Description: Truncate text to a desirec length
*/
function truncate_text($string, $maxlen=200, $append='&hellip;'){
if (strlen($string) > $maxlen) 
{
    $string = wordwrap($string, $maxlen);
    $string = substr($string, 0, strpos($string, "\n"));
	$string .= $append;
}
return $string;
}