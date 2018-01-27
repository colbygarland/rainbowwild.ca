<?php
/*
Title: Menu Class Enhancements
Version: 1.0
Last Updated: July 10, 2013
Description: Adds the class "parent" to any menu items that have children and adds the class "first" and "last" to the menu li
*/
function idp_add_parent_class( $css_class, $page, $depth, $args )
{
    if ( ! empty( $args['has_children'] ) )
        $css_class[] = 'parent';
    return $css_class;
}
add_filter( 'page_css_class', 'idp_add_parent_class', 10, 4 );
function idp_first_and_last_menu_class($items) {
    $items[1]->classes[] = 'first';
    $items[count($items)]->classes[] = 'last';
    return $items;
}
add_filter('wp_nav_menu_objects', 'idp_first_and_last_menu_class');