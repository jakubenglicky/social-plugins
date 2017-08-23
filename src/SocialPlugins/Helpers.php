<?php

namespace jakubenglicky\SocialPlugins;


class Helpers
{
	/**
	 * @var \Latte\Engine
	 */
	public $latte;

	public function __construct()
	{
		$this->latte = new \Latte\Engine();
	}

	public function getUrl()
	{
		$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		return $actual_link;
	}
}