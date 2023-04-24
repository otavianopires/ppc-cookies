<?php
/**
 * PPC Cookies: PPC_Cookie_Generator class
 *
 * @package ppc-cookie
 * @author  Otaviano Pires Amancio
 * @since   0.1.0
 */

/**
 * Class used to create the PPC Cookies.
 *
 * @since 0.1.0
 */
class PPC_Cookie_Generator {
	/**
	 * The PPC Cookies name.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $ppc_cookie_toggle_cookie_name = 'ppc_cookie_toggle';

	/**
	 * The PPC Cookies name for tracking.
	 *
	 * @since 0.4.0
	 * @var   string
	 */
	private $ppc_cookie_tracking_cookie_name = 'ppc_cookie_tracking';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 0.1.0
	 * @since 0.4.0 Added 'set_ppc_tracking_cookie' action.
	 */
	public function __construct() {
		add_action( 'template_redirect', array( $this, 'set_ppc_cookie' ) );
		add_action( 'template_redirect', array( $this, 'set_ppc_tracking_cookie' ) );
	}

	/**
	 * Set and Unset PPC Cookies.
	 *
	 * @since 0.1.0 Set a cookie if `utm_medium` query string is present
	 *              and `ppc_cookie_visibility` toggle is set to true.
	 */
	public function set_ppc_cookie() {
		$utm_medium            = isset( $_GET['utm_medium'] ) ? sanitize_key( $_GET['utm_medium'] ) : '';
		$ppc_cookie_visibility = $this->check_coookie_visibility();

		if ( $ppc_cookie_visibility && 'paid' === $utm_medium ) {
			$referer_url = wp_get_referer() ? wp_get_referer() : home_url();
			setcookie( $this->ppc_cookie_toggle_cookie_name, wp_unslash( $referer_url ), time() + 86400, COOKIEPATH, COOKIE_DOMAIN );
		}
	}

	/**
	 * Set PPC Tracking Cookie.
	 *
	 * @since 0.4.0 Set a tracking cookie with click ID if `utm_medium` query string is present.
	 */
	public function set_ppc_tracking_cookie() {
		$utm_medium            = isset( $_GET['utm_medium'] ) ? sanitize_key( $_GET['utm_medium'] ) : '';
		$ppc_cookie_visibility = $this->check_coookie_visibility();

		if ( isset( $_GET['gclid'] ) ) {
			$click_id = sanitize_key( $_GET['gclid'] );   // Google clickID
		} else if ( isset( $_GET['msclkid'] ) ) {
			$click_id = sanitize_key( $_GET['msclkid'] ); // Bing clickID
		} else if ( isset( $_GET['fbclid'] ) ) {
			$click_id = sanitize_key( $_GET['fbclid'] );  // Facebook clickID
		} else {
			$click_id = false;
		}

		if ( $ppc_cookie_visibility && $click_id && 'paid' === $utm_medium ) {
			setcookie( $this->ppc_cookie_tracking_cookie_name, $click_id, time() + 86400, COOKIEPATH, COOKIE_DOMAIN );
		}
	}

	/**
	 * Set PPC Tracking Cookie.
	 *
	 * @since 0.1.0 Check if `ppc_cookie_visibility` meta field is set to true.
	 */
	public function check_coookie_visibility() {
		return get_post_meta( get_the_ID(), 'ppc_cookie_visibility', true );
	}
}
