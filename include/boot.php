<?php
/**
 * @copyright Copyright (c) 2012, Dan Bettles
 * @author Dan Bettles <dan@danbettles.net>
 */

namespace metatagwriter;

/**
 * Returns a meta tag
 * 
 * @param string $name
 * @param string $content
 * @return string
 */
function createMetaTag($name, $content) {
    return sprintf('<meta name="%s" content="%s"/>', esc_attr($name), esc_attr($content));
}

/**
 * Returns meta-tags created from the custom fields for a post
 * 
 * @param array $aPostCustomField
 * @param array $aCustomFieldName
 * @return string
 */
function createMetaTagsFromPostCustomFields(array $aPostCustomField, array $aCustomFieldName) {
    $aMetaTag = array();

    foreach ($aCustomFieldName as $customFieldName => $metaName) {
        if (! array_key_exists($customFieldName, $aPostCustomField)) {
            continue;
        }

        $aMetaTag []= createMetaTag($metaName, reset($aPostCustomField[$customFieldName]));
    }

    return implode("\n", $aMetaTag);
}