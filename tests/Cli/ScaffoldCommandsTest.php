<?php declare(strict_types=1);

namespace MWPD\Scaffold;

use MWPD\Scaffold\Cli\ScaffoldCommands;
use MWPD\Scaffold\Tests\CommandTesterTrait;
use MWPD\Scaffold\Tests\CommandTesterInterface;
use PHPUnit\Framework\TestCase;

class ScaffoldCommandsTest extends TestCase implements CommandTesterInterface
{

    use CommandTesterTrait;

    /**
     * Prepare to test our command file.
     */
    public function setUp(): void
    {
        $this->setupCommandTester('TestFixtureApp', '1.0.0');
    }

    /**
     * Data provider for testScaffoldCommands.
     *
     * Return an array of arrays, each of which contains the data for one test.
     * The parameters in each array should be:
     *
     *   - Expected output strings (actual output must CONTAIN these string);
     *   - Expected function status code;
     *   - Variable argument of arguments to pass to the command.
     *
     * All of the remaining parameters after the first two are interpreted to be the argv value to pass to the command.
     * The application name is automatically unshifted into argv[0] first.
     */
    public function exampleTestCommandParameters()
    {
        return [

            'a plugin can be scaffolded' => [
                "Creating plugin: 'test-plugin'",
                self::STATUS_OK,
                'scaffold:plugin',
                'test-plugin',
            ],
        ];
    }

    /**
     * Test our example command file class. Each time this function is called, it will be passed the expected output and
     * expected status code; the remainder of the arguments passed will be used as $argv.
     *
     * @dataProvider exampleTestCommandParameters
     *
     * @param string|string[] $expectedOutputStrings One or more strings of command output to expect.
     * @param int             $expectedStatus        Command exit status to expect.
     * @param mixed           ...$variable_args      Variable amount of arguments to pass to the command as $argv.
     */
    public function testScaffoldCommands($expectedOutputStrings, $expectedStatus, $variable_args)
    {
        $argv = $this->argv(func_get_args());
        [$actualOutput, $statusCode] = $this->execute($argv, [ScaffoldCommands::class], false);

        $this->assertEquals($expectedStatus, $statusCode);
        foreach ((array)$expectedOutputStrings as $expectedOutput) {
            $this->assertStringContainsString($expectedOutput, $actualOutput);
        }
    }
}
