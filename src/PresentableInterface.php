<?php

namespace Ackee\ViewPresenter;

interface PresentableInterface
{
	public function parse($template, array $data = []);
}
