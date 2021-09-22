<?php
/**
 * UBC H5P Author Only Content
 *
 * @package           UBCH5PAuthorOnlyContent
 * @author            Rich Tape
 * @copyright         2021 UBC CTLT
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       UBC H5P Author Only Content
 * Plugin URI:        https://ctlt.ubc.ca
 * Description:       H5P Authors should only see their own content in the dashboard.
 * Version:           0.0.1
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Author:            Rich Tape
 * Author URI:        https://example.com
 * Text Domain:       ubc-h5p-author-only-content
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

add_action( 'admin_init', 'ubc_h5p_remove_ability_for_authors_to_see_other_authors_content_in_dashboard' );

/**
 * Remove the view_others_h5p_contents capability from the author role. This ensures that
 * an author can't view another author's H5P content in the dashboard.
 *
 * We set an option 'ubc_authors_only_h5p_content' so that we only
 * run this operation once. The option is autoloaded.
 *
 * @since 0.0.1
 * @return void
 */
function ubc_h5p_remove_ability_for_authors_to_see_other_authors_content_in_dashboard() {

	// Setting it to the date will allow us to adjust this down the line should we need.
	$date_set = '2021-09-22';

	$option_name = 'ubc_authors_only_h5p_content';

	// Ensure we do this only once.
	$already_removed = get_option( $option_name );

	if ( $date_set === $already_removed ) {
		return;
	}

	// This hasn't been done yet, so do it, set an option, and go and get a cup of tea.
	$role = get_role( 'author' );

	$role->remove_cap( 'view_others_h5p_contents' );

	update_option( $option_name, $date_set );

}//end ubc_h5p_remove_ability_for_authors_to_see_other_authors_content_in_dashboard()
