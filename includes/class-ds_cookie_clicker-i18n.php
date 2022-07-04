<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       .
 * @since      1.0.0
 *
 * @package    Ds_cookie_clicker
 * @subpackage Ds_cookie_clicker/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ds_cookie_clicker
 * @subpackage Ds_cookie_clicker/includes
 * @author     Jeroen <jeroen.jeroenvdlaan@gmail.com>
 */
class Ds_cookie_clicker_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ds_cookie_clicker',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
