<?php
/**
 * PPC Cookies
 *
 * This file implements all scripts for the plugin.
 *
 * @package ppc-cookie
 * @author  Otaviano Pires Amancio
 * @since   0.1.0
 */

if ( class_exists( 'PPC_Cookie_Generator' ) ) {
	new PPC_Cookie_Generator();
}

if ( class_exists( 'PPC_Meta_Boxes' ) ) {
	new PPC_Meta_Boxes();
}

if ( class_exists( 'PPC_Cookie_Enqueue' ) ) {
	new PPC_Cookie_Enqueue();
}
