<?php
/**
 * Plugin Name: PPC Cookies
 * Description: Generate cookies for PPC pages based on URL query parameter.
 * Version: 0.4.0
 * Author: Otaviano Pires Amancio
 * Author URI: https://otavianopires.com/
 * Text Domain: ppc-cookie
 *
 * @package ppc-cookie
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define constants.
define( 'PPC_PATH', plugin_dir_path( __FILE__ ) );
define( 'PPC_URL', plugin_dir_url( __FILE__ ) );

// Classes
require PPC_PATH . 'includes/class-ppc-cookie-generator.php';
require PPC_PATH . 'includes/class-ppc-meta-boxes.php';
require PPC_PATH . 'includes/class-ppc-cookie-enqueue.php';

// Plugin core.
require PPC_PATH . 'includes/ppc-core.php';
