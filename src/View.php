<?php

namespace Ackee\ViewPresenter;

class View
{
    private $parser;
    private $presentable;
    private $fileExt;

    public function __construct(
        ParserInterface $parser,
        PresentableInterface $presentable,
        $config = []
    )
    {
        $this->parser = $parser;
        $this->presentable = $presentable;
        $this->setConfig($config);
    }

    public function presenter($template, $presenter)
    {
        if (! is_array($template)) {
            $template = [$template];
        }

        foreach ($template as $tpl) {
            if ($this->presentable->hasAndInstanceOf($tpl, $presenter)) {
                continue;
            }
            $this->presentable->set($tpl, $presenter);
        }
    }

    public function render($template, array $data = [])
    {
        $presenterKey = $this->parseTemplateName($template);
        $data = $this->presentable->parse($presenterKey, $data);
        return $this->parser->render($template, $data);
    }

    private function parseTemplateName($templateName)
    {
        if (strpos($templateName, $this->fileExt) !== false) {
            $fileInfo = explode($this->fileExt, $templateName);
            $templateName = $fileInfo[0];
        }

        return $templateName;
    }

    private function setConfig(array $config = [])
    {
        $this->fileExt = isset($config['file.ext']) ? $config['file.ext'] : ".php";
    }
}
