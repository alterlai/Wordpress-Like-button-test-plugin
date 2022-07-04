<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       .
 * @since      1.0.0
 *
 * @package    Ds_cookie_clicker
 * @subpackage Ds_cookie_clicker/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ds_cookie_clicker
 * @subpackage Ds_cookie_clicker/public
 * @author     Jeroen <jeroen.jeroenvdlaan@gmail.com>
 */
class Ds_cookie_clicker_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ds_cookie_clicker_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ds_cookie_clicker_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ds_cookie_clicker-public.css?v='.time(), array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ds_cookie_clicker_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ds_cookie_clicker_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ds_cookie_clicker-public.js?v=', array( 'jquery' ), time(), false );

		$this->cc_localize(); 
	}

	public function cc_localize() {

		$ajax_url = admin_url( 'admin-ajax.php' );

		wp_localize_script(
			$this->plugin_name,
			'cc_data',
			array(
				'ajax_url' => $ajax_url
			)
		);
	}

	/**
	 * Add the button to the content. Only if it's a post, not a page.
	 */
	public function add_button_to_content() {

		$post = get_queried_object();

		// For other pages such as the homepage.
		if ($post == null) {
			return;
		}

		$nonce = wp_create_nonce('cc_button');

		// If the page is not a post, don't add anything.
		if ($post->post_type != "post") {
			return "";
		}

		$clicks = get_post_meta($post->ID, 'clicks', $single=true);

		if ( empty ( $clicks ) ) {
			$clicks = 0;
		}

		return "<button class='cookie-clicker' data-nonce=" . $nonce . " data-post_id=". $post->ID .">Add 1!</button>   Clicks: <span id='counter'>".$clicks."</span>";
	}

	/**
	 * Add one to the current post
	 * Returns the ammount of clicks.
	 */
	public function add_one_to_post_meta() {
	
		$post_id = intval($_POST['post_id']);
		$post = get_post( $post_id );

		// Get post meta
		$clicks = get_post_meta($post->ID, 'clicks', $single=true);

		if ( empty ( $clicks ) ) {
			$clicks = 0;
		}

		$clicks = intval($clicks);

		// Add one
			$clicks += 1;

		update_post_meta($post->ID, 'clicks', $clicks);

		$return = array(
			'clicks' => $clicks,
		);

		return wp_send_json($return);
	}
}
