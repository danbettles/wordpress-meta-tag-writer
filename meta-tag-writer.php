<?php
/**
 * @copyright Copyright (c) 2012, Dan Bettles
 * @author Dan Bettles <dan@danbettles.net>
 */
/*
Plugin Name: Meta-Tag Writer
Plugin URI: https://github.com/danbettles/wordpress-meta-tag-writer
Description: Enables you to add meta-tags to posts and pages
Author: Dan Bettles
Version: 1.0
Author URI: http://danbettles.net/
*/

require_once __DIR__ . '/include/boot.php';

add_action('wp_head', function() {
    global $post;

    if (! $post) {
        return;
    }

    $aPostCustomField = get_post_custom($post->ID);

    $aCustomFieldName = array(
        'meta_description' => 'description',
        'meta_keywords' => 'keywords',
    );

    echo metatagwriter\createMetaTagsFromPostCustomFields($aPostCustomField, $aCustomFieldName) . "\n";
});