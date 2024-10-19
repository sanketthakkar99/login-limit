<?php
/*
Plugin Name: Login Limit
Description: A simple plugin to limit login attempts and prevent brute force attacks.
Version: 1.0
Author: Sanket Thakkar
Text Domain: login-limit
*/

// Check login attempts
function lla_check_attempted_login( $user, $username, $password ) {
    if ( get_transient( 'attempted_login' ) ) {
        $datas = get_transient( 'attempted_login' );

        if ( $datas['tried'] >= 3 ) {
            $until = get_option( '_transient_timeout_' . 'attempted_login' );
            $time = lla_time_to_go( $until );

            return new WP_Error( 'too_many_tried',  sprintf( __( '<strong>ERROR</strong>: You have reached the authentication limit, you will be able to try again in %1$s.', 'limit-login-attempts' ) , $time ) );
        }
    }

    return $user;
}
add_filter( 'authenticate', 'lla_check_attempted_login', 30, 3 );

// Increment failed login attempts
function lla_login_failed( $username ) {
    if ( get_transient( 'attempted_login' ) ) {
        $datas = get_transient( 'attempted_login' );
        $datas['tried']++;

        if ( $datas['tried'] <= 3 ) {
            set_transient( 'attempted_login', $datas , 300 );
        }
    } else {
        $datas = array( 'tried' => 1 );
        set_transient( 'attempted_login', $datas , 300 );
    }
}
add_action( 'wp_login_failed', 'lla_login_failed', 10, 1 );

// Function to calculate time left for next attempt
function lla_time_to_go( $timestamp ) {
    $periods = array( "second", "minute", "hour", "day", "week", "month", "year" );
    $lengths = array( "60", "60", "24", "7", "4.35", "12" );
    $current_timestamp = time();
    $difference = abs( $current_timestamp - $timestamp );
    
    for ( $i = 0; $difference >= $lengths[$i] && $i < count( $lengths ) - 1; $i++ ) {
        $difference /= $lengths[$i];
    }
    
    $difference = round( $difference );
    if ( isset( $difference ) ) {
        if ( $difference != 1 ) {
            $periods[$i] .= "s";
        }
        return "$difference $periods[$i]";
    }
}
