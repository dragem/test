<?php

require_once(__DIR__.'/../src/DwdUtils.php');

use Test\DwdUtils;

/**
 * Class DwdUtilsTest
 */
class DwdUtilsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider excerptSuccessProvider
     */
    public function testSuccessExcerpt($name, $length, $trailing, $expected)
    {
        $utils = new DwdUtils();

        $result = $utils->excerpt($name, $length, $trailing);
        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider excerptFailureProvider
     */
    public function testFailureExcerpt($name, $length, $trailing, $expected)
    {
        $utils = new DwdUtils();

        $result = $utils->excerpt($name, $length, $trailing);
        $this->assertNotEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function excerptSuccessProvider()
    {
        return array(
            array('er win', 4, '..', 'er..'),
            array('erwin', 4, '..', '..'),
            array('erwin', 5, '..', 'erwin'),
            array('erwin', 6, '..', 'erwin'),
            array('erwin ten hoorn boer', 8, '..', 'erwin..'),
            array('erwin ten hoorn boer', 10, '..', 'erwin ten..'),
            array('erwin ten hoorn boer', 16, '..', 'erwin ten hoorn..'),
            array('erwin ten hoorn boer', 20, '..', 'erwin ten hoorn boer'),
            array('erwin ten hoorn boer', 4, '..', '..'),
            array('erwin ten hoorn boer', 6, '..', 'erwin..'),
            array('erwin ten hoorn boer', 4, '..', '..'),
            array('erwin ten hoorn boer', 4, 'erwin', 'erwin'),
        );
    }

    /**
     * @return array
     */
    public function excerptFailureProvider()
    {
        return array(
            array('erwin', 4, '..', 'er..')
        );
    }
}