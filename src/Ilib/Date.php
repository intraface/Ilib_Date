<?php
/**
 * Ilib_Date
 *
 * Takes dates in various formats and converts them to iso YYYY-mm-dd which
 * can be used in databases.
 *
 * <code>
 * $date = new Ilib_Date('10-10-2009');
 * $date = new Ilib_Date('10 10 2009');
 * $date = new Ilib_Date('10/10/2009');
 *
 * $date->converttodb();
 * $date->get(); // outputs 2009-10-10
 *
 * $date = new Ilib_Date('10-10');
 * $date->converttodb();
 * $date->get(); // outputs date('Y')-10-10
 * </code>
 *
 * PHP Version 5
 *
 * @package Ilib_Date
 * @author  Lars Olesen <lars@legestue.net>
 * @author  Sune Jensen <sj@sunet.dk>
 * @license MIT
 * @version 1.0.0
 *
 */
class Ilib_Date
{
    /**
     * @var string
     */
    private $date;

    /**
     * Constructor
     *
     * @param string $date Various date formats
     *
     * @return void
     */
    function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * Converts date to db-format
     *
     * @param string $default_year Default year if current year will not work
     *
     * @return boolean
     */
    function convert2db($default_year = "")
    {
        // @todo Remember to edit both the validator an this class
        $d = "([0-3]?[0-9])";
        $m = "([0-1]?[0-9])";
        $y = "([0-9][0-9][0-9][0-9]|[0-9]?[0-9])";
        $s = "(-|\.|/| )";

        if ($default_year == "") {
            $default_year = date("Y");
        }

        if (ereg("^".$d.$s.$m.$s.$y."$", $this->date, $parts)) {
            // true
        } elseif(ereg("^".$d.$s.$m."$", $this->date, $parts)) {
            $parts[5] = $default_year;
            // true
        } else {
            return false;
        }

        $this->date = $parts[5]."-".$parts[3]."-".$parts[1];
        return true;
    }

    /**
     * Gets the date
     *
     * @return string
     */
    function get()
    {
        return $this->date;
    }
}