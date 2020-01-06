<?php declare(strict_types=1);

namespace MWPD\Scaffold\Tests;

use Robo\Robo;
use Robo\Runner;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Utility trait to provide a convenient way of testing Robo commands.
 *
 * @package MWPD\Scaffold\Tests
 */
trait CommandTesterTrait
{

    /** @var string */
    protected $appName;

    /** @var string */
    protected $appVersion;

    /**
     * Instantiate a new runner
     */
    public function setupCommandTester($appName, $appVersion)
    {
        $this->appName    = $appName;
        $this->appVersion = $appVersion;
    }

    /**
     * Prepare our $argv array.
     *
     * Puts the app name in $argv[0] followed by the command name and all command arguments and options.
     *
     * @param array $functionParameters    Should usually be the return value of func_get_args().
     * @param int   $leadingParameterCount The number of function parameters that are NOT part of argv. Default is 2
     *                                     (expected content and expected status code).
     * @return array Array of arguments to pass to the command.
     */
    protected function argv($functionParameters, $leadingParameterCount = 2)
    {
        $argv = $functionParameters;
        $argv = array_slice($argv, $leadingParameterCount);
        array_unshift($argv, $this->appName);

        return $argv;
    }

    /**
     * Simulated front controller.
     *
     * @param array $argv              Array of arguments to pass to the command.
     * @param array $commandClasses    Command classes to register.
     * @param bool  $configurationFile Optional. Configuration file to use.
     * @return array Array with the produced output and the exit status code.
     */
    protected function execute($argv, $commandClasses, $configurationFile = false): array
    {
        // Define a global output object to capture the test results
        $output = new BufferedOutput();

        // We can only call `Runner::execute()` once; then we need to tear down.
        $runner = new Runner($commandClasses);

        if ($configurationFile) {
            $runner->setConfigurationFilename($configurationFile);
        }

        $statusCode = $runner->execute($argv, $this->appName, $this->appVersion, $output);

        // Destroy our container so that we can call $runner->execute() again for the next test.
        Robo::unsetContainer();

        // Return the output and status code.
        return [trim($output->fetch()), $statusCode];
    }
}
