<?php declare(strict_types=1);

namespace MWPD\Scaffold\TemplateEngine;

use PHPUnit\Framework\TestCase;

final class MustacheTemplateEngineTest extends TestCase
{

    public function testProcess()
    {
        $templateEngine = new MustacheTemplateEngine();
        $this->assertEquals('text', $templateEngine->process('text'));
    }
}
