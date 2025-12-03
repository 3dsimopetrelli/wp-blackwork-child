<?php
/**
 * Fallback template that defers rendering to the parent theme.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

require get_template_directory() . '/index.php';
