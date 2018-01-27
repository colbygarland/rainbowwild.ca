<?php
/*
Title: Admin Bar - Hide on Front-end of site
Version: 1.0
Last Updated: July 10, 2013
Description:  Hides admin bar on front-end of website
*/
add_filter('show_admin_bar', 'idp_false'); function idp_false(){ return false; }