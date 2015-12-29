<?php
namespace Nueve\ViewPresenter;

interface PresentableInterface
{
	/**
	 * @param $offset
	 * @param $presenter
	 * @return bool
	 */
	public function hasAndInstanceOf($offset, $presenter);

	/**
	 * @param $offset
	 * @param $value
	 * @return void
	 */
	public function set($offset, $value);

	/**
	 * @param $template
	 * @param array $data
	 * @return array
	 */
	public function parse($template, array $data = []);
}
