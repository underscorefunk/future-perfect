<?php

namespace underscorefunk\future_perfect;

class Plugin
{
	const HOOK = "future_perfect_cron";
	
	
	public static function init( $plugin_file )
	{
		
		if ( did_action( __METHOD__ ) ) {
			return;
		}
		
		register_activation_hook( $plugin_file, [ __CLASS__, 'activate' ] );
		register_deactivation_hook( $plugin_file, [ __CLASS__, 'deactivate' ] );
		add_action( self::HOOK, [ __CLASS__, 'publish_future_past_posts' ] );
	}
	
	
	public static function activate()
	{
		if ( ! wp_get_schedule( self::HOOK ) ) {
			wp_schedule_event( time(), 'hourly', self::HOOK );
		}
	}
	
	
	public static function deactivate()
	{
		wp_clear_scheduled_hook( self::HOOK );
	}
	
	
	public static function publish_future_past_posts()
	{
		global $wpdb;
		$sql = $wpdb->prepare( "
				SELECT ID
				FROM wp_posts
				WHERE post_status = 'future'
				AND post_date < %s",
			current_time( 'mysql' )
		);
		
		$post_ids = $wpdb->get_col( $sql );
		
		array_map(
			'wp_publish_post',
			$post_ids
		);
		
	}
	
}
//
//// Here we register our plugin "on activation function". WordPress runs it when the user activates your plugin
//
//function on_plugin_activation() {
//	// First, we need to check if the schedule event is not already created, then we create it.
//	if( ! wp_get_schedule( 'scheduled_api_pulling' ) ) { // "scheduled_api_pulling"
//		/**
//		 * Here we schedule our event in a weekly basis.
//		 * The first parameter is the current time to start counting.
//		 * The second parameter is the recurring basis term, this time is 'weekly.' (I will explain latter how to create this 'weekly' term.)
//		 * The third parameter is our event name, and it should be unique.
//		 */
//
//		wp_schedule_event( time(), 'weekly', 'scheduled_api_pulling' );
//	}
//}
//
//// Here we register our plugin "on deactivation function". WordPress runs it when the user deactivates your plugin
//register_deactivation_hook(__FILE__, 'on_plugin_deactivation');
//function on_plugin_deactivation() {
//	wp_clear_scheduled_hook('scheduled_api_pulling');
//}
//
//// Finally, this is the function that is going to run every week, code your magic here.
//function do_api_pulling() {
//	// Do you magic API pulling information here.
//}
//
///**
// * When you create a Scheduled Event, WordPress saves it as an "action", this means, you can register several functions to this action
// * and WordPress will execute them all at your chosen time (weekly in this example).
// * So, in this line, we register 'do_api_pulling' function to our 'scheduled_api_pulling' (our unique scheduled event name) action.
// */
//
//add_action( 'scheduled_api_pulling', 'do_api_pulling' );