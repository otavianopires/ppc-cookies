<?php
/**
 * PPC Cookies: PPC_Meta_Boxes class
 *
 * @package ppc-cookie
 * @author  Otaviano Pires Amancio
 * @since   0.1.0
 */

/**
 * Class used to create custom meta boxes for PPC Cookies fields.
 *
 * @since 0.1.0
 */
class PPC_Meta_Boxes {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_ppc_meta_box' ) );
		add_action( 'save_post', array( $this, 'ppc_cookie_save_postdata' ) );
	}

	/**
	 * Add custom Meta Box for Visibility Toggle.
	 *
	 * @since 0.1.0
	 */
	public function add_ppc_meta_box() {
		$screens = array( 'page', 'post' );
		foreach ( $screens as $screen ) {
			add_meta_box(
				'ppc_cookie_box_id',
				'Paid Media URL',
				array( $this, 'ppc_cookie_box_html' ),
				$screen,
				'normal',
				'high'
			);
		}
	}

	/**
	 * Add form elements, labels, and other HTML elements for meta box.
	 *
	 * @since 0.1.0
	 * @since 0.3.0 Added dedicated input field to display the Generated URL.
	 *
	 * @param WP_Post $post Post object data.
	 */
	public function ppc_cookie_box_html( $post ) {
		wp_nonce_field( 'ppc_cookie_action', 'ppc_cookie_nonce' );
		$ppc_cookie_visibility = get_post_meta( $post->ID, 'ppc_cookie_visibility', true );
		$utm_url               = $ppc_cookie_visibility ? get_permalink() . '?utm_medium=paid' : false;
		?>

		<table class="form-table">
			<tr>
				<th scope="row">Enable Paid URL</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span>Enable Paid URL</span>
						</legend>
						<label for="ppc_cookie_visibility_field" class="ppc-cookie-checkbox"><input name="ppc_cookie_visibility_field" type="checkbox" id="ppc_cookie_visibility_field" value="1" <?php checked( $ppc_cookie_visibility, 1 ); ?> /> <span class="screen-reader-text-">Enable Paid URL</span></label><br>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row"><label>Paid URL</label></th>
				<td>
					<?php if ( $utm_url ) : ?>
						<div class="ppc-cookie-paid-url-container">
							<input type="url" value="<?php echo esc_url( $utm_url ); ?>" id="ppc-cookie-paid-url" disabled="disabled" class="large-text" style="color: #777777;"><button id="ppc-cookie-paid-url-copy" class="button">Copy Paid URL</button>
						</div>
					<?php else : ?>
						<em>Please enable the Paid URL and update the article to generate the URL.</em>
					<?php endif; ?>
				</td>
			</tr>
		</table>
		<?php
	}

	/**
	 * Handle PPC Cookies fields and save in the database.
	 *
	 * @since 0.1.0
	 *
	 * @param int $post_id The Post ID.
	 */
	public function ppc_cookie_save_postdata( $post_id ) {
		// Verify the nonce sent in the current request.
		if ( ! isset( $_POST['ppc_cookie_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['ppc_cookie_nonce'] ), 'ppc_cookie_action' ) ) {
			return;
		}

		$this->handle_post_meta_data( $post_id, 'ppc_cookie_visibility' );
	}

	/**
	 * Handles storing and deletion of post meta field values in database.
	 *
	 * @since 0.2.0
	 * @since 0.3.0 Updated conditional, so toggle fields to hide elements
	 *              are removed if `ppc_cookie_visibility_field` is no isset.
	 *
	 * @param int    $post_id The Post ID.
	 * @param string $field_name The field name in string formats.
	 */
	private function handle_post_meta_data( $post_id, $field_name ) {
		// Get data from ppc fields.
		$ppc_cookie_field = ! empty( $_POST[$field_name . '_field'] ) ? sanitize_key( $_POST[$field_name . '_field'] ) : '';

		// Handle `ppc_cookie_visibility` post meta data.
		if ( array_key_exists( $field_name . '_field', $_POST ) && array_key_exists( 'ppc_cookie_visibility_field', $_POST ) ) {
			update_post_meta( $post_id, $field_name, $ppc_cookie_field );
		} else {
			delete_post_meta( $post_id, $field_name );
		}
	}
}
