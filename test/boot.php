<?php
/**
 * @copyright Copyright (c) 2012, Dan Bettles
 * @author Dan Bettles <dan@danbettles.net>
 */

require_once dirname(__DIR__) . '/include/boot.php';

/**
 * Stub for the WordPress function
 */
function esc_attr($text) {
	return htmlspecialchars($text, ENT_QUOTES);
}