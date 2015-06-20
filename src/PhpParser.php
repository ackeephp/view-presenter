<?php

namespace Ackee\ViewPresenter;

/**
 * PhpParser
 */
final class PhpParser implements ParserInterface
{
	private $templatesDirectory;

	public function setTemplatesDirectory($directory)
    {
        $this->templatesDirectory = rtrim($directory, DIRECTORY_SEPARATOR)
    }

	private function getTemplatePathname($template)
    {
        return $this->templatesDirectory . DIRECTORY_SEPARATOR .
            ltrim($template, DIRECTORY_SEPARATOR);
    }

	public function render($template, array $data = [])
	{
		$templateFile = $this->getTemplatePathname($template);

		extract($data);
		ob_start();
		require $templateFile;
		return ob_get_clean();
	}
}
