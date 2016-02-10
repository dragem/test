<?php

require_once(__DIR__.'/../src/DwdUtils.php');

use Test\DwdUtils;

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

    public function excerptSuccessProvider()
    {
        return array(
            array('er win', 4, '..', 'er..'),
            array('erwin', 4, '..', '..'),
            array('erwin', 5, '..', 'erwin'),
            array('erwin', 6, '..', 'erwin'),
            array('erwin ter hoorn boer', 8, '..', 'erwin..'),
            array('erwin ter hoorn boer', 10, '..', 'erwin ter..'),
            array('erwin ter hoorn boer', 16, '..', 'erwin ter hoorn..'),
            array('erwin ter hoorn boer', 20, '..', 'erwin ter hoorn boer'),
            array('erwin ter hoorn boer', 4, '..', '..'),
            array('erwin ter hoorn boer', 6, '..', 'erwin..'),
            array('erwin ter hoorn boer', 4, '..', '..'),
            array('erwin ter hoorn boer', 4, 'erwin', 'erwin'),
        );
    }

    public function excerptFailureProvider()
    {
        return array(
            array('erwin', 4, '..', 'er..')
        );
    }
}