<?php declare(strict_types=1);

namespace MWPD\Scaffold\Tests;

/**
 * Interface to regroup the known exit status codes that the tested Robo commands can produce.
 *
 * @package MWPD\Scaffold\Tests
 */
interface CommandTesterInterface
{

    const STATUS_OK    = 0;
    const STATUS_ERROR = 1;
}
