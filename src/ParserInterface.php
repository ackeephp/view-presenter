<?php

namespace Ackee\ViewPresenter;

interface ParserInterface
{
	public function render($template, array $data = []);
}
