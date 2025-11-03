<?php
/**
 * Plugin Name:       GP Remove Translation
 * Plugin URI:        https://blog.meloniq.net/gp-remove-translation/
 *
 * Description:       GlotPress plugin to remove unwanted translations.
 * Tags:              glotpress, translations, remove, cleanup
 *
 * Requires at least: 4.9
 * Requires PHP:      7.4
 * Version:           1.0
 *
 * Author:            MELONIQ.NET
 * Author URI:        https://meloniq.net/
 *
 * License:           GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain:       gp-remove-translation
 *
 * Requires Plugins:  glotpress
 *
 * @package Meloniq\GpRemoveTranslation
 */

// If this file is accessed directly, then abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'GPRTS_TD', 'gp-remove-translation' );
