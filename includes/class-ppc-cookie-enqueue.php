<?php
/**
 * PPC Cookies: PPC_Cookie_Enqueue class
 *
 * @package ppc-cookie
 * @author  Otaviano Pires Amancio
 * @since   0.1.0
 */

/**
 * Class to enqueue scripts and styles.
 *
 * @since 0.1.0
 */
class PPC_Cookie_Enqueue {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles_and_scripts' ) );
	}

	/**
	 * Enqueue Styles and Scripts.
	 *
	 * @since 0.1.0
	 *
	 * @param string $hook The current admin page.
	 */
	public function enqueue_styles_and_scripts( $hook ) {
		if ( ( 'post.php' === $hook ) && ( in_array( get_post_type(), array( 'page', 'post' ), true ) ) ) {
      wp_enqueue_style( 'ppc_wp_admin_css', PPC_URL . 'assets/ppc-cookie.css', false, filemtime( PPC_PATH . 'assets/ppc-cookie.css' ) );
      wp_enqueue_script( 'ppc_wp_admin_js', PPC_URL . 'assets/ppc-cookie.js', array( 'jquery' ), filemtime( PPC_PATH . 'assets/ppc-cookie.js' ), true );
		}
	}
}