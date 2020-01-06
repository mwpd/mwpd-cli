<?php declare(strict_types=1);

namespace MWPD\Scaffold;

interface TemplateEngine
{

    /**
     * Process tge provided input and run all needed replacements.
     *
     * @param string $input Input to process.
     * @return string Processed output.
     */
    public function process(string $input): string;
}
