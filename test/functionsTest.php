<?php
/**
 * @copyright Copyright (c) 2012, Dan Bettles
 * @author Dan Bettles <dan@danbettles.net>
 */

namespace metatagwriter\test\functions;

/**
 * @author Dan Bettles <dan@danbettles.net>
 */
class Test extends \PHPUnit_Framework_TestCase {
    /**
     * @dataProvider metaTags
     */
    public function testCreatemetatagReturnsAMetaTag($expected, $name, $content) {
        $this->assertEquals($expected, \metatagwriter\createMetaTag($name, $content));
    }

    public static function metaTags() {
        return array(
            array('<meta name="description" content="Foo"/>', 'description', 'Foo'),
            array('<meta name="keywords" content="Foo Bar Baz"/>', 'keywords', 'Foo Bar Baz'),
            array('<meta name="description" content="&amp;&quot;&#039;&lt;&gt;"/>', 'description', '&"\'<>'),
        );
    }

    /**
     * @dataProvider metaTagsFromPostCustomFields
     */
    public function testCreatemetatagsfrompostcustomfieldsReturnsMetaTagsCreatedFromTheCustomFieldsForAPost($expected, array $aPostCustomField, array $aCustomFieldName) {
        $this->assertEquals(
            $expected,
            \metatagwriter\createMetaTagsFromPostCustomFields($aPostCustomField, $aCustomFieldName)
        );
    }

    public static function metaTagsFromPostCustomFields() {
        return array(
            array(
                '<meta name="description" content="first description"/>',
                array(
                    'meta_description' => array(
                        'first description',
                        'second description',
                    ),
                    'meta_keywords' => array(
                        'first keywords',
                        'second keywords',
                    ),
                ),
                array(
                    'meta_description' => 'description',
                ),
            ),
            array(
                "<meta name=\"description\" content=\"first description\"/>\n<meta name=\"keywords\" content=\"first keywords\"/>",
                array(
                    'meta_description' => array(
                        'first description',
                        'second description',
                    ),
                    'meta_keywords' => array(
                        'first keywords',
                        'second keywords',
                    ),
                ),
                array(
                    'meta_description' => 'description',
                    'meta_keywords' => 'keywords',
                ),
            ),
            array(
                '<meta name="description" content="&amp;&quot;&#039;&lt;&gt;"/>',
                array(
                    'meta_description' => array(
                        '&"\'<>',
                    ),
                ),
                array(
                    'meta_description' => 'description',
                ),
            ),
        );
    }
}