<?php

namespace jakubenglicky\SocialPlugins;


class Twitter
{
	/**
	 * @var Helpers
	 */
	private $helpers;

	/* Sizes */
	const SIZE_SMALL = 'small';
	const SIZE_LARGE = 'large';

	public function __construct($globalCommentsWidth = 550)
	{
		$this->helpers = new Helpers();
	}

	public function renderJs()
	{
		return $this->helpers->latte->renderToString(__DIR__ . '/templates/twScript.latte');
	}

	public function renderTweetButton($link = NULL, $size = self::SIZE_SMALL)
	{
		if ($link == NULL) {
			$link = $this->helpers->getUrl();
		}

		$parameters = array(
			"link" => $link,
			"size" => $size,
		);

		return $this->helpers->latte->renderToString(__DIR__ . '/templates/twButton.latte', $parameters);
	}
}