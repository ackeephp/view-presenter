<?php
namespace Nueve\ViewPresenter;

interface ParserInterface
{
	public function render($template, array $data = []);
}
