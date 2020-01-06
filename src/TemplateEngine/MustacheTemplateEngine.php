<?php declare(strict_types=1);

namespace MWPD\Scaffold\TemplateEngine;

use MWPD\Scaffold\TemplateEngine;

final class MustacheTemplateEngine implements TemplateEngine
{

    /**
     * Process tge provided input and run all needed replacements.
     *
     * @param string $input Input to process.
     * @return string Processed output.
     */
    public function process(string $input): string
    {
        return $input;
    }
}
