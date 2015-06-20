<?php

namespace Ackee\ViewPresenter;

/**
 * Presentable
 */
final class Presentable implements PresentableInterface
{
	protected $data = [];

	public function parse($template, array $data = [])
	{
		$presenters = $this->get($template);
        
		foreach ($presenters as $presenter) {
            if (is_string($presenter)) {
                $presenter = new $presenter();
            }

			if ($presenter instanceOf PresenterInterface) {
                $klass = $presenter;
			}

            $presenterData = $klass->data();
			$data = array_merge($data, $presenterData);
		}

		return $data;
	}

	/**
     * @param $offset
     * @param array $default
     * @return array
     */
    public function get($offset, $default = [])
    {
        if (!$this->has($offset)) {
            return $default;
        }
        return $this->data[$offset];
    }

    /**
     * @param $offset
     * @return bool
     */
    public function has($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param string $offset
     * @param string|object $presenter
     * @return bool
     */
    public function hasAndInstanceOf($offset, $presenter)
    {
        if ($this->has($offset)) {
            if (is_string($presenter)) {
                $presenter = new $presenter();
            }

            // get all presenters
            $presenters = $this->get($offset);

            // check if presenter is instance of
            foreach ($presenters as $composr) {
                if ($composr instanceof $presenter) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param $offset
     * @param $value
     */
    public function set($offset, $value)
    {
        if (!$this->has($offset)) {
            $this->data[$offset] = [];
        }
        $this->data[$offset][] = $value;
    }

    /**
     * @param $offset
     */
    public function remove($offset)
    {
        unset($this->data[$offset]);
    }
}
