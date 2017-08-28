<?php

namespace jakubenglicky\SocialPlugins;


class Hub
{
	/**
	 * @var Facebook
	 */
	public $fb;

	/**
	 * @var Twitter
	 */
	public $tw;

	public function __construct()
	{
		$this->fb = new Facebook();
		$this->tw = new Twitter();
	}
}
