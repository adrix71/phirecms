<?php
/**
 * Phire CMS (http://www.phirecms.org/)
 *
 * @link       https://github.com/phirecms/phirecms
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2018 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.phirecms.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Phire\Console\Event;

/**
 * Console event class
 *
 * @category   Phire
 * @package    Phire
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2018 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.phirecms.org/license     New BSD License
 * @version    3.0.0
 */
class Console
{

    /**
     * Display console header
     *
     * @return void
     */
    public static function header()
    {
        $consoleTitle = 'Phire CMS Console (v' . \Phire\Module::VERSION . ')';
        echo PHP_EOL . '    ' . $consoleTitle . PHP_EOL;
        echo '    ' . str_repeat('=', strlen($consoleTitle)) . PHP_EOL . PHP_EOL;
    }

    /**
     * Display console footer
     *
     * @return void
     */
    public static function footer()
    {
        echo PHP_EOL;
    }

}