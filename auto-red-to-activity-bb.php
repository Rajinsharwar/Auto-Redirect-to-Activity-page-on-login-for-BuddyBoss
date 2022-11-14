<?php
/**
 * Plugin Name: Auto-redirect to Activity page on Login for BuddyBoss.
 * Description: Automatically redirect your users to activity feed after login. No need any configurations, just activate the plugin, and your users will be redirected to activity feed after login.
 * Author: Rajin Sharwar
 * Author URI: https://linkedin.com/in/rajinsharwar
 * Version: 1.0.0
 * Text Domain: autoredirectbuddyboss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function redirect_to_profile( $redirect_to_calculated, $redirect_url_specified, $user ) { 
 if ( ! $user || is_wp_error( $user ) ) { 
 return $redirect_to_calculated; 
 } 
 // If the redirect is not specified, assume it to be dashboard. 
 if ( empty( $redirect_to_calculated ) ) { 
 $redirect_to_calculated = admin_url(); 
 } 
 // if the user is not site admin, redirect to his/her profile. 
 if ( function_exists( 'bp_core_get_user_domain' ) && ! is_super_admin( $user->ID ) ) { 
 return bp_core_get_user_domain( $user->ID )."/activity/"; 
 } 
 // if site admin or not logged in, do not do anything much. 
 return $redirect_to_calculated; 
} 
add_filter( 'login_redirect', 'redirect_to_profile', 100, 3 );