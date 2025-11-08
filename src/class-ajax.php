<?php
/**
 * Ajax class.
 *
 * @package Meloniq\GpRemoveTranslation
 */

namespace Meloniq\GpRemoveTranslation;

use GP;

/**
 * Ajax class.
 */
class Ajax {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_ajax_gprts_remove_translation', array( $this, 'handle_remove_translation' ) );
	}

	/**
	 * Handle the AJAX request to remove a translation.
	 *
	 * @return void
	 */
	public function handle_remove_translation(): void {
		// Get translation ID from POST data.
		$translation_id = isset( $_POST['translation_id'] ) ? intval( $_POST['translation_id'] ) : 0;

		// Check nonce for security.
		check_ajax_referer( 'gprts_remove_translation_' . $translation_id, 'nonce', true );

		if ( $translation_id <= 0 ) {
			wp_send_json_error( array( 'message' => __( 'Invalid translation ID.', 'gp-remove-translation' ) ) );
		}

		$translation = GP::$translation->find_one( "id = '$translation_id'" );

		if ( ! $translation ) {
			wp_send_json_error( array( 'message' => __( 'Translation not found.', 'gp-remove-translation' ) ) );
		}

		// Perform deletion.
		$translation->delete();

		wp_send_json_success( array( 'message' => __( 'Translation removed successfully.', 'gp-remove-translation' ) ) );
	}
}
