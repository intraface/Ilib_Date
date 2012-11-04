<?php
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/../src/Ilib/Date.php';

date_default_timezone_set('Europe/Berlin');

class DateTest extends PHPUnit_Framework_TestCase
{
    function testDateIsConvertedToDatabaseFormat()
    {
        $date = new Ilib_Date('10-10-2008');
        $this->assertTrue($date->convert2db());
        $this->assertEquals('2008-10-10', $date->get());
    }

    function testDateCanAutomaticallyTakeYearIsConvertedToDatabaseFormat()
    {
        $date = new Ilib_Date('10-10');
        $this->assertTrue($date->convert2db());
        $this->assertEquals(date('Y') . '-10-10', $date->get());
    }

    function testDateCanTakeSpacesAsSplittersDatabaseFormat()
    {
        $date = new Ilib_Date('10 10 2009');
        $this->assertTrue($date->convert2db());
        $this->assertEquals('2009-10-10', $date->get());
    }

    function testDateCanTakeSlashesAsSplittersDatabaseFormat()
    {
        $date = new Ilib_Date('10/10/2009');
        $this->assertTrue($date->convert2db());
        $this->assertEquals('2009-10-10', $date->get());
    }
   
    function testInvalidDateCannotConvert()
    {
        $date = new Ilib_Date(1);
        $this->assertFalse($date->convert2db());
    } 
}
