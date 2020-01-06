<?php declare(strict_types=1);

namespace MWPD\Scaffold\Cli;

use MWPD\Scaffold\TemplateEngine;
use Robo\Tasks;

final class ScaffoldCommands extends Tasks
{

    /**
     * Template engine to use for scaffolding.
     *
     * @var TemplateEngine
     */
    private $templateEngine;

    /**
     * Instantiate a ScaffoldCommands object.
     */
    public function __construct()
    {
        // @todo This should be injected instead.
        $this->templateEngine = new TemplateEngine\MustacheTemplateEngine();
    }

    /**
     * Scaffold a new plugin.
     *
     * @param string $name Name of the plugin to scaffold.
     */
    public function scaffoldPlugin($name)
    {
        $this->io()->section("Creating plugin: '{$name}'");
    }
}
