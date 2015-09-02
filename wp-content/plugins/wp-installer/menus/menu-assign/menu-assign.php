<?php

defined( 'ABSPATH' ) || die();

function assign_menus() {
    require_once( dirname(__FILE__) . '/data.php' );
    $menus = get_menu_assign_data();
    if ( $menus ) foreach ( $menus as $menu ) {
        if ( $menu_exists = wp_get_nav_menu_object( $menu['name'] ) ) {
            $locations = get_theme_mod( 'nav_menu_locations' );
            if ( isset( $locations[ $menu['location'] ] ) ) {
                $locations[ $menu['location'] ] = $menu_exists->term_id; 
            }
            set_theme_mod( 'nav_menu_locations', $locations );
        }
    }
}
